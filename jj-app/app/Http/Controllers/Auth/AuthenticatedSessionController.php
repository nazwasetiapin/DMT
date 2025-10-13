<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validasi input login
        $request->validate([
            'no_wa' => ['required', 'string'],
            'username' => ['required', 'string'],
        ]);

        // Coba cari user berdasarkan no_wa dan username
        $user = User::firstOrCreate(
            [
                'no_wa' => $request->no_wa,
                'username' => $request->username,
            ],
            [
                // Ini optional, password default walaupun tidak digunakan
                'password' => bcrypt('default'),
            ]
        );

        // Login manual
        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        // Redirect ke dashboard
        return redirect()->intended('/dashboard');
    }

    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
