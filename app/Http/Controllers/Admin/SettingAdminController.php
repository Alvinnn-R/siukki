<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.setting', compact('admin'));
    }

    public function updateUsername(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $admin       = Auth::guard('admin')->user();
        $admin->nama = $request->name;
        $admin->save();

        return response()->json(['success' => true]);
    }

    public function updatePassword(Request $request)
    {
        $messages = [
            'current_password.required'      => 'Password saat ini wajib diisi.',
            'new_password.required'          => 'Password baru wajib diisi.',
            'new_password.min'               => 'Password baru harus mengandung setidaknya 8 karakter.',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
            'password_confirmation.same'     => 'Konfirmasi password harus sama dengan password baru.',
        ];

        // Validasi input dari form
        $request->validate([
            'current_password'      => 'required',
            'new_password'          => 'required|min:8',
            'password_confirmation' => 'required|same:new_password',
        ], $messages);

        // Ambil data admin yang sedang login
        $admin = Auth::guard('admin')->user();

        // Cek apakah password saat ini benar
        if (! Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah']);
        }

        // Cek apakah password baru dan konfirmasi password cocok
        if ($request->new_password !== $request->password_confirmation) {
            return back()->withErrors(['password_confirmation' => 'Password baru dan konfirmasi password tidak cocok']);
        }

        // Perbarui password
        $admin->password = Hash::make($request->new_password);
        $admin->save();

        // Kirim pesan keberhasilan setelah password berhasil diubah
        return back()->with('success', 'Password berhasil diperbarui!');
    }
}
