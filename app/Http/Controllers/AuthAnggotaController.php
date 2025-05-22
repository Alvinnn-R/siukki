<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAnggotaController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-anggota');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'npm'      => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::guard('anggota')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'npm' => 'NPM atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('anggota')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
