@extends('layouts.app')

@section('title', 'Edit Misi - Admin SiUKKI')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .form-section {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
        }

        .section-title {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .preview-icon {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 1rem;
        }

        .current-info {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid #4CAF50;
        }

        .alert-info-custom {
            background: #e3f2fd;
            border: 1px solid #90caf9;
            color: #1565c0;
            border-radius: 8px;
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="section-header">
        <h2>
            <i class="material-icons me-3" style="font-size: 2rem;">edit</i>
            Edit Misi
        </h2>
    </div>

    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('admin.misi.show', $misi->id_misi) }}" class="btn btn-outline-secondary">
            <i class="material-icons me-1" style="font-size: 18px;">arrow_back</i>
            Kembali ke Detail
        </a>
    </div>

    <form action="{{ route('admin.misi.update', $misi->id_misi) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Info Box -->
        <div class="misi-section-box">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">Edit Misi {{ $misi->nama_misi }}</h5>
                    <p class="mb-0 text-muted">Silakan edit informasi misi sesuai kebutuhan</p>
                </div>
            </div>
        </div>

        <!-- Form Content -->
        <div class="row">
            <!-- Left Column - Basic Info -->
            <div class="col-md-8">
                <div class="form-section">
                    <div class="section-title">
                        <i class="material-icons me-2" style="font-size: 1.5rem;">assignment</i>
                        <h5 class="mb-0">Informasi Dasar</h5>
                    </div>

                    <!-- Nama Misi -->
                    <div class="mb-3">
                        <label for="nama_misi" class="form-label">Nama Misi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nama_misi') is-invalid @enderror" id="nama_misi"
                            name="nama_misi" value="{{ old('nama_misi', $misi->nama_misi) }}" required>
                        @error('nama_misi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $misi->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- XP Reward -->
                    <div class="mb-3">
                        <label for="xp_reward" class="form-label">XP Reward <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('xp_reward') is-invalid @enderror" id="xp_reward"
                            name="xp_reward" value="{{ old('xp_reward', $misi->xp_reward) }}" required min="0">
                        @error('xp_reward')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Right Column - Additional Info -->
            <div class="col-md-4">
                <!-- Status Section -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="material-icons me-2" style="font-size: 1.5rem;">settings</i>
                        <h5 class="mb-0">Status & Tipe</h5>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status_aktif"
                                    value="aktif" {{ old('status', $misi->status) === 'aktif' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_aktif">Aktif</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status_nonaktif"
                                    value="nonaktif" {{ old('status', $misi->status) === 'nonaktif' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_nonaktif">Nonaktif</label>
                            </div>
                        </div>
                        @error('status')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tipe Misi -->
                    <div class="mb-3">
                        <label for="tipe_misi" class="form-label">Tipe Misi <span class="text-danger">*</span></label>
                        <select class="form-select @error('tipe_misi') is-invalid @enderror" id="tipe_misi" name="tipe_misi"
                            required>
                            <option value="harian" {{ old('tipe_misi', $misi->tipe_misi) === 'harian' ? 'selected' : '' }}>
                                Harian</option>
                            {{-- <option value="mingguan"
                                {{ old('tipe_misi', $misi->tipe_misi) === 'mingguan' ? 'selected' : '' }}>Mingguan</option> --}}
                            <option value="event" {{ old('tipe_misi', $misi->tipe_misi) === 'event' ? 'selected' : '' }}>
                                Event</option>
                        </select>
                        @error('tipe_misi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Schedule Section -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="material-icons me-2" style="font-size: 1.5rem;">schedule</i>
                        <h5 class="mb-0">Jadwal</h5>
                    </div>

                    <!-- Jadwal -->
                    <div class="mb-3">
                        <label for="jadwal" class="form-label">Jadwal <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('jadwal') is-invalid @enderror" id="jadwal"
                            name="jadwal" value="{{ old('jadwal', $misi->jadwal->format('Y-m-d')) }}" required>
                        @error('jadwal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal Mulai -->
                    <div class="mb-3">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_mulai') is-invalid @enderror"
                            id="tanggal_mulai" name="tanggal_mulai"
                            value="{{ old('tanggal_mulai', $misi->tanggal_mulai->format('Y-m-d')) }}" required>
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal Selesai -->
                    <div class="mb-3">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai <span
                                class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror"
                            id="tanggal_selesai" name="tanggal_selesai"
                            value="{{ old('tanggal_selesai', $misi->tanggal_selesai->format('Y-m-d')) }}" required>
                        @error('tanggal_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Icon Section -->
                <div class="form-section">
                    <div class="section-title">
                        <i class="material-icons me-2" style="font-size: 1.5rem;">image</i>
                        <h5 class="mb-0">Icon Misi</h5>
                    </div>

                    @if ($misi->icon)
                        <div class="text-center mb-3">
                            <img src="{{ asset('assets/icons/' . $misi->icon . '.png') }}" alt="Icon saat ini"
                                class="preview-icon mb-2">
                            <small class="d-block text-muted">Icon saat ini</small>
                        </div>
                    @endif

                    <div class="mb-3">
                        <label for="icon" class="form-label">Upload Icon Baru (SVG dan PNG)</label>
                        <input type="file" class="form-control @error('icon') is-invalid @enderror" id="icon"
                            name="icon">
                        <div class="form-text">Kosongkan jika tidak ingin mengubah icon</div>
                        @error('icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="misi-section-box">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Simpan Perubahan</h6>
                    <p class="mb-0 text-muted">Pastikan semua data sudah benar sebelum menyimpan</p>
                </div>
                <div class="d-flex gap-3">
                    <a href="{{ route('admin.misi.show', $misi->id_misi) }}" class="btn btn-outline-secondary">
                        <i class="material-icons me-1" style="font-size: 18px;">cancel</i>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons me-1" style="font-size: 18px;">save</i>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        // Validasi tanggal
        document.getElementById('tanggal_mulai').addEventListener('change', function() {
            document.getElementById('tanggal_selesai').min = this.value;
        });

        // Preview icon sebelum upload
        document.getElementById('icon').addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (document.querySelector('.preview-icon')) {
                        document.querySelector('.preview-icon').src = e.target.result;
                    } else {
                        const preview = document.createElement('div');
                        preview.className = 'text-center mb-3';
                        preview.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" class="preview-icon mb-2">
                        <small class="d-block text-muted">Preview icon baru</small>
                    `;
                        document.getElementById('icon').parentNode.insertBefore(preview, document
                            .getElementById('icon'));
                    }
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    </script>
@endpush
