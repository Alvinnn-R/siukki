@extends('layouts.app')

@section('title', 'Settings SiUKKI')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/setting.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="main-content-settings">
                <div class="settings-area">
                    <h2>Settings</h2>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('setting') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="profile-setting-card">
                            <div class="profile-setting-left">
                                <img src="{{ asset('assets/images/' . (Auth::guard('anggota')->user()->profile ?? 'avatar/noprofile.png')) }}?v={{ time() }}" alt="Profile" class="img-profile">                           
                            </div>
                            <div class="profile-setting-right">
                                <div class="button-row">
                                    <input type="file" id="profileImageInput" name="profile_image" accept="image/*"
                                        style="display: none;">
                                    <button type="button" class="btn-setting" data-bs-toggle="modal"
                                        data-bs-target="#chooseAvatarModal">
                                        Change image
                                    </button>
                                    {{-- Remove Image --}}
                                    <button type="button" class="btn-setting" id="removeImageBtn">
                                        Remove image
                                    </button>                                   
                                </div>
                                <label for="username" style="margin-bottom: 0px;">Username</label>
                                <input id="username" name="name" type="text"
                                    value="{{ Auth::user()->nama }}"
                                    class="@error('name') is-invalid @enderror" readonly
                                    style="pointer-events: none; background-color: #f5f5f5;">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <!-- Edit Username Button -->
                                <button type="button" class="btn-setting" data-bs-toggle="modal"
                                    data-bs-target="#editUsernameModal" style="margin-bottom: 15px;">
                                    Edit Username
                                </button>

                                <label for="password" style="margin-bottom: 0px;">Password</label>
                                <input id="password" name="password" type="password"
                                    class="@error('password') is-invalid @enderror" value="************" readonly disabled
                                    style="pointer-events: none; background-color: #f5f5f5;">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <!-- Edit Password Button -->
                                <button type="button" class="btn-setting" data-bs-toggle="modal"
                                    data-bs-target="#editPasswordModal" style="margin-bottom: 15px;">
                                    Edit Password
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- Form RemoveImage --}}
                    <form id="removeImageForm" action="{{ route('setting.profile.remove') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Choose Avatar -->
    <div class="modal fade" id="chooseAvatarModal" tabindex="-1" aria-labelledby="chooseAvatarModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="chooseAvatarModalLabel">Choose Avatar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="avatarSelectForm" action="{{ route('setting.profile') }}" method="POST">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="modal-body">
                        <div class="d-flex flex-wrap gap-3 justify-content-center" id="avatarList">
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
                                <div class="avatar-option" data-avatar="{{ $avatar }}" style="cursor:pointer;">
                                    <img src="{{ asset('assets/images/' . $avatar) }}" alt="Avatar"
                                        style="width:70px; height:70px; border-radius:50%; border:2px solid #ddd; object-fit:cover;">
                                </div>
                            @endforeach
                        </div>
                        <input type="hidden" name="profile" id="selectedAvatarInput">
                        <hr>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="saveAvatarBtn" disabled>Save Change</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Konfirmasi Remove Image --}}
    <div class="modal fade" id="removeImageConfirmModal" tabindex="-1" aria-labelledby="removeImageConfirmModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="removeImageConfirmModalLabel">Konfirmasi Hapus Foto Profil</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Apakah Anda yakin ingin menghapus foto profil?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-secondary" id="confirmRemoveImageBtn" style="background-color:#dc3545; border-color:#dc3545; color:#fff;">Hapus</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Edit Username -->
    <div class="modal fade" id="editUsernameModal" tabindex="-1" aria-labelledby="editUsernameModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {{-- <form action=""> --}}
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUsernameModalLabel">Edit Username</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="newUsername">New Username</label>
                        <input type="text" id="newUsernameInput" class="form-control" placeholder="Masukkan username baru">
                    </div>
                    <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Username</button>
                    </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>

        <!-- Modal Edit Password -->
        <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('setting.password') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="editPasswordModalLabel">Edit Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Current Password -->
                            <label for="current_password">Password Saat Ini</label>
                            <input id="current_password" name="current_password" type="password" placeholder="Masukkan Password Saat Ini" class="form-control @error('current_password') is-invalid @enderror">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <!-- New Password -->
                            <label for="new_password" class="mt-3">Password Baru</label>
                            <input id="new_password" name="new_password" type="password" placeholder="Masukkan Password Baru" class="form-control @error('new_password') is-invalid @enderror">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <!-- Confirm New Password -->
                            <label for="password_confirmation" class="mt-3">Konfirmasi Password Baru</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Konfirmasi Password baru" class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    @push('scripts')
    {{-- Edit Profile --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const avatarOptions = document.querySelectorAll('.avatar-option');
            const selectedAvatarInput = document.getElementById('selectedAvatarInput');
            const saveBtn = document.getElementById('saveAvatarBtn');

            avatarOptions.forEach(option => {
                option.addEventListener('click', function() {
                    avatarOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                    selectedAvatarInput.value = this.getAttribute('data-avatar');
                    saveBtn.disabled = false;
                });
            });

            // Optional: Reset selection when modal closed
            $('#chooseAvatarModal').on('hidden.bs.modal', function() {
                avatarOptions.forEach(opt => opt.classList.remove('selected'));
                selectedAvatarInput.value = '';
                saveBtn.disabled = true;
            });
        });
    </script>

    {{-- Script untuk Remove Image dengan Bootstrap Modal --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const removeImageBtn = document.getElementById('removeImageBtn');
            const removeImageForm = document.getElementById('removeImageForm');
            const removeImageConfirmModal = new bootstrap.Modal(document.getElementById('removeImageConfirmModal'));

            removeImageBtn.addEventListener('click', function () {
                removeImageConfirmModal.show();
            });

            document.getElementById('confirmRemoveImageBtn').addEventListener('click', function () {
                removeImageForm.submit();
            });
        });
    </script>
    
    {{-- Script untuk edit Username--}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('editUsernameModal');
            const input = document.getElementById('newUsernameInput');
            const updateBtn = modal.querySelector('.btn-primary');
            const cancelBtn = modal.querySelector('.btn-secondary');

            // Fungsi untuk update username
            function updateUsername() {
                const name = input.value.trim();
                if (!name) return;

                fetch("{{ route('setting.username.update') }}", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ name })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('Username berhasil diperbarui!');
                        location.reload();
                    } else {
                        alert(data.message || 'Gagal memperbarui username.');
                    }
                })
                .catch(err => {
                    console.error("Error:", err);
                    alert("Terjadi kesalahan saat memperbarui.");
                });
            }

            // Enter key pada input
            modal.addEventListener('shown.bs.modal', function () {
                input.focus();
            });

            input.addEventListener('keydown', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    updateUsername();
                }
            });

            // Klik tombol update
            updateBtn.addEventListener('click', function (e) {
                e.preventDefault();
                updateUsername();
            });

            // Kosongkan input saat Cancel ditekan
            cancelBtn.addEventListener('click', function () {
                input.value = '';
            });

            // Juga kosongkan input saat modal ditutup (misal klik X)
            modal.addEventListener('hidden.bs.modal', function () {
                input.value = '';
            });
        });
    </script>

    {{-- Modal password tidak ditutup jika terjadi error --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editPasswordModal = document.getElementById('editPasswordModal');
            const modal = new bootstrap.Modal(editPasswordModal);

            // Buka modal jika ada error
            @if($errors->has('current_password') || $errors->has('new_password') || $errors->has('password_confirmation'))
                modal.show();
            @endif

            // Jika sukses, tutup modal
            @if(session('success'))
                modal.hide();
            @endif

            // Kosongkan form saat Cancel ditekan
            const cancelBtn = editPasswordModal.querySelector('.btn-secondary');
            cancelBtn.addEventListener('click', function () {
                editPasswordModal.querySelectorAll('input[type="password"]').forEach(input => input.value = '');
            });

            // Juga kosongkan saat modal ditutup (misal klik X)
            editPasswordModal.addEventListener('hidden.bs.modal', function () {
                editPasswordModal.querySelectorAll('input[type="password"]').forEach(input => input.value = '');
            });
        });
    </script>


@endpush

@endsection




