<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-admin');
    }

    public function login(Request $request)
    {
        // Validasi input - sesuaikan dengan field yang ada
        $request->validate([
            'id_admin' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = [
            'id_admin' => $request->id_admin,
            'password' => $request->password,
        ];

        // Attempt login dengan guard admin
        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('admin.dashboard'))
                ->with('success', 'Login berhasil! Selamat datang di Admin Panel.');
        }

        return back()->withErrors([
            'id_admin' => 'ID Admin atau password salah.',
        ])->onlyInput('id_admin');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')
            ->with('success', 'Anda telah logout dari Admin Panel.');
    }
}
