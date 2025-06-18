@extends('layouts.app')

@section('title', 'Settings Admin')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush
@push('styles')
    <style>
        .settings-area {
            background: #99bc85;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .settings-area h2 {
            color: #333;
            margin-bottom: 30px;
            font-weight: 600;
        }

        .profile-setting-card {
            display: flex;
            gap: 30px;
            align-items: flex-start;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 30px;
            background: #f9f9f9;
        }

        .profile-setting-left {
            flex-shrink: 0;
        }

        .img-profile {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #e0e0e0;
        }

        .profile-setting-right {
            flex: 1;
        }

        .profile-setting-right label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .profile-setting-right input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .btn-setting {
            background-color: #6d9d3b;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-bottom: 15px;
            margin-right: 10px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-setting:hover {
            background-color: #52841e;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 5px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .btn-close {
            background: none;
            border: none;
            font-size: 18px;
            cursor: pointer;
            float: right;
        }

        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            background-color: #99bc85;
            border-radius: 5px 5px 0px 0px;
            border-bottom: 1px solid #dee2e6;
        }

        .modal-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }

        /* .form-control {
                                                                        padding: 10px;
                                                                        border: 1px solid #ddd;
                                                                        border-radius: 5px;
                                                                        margin-bottom: 15px;
                                                                    } */

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            color: #dc3545;
            font-size: 14px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-primary:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="main-content-settings">
                <div class="settings-area">
                    <h2><i class="material-icons me-3" style="font-size: 2rem;">manage_accounts</i>Settings Admin</h2>

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    <div class="profile-setting-card">
                        <div class="profile-setting-left">
                            <img src="{{ asset('assets/images/avatar-admin.png') }}" alt="Admin Profile"
                                class="img-profile">
                        </div>
                        <div class="profile-setting-right">
                            <label for="username" style="margin-bottom: 8px;">Username</label>
                            <input id="username" name="name" type="text"
                                value="{{ Auth::guard('admin')->user()->nama }}" class="form-control" readonly
                                style="pointer-events: none; background-color: #f5f5f5;">

                            <!-- Edit Username Button -->
                            <button type="button" class="btn-setting" data-bs-toggle="modal"
                                data-bs-target="#editUsernameModal">
                                Edit Username
                            </button>

                            <label for="password" style="margin-bottom: 8px;">Password</label>
                            <input id="password" name="password" type="password" class="form-control" value="************"
                                readonly disabled style="pointer-events: none; background-color: #f5f5f5;">

                            <!-- Edit Password Button -->
                            <button type="button" class="btn-setting" data-bs-toggle="modal"
                                data-bs-target="#editPasswordModal">
                                Edit Password
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Username Modal -->
    <div class="modal fade" id="editUsernameModal" tabindex="-1" aria-labelledby="editUsernameModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editUsernameModalLabel">Edit Username</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <div class="modal-body">
                    <label for="newUsername">New Username</label>
                    <input type="text" id="newUsernameInput" class="form-control" placeholder="Enter new username">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveUsernameBtn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Password -->
    <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="editPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.setting.password') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPasswordModalLabel">Edit Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <!-- Current Password -->
                        <label for="current_password">Password Saat Ini</label>
                        <input id="current_password" name="current_password" type="password"
                            placeholder="Masukkan Password Saat Ini"
                            class="form-control @error('current_password') is-invalid @enderror">
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!-- New Password -->
                        <label for="new_password" class="mt-3">Password Baru</label>
                        <input id="new_password" name="new_password" type="password"
                            placeholder="Masukkan Password Baru"
                            class="form-control @error('new_password') is-invalid @enderror">
                        @error('new_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!-- Confirm New Password -->
                        <label for="password_confirmation" class="mt-3">Konfirmasi Password Baru</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            placeholder="Konfirmasi Password baru"
                            class="form-control @error('password_confirmation') is-invalid @enderror">
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
        {{-- Script untuk edit Username --}}
        <script>
            function showBootstrapAlert(message, type) {
                const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert">&times;</button>
        </div>
    `;
                document.querySelector('.settings-area').insertAdjacentHTML('afterbegin', alertHtml);

                // Auto close after 3 seconds
                setTimeout(() => {
                    const alert = document.querySelector('.alert');
                    if (alert) alert.remove();
                }, 3000);
            }
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('editUsernameModal');
                const saveBtn = document.getElementById('saveUsernameBtn');

                modal.addEventListener('shown.bs.modal', function() {
                    const input = document.getElementById('newUsernameInput');
                    if (!input) return;
                    input.focus();

                    // Handle Enter key
                    input.removeEventListener('keydown', window._handleEnterKey);
                    window._handleEnterKey = function(e) {
                        if (e.key === 'Enter') {
                            e.preventDefault();
                            updateUsername();
                        }
                    };
                    input.addEventListener('keydown', window._handleEnterKey);

                    // Handle save button click
                    saveBtn.onclick = function() {
                        updateUsername();
                    };
                });

                function updateUsername() {
                    const input = document.getElementById('newUsernameInput');
                    const name = input.value.trim();
                    if (!name) return;

                    fetch("{{ route('admin.setting.username.update') }}", {
                            method: "POST",
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                name
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                showBootstrapAlert('Username berhasil diperbarui!', 'success');
                                setTimeout(() => location.reload(), 1500);
                            } else {
                                showBootstrapAlert('Gagal memperbarui username.', 'danger');
                            }
                        })
                        .catch(err => {
                            console.error("Error:", err);
                            showBootstrapAlert("Terjadi kesalahan saat memperbarui.", 'danger');
                        });
                }
            });

            document.addEventListener('DOMContentLoaded', function() {
                const editPasswordModal = document.getElementById('editPasswordModal');

                // Buka modal jika ada error
                @if ($errors->has('current_password') || $errors->has('new_password') || $errors->has('password_confirmation'))
                    const modal = new bootstrap.Modal(editPasswordModal);
                    modal.show();
                @endif

                // Jika sukses, tutup modal
                @if (session('success'))
                    const modal = bootstrap.Modal.getInstance(editPasswordModal);
                    if (modal) {
                        modal.hide();
                    }
                @endif
            });

            document.addEventListener('DOMContentLoaded', function() {
                // Auto dismiss alerts after 5 seconds
                setTimeout(function() {
                    const alerts = document.querySelectorAll('.alert');
                    alerts.forEach(function(alert) {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    });
                }, 5000);
            });
        </script>
    @endpush

@endsection
