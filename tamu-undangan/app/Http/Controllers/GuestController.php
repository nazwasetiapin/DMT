<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class GuestController extends Controller
{
    // halaman admin data tamu (akses lewat /data)
    public function data(Request $request)
{
    $query = Guest::query();

    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $guests = $query->latest()->paginate(10)->withQueryString();

    //hitung total uang
    $totalCash = Guest::sum('cash_amount');
    $totalTransfer = Guest::sum('transfer_amount');
    $totalUang = $totalCash + $totalTransfer;

    return view('admin.data', compact('guests', 'totalCash', 'totalTransfer', 'totalUang'));
}

  public function album(Request $request)
{
    $guests = Guest::when($request->search, fn($q) => 
                    $q->where('name', 'like', '%'.$request->search.'%'))
                ->latest()
                ->paginate(10);

    // Kalau AJAX → balikin JSON
    if ($request->ajax()) {
        return response()->json([
            'html'    => view('guests.partials.album-rows', compact('guests'))->render(),
            'hasMore' => $guests->hasMorePages(),
        ]);
    }

    // Kalau bukan AJAX → render full view
    return view('guests.album', compact('guests'));
}


    // tampilkan form undangan
    public function create()
    {
        return view('guests.create');
    }

    // simpan data tamu
public function store(Request $request)
{
    $request->validate([
        'name'      => 'required|string|max:255',
        'whatsapp'  => 'required|string|max:20|unique:guests,whatsapp',
        'address'   => 'required|string|max:255',
        'message'   => 'required|string',
        'gift_type' => 'required|in:transfer,cash,barang',
        'cash_amount'     => 'nullable|string',
        'transfer_amount' => 'nullable|string',
        'transfer_method' => 'nullable|string|max:100',
        'barang_name'     => 'nullable|string|max:255',
        'photo'     => 'nullable|image|max:10048',
        'proof'     => 'nullable|image|max:10048',
    ], [
        'whatsapp.unique' => 'Nomor WhatsApp sudah digunakan.',
    ]);

    // helper untuk hapus Rp, titik, spasi → jadi integer
    $cleanRupiah = function ($value) {
        return $value ? (int) str_replace(['Rp', '.', ' '], '', $value) : 0;
    };

    // ambil data dasar
    $data = $request->only(['name', 'whatsapp', 'address', 'message', 'gift_type']);

    // isi sesuai gift_type
    if ($request->gift_type === 'cash') {
        $data['cash_amount'] = $cleanRupiah($request->cash_amount);
    } elseif ($request->gift_type === 'transfer') {
        $data['transfer_amount'] = $cleanRupiah($request->transfer_amount);
        $data['transfer_method'] = $request->transfer_method ?? 'lainnya';
    } elseif ($request->gift_type === 'barang') {
        $data['barang_name'] = $request->barang_name ?? 'tidak ada';
    }

    // upload bukti transfer
    if ($request->hasFile('proof')) {
        $data['proof'] = $request->file('proof')->store('proofs', 'public');
    }

    // upload foto tamu
    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('guests', 'public');
    }

    Guest::create($data);

    return redirect()->route('guests.thankyou')->with('success', 'Data tamu berhasil dikirim!');
}


    // halaman terima kasih
    public function thankyou()
    {
        return view('guests.thankyou');
    }

    // monitor ucapan di layar
    public function monitor()
    {
        $guests = Guest::latest()->get();
        return view('guests.monitor', compact('guests'));
    }

    public function destroy(Guest $guest)
    {
        // hapus file foto kalau ada
        if ($guest->photo && Storage::disk('public')->exists($guest->photo)) {
            Storage::disk('public')->delete($guest->photo);
        }

        // hapus bukti transfer kalau ada
        if ($guest->proof && Storage::disk('public')->exists($guest->proof)) {
            Storage::disk('public')->delete($guest->proof);
        }

        $guest->delete();

        return redirect()->route('guests.data')->with('success', 'Data tamu berhasil dihapus.');
    }

    // export pdf album

    public function exportPdfAlbum()
    {
        $guests = Guest::latest()->get();

        $pdf = Pdf::loadView('guests.export_pdf_album', compact('guests'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('album_buku_tamu.pdf');
    }

    // export pdf data
public function exportPdfData()
{
    // urutkan hanya berdasarkan nama
    $guests = Guest::orderBy('name', 'asc')->get();

    $pdf = Pdf::loadView('guests.export_pdf_data', compact('guests'))
        ->setPaper('a4', 'portrait');

    return $pdf->download('data.pdf');
}


}
