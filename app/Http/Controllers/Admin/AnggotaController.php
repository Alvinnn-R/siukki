<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AnggotaController extends Controller
{
    public function index(Request $request)
    {
        $query = Anggota::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('npm', 'like', "%{$search}%");
            });
        }

        // Filter by level
        if ($request->filled('level')) {
            $query->where('level', $request->level);
        }

        // Filter by badge
        if ($request->filled('badge')) {
            $query->where('badge', $request->badge);
        }

        $anggota = $query->orderBy('created_at', 'desc')->paginate(10);

        // Statistics dengan relasi yang benar
        $totalAnggota = Anggota::count();
        $anggotaBaru  = Anggota::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $anggotaAktif = Anggota::whereHas('aktivitas', function ($query) {
            $query->whereMonth('tanggal', now()->month);
        })->count();
        $totalBadges = Anggota::distinct('badge')->whereNotNull('badge')->count();

        return view('admin.anggota.index', compact(
            'anggota',
            'totalAnggota',
            'anggotaBaru',
            'anggotaAktif',
            'totalBadges'
        ));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'npm'             => 'required|string|unique:anggotas,npm|max:15',
            'nama'            => 'required|string|max:255',
            'password'        => 'required|string|min:8|confirmed',
            'selected_avatar' => 'nullable|string',
            'profile_type'    => 'required|string|in:default,avatar,upload',
            'profile_upload'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'xp'              => 'nullable|integer|min:0|max:10000',
            'level'           => 'nullable|integer|min:1|max:20',
            'badge'           => 'nullable|string|in:Murid Ilmu,Penuntut Kebaikan,Cendekiawan Islami',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['xp']       = $validated['xp'] ?? 0;
        $validated['level']    = $validated['level'] ?? 1;

        // Handle profile image based on type
        $profileImage         = $this->handleProfileImage($request, $validated);
        $validated['profile'] = $profileImage;

        // Auto set badge based on level if not provided
        if (empty($validated['badge'])) {
            $validated['badge'] = $this->getDefaultBadge($validated['level']);
        }

        // Remove fields that are not in database
        unset($validated['selected_avatar'], $validated['profile_type'], $validated['profile_upload']);

        $anggota = Anggota::create($validated);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil didaftarkan!');
    }

    public function show(Anggota $anggota)
    {
        $anggota->load('aktivitas.misi');
        return view('admin.anggota.show', compact('anggota'));
    }

    public function edit(Anggota $anggota)
    {
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $validated = $request->validate([
            'npm'             => ['required', 'string', 'max:15', Rule::unique('anggotas')->ignore($anggota->npm, 'npm')],
            'nama'            => 'required|string|max:255',
            'password'        => 'nullable|string|min:8|confirmed',
            'selected_avatar' => 'nullable|string',
            'profile_type'    => 'required|string|in:default,avatar,upload',
            'profile_upload'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'xp'              => 'nullable|integer|min:0|max:10000',
            'level'           => 'nullable|integer|min:1|max:20',
            'badge'           => 'nullable|string|in:Murid Ilmu,Penuntut Kebaikan,Cendekiawan Islami',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Handle profile image based on type
        $profileImage = $this->handleProfileImage($request, $validated, $anggota);
        if ($profileImage !== null) {
            $validated['profile'] = $profileImage;
        }

        $validated['xp']    = $validated['xp'] ?? $anggota->xp;
        $validated['level'] = $validated['level'] ?? $anggota->level;

        // Auto set badge based on level if not provided
        if (empty($validated['badge'])) {
            $validated['badge'] = $this->getDefaultBadge($validated['level']);
        }

        // Remove fields that are not in database
        unset($validated['selected_avatar'], $validated['profile_type'], $validated['profile_upload']);

        $anggota->update($validated);

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy(Anggota $anggota)
    {
        // Delete profile picture if it's an uploaded file (not avatar)
        if ($anggota->profile && $this->isUploadedFile($anggota->profile)) {
            $filePath = public_path('uploads/profiles/' . $anggota->profile);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $anggota->delete();

        return redirect()->route('admin.anggota.index')
            ->with('success', 'Anggota berhasil dihapus!');
    }

    /**
     * Handle profile image based on the selected type
     */
    private function handleProfileImage(Request $request, array $validated, Anggota $anggota = null)
    {
        $profileType = $validated['profile_type'];

        switch ($profileType) {
            case 'avatar':
                // Selected avatar from predefined list
                if (! empty($validated['selected_avatar'])) {
                    // Clean up old uploaded file if switching from upload to avatar
                    if ($anggota && $anggota->profile && $this->isUploadedFile($anggota->profile)) {
                        $oldFilePath = public_path('uploads/profiles/' . $anggota->profile);
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath);
                        }
                    }
                    return $validated['selected_avatar'];
                }
                break;

            case 'upload':
                // Handle file upload
                if ($request->hasFile('profile_upload')) {
                    // Delete old uploaded file
                    if ($anggota && $anggota->profile && $this->isUploadedFile($anggota->profile)) {
                        $oldFilePath = public_path('uploads/profiles/' . $anggota->profile);
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath);
                        }
                    }

                    $fileName = time() . '.' . $request->profile_upload->extension();
                    $request->profile_upload->move(public_path('uploads/profiles'), $fileName);
                    return $fileName;
                }
                break;

            case 'default':
            default:
                // Use default avatar
                if ($anggota && $anggota->profile && $this->isUploadedFile($anggota->profile)) {
                    $oldFilePath = public_path('uploads/profiles/' . $anggota->profile);
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath);
                    }
                }
                return 'Avater.png'; // Default avatar filename
        }

        // Return null if no changes needed (for updates)
        return $anggota ? null : 'Avater.png';
    }

    /**
     * Check if the profile image is an uploaded file (not a predefined avatar)
     */
    private function isUploadedFile($filename)
    {
        // Check if it's not a predefined avatar
        $predefinedAvatars = [
            'Avater.png',
            'avatar/1_boy.jpeg', 'avatar/2_boy.jpeg', 'avatar/3_boy.jpeg', 'avatar/4_boy.jpeg', 'avatar/5_boy.jpeg',
            'avatar/6_boy.jpeg', 'avatar/7_boy.jpeg', 'avatar/8_boy.jpeg', 'avatar/9_boy.jpeg', 'avatar/10_boy.jpeg',
            'avatar/1_girl.jpeg', 'avatar/2_girl.jpeg', 'avatar/3_girl.jpeg', 'avatar/4_girl.jpeg', 'avatar/5_girl.jpeg',
            'avatar/6_girl.jpeg', 'avatar/7_girl.jpeg', 'avatar/8_girl.jpeg', 'avatar/9_girl.jpeg', 'avatar/10_girl.jpeg',
        ];

        return ! in_array($filename, $predefinedAvatars);
    }

    /**
     * Get default badge based on level
     */
    private function getDefaultBadge($level)
    {
        if ($level >= 9) {
            return 'Cendekiawan Islami';
        } elseif ($level >= 5) {
            return 'Penuntut Kebaikan';
        } else {
            return 'Murid Ilmu';
        }
    }

    /**
     * Get profile image URL for display
     */
    public static function getProfileImageUrl($profile)
    {
        if (! $profile) {
            return asset('assets/images/Avater.png');
        }

        // Check if it's a predefined avatar
        $predefinedAvatars = [
            'Avater.png',
            'avatar/1_boy.jpeg', 'avatar/2_boy.jpeg', 'avatar/3_boy.jpeg', 'avatar/4_boy.jpeg', 'avatar/5_boy.jpeg',
            'avatar/6_boy.jpeg', 'avatar/7_boy.jpeg', 'avatar/8_boy.jpeg', 'avatar/9_boy.jpeg', 'avatar/10_boy.jpeg',
            'avatar/1_girl.jpeg', 'avatar/2_girl.jpeg', 'avatar/3_girl.jpeg', 'avatar/4_girl.jpeg', 'avatar/5_girl.jpeg',
            'avatar/6_girl.jpeg', 'avatar/7_girl.jpeg', 'avatar/8_girl.jpeg', 'avatar/9_girl.jpeg', 'avatar/10_girl.jpeg',
        ];

        if (in_array($profile, $predefinedAvatars)) {
            return asset('assets/images/' . $profile);
        } else {
            // It's an uploaded file
            return asset('uploads/profiles/' . $profile);
        }
    }
}
