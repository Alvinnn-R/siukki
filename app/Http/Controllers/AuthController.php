<?php
namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\UserAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'password'   => 'required|string',
        ]);

        $identifier = $request->input('identifier');
        $password   = $request->input('password');

        // Cek apakah identifier seperti npm (angka dan panjang 15)
        if (strlen($identifier) === 15 && ctype_digit($identifier)) {
            $user = Anggota::where('npm', $identifier)->first();

            if ($user && password_verify($password, $user->password)) {
                Auth::guard('anggota')->login($user);
                Session::put('role', 'anggota');
                return redirect()->intended(route('dashboard'));
            }
        } else {
            $admin = UserAdmin::where('id_admin', $identifier)->first();

            if ($admin && password_verify($password, $admin->password)) {
                Auth::guard('admin')->login($admin);
                Session::put('role', 'admin');
                return redirect()->intended(route('dashboard'));
            }
        }

        return back()->withErrors(['identifier' => 'NPM/ID Admin atau password salah']);
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect()->route('login');
    }
}
