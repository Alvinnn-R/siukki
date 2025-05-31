@extends('layouts.app')

@section('title', 'Edit Anggota - Admin SiUKKI')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .profile-preview {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 3px solid #e0e0e0;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .current-info {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            border-left: 4px solid #4CAF50;
        }

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

        .preview-card {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            border: 1px dashed #dee2e6;
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
            Edit Data Anggota
        </h2>
    </div>

    <!-- Info Box -->
    <div class="misi-section-box">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-2">Edit Profil: {{ $anggota->nama }}</h5>
                <p class="mb-0 text-muted">Perbarui informasi anggota UKKI. Biarkan field password kosong jika tidak ingin
                    mengubah password.</p>
            </div>
            <a href="{{ route('admin.anggota.index') }}" class="btn btn-outline-secondary">
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

    <form action="{{ route('admin.anggota.update', $anggota->npm) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Current Profile Info -->
        <div class="form-section">
            <div class="section-title">
                <i class="material-icons me-2">account_circle</i>
                <h5 class="mb-0">Profil Saat Ini</h5>
            </div>

            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <img src="{{ $anggota->profile_url }}" alt="{{ $anggota->nama }}"
                        class="rounded-circle profile-preview mb-3" id="currentProfileImg">
                    <p class="mb-0 text-muted">Foto Profil Saat Ini</p>
                </div>
                <div class="col-md-9">
                    <div class="current-info">
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted d-block">NPM</small>
                                <strong>{{ $anggota->npm }}</strong>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block">Level Saat Ini</small>
                                <strong>Level {{ $anggota->level }} - {{ $anggota->badge }}</strong>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <small class="text-muted d-block">Total XP</small>
                                <strong>{{ $anggota->xp }} XP</strong>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block">Bergabung Sejak</small>
                                <strong>{{ $anggota->created_at->format('d F Y') }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Anggota Section -->
        <div class="form-section">
            <div class="section-title">
                <i class="material-icons me-2">person</i>
                <h5 class="mb-0">Data Anggota</h5>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="npm" class="form-label fw-semibold">NPM <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('npm') is-invalid @enderror" id="npm"
                        name="npm" value="{{ old('npm', $anggota->npm) }}" maxlength="15" required>
                    @error('npm')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">NPM digunakan sebagai username login</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Lengkap <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                        name="nama" value="{{ old('nama', $anggota->nama) }}" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="profile" class="form-label fw-semibold">Ganti Foto Profil</label>
                    <input type="file" class="form-control @error('profile') is-invalid @enderror" id="profile"
                        name="profile" accept="image/*">
                    @error('profile')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, PNG, maksimal 2MB
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="badge" class="form-label fw-semibold">Badge</label>
                    <select class="form-select @error('badge') is-invalid @enderror" id="badge" name="badge">
                        <option value="">Otomatis berdasarkan level</option>
                        <option value="Murid Ilmu" {{ old('badge', $anggota->badge) == 'Murid Ilmu' ? 'selected' : '' }}>
                            Murid Ilmu
                        </option>
                        <option value="Penuntut Kebaikan"
                            {{ old('badge', $anggota->badge) == 'Penuntut Kebaikan' ? 'selected' : '' }}>
                            Penuntut Kebaikan
                        </option>
                        <option value="Cendekiawan Islami"
                            {{ old('badge', $anggota->badge) == 'Cendekiawan Islami' ? 'selected' : '' }}>
                            Cendekiawan Islami
                        </option>
                    </select>
                    @error('badge')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Badge akan otomatis disesuaikan dengan level jika tidak dipilih</div>
                </div>
            </div>
        </div>

        <!-- Data Gamifikasi Section -->
        <div class="form-section">
            <div class="section-title">
                <i class="material-icons me-2">stars</i>
                <h5 class="mb-0">Data Gamifikasi</h5>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="xp" class="form-label fw-semibold">Total XP</label>
                    <input type="number" class="form-control @error('xp') is-invalid @enderror" id="xp"
                        name="xp" value="{{ old('xp', $anggota->xp) }}" min="0" max="10000">
                    @error('xp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">XP saat ini: {{ $anggota->xp }}</div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="level" class="form-label fw-semibold">Level</label>
                    <input type="number" class="form-control @error('level') is-invalid @enderror" id="level"
                        name="level" value="{{ old('level', $anggota->level) }}" min="1" max="20">
                    @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Level saat ini: {{ $anggota->level }}</div>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Preview Level & XP</label>
                    <div class="preview-card">
                        <div class="progress mb-2" style="height: 20px;">
                            <div class="progress-bar bg-success" role="progressbar"
                                style="width: {{ $anggota->progress_percentage }}%"
                                aria-valuenow="{{ $anggota->progress_percentage }}" aria-valuemin="0"
                                aria-valuemax="100">
                                {{ round($anggota->progress_percentage) }}%
                            </div>
                        </div>
                        <small class="text-muted d-block">Progress: {{ $anggota->xp }} / {{ $anggota->level * 300 }}
                            XP</small>
                        <small class="text-muted">Butuh {{ $anggota->xp_to_next_level }} XP untuk Level
                            {{ $anggota->level + 1 }}</small>
                    </div>
                </div>
            </div>

            <div class="alert alert-info-custom" role="alert">
                <i class="material-icons me-2" style="vertical-align: middle;">info</i>
                <strong>Catatan:</strong> Mengubah XP atau Level secara manual akan mempengaruhi progress anggota.
                Pastikan perubahan sesuai dengan kebijakan sistem gamifikasi.
            </div>
        </div>

        <!-- Data Login Section -->
        <div class="form-section">
            <div class="section-title">
                <i class="material-icons me-2">vpn_key</i>
                <h5 class="mb-0">Ubah Password (Opsional)</h5>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label fw-semibold">Password Baru</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Minimal 8 karakter. Biarkan kosong jika tidak ingin mengubah password.</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="Ulangi password baru">
                    <div class="form-text">Hanya isi jika Anda mengubah password</div>
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
                    <a href="{{ route('admin.anggota.show', $anggota->npm) }}" class="btn btn-outline-secondary">
                        <i class="material-icons me-1" style="font-size: 18px;">visibility</i>
                        Lihat Profil
                    </a>
                    <a href="{{ route('admin.anggota.index') }}" class="btn btn-outline-secondary">
                        <i class="material-icons me-1" style="font-size: 18px;">cancel</i>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-success-custom">
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
        // Preview new image before upload
        document.getElementById('profile').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('currentProfileImg').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Real-time password confirmation validation
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;

            if (password && confirmPassword && confirmPassword !== password) {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
                if (!this.nextElementSibling || !this.nextElementSibling.classList.contains('invalid-feedback')) {
                    const feedback = document.createElement('div');
                    feedback.classList.add('invalid-feedback');
                    feedback.textContent = 'Password tidak cocok!';
                    this.parentNode.appendChild(feedback);
                }
            } else if (password && confirmPassword && confirmPassword === password) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
                const feedback = this.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.remove();
                }
            } else if (!password && confirmPassword) {
                this.classList.add('is-invalid');
                if (!this.nextElementSibling || !this.nextElementSibling.classList.contains('invalid-feedback')) {
                    const feedback = document.createElement('div');
                    feedback.classList.add('invalid-feedback');
                    feedback.textContent = 'Masukkan password baru terlebih dahulu!';
                    this.parentNode.appendChild(feedback);
                }
            }
        });

        // Clear password confirmation when password field is cleared
        document.getElementById('password').addEventListener('input', function() {
            if (!this.value) {
                const confirmField = document.getElementById('password_confirmation');
                confirmField.value = '';
                confirmField.classList.remove('is-invalid', 'is-valid');
                const feedback = confirmField.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.remove();
                }
            }
        });

        // Auto calculate badge based on level
        document.getElementById('level').addEventListener('input', function() {
            const level = parseInt(this.value);
            const badgeSelect = document.getElementById('badge');

            // Only auto-set if badge is not manually selected
            if (!badgeSelect.value) {
                if (level >= 9) {
                    badgeSelect.value = 'Cendekiawan Islami';
                } else if (level >= 5) {
                    badgeSelect.value = 'Penuntut Kebaikan';
                } else {
                    badgeSelect.value = 'Murid Ilmu';
                }
            }
        });

        // XP and Level relationship info
        document.getElementById('xp').addEventListener('input', function() {
            const xp = parseInt(this.value) || 0;
            const calculatedLevel = Math.floor(xp / 300) + 1;
            const levelInput = document.getElementById('level');

            // Show suggestion if XP doesn't match level
            if (calculatedLevel !== parseInt(levelInput.value)) {
                this.classList.add('border-warning');
                if (!this.parentNode.querySelector('.xp-warning')) {
                    const warning = document.createElement('small');
                    warning.className = 'text-warning xp-warning';
                    warning.textContent = `XP ini seharusnya untuk Level ${calculatedLevel}`;
                    this.parentNode.appendChild(warning);
                }
            } else {
                this.classList.remove('border-warning');
                const warning = this.parentNode.querySelector('.xp-warning');
                if (warning) warning.remove();
            }
        });
    </script>
@endpush
