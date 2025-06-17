@extends('layouts.app')

@section('title', 'Kelola Anggota - Admin SiUKKI')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        /* Modal styles */
        .modal-header.bg-danger {
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
        }

        .btn-close-white {
            filter: invert(1);
        }

        #deleteModal .alert-light {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        #deleteModal .modal-body {
            padding: 1.5rem;
        }

        #deleteModal .alert-danger {
            font-size: 0.875rem;
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="section-header">
        <h2>
            <i class="material-icons me-3" style="font-size: 2rem;">people</i>
            Kelola Anggota UKKI
        </h2>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="material-icons mb-2" style="font-size: 2.5rem;">people</i>
                    <h3 class="fw-bold">{{ $totalAnggota ?? 0 }}</h3>
                    <p class="mb-0">Total Anggota</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="material-icons mb-2" style="font-size: 2.5rem;">person_add</i>
                    <h3 class="fw-bold">{{ $anggotaBaru ?? 0 }}</h3>
                    <p class="mb-0">Anggota Baru</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="material-icons mb-2" style="font-size: 2.5rem;">trending_up</i>
                    <h3 class="fw-bold">{{ $anggotaAktif ?? 0 }}</h3>
                    <p class="mb-0">Anggota Aktif</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="material-icons mb-2" style="font-size: 2.5rem;">military_tech</i>
                    <h3 class="fw-bold">{{ $totalBadges ?? 0 }}</h3>
                    <p class="mb-0">Jenis Badge</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Button -->
    <div class="misi-section-box d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-1">Manajemen Anggota</h5>
            <p class="mb-0 text-muted">Kelola data anggota UKKI, tambah anggota baru, dan pantau aktivitas mereka</p>
        </div>
        <a href="{{ route('admin.anggota.create') }}" class="btn btn-success-custom btn-lg">
            <i class="material-icons me-2" style="vertical-align: middle;">person_add</i>
            Tambah Anggota Baru
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="search-filter-box">
        <form method="GET" action="{{ route('admin.anggota.index') }}">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label fw-semibold">Cari Anggota</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}"
                        placeholder="NPM atau Nama Anggota">
                </div>
                <div class="col-md-3">
                    <label for="level" class="form-label fw-semibold">Filter Level</label>
                    <select class="form-select" id="level" name="level">
                        <option value="">Semua Level</option>
                        @for ($i = 1; $i <= 20; $i++)
                            <option value="{{ $i }}" {{ request('level') == $i ? 'selected' : '' }}>Level
                                {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="badge" class="form-label fw-semibold">Filter Badge</label>
                    <select class="form-select" id="badge" name="badge">
                        <option value="">Semua Badge</option>
                        <option value="Murid Ilmu" {{ request('badge') == 'Murid Ilmu' ? 'selected' : '' }}>Murid Ilmu
                        </option>
                        <option value="Penuntut Kebaikan" {{ request('badge') == 'Penuntut Kebaikan' ? 'selected' : '' }}>
                            Penuntut Kebaikan</option>
                        <option value="Cendekiawan Islami"
                            {{ request('badge') == 'Cendekiawan Islami' ? 'selected' : '' }}>Cendekiawan Islami</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-success-custom w-100">
                        <i class="material-icons" style="font-size: 18px;">search</i>
                        Cari
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="table-box">
        <div class="table-header">
            <h5 class="mb-0">
                <i class="material-icons me-2" style="vertical-align: middle;">list</i>
                Daftar Anggota UKKI
            </h5>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th width="15%">NPM</th>
                        <th width="25%">Nama Anggota</th>
                        <th width="10%">Level</th>
                        <th width="15%">Badge</th>
                        <th width="10%">Total XP</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anggota ?? [] as $index => $member)
                        <tr>
                            <td>{{ $anggota->firstItem() + $index }}</td>
                            <td>
                                <span class="fw-semibold text-primary">{{ $member->npm }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $member->profile_url }}" alt="Avatar"
                                        class="rounded-circle me-2" style="width: 35px; height: 35px; object-fit: cover;">
                                    <div>
                                        <div class="fw-semibold">{{ $member->nama }}</div>
                                        <small class="text-muted">Member sejak
                                            {{ $member->created_at->format('M Y') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <span class="badge bg-primary fs-6 px-2 py-1">{{ $member->level }}</span>
                                    <div class="progress mt-1" style="height: 4px;">
                                        <div class="progress-bar bg-success"
                                            style="width: {{ $member->progress_percentage }}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @php
                                    $badgeClass = 'badge-murid';
                                    if ($member->badge == 'Penuntut Kebaikan') {
                                        $badgeClass = 'badge-penuntut';
                                    }
                                    if ($member->badge == 'Cendekiawan Islami') {
                                        $badgeClass = 'badge-cendekiawan';
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $member->badge ?? 'Murid Ilmu' }}</span>
                            </td>
                            <td>
                                <div class="text-center">
                                    <div class="fw-bold text-warning" style="font-size: 1.1rem;">{{ $member->xp }}
                                    </div>
                                    <small class="text-muted">XP</small>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.anggota.show', $member->npm) }}"
                                        class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                        <i class="material-icons" style="font-size: 16px;">visibility</i>
                                    </a>
                                    <a href="{{ route('admin.anggota.edit', $member->npm) }}"
                                        class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="material-icons" style="font-size: 16px;">edit</i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus"
                                        data-npm="{{ $member->npm }}" data-nama="{{ $member->nama }}"
                                        data-aktivitas="{{ $member->aktivitas->count() }}" onclick="confirmDelete(this)">
                                        <i class="material-icons" style="font-size: 16px;">delete</i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="material-icons text-muted mb-3" style="font-size: 4rem;">people_outline</i>
                                <p class="text-muted mb-0 h5">Belum ada data anggota</p>
                                <a href="{{ route('admin.anggota.create') }}" class="btn btn-success-custom mt-3">
                                    <i class="material-icons me-1" style="font-size: 18px;">person_add</i>
                                    Tambah Anggota Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if (isset($anggota) && $anggota->hasPages())
            <!-- Pagination -->
            <div class="p-3 border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Menampilkan {{ $anggota->firstItem() }}-{{ $anggota->lastItem() }} dari {{ $anggota->total() }}
                        anggota
                    </div>
                    {{ $anggota->links() }}
                </div>
            </div>
        @endif
    </div>

    <!-- Success Alert -->
    @if (session('success'))
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="material-icons me-2" style="vertical-align: middle;">check_circle</i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <!-- Modal Konfirmasi Delete -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">
                        <i class="material-icons me-2" style="vertical-align: middle;">warning</i>
                        Konfirmasi Hapus Anggota
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="material-icons text-danger" style="font-size: 4rem;">delete_forever</i>
                    </div>
                    <h5 class="text-center mb-3">Apakah Anda yakin ingin menghapus anggota ini?</h5>

                    <div class="alert alert-light border">
                        <div class="mb-2">
                            <small class="text-muted">Nama Anggota:</small>
                            <div class="fw-bold" id="deleteAnggotaNama">-</div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">NPM:</small>
                            <div class="fw-bold" id="deleteAnggotaNpm">-</div>
                        </div>
                        <div>
                            <small class="text-muted">Total Aktivitas:</small>
                            <div class="fw-bold text-danger" id="deleteAnggotaAktivitas">0 aktivitas</div>
                        </div>
                    </div>

                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="material-icons me-2">info</i>
                        <div>
                            <strong>Perhatian!</strong> Tindakan ini tidak dapat dibatalkan.
                            Semua data aktivitas yang terkait dengan anggota ini akan ikut terhapus.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="material-icons me-1" style="font-size: 18px;">close</i>
                        Batal
                    </button>
                    <form id="deleteForm" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="material-icons me-1" style="font-size: 18px;">delete</i>
                            Ya, Hapus Anggota
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Auto submit form when filter changes
        document.querySelectorAll('#level, #badge').forEach(element => {
            element.addEventListener('change', function() {
                this.form.submit();
            });
        });

        // Auto hide success message
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert-dismissible');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                setTimeout(() => {
                    bsAlert.close();
                }, 5000);
            });
        }, 100);

        // Function to show delete confirmation modal
        function confirmDelete(button) {
            // Get data from button attributes
            const npm = button.getAttribute('data-npm');
            const nama = button.getAttribute('data-nama');
            const totalAktivitas = button.getAttribute('data-aktivitas');

            // Set data ke modal
            document.getElementById('deleteAnggotaNama').textContent = nama;
            document.getElementById('deleteAnggotaNpm').textContent = npm;
            document.getElementById('deleteAnggotaAktivitas').textContent = totalAktivitas + ' aktivitas';

            // Set action URL ke form
            const deleteForm = document.getElementById('deleteForm');
            const baseUrl = "{{ route('admin.anggota.destroy', '__npm__') }}";
            deleteForm.action = baseUrl.replace('__npm__', npm);

            // Show modal
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endpush
