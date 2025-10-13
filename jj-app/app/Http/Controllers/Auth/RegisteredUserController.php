<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    /**
     * Tampilkan form registrasi.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi pengguna.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_wa'     => ['required', 'string', 'max:20', 'unique:users,no_wa'],
            'username'  => ['required', 'string', 'max:255', 'unique:users,username'],
            'username2' => ['nullable', 'string', 'max:255'],
        ]);

        $user = User::create([
            'no_wa'     => $request->no_wa,
            'username'  => $request->username,
            'username2' => $request->username2,
            'password'  => Hash::make('default_password'), // password default (tidak dari input form)
        ]);

        Auth::login($user);

        return redirect()->intended('/dashboard'); // arahkan ke halaman sesuai kebutuhanmu
    }
}
