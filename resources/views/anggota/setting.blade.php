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
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
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
                            <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('assets/images/Avater.png') }}" 
                                 alt="Profile" id="profileImage" />
                        </div>
                        <div class="profile-setting-right">
                            <div class="button-row">
                                <input type="file" id="profileImageInput" name="profile_image" accept="image/*" style="display: none;">
                                <button type="button" class="btn-setting" onclick="document.getElementById('profileImageInput').click()">
                                    Change image
                                </button>
                                <button type="button" class="btn-setting" onclick="removeProfileImage()">
                                    Remove image
                                </button>
                            </div>
                            
                            <label for="username">Username</label>
                            <input id="username" name="name" type="text" 
                                   value="{{ old('name', auth()->user()->name ?? 'Riky') }}" 
                                   class="@error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="current_password">Current Password</label>
                            <input id="current_password" name="current_password" type="password" 
                                   placeholder="Enter current password"
                                   class="@error('current_password') is-invalid @enderror">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="new_password">New Password</label>
                            <input id="new_password" name="password" type="password" 
                                   placeholder="Enter new password"
                                   class="@error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <label for="password_confirmation">Confirm New Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" 
                                   placeholder="Confirm new password">

                            <button type="submit" class="btn-setting" style="margin-top:10px;">
                                Update Profile
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
                        <input type="text" value="{{ auth()->user()->email ?? '23081010021@student.upnjatim.ac.id' }}" disabled>
                        <label class="switch">
                            <input type="checkbox" id="notifToggle" 
                                   {{ auth()->user()->notifications_enabled ? 'checked' : '' }}
                                   onchange="toggleNotifications()">
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
            </div>
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
                        <label for="badge" class="form-label">Badge</label>
                        <input type="text" class="form-control" id="badge" name="badge" 
                               value="{{ auth()->user()->badge ?? 'HAJI' }}" maxlength="20">
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
            fetch('{{ route("setting.remove-image") }}', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('profileImage').src = '{{ asset("assets/Avater.png") }}';
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
        
        fetch('{{ route("setting.notifications") }}', {
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