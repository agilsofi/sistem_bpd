<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $username = $request->username;
        $user = \App\Models\User::where('username', $username)->first();

        if (!$user) {
            return back()->withErrors([
                'username' => 'User tidak ditemukan.',
            ])->withInput($request->only('username'));
        }

        if ($user->status !== 'aktif') {
            return back()->withErrors([
                'username' => 'Akun tidak aktif. Silakan hubungi administrator.',
            ]);
        }

        $credentials = $request->only('username', 'password');
        $credentials['status'] = 'aktif';

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'password' => 'Password salah.',
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
