<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    // Menampilkan daftar upload milik user login
    public function index()
    {
        $uploads = Upload::where('user_id', auth()->id())->latest()->get();
        return view('uploads.index', compact('uploads'));
    }

    // Menyimpan file upload dan bukti pembayaran
    public function store(Request $request)
    {
        $isArray = is_array($request->file('file'));

        $request->validate([
            'type'         => 'required|in:foto,video',
            'file'         => $isArray ? 'required|array' : 'required|file',
            'file.*'       => $isArray ? 'required|file' : '',
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:102400',
            'request_note' => 'nullable|string|max:1000',
        ]);

        $type = $request->input('type');
        $files = $isArray ? $request->file('file') : [$request->file('file')];
        $bukti = $request->file('bukti');

        foreach ($files as $file) {
            // Validasi tipe file
            if ($type === 'foto') {
                if (!str_starts_with($file->getMimeType(), 'image/')) {
                    return back()->withErrors(['file' => 'Semua file harus berupa gambar jika jenis upload adalah foto.']);
                }

                // Maksimal 10MB untuk foto (default)
                if ($file->getSize() > 10 * 1024 * 1024) {
                    return back()->withErrors(['file' => 'Ukuran gambar maksimal 10 MB per file.']);
                }
            }

            if ($type === 'video') {
                if (!str_starts_with($file->getMimeType(), 'video/')) {
                    return back()->withErrors(['file' => 'Semua file harus berupa video jika jenis upload adalah video.']);
                }

                // Maksimal 2MB untuk video
                // if ($file->getSize() > 2 * 1024 * 1024) {
                //     return back()->withErrors(['file' => 'Ukuran video maksimal 2 MB per file.']);
                // }

                // NOTE: Validasi durasi video maksimal 25 detik dilakukan via JavaScript di form
            }
        }

        $buktiPath = $bukti ? $bukti->store('uploads/bukti', 'public') : null;
        $fileFolder = $type === 'foto' ? 'uploads/foto' : 'uploads/video';
       $harga = $request->has('is_free') ? 0 : ($type === 'foto' ? 15000 : 10000);


        foreach ($files as $file) {
            $filePath = $file->store($fileFolder, 'public');

            Upload::create([
                'user_id'      => Auth::id(),
                'type'         => $type,
                'file'         => $filePath,
                'request_note' => $request->request_note,
                'bukti'        => $buktiPath,
                'harga'        => $harga,
            ]);
        }

        return redirect()->route('dashboard')->with('success', "Berhasil mengupload $type. Biaya: Rp " . number_format($harga, 0, ',', '.'));
    }
}
