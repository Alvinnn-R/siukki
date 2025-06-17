@extends('layouts.app')

@section('title', 'Edit Anggota - Admin SiUKKI')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        /* Avatar selection styles */
        .avatar-preview {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid #ddd;
            object-fit: cover;
            cursor: pointer;
            transition: border-color 0.3s;
        }

        .avatar-preview:hover {
            border-color: #007bff;
        }

        .avatar-option {
            cursor: pointer;
            transition: transform 0.2s;
        }

        .avatar-option:hover {
            transform: scale(1.05);
        }

        .avatar-option.selected img {
            border: 3px solid #007bff !important;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        .profile-preview-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border: 2px dashed #dee2e6;
            transition: all 0.3s ease;
        }

        .profile-preview-container:hover {
            border-color: #007bff;
            background: #f0f8ff;
        }

        .profile-actions {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
            max-width: 200px;
        }

        .badge-selection-container {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border: 2px solid #dee2e6;
            height: fit-content;
        }

        .badge-preview {
            text-align: center;
            margin-bottom: 15px;
        }

        .badge-display {
            display: inline-block;
            padding: 8px 16px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
            box-shadow: 0 2px 10px rgba(0, 123, 255, 0.3);
        }

        .badge-display.empty {
            background: #6c757d;
            color: #fff;
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
                <h5 class="mb-2">Edit Data Anggota: {{ $anggota->nama }}</h5>
                <p class="mb-0 text-muted">Perbarui informasi anggota yang diperlukan. Kosongkan password jika tidak ingin
                    mengubah.</p>
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

    <form action="{{ route('admin.anggota.update', $anggota) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Alert Info -->
        <div class="alert alert-info-custom" role="alert">
            <i class="material-icons me-2" style="vertical-align: middle;">info</i>
            <strong>Informasi:</strong> Anggota login menggunakan NPM sebagai username. Kosongkan password jika tidak ingin
            mengubah.
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
                        name="npm" value="{{ old('npm', $anggota->npm) }}" placeholder="Contoh: 23081010001"
                        maxlength="15" required>
                    @error('npm')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">NPM akan digunakan sebagai username login</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nama" class="form-label fw-semibold">Nama Lengkap <span
                            class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                        name="nama" value="{{ old('nama', $anggota->nama) }}" placeholder="Masukkan nama lengkap anggota"
                        required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <!-- Profile Section -->
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Foto Profil</label>
                    <div class="profile-preview-container">
                        @php
                            $currentProfileSrc = asset('assets/images/Avater.png'); // default
                            $currentSelectedAvatar = '';

                            if ($anggota->selected_avatar) {
                                // If user has selected avatar
                                $currentProfileSrc = asset('assets/images/' . $anggota->selected_avatar);
                                $currentSelectedAvatar = $anggota->selected_avatar;
                            } elseif (
                                $anggota->profile &&
                                file_exists(public_path('assets/images/' . $anggota->profile))
                            ) {
                                // If user has uploaded custom profile
                                $currentProfileSrc = asset('assets/images/' . $anggota->profile);
                            }
                        @endphp

                        <img src="{{ $currentProfileSrc }}" alt="Profile Preview" id="profilePreview"
                            class="avatar-preview">

                        <div class="profile-actions">
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                data-bs-target="#chooseAvatarModal">
                                <i class="material-icons me-1" style="font-size: 16px;">face</i>
                                Pilih Avatar
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="resetProfileImage()"
                                id="removeImageBtn"
                                style="{{ $anggota->selected_avatar || $anggota->profile ? 'display: inline-block;' : 'display: none;' }}">
                                <i class="material-icons me-1" style="font-size: 16px;">delete</i>
                                Hapus
                            </button>
                        </div>
                    </div>

                    <!-- Hidden inputs -->
                    <input type="hidden" name="selected_avatar" id="selectedAvatarInput"
                        value="{{ old('selected_avatar', $anggota->selected_avatar) }}">
                    <input type="hidden" name="profile_type" id="profileTypeInput"
                        value="{{ $anggota->selected_avatar ? 'avatar' : ($anggota->profile ? 'upload' : 'default') }}">
                    <input type="hidden" name="remove_profile" id="removeProfileInput" value="0">

                    @error('selected_avatar')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Badge Section -->
                <div class="col-md-6 mb-3">
                    <label for="badge" class="form-label fw-semibold">Badge</label>
                    <div class="badge-selection-container">
                        <div class="badge-preview">
                            <div class="badge-display {{ $anggota->badge ? '' : 'empty' }}" id="badgeDisplay">
                                {{ $anggota->badge ?: 'Belum ada badge' }}
                            </div>
                            <div class="form-text text-center">Preview badge yang dipilih</div>
                        </div>

                        <select class="form-select @error('badge') is-invalid @enderror" id="badge" name="badge">
                            <option value="">Pilih badge (opsional)</option>
                            <option value="Murid Ilmu"
                                {{ old('badge', $anggota->badge) == 'Murid Ilmu' ? 'selected' : '' }}>Murid Ilmu</option>
                            <option value="Penuntut Kebaikan"
                                {{ old('badge', $anggota->badge) == 'Penuntut Kebaikan' ? 'selected' : '' }}>Penuntut
                                Kebaikan</option>
                            <option value="Cendekiawan Islami"
                                {{ old('badge', $anggota->badge) == 'Cendekiawan Islami' ? 'selected' : '' }}>Cendekiawan
                                Islami</option>
                        </select>

                        @error('badge')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text mt-2">Badge akan otomatis disesuaikan dengan level jika tidak dipilih</div>
                    </div>
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
                    <label for="xp" class="form-label fw-semibold">XP</label>
                    <input type="number" class="form-control @error('xp') is-invalid @enderror" id="xp"
                        name="xp" value="{{ old('xp', $anggota->xp) }}" min="0" max="10000">
                    @error('xp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">XP anggota saat ini</div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="level" class="form-label fw-semibold">Level</label>
                    <input type="number" class="form-control @error('level') is-invalid @enderror" id="level"
                        name="level" value="{{ old('level', $anggota->level) }}" min="1" max="20">
                    @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Level anggota saat ini</div>
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
                    <label for="password" class="form-label fw-semibold">Password Baru</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Minimal 8 karakter jika diisi, kosongkan jika tidak ingin mengubah</div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                        placeholder="Ulangi password baru">
                    <div class="form-text">Masukkan ulang password untuk konfirmasi</div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info-custom">
                        <i class="material-icons me-2" style="vertical-align: middle;">info</i>
                        <strong>Info Login:</strong> Anggota login menggunakan <strong>NPM: {{ $anggota->npm }}</strong>
                        sebagai username.
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="misi-section-box">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="mb-1">Update Data Anggota</h6>
                    <p class="mb-0 text-muted">Pastikan semua perubahan sudah benar sebelum menyimpan</p>
                </div>
                <div class="d-flex gap-3">
                    <a href="{{ route('admin.anggota.index') }}" class="btn btn-outline-secondary">
                        <i class="material-icons me-1" style="font-size: 18px;">cancel</i>
                        Batal
                    </a>
                    <button type="submit" class="btn btn-success-custom">
                        <i class="material-icons me-1" style="font-size: 18px;">save</i>
                        Update Anggota
                    </button>
                </div>
            </div>
        </div>
    </form>

    <!-- Choose Avatar Modal -->
    <div class="modal fade" id="chooseAvatarModal" tabindex="-1" aria-labelledby="chooseAvatarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="chooseAvatarModalLabel">
                        <i class="material-icons me-2" style="vertical-align: middle;">face</i>
                        Pilih Avatar
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3" id="avatarList">
                        @php
                            $avatars = [
                                'avatar/1_boy.jpeg',
                                'avatar/2_boy.jpeg',
                                'avatar/3_boy.jpeg',
                                'avatar/4_boy.jpeg',
                                'avatar/5_boy.jpeg',
                                'avatar/6_boy.jpeg',
                                'avatar/7_boy.jpeg',
                                'avatar/8_boy.jpeg',
                                'avatar/9_boy.jpeg',
                                'avatar/10_boy.jpeg',
                                'avatar/1_girl.jpeg',
                                'avatar/2_girl.jpeg',
                                'avatar/3_girl.jpeg',
                                'avatar/4_girl.jpeg',
                                'avatar/5_girl.jpeg',
                                'avatar/6_girl.jpeg',
                                'avatar/7_girl.jpeg',
                                'avatar/8_girl.jpeg',
                                'avatar/9_girl.jpeg',
                                'avatar/10_girl.jpeg',
                            ];
                        @endphp
                        @foreach ($avatars as $avatar)
                            <div class="col-md-3 col-sm-4 col-6">
                                <div class="avatar-option text-center {{ old('selected_avatar', $anggota->selected_avatar) == $avatar ? 'selected' : '' }}"
                                    data-avatar="{{ $avatar }}">
                                    <img src="{{ asset('assets/images/' . $avatar) }}" alt="Avatar"
                                        class="img-fluid rounded-circle"
                                        style="width: 80px; height: 80px; border: 2px solid #ddd; object-fit: cover; cursor: pointer;">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="material-icons me-1" style="font-size: 16px;">cancel</i>
                        Batal
                    </button>
                    <button type="button" class="btn btn-primary" id="saveAvatarBtn" data-bs-dismiss="modal">
                        <i class="material-icons me-1" style="font-size: 16px;">check</i>
                        Pilih Avatar
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Avatar selection functionality
        document.addEventListener('DOMContentLoaded', function() {
            const avatarOptions = document.querySelectorAll('.avatar-option');
            const selectedAvatarInput = document.getElementById('selectedAvatarInput');
            const profileTypeInput = document.getElementById('profileTypeInput');
            const removeProfileInput = document.getElementById('removeProfileInput');
            const saveBtn = document.getElementById('saveAvatarBtn');
            const profilePreview = document.getElementById('profilePreview');
            const removeBtn = document.getElementById('removeImageBtn');
            const badgeSelect = document.getElementById('badge');
            const badgeDisplay = document.getElementById('badgeDisplay');

            let selectedAvatar = selectedAvatarInput.value;

            // Initialize modal selection state on page load
            function setInitialSelection() {
                avatarOptions.forEach(option => {
                    const avatarPath = option.getAttribute('data-avatar');
                    if (avatarPath === selectedAvatar) {
                        option.classList.add('selected');
                    } else {
                        option.classList.remove('selected');
                    }
                });
            }

            // Set initial selection
            setInitialSelection();

            // Avatar selection in modal
            avatarOptions.forEach(option => {
                option.addEventListener('click', function() {
                    avatarOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                    selectedAvatar = this.getAttribute('data-avatar');
                });
            });

            // Save selected avatar
            saveBtn.addEventListener('click', function() {
                if (selectedAvatar) {
                    selectedAvatarInput.value = selectedAvatar;
                    profilePreview.src = "{{ asset('assets/images/') }}" + "/" + selectedAvatar;
                    profileTypeInput.value = 'avatar';
                    removeProfileInput.value = '0';

                    // Show remove button
                    removeBtn.style.display = 'inline-block';
                }
            });

            // Badge selection preview
            badgeSelect.addEventListener('change', function() {
                const selectedBadge = this.value;
                if (selectedBadge) {
                    badgeDisplay.textContent = selectedBadge;
                    badgeDisplay.classList.remove('empty');
                } else {
                    badgeDisplay.textContent = 'Belum ada badge';
                    badgeDisplay.classList.add('empty');
                }
            });

            // Reset modal selection when opened
            $('#chooseAvatarModal').on('shown.bs.modal', function() {
                selectedAvatar = selectedAvatarInput.value;
                setInitialSelection();
            });

            // Reset selection when modal closed without saving
            $('#chooseAvatarModal').on('hidden.bs.modal', function() {
                selectedAvatar = selectedAvatarInput.value;
                setInitialSelection();
            });
        });

        // Reset profile image
        function resetProfileImage() {
            document.getElementById('profilePreview').src = "{{ asset('assets/images/Avater.png') }}";
            document.getElementById('selectedAvatarInput').value = '';
            document.getElementById('profileTypeInput').value = 'default';
            document.getElementById('removeProfileInput').value = '1';
            document.getElementById('removeImageBtn').style.display = 'none';

            // Clear avatar selections in modal
            document.querySelectorAll('.avatar-option').forEach(opt => opt.classList.remove('selected'));
        }

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
            } else {
                this.classList.remove('is-invalid', 'is-valid');
                const feedback = this.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.remove();
                }
            }
        });

        // Password field validation
        document.getElementById('password').addEventListener('input', function() {
            const confirmPassword = document.getElementById('password_confirmation');
            if (confirmPassword.value) {
                confirmPassword.dispatchEvent(new Event('input'));
            }
        });
    </script>
@endpush
