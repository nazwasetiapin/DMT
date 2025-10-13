<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use Illuminate\Support\Facades\Storage;

class AdminUploadController extends Controller
{
    /**
     * Tampilkan semua upload dari semua user
     */
    public function index()
    {
        $uploads = Upload::with('user')->latest()->get();
        return view('admin.uploads.index', compact('uploads'));
    }

    /**
     * Tampilkan form edit status dan file hasil
     */
    public function edit($id)
    {
        $upload = Upload::with('user')->findOrFail($id);
        return view('admin.uploads.edit', compact('upload'));
    }

    /**
     * Update status dan upload file hasil
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:tunggu,proses,selesai',
            'processed_file' => 'nullable|file|mimes:zip,rar,mp4,mkv,mov,avi,pdf,docx,xlsx,jpg,jpeg,png|max:51200',
        ]);

        $upload = Upload::findOrFail($id);
        $upload->status = $request->status;

        if ($request->hasFile('processed_file')) {
            if ($upload->processed_file && Storage::disk('public')->exists($upload->processed_file)) {
                Storage::disk('public')->delete($upload->processed_file);
            }

            $path = $request->file('processed_file')->store('uploads/hasil', 'public');
            $upload->processed_file = $path;
        }

        $upload->save();

        return redirect()->route('admin.uploads.index')->with('success', 'Upload berhasil diperbarui.');
    }
}
