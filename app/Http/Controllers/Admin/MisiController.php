<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Misi;
use Illuminate\Http\Request;

class MisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Misi::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_misi', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('xp_reward', 'like', "%{$search}%");
            });
        }

        // Filter by tipe_misi
        if ($request->filled('tipe_misi')) {
            $query->where('tipe_misi', $request->tipe_misi);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // PERBAIKAN UTAMA: Gunakan query yang sudah difilter, bukan query baru
        $misis = $query->orderBy('created_at', 'desc')->paginate(10);

        // Tambahkan parameter request ke pagination links
        $misis->appends($request->all());

        // Data untuk statistik (opsional)
        $misisAktif  = Misi::where('status', 'aktif')->count();
        $misisHarian = Misi::where('tipe_misi', 'harian')->count();
        $misisEvent  = Misi::where('tipe_misi', 'event')->count();

        return view('admin.misi.index', compact('misis', 'misisAktif', 'misisHarian', 'misisEvent'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.misi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_misi'       => 'required|string|max:255',
            'deskripsi'       => 'nullable|string',
            'xp_reward'       => 'required|integer|min:0',
            'tipe_misi'       => 'required|in:harian,mingguan,event',
            'status'          => 'required|in:aktif,nonaktif',
            'jadwal'          => 'required|date',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'icon'            => 'nullable|image|mimes:svg,png,jpg,jpeg|max:2048',
        ]);

        $data = $request->all();

        // Upload icon jika ada
        if ($request->hasFile('icon')) {
            $iconName = time() . '.' . $request->file('icon')->getClientOriginalExtension();
            $request->file('icon')->move(public_path('assets/icons'), $iconName);
            $data['icon'] = pathinfo($iconName, PATHINFO_FILENAME);
        }

        Misi::create($data);

        return redirect()->route('admin.misi.index')
            ->with('success', 'Misi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Misi $misi)
    {
        return view('admin.misi.show', compact('misi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Misi $misi)
    {
        return view('admin.misi.edit', compact('misi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Misi $misi)
    {
        $request->validate([
            'nama_misi'       => 'required|string|max:255',
            'deskripsi'       => 'nullable|string',
            'xp_reward'       => 'required|integer|min:0',
            'tipe_misi'       => 'required|in:harian,mingguan,event',
            'status'          => 'required|in:aktif,nonaktif',
            'jadwal'          => 'required|date',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'icon'            => 'nullable|image|mimes:svg,png,jpg,jpeg|max:2048',
        ]);

        $data = $request->all();

        // Upload icon baru jika ada
        if ($request->hasFile('icon')) {
            // Hapus icon lama jika ada
            if ($misi->icon) {
                $oldIconPath    = public_path('assets/icons/' . $misi->icon . '.svg');
                $oldIconPathPng = public_path('assets/icons/' . $misi->icon . '.png');
                $oldIconPathJpg = public_path('assets/icons/' . $misi->icon . '.jpg');

                if (file_exists($oldIconPath)) {
                    unlink($oldIconPath);
                }

                if (file_exists($oldIconPathPng)) {
                    unlink($oldIconPathPng);
                }

                if (file_exists($oldIconPathJpg)) {
                    unlink($oldIconPathJpg);
                }

            }

            $iconName = time() . '.' . $request->file('icon')->getClientOriginalExtension();
            $request->file('icon')->move(public_path('assets/icons'), $iconName);
            $data['icon'] = pathinfo($iconName, PATHINFO_FILENAME);
        }

        $misi->update($data);

        return redirect()->route('admin.misi.index')
            ->with('success', 'Misi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Misi $misi)
    {
        // Hapus icon jika ada
        if ($misi->icon) {
            $iconExtensions = ['svg', 'png', 'jpg', 'jpeg'];
            foreach ($iconExtensions as $ext) {
                $iconPath = public_path('assets/icons/' . $misi->icon . '.' . $ext);
                if (file_exists($iconPath)) {
                    unlink($iconPath);
                    break;
                }
            }
        }

        $misi->delete();

        return redirect()->route('admin.misi.index')
            ->with('success', 'Misi berhasil dihapus.');
    }

    /**
     * Toggle status misi (aktif/nonaktif)
     */
    public function toggleStatus(Misi $misi)
    {
        $misi->status = $misi->status === 'aktif' ? 'nonaktif' : 'aktif';
        $misi->save();

        return redirect()->back()
            ->with('success', 'Status misi berhasil diubah.');
    }
}
