<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{    public function showLoginForm()
    {
        return view('auth.login');
    }

  public function login(Request $request)
{
    $request->validate([
        'no_wa' => 'required|string|max:20',
        'username' => 'required|string|max:255',
    ]);

    // Ambil user berdasarkan no_wa
    $user = User::where('no_wa', $request->no_wa)->first();

    // Jika user tidak ditemukan
    if (!$user) {
        return back()->withErrors([
            'login' => 'Nomor WA belum terdaftar.',
        ])->with('show_register', true);
    }

    // Jika username tidak cocok
    if ($user->username !== $request->username) {
        return back()->withErrors([
            'login' => 'Username TikTok tidak cocok.',
        ])->with('show_register', true);
    }

    // Jika cocok, login secara manual
    Auth::login($user);

    return redirect()->intended('/dashboard');
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
