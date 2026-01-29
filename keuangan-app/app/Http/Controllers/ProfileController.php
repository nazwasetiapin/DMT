<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // =====================
        // UPDATE USERNAME
        // =====================
        $user->username = $request->username;

        // =====================
        // UPDATE FOTO
        // =====================
        if ($request->hasFile('photo')) {

            // hapus foto lama
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }

            $path = $request->file('photo')->store('profile', 'public');
            $user->photo = $path;
        }

        
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui');
    }
}