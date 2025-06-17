@extends('layouts.app')

@section('title', 'Tambah Misi Baru - Admin SiUKKI')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
    <!-- Page Header -->
    <div class="section-header">
        <h2>
            <i class="material-icons me-3" style="font-size: 2rem;">add_circle</i>
            Tambah Misi Baru
        </h2>
    </div>

    <!-- Info Box -->
    <div class="misi-section-box">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-2">Form Tambah Misi UKKI</h5>
                <p class="mb-0 text-muted">Buat misi baru untuk anggota UKKI. Misi dapat berupa harian atau event
                    spesial dengan XP reward.</p>
            </div>
            <a href="{{ route('admin.misi.index') }}" class="btn btn-outline-secondary">
                <i class="material-icons me-1" style="font-size: 18px;">arrow_back</i>
                Kembali ke Daftar
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="material-icons me-2" style="vertical-align: middle;">error</i>
            <strong>Terdapat kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.misi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Alert Info -->
        <div class="alert alert-info-custom" role="alert">
            <i class="material-icons me-2" style="vertical-align: middle;">info</i>
            <strong>Informasi:</strong> Misi yang sudah dibuat akan muncul di dashboard anggota sesuai dengan periode yang
            ditentukan.
        </div>

        <!-- Data Misi Section -->
        <div class="form-section">
            <div class="section-title">
                <i class="material-icons me-2">assignment</i>
                <h5 class="mb-0">Informasi Misi</h5>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nama_misi" class="form-label fw-semibold">Nama Misi <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama_misi') is-invalid @enderror" id="nama_misi"
                        name="nama_misi" value="{{ old('nama_misi') }}" placeholder="Contoh: Menghadiri Kajian Rutin"
                        required>
                    @error('nama_misi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tipe_misi" class="form-label fw-semibold">Tipe Misi <span
                            class="text-danger">*</span></label>
                    <select class="form-select @error('tipe_misi') is-invalid @enderror" id="tipe_misi" name="tipe_misi"
                        required>
                        <option value="">Pilih tipe misi</option>
                        <option value="harian" {{ old('tipe_misi') == 'harian' ? 'selected' : '' }}>Harian</option>
                        {{-- <option value="mingguan" {{ old('tipe_misi') == 'mingguan' ? 'selected' : '' }}>Mingguan</option> --}}
                        <option value="event" {{ old('tipe_misi') == 'event' ? 'selected' : '' }}>Event</option>
                    </select>
                    @error('tipe_misi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Misi harian dapat diulang setiap hari dan event hanya sekali dalam
                        periode</div>
                </div>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label fw-semibold">Deskripsi Misi</label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3"
                    placeholder="Jelaskan detail misi ini (opsional)">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="xp_reward" class="form-label fw-semibold">XP Reward <span
                            class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('xp_reward') is-invalid @enderror" id="xp_reward"
                        name="xp_reward" value="{{ old('xp_reward', 50) }}" min="0" max="1000" required>
                    @error('xp_reward')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">XP yang akan diterima anggota</div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="status" class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status"
                        required>
                        <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="icon" class="form-label fw-semibold">Icon Misi</label>
                    <input type="file" class="form-control @error('icon') is-invalid @enderror" id="icon"
                        name="icon" accept="image/*">
                    @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Format: JPG, PNG, SVG, WEBP (Maks: 2MB)</div>
                </div>
            </div>
        </div>

        <!-- Periode Misi Section -->
        <div class="form-section">
            <div class="section-title">
                <i class="material-icons me-2">calendar_today</i>
                <h5 class="mb-0">Periode Misi</h5>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="jadwal" class="form-label fw-semibold">Jadwal <span
                            class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('jadwal') is-invalid @enderror" id="jadwal"
                        name="jadwal" value="{{ old('jadwal') }}" required>
                    @error('jadwal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Tanggal pelaksanaan misi</div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="tanggal_mulai" class="form-label fw-semibold">Tanggal Mulai <span
                            class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                        id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}" required>
                    @error('tanggal_mulai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="tanggal_selesai" class="form-label fw-semibold">Tanggal Selesai <span
                            class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                        id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}" required>
                    @error('tanggal_selesai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="alert alert-info-custom">
                <i class="material-icons me-2" style="vertical-align: middle;">info</i>
                <strong>Tips:</strong>
                <ul class="mb-0 mt-2">
                    <li>Misi harian biasanya memiliki periode 1 hari</li>
                    {{-- <li>Misi mingguan memiliki periode 7 hari</li> --}}
                    <li>Misi event dapat memiliki periode custom sesuai kebutuhan</li>
                </ul>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="misi-section-box">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Simpan Misi</h6>
                    <p class="mb-0 text-muted">Pastikan semua data sudah benar sebelum menyimpan</p>
                </div>
                <div class="d-flex gap-3">
                    <a href="{{ route('admin.misi.index') }}" class="btn btn-outline-secondary">
                        <i class="material-icons me-1" style="font-size: 18px;">cancel</i>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-success-custom">
                        <i class="material-icons me-1" style="font-size: 18px;">save</i>
                        Simpan Misi
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        // Auto set tanggal selesai berdasarkan tipe misi
        document.getElementById('tipe_misi').addEventListener('change', function() {
            const tipe = this.value;
            const tanggalMulai = document.getElementById('tanggal_mulai').value;

            if (tanggalMulai) {
                const startDate = new Date(tanggalMulai);
                let endDate = new Date(tanggalMulai);

                if (tipe === 'harian') {
                    // Misi harian = 1 hari
                    endDate = startDate;
                } else if (tipe === 'mingguan') {
                    // Misi mingguan = 7 hari
                    endDate.setDate(startDate.getDate() + 6);
                }

                // Format date to YYYY-MM-DD
                const year = endDate.getFullYear();
                const month = String(endDate.getMonth() + 1).padStart(2, '0');
                const day = String(endDate.getDate()).padStart(2, '0');

                if (tipe === 'harian') {
                    document.getElementById('tanggal_selesai').value = `${year}-${month}-${day}`;
                }
            }
        });

        // Validasi tanggal
        document.getElementById('tanggal_mulai').addEventListener('change', function() {
            document.getElementById('tanggal_selesai').min = this.value;

            // Trigger tipe misi change event to auto-set tanggal_selesai
            const event = new Event('change');
            document.getElementById('tipe_misi').dispatchEvent(event);
        });

        // Preview icon file
        document.getElementById('icon').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Check file size (2MB = 2048KB)
                if (file.size > 2048 * 1024) {
                    alert('Ukuran file terlalu besar! Maksimal 2MB.');
                    this.value = '';
                    return;
                }

                // Check if it's an image
                if (!file.type.startsWith('image/')) {
                    alert('File harus berupa gambar!');
                    this.value = '';
                    return;
                }

                console.log('Image file selected:', file.name, 'Size:', (file.size / 1024).toFixed(2) + 'KB');
            }
        });
    </script>
@endpush
