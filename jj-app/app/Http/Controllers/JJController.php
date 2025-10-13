<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JJModel;
use App\Http\Controllers\Create;

class JJController extends Controller
{
    // Menampilkan form input JJ
    public function form()
    {
        return view('jj.form');
    }
 
public function createFoto()
{
    return view('jj.form_foto');
}

public function createVideo()
{
    return view('jj.form_video');
}
public function createVideoGratis()
{
    return view('jj.form_video_gratis');
}


    // Menyimpan data JJ ke database
    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal'   => 'required|date',
        ]);

        JJModel::create([
            'user_id'   => auth()->id(),
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal'   => $request->tanggal,
        ]);
        

        return redirect()->route('dashboard')->with('success', 'Data JJ berhasil disimpan!');
    }
}
