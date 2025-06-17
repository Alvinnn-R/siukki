<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingAnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $anggota = Auth::guard('anggota')->user();
        return view('anggota.setting', compact('anggota'));
    }

    public function updateProfile(Request $request)
    {

        $anggota = Auth::guard('anggota')->user();

        // Simpan langsung string preset avatar
        if ($request->filled('profile')) {
            $anggota->profile = $request->profile;
        }

        $anggota->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function removeImage()
    {
        $user = Auth::guard('anggota')->user();

        // Set profile ke default avatar
        $user->profile = null;
        $user->save();

        return back()->with('success', 'Foto Profil Berhasil Dihapus!');
    }

    public function updateUsername(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $anggota       = Auth::guard('anggota')->user();
        $anggota->nama = $request->name;
        $anggota->save();

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

        // Ambil data user yang sedang login
        $user = Auth::user();

        // Cek apakah password saat ini benar
        if (! Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password saat ini salah']);
        }

        // Cek apakah password baru dan konfirmasi password cocok
        if ($request->new_password !== $request->password_confirmation) {
            return back()->withErrors(['password_confirmation' => 'Password baru dan konfirmasi password tidak cocok']);
        }

        // Perbarui password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Kirim pesan keberhasilan setelah password berhasil diubah
        return back()->with('success', 'Password berhasil diperbarui!');
    }

}
