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

        // Statistics
        $totalAnggota = Anggota::count();
        $anggotaBaru = Anggota::whereMonth('created_at', now()->month)
                             ->whereYear('created_at', now()->year)
                             ->count();
        $anggotaAktif = Anggota::whereNotNull('npm')->count(); // Semua anggota yang terdaftar
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
            'npm' => 'required|string|unique:anggotas,npm|max:15',
            'nama' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'xp' => 'nullable|integer|min:0|max:10000',
            'level' => 'nullable|integer|min:1|max:20',
            'badge' => 'nullable|string|in:Murid Ilmu,Penuntut Kebaikan,Cendekiawan Islami'
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['xp'] = $validated['xp'] ?? 0;
        $validated['level'] = $validated['level'] ?? 1;

        // Handle file upload
        if ($request->hasFile('profile')) {
            $fileName = time() . '.' . $request->profile->extension();
            $request->profile->move(public_path('uploads/profiles'), $fileName);
            $validated['profile'] = $fileName;
        }

        // Auto set badge based on level if not provided
        if (empty($validated['badge'])) {
            if ($validated['level'] >= 9) {
                $validated['badge'] = 'Cendekiawan Islami';
            } elseif ($validated['level'] >= 5) {
                $validated['badge'] = 'Penuntut Kebaikan';
            } else {
                $validated['badge'] = 'Murid Ilmu';
            }
        }

        $anggota = Anggota::create($validated);

        return redirect()->route('admin.anggota.index')
                        ->with('success', 'Anggota berhasil didaftarkan!');
    }

    public function show(Anggota $anggota)
    {
        return view('admin.anggota.show', compact('anggota'));
    }

    public function edit(Anggota $anggota)
    {
        return view('admin.anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $validated = $request->validate([
            'npm' => ['required', 'string', 'max:15', Rule::unique('anggotas')->ignore($anggota->npm, 'npm')],
            'nama' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'xp' => 'nullable|integer|min:0|max:10000',
            'level' => 'nullable|integer|min:1|max:20',
            'badge' => 'nullable|string|in:Murid Ilmu,Penuntut Kebaikan,Cendekiawan Islami'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Handle file upload
        if ($request->hasFile('profile')) {
            // Delete old profile picture
            if ($anggota->profile && file_exists(public_path('uploads/profiles/' . $anggota->profile))) {
                unlink(public_path('uploads/profiles/' . $anggota->profile));
            }

            $fileName = time() . '.' . $request->profile->extension();
            $request->profile->move(public_path('uploads/profiles'), $fileName);
            $validated['profile'] = $fileName;
        }

        $validated['xp'] = $validated['xp'] ?? $anggota->xp;
        $validated['level'] = $validated['level'] ?? $anggota->level;

        // Auto set badge based on level if not provided
        if (empty($validated['badge'])) {
            if ($validated['level'] >= 9) {
                $validated['badge'] = 'Cendekiawan Islami';
            } elseif ($validated['level'] >= 5) {
                $validated['badge'] = 'Penuntut Kebaikan';
            } else {
                $validated['badge'] = 'Murid Ilmu';
            }
        }

        $anggota->update($validated);

        return redirect()->route('admin.anggota.index')
                        ->with('success', 'Data anggota berhasil diperbarui!');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();

        return redirect()->route('admin.anggota.index')
                        ->with('success', 'Anggota berhasil dihapus!');
    }

    public function toggleStatus(Anggota $anggota)
    {
        // Karena tidak ada field status_aktif, kita bisa menggunakan alternatif
        // Misalnya soft delete atau field lain, tapi untuk sementara kita hapus method ini

        return redirect()->back()
                        ->with('info', 'Fitur toggle status belum tersedia!');
    }
}
