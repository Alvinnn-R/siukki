@extends('layouts.app')

@section('title', 'Registrasi Anggota Baru - Admin SiUKKI')

@push('styles')
    <style>
        .content-bg {
            background-color: #F4FDF0;
            min-height: calc(100vh - 2rem);
            border-radius: 15px;
        }

        .form-card {
            background: linear-gradient(135deg, #d2ebbc 0%, #a6cf90 100%);
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .form-section {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(166, 207, 144, 0.2);
        }

        .section-header {
            background-color: #a6cf90;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 1rem 1.5rem;
            margin: -1rem -1rem 1rem -1rem;
        }

        .btn-success-custom {
            background-color: #a6cf90;
            border-color: #a6cf90;
            color: white;
        }

        .btn-success-custom:hover {
            background-color: #8fb876;
            border-color: #8fb876;
            color: white;
        }

        .alert-info-custom {
            background-color: #d2ebbc;
            border-color: #a6cf90;
            color: #2d5016;
        }
    </style>
@endpush

@section('content')
    <div class="content-bg p-4">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-1" style="color: #2d5016;">
                            <i class="material-icons me-2" style="vertical-align: middle; color: #a6cf90;">person_add</i>
                            Registrasi Anggota Baru
                        </h2>
                        <p class="text-muted mb-0">Tambahkan anggota baru ke dalam sistem SiUKKI</p>
                    </div>
                    <a href="{{ route('admin.anggota.index') }}" class="btn btn-outline-secondary">
                        <i class="material-icons me-1" style="font-size: 18px; vertical-align: middle;">arrow_back</i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="form-card p-4">
                    <!-- Alert Info -->
                    <div class="alert alert-info-custom mb-4" role="alert">
                        <i class="material-icons me-2" style="vertical-align: middle;">info</i>
                        <strong>Informasi:</strong> Data anggota yang didaftarkan akan mendapatkan akses login ke sistem
                        SiUKKI.
                    </div>

                    <form action="{{ route('admin.anggota.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Data Anggota Section -->
                        <div class="form-section p-4 mb-4">
                            <div class="section-header">
                                <h5 class="mb-0">
                                    <i class="material-icons me-2" style="vertical-align: middle;">person</i>
                                    Data Anggota
                                </h5>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="npm" class="form-label fw-semibold">NPM *</label>
                                    <input type="text" class="form-control @error('npm') is-invalid @enderror"
                                        id="npm" name="npm" value="{{ old('npm') }}"
                                        placeholder="e.g. 23081010xxx" maxlength="15" required>
                                    @error('npm')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">NPM akan digunakan sebagai username login</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="nama" class="form-label fw-semibold">Nama Lengkap *</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                        id="nama" name="nama" value="{{ old('nama') }}"
                                        placeholder="Masukkan nama lengkap" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="profile" class="form-label fw-semibold">Foto Profile</label>
                                    <input type="file" class="form-control @error('profile') is-invalid @enderror"
                                        id="profile" name="profile" accept="image/*">
                                    @error('profile')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Format: JPG, PNG, maksimal 2MB</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="badge" class="form-label fw-semibold">Badge Awal</label>
                                    <select class="form-select @error('badge') is-invalid @enderror" id="badge"
                                        name="badge">
                                        <option value="">Tanpa Badge</option>
                                        <option value="Murid Ilmu" {{ old('badge') == 'Murid Ilmu' ? 'selected' : '' }}>
                                            Murid Ilmu</option>
                                        <option value="Penuntut Kebaikan"
                                            {{ old('badge') == 'Penuntut Kebaikan' ? 'selected' : '' }}>Penuntut Kebaikan
                                        </option>
                                        <option value="Cendekiawan Islami"
                                            {{ old('badge') == 'Cendekiawan Islami' ? 'selected' : '' }}>Cendekiawan Islami
                                        </option>
                                    </select>
                                    @error('badge')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Badge akan otomatis berubah sesuai level</div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Gamifikasi Section -->
                        <div class="form-section p-4 mb-4">
                            <div class="section-header">
                                <h5 class="mb-0">
                                    <i class="material-icons me-2" style="vertical-align: middle;">stars</i>
                                    Data Gamifikasi
                                </h5>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="xp" class="form-label fw-semibold">XP Awal</label>
                                    <input type="number" class="form-control @error('xp') is-invalid @enderror"
                                        id="xp" name="xp" value="{{ old('xp', 0) }}" min="0"
                                        max="10000">
                                    @error('xp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">XP yang akan diberikan saat registrasi</div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="level" class="form-label fw-semibold">Level Awal</label>
                                    <input type="number" class="form-control @error('level') is-invalid @enderror"
                                        id="level" name="level" value="{{ old('level', 1) }}" min="1"
                                        max="20">
                                    @error('level')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Level awal anggota (1-20)</div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Preview XP/Level</label>
                                    <div class="card bg-light p-2">
                                        <small class="text-muted">XP untuk Level 1: 0-299</small>
                                        <small class="text-muted">XP untuk Level 2: 300-599</small>
                                        <small class="text-muted">XP untuk Level 3: 600-899</small>
                                        <small class="text-muted">dst...</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Data Login Section -->
                        <div class="form-section p-4 mb-4">
                            <div class="section-header">
                                <h5 class="mb-0">
                                    <i class="material-icons me-2" style="vertical-align: middle;">vpn_key</i>
                                    Data Login
                                </h5>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label fw-semibold">Password *</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Minimal 8 karakter" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Password minimal 8 karakter</div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password
                                        *</label>
                                    <input type="password" class="form-control" id="password_confirmation"
                                        name="password_confirmation" placeholder="Ulangi password" required>
                                    <div class="form-text">Masukkan ulang password yang sama</div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-info-custom">
                                        <i class="material-icons me-2" style="vertical-align: middle;">info</i>
                                        <strong>Login Info:</strong> Anggota akan login menggunakan <strong>NPM</strong>
                                        sebagai username dan password yang telah dibuat.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end gap-3">
                            <a href="{{ route('admin.anggota.index') }}" class="btn btn-outline-secondary">
                                <i class="material-icons me-1" style="font-size: 18px; vertical-align: middle;">cancel</i>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-success-custom">
                                <i class="material-icons me-1" style="font-size: 18px; vertical-align: middle;">save</i>
                                Simpan Anggota
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Auto-generate password suggestion
        document.getElementById('npm').addEventListener('input', function() {
            const npm = this.value;
            if (npm.length >= 8) {
                // Suggest password based on NPM (you can customize this logic)
                const suggestedPassword = npm + 'ukki';
                document.getElementById('password').placeholder = 'Saran: ' + suggestedPassword;
            }
        });

        // Password confirmation validation
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;

            if (password !== confirmPassword) {
                this.setCustomValidity('Password tidak cocok');
            } else {
                this.setCustomValidity('');
            }
        });
    </script>
@endpush
