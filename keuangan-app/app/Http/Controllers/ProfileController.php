<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        // 🔹 Beda tampilan berdasarkan role
        if ($user->role === 'ceo') {
            return view('profile.ceo', ['user' => $user]);
        }

        // 🔹 Default untuk admin
        return view('profile.admin', ['user' => $user]);
    }

    /**
     * Update data profil user.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'username' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update nama
        $user->username = $request->username;

        // Update foto kalau ada
        if ($request->hasFile('photo')) {
            // Hapus foto lama (kalau ada)
            if ($user->photo && Storage::exists('public/' . $user->photo)) {
                Storage::delete('public/' . $user->photo);
            }

            // Simpan foto baru
            $path = $request->file('photo')->store('photos', 'public');
            $user->photo = $path;
        }

        $user->save();

        auth()->setUser($user);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Hapus akun user.
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
