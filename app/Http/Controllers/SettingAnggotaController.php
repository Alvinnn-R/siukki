<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

        $anggota = Auth::guard('anggota')->user();
        $anggota->nama = $request->name;
        $anggota->save();

        return response()->json(['success' => true]);
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully!');
    }

    public function updateNotificationSettings(Request $request)
    {
        $user = Auth::user();
        $user->notifications_enabled = $request->has('notifications_enabled');
        $user->save();

        return back()->with('success', 'Notification settings updated successfully!');
    }
}