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
        $user = Auth::user();
        return view('anggota.setting', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = Auth::user();
        
        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::delete('public/' . $user->profile_image);
            }
            
            // Store new image
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $imagePath;
        }

        $user->username = $request->username;
        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }

    public function removeProfileImage()
    {
        $user = Auth::user();
        
        if ($user->profile_image) {
            Storage::delete('public/' . $user->profile_image);
            $user->profile_image = null;
            $user->save();
        }

        return back()->with('success', 'Profile image removed successfully!');
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

    public function updateBadge(Request $request)
    {
        $request->validate([
            'badge' => 'required|string|max:50'
        ]);

        $user = Auth::user();
        $user->badge = $request->badge;
        $user->save();

        return back()->with('success', 'Badge updated successfully!');
    }

    public function updateNotificationSettings(Request $request)
    {
        $user = Auth::user();
        $user->notifications_enabled = $request->has('notifications_enabled');
        $user->save();

        return back()->with('success', 'Notification settings updated successfully!');
    }
}