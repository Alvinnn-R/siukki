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
                        @method('PUT')

                        <div class="profile-setting-card">
                            <div class="profile-setting-left">
                                <img src="{{ auth()->user()->profile_url ? auth()->user()->profile_url : asset('assets/images/Avater.png') }}"
                                    alt="Profile" id="profileImage" />
                            </div>
                            <div class="profile-setting-right">
                                <div class="button-row">
                                    <input type="file" id="profileImageInput" name="profile_image" accept="image/*"
                                        style="display: none;">
                                    <button type="button" class="btn-setting" data-bs-toggle="modal"
                                        data-bs-target="#chooseAvatarModal">
                                        Change image
                                    </button>
                                    <button type="button" class="btn-setting" onclick="removeProfileImage()">
                                        Remove image
                                    </button>
                                </div>

                                <label for="username" style="margin-bottom: 0px;">Username</label>
                                <input id="username" name="name" type="text"
                                    value="{{ old('name', auth()->user()->name ?? 'Riky') }}"
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

                    <div class="setting-bottom-row">
                        <div class="badge-box">
                            <span>Badge</span>
                            <input type="text" value="{{ auth()->user()->badge ?? 'HAJI' }}" disabled>
                            <button class="btn-setting" data-bs-toggle="modal" data-bs-target="#badgeModal">
                                Edit badge
                            </button>
                        </div>
                        <div class="notif-box">
                            <span>Notification</span>
                            <input type="text"
                                value="{{ auth()->user()->email ?? '23081010021@student.upnjatim.ac.id' }}" disabled>
                            <label class="switch">
                                <input type="checkbox" id="notifToggle"
                                    {{ auth()->user()->notifications_enabled ? 'checked' : '' }}
                                    onchange="confirmToggleNotifications()">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <script>
                            function confirmToggleNotifications() {
                                const checkbox = document.getElementById('notifToggle');
                                if (checkbox.checked) {
                                    if (confirm('Are you sure you want to enable notifications?')) {
                                        toggleNotifications();
                                    } else {
                                        checkbox.checked = false;
                                    }
                                } else {
                                    toggleNotifications();
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Choose Avatar Modal -->
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
                    @method('PUT')
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
                        <input type="hidden" name="avatar" id="selectedAvatarInput">
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

    @push('scripts')
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
    @endpush

    <!-- Edit Username Modal -->
    <div class="modal fade" id="editUsernameModal" tabindex="-1" aria-labelledby="editUsernameModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('setting.username') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUsernameModalLabel">Edit Username</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="new_username">New Username</label>
                        <input id="new_username" name="name" type="text" placeholder="Enter new username"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Password Modal -->
    <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('setting.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPasswordModalLabel">Edit Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="current_password">Current Password</label>
                        <input id="current_password" name="current_password" type="password"
                            placeholder="Enter current password"
                            class="form-control @error('current_password') is-invalid @enderror">
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="new_password" class="mt-3">New Password</label>
                        <input id="new_password" name="password" type="password" placeholder="Enter new password"
                            class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <label for="password_confirmation" class="mt-3">Confirm New Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            placeholder="Confirm new password" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Badge Modal -->
    <div class="modal fade" id="badgeModal" tabindex="-1" aria-labelledby="badgeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="badgeModalLabel">Edit Badge</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('setting.badge') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Badge</label>
                            <div class="d-flex gap-2">
                                @php
                                    $badges = ['MURID ILMU', 'SANTRI', 'HABIB'];
                                    $currentBadge = auth()->user()->badge ?? 'HAJI';
                                @endphp
                                @foreach ($badges as $badge)
                                    <input type="radio" class="btn-check" name="badge"
                                        id="badge-{{ $badge }}" value="{{ $badge }}" autocomplete="off"
                                        {{ $currentBadge === $badge ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary"
                                        for="badge-{{ $badge }}">{{ $badge }}</label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // Preview image before upload
        document.getElementById('profileImageInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Remove profile image
        function removeProfileImage() {
            if (confirm('Are you sure you want to remove your profile image?')) {
                fetch('{{ route('setting.remove-image') }}', {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('profileImage').src = '{{ asset('assets/Avater.png') }}';
                            location.reload();
                        } else {
                            alert('Failed to remove image');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred');
                    });
            }
        }

        // Toggle notifications
        function toggleNotifications() {
            const checkbox = document.getElementById('notifToggle');
            const enabled = checkbox.checked;

            fetch('{{ route('setting.notifications') }}', {
                    method: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        notifications_enabled: enabled
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) {
                        // Revert checkbox if failed
                        checkbox.checked = !enabled;
                        alert('Failed to update notification settings');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Revert checkbox if failed
                    checkbox.checked = !enabled;
                    alert('An error occurred');
                });
        }
    </script>
@endsection
