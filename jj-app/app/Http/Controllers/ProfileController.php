<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller
{
    /**
     * Tampilkan form edit profil.
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update data profil (WA & TikTok).
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'no_wa' => 'required|string|max:20',
            'username' => 'nullable|string|max:255',
            'username2' => 'nullable|string|max:255',
        ]);

        $user = $request->user();
        $user->no_wa = $request->no_wa;
        $user->username = $request->username;
        $user->username2 = $request->username2;
        $user->save();

        return Redirect::route('dashboard')->with('success', 'Profil berhasil diperbarui.');
    }

    /**
     * Hapus akun (jika ingin tetap disediakan).
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
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
