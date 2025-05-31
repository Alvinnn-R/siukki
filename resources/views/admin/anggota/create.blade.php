@extends('layouts.app')

@section('title', 'Registrasi Anggota Baru - Admin SiUKKI')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
    <!-- Page Header -->
    <div class="section-header">
        <h2>
            <i class="material-icons me-3" style="font-size: 2rem;">person_add</i>
            Registrasi Anggota Baru
        </h2>
    </div>

    <!-- Info Box -->
    <div class="misi-section-box">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-2">Form Registrasi Anggota UKKI</h5>
                <p class="mb-0 text-muted">Lengkapi data anggota baru yang akan bergabung dengan sistem SiUKKI. Data yang
                    sudah tersimpan akan digunakan untuk login dan tracking aktivitas anggota.</p>
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

    <form action="{{ route('admin.anggota.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Alert Info -->
        <div class="alert alert-info-custom" role="alert">
            <i class="material-icons me-2" style="vertical-align: middle;">info</i>
            <strong>Informasi:</strong> Anggota yang didaftarkan akan mendapatkan akses login menggunakan NPM sebagai
            username dan password yang dibuat.
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
                        name="npm" value="{{ old('npm') }}" placeholder="Contoh: 23081010001" maxlength="15"
                        required>
                    @error('npm')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">NPM akan digunakan sebagai username login</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Lengkap <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                        name="nama" value="{{ old('nama') }}" placeholder="Masukkan nama lengkap anggota" required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="profile" class="form-label fw-semibold">Foto Profil</label>
                    <input type="file" class="form-control @error('profile') is-invalid @enderror" id="profile"
                        name="profile" accept="image/*">
                    @error('profile')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Format: JPG, PNG, maksimal 2MB</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="badge" class="form-label fw-semibold">Badge Awal</label>
                    <select class="form-select @error('badge') is-invalid @enderror" id="badge" name="badge">
                        <option value="">Pilih badge awal (opsional)</option>
                        <option value="Murid Ilmu" {{ old('badge') == 'Murid Ilmu' ? 'selected' : '' }}>Murid Ilmu</option>
                        <option value="Penuntut Kebaikan" {{ old('badge') == 'Penuntut Kebaikan' ? 'selected' : '' }}>
                            Penuntut Kebaikan</option>
                        <option value="Cendekiawan Islami" {{ old('badge') == 'Cendekiawan Islami' ? 'selected' : '' }}>
                            Cendekiawan Islami</option>
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
                    <label for="xp" class="form-label fw-semibold">XP Awal</label>
                    <input type="number" class="form-control @error('xp') is-invalid @enderror" id="xp"
                        name="xp" value="{{ old('xp', 0) }}" min="0" max="10000">
                    @error('xp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">XP yang diberikan saat registrasi (default: 0)</div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="level" class="form-label fw-semibold">Level Awal</label>
                    <input type="number" class="form-control @error('level') is-invalid @enderror" id="level"
                        name="level" value="{{ old('level', 1) }}" min="1" max="20">
                    @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Level awal anggota (default: 1)</div>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label fw-semibold">Preview Level</label>
                    <div class="preview-card">
                        <small class="text-muted d-block">XP untuk Level 1: 0-299</small>
                        <small class="text-muted d-block">XP untuk Level 2: 300-599</small>
                        <small class="text-muted d-block">XP untuk Level 3: 600-899</small>
                        <small class="text-muted">dst. (setiap level = 300 XP)</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Login Section -->
        <div class="form-section">
            <div class="section-title">
                <i class="material-icons me-2">vpn_key</i>
                <h5 class="mb-0">Data Login</h5>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label fw-semibold">Password <span
                            class="text-danger">*</span></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Minimal 8 karakter" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Password minimal 8 karakter, kombinasi huruf dan angka</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password <span
                            class="text-danger">*</span></label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="Ulangi password yang sama" required>
                    <div class="form-text">Masukkan ulang password untuk konfirmasi</div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info-custom">
                        <i class="material-icons me-2" style="vertical-align: middle;">info</i>
                        <strong>Info Login:</strong> Anggota akan login menggunakan <strong>NPM</strong> sebagai username
                        dan password yang telah dibuat di atas.
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="misi-section-box">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Simpan Data Anggota</h6>
                    <p class="mb-0 text-muted">Pastikan semua data sudah benar sebelum menyimpan</p>
                </div>
                <div class="d-flex gap-3">
                    <a href="{{ route('admin.anggota.index') }}" class="btn btn-outline-secondary">
                        <i class="material-icons me-1" style="font-size: 18px;">cancel</i>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-success-custom">
                        <i class="material-icons me-1" style="font-size: 18px;">save</i>
                        Simpan Anggota
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        // Auto-generate password suggestion based on NPM
        document.getElementById('npm').addEventListener('input', function() {
            const npm = this.value;
            if (npm.length >= 8) {
                const suggestedPassword = npm + 'ukki';
                document.getElementById('password').placeholder = 'Saran: ' + suggestedPassword;
            } else {
                document.getElementById('password').placeholder = 'Minimal 8 karakter';
            }
        });

        // Real-time password confirmation validation
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmPassword = this.value;

            if (confirmPassword && confirmPassword !== password) {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
                if (!this.nextElementSibling || !this.nextElementSibling.classList.contains('invalid-feedback')) {
                    const feedback = document.createElement('div');
                    feedback.classList.add('invalid-feedback');
                    feedback.textContent = 'Password tidak cocok!';
                    this.parentNode.appendChild(feedback);
                }
            } else if (confirmPassword && confirmPassword === password) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
                const feedback = this.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.remove();
                }
            }
        });

        // Preview image before upload
        document.getElementById('profile').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // You can add preview functionality here if needed
                    console.log('Image selected:', file.name);
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush
