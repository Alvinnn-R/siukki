@extends('layouts.app')

@section('title', 'Kelola Misi - Admin SiUKKI')

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

        .badge-harian {
            background-color: #2196F3;
            color: white;
        }

        .badge-mingguan {
            background-color: #FF9800;
            color: white;
        }

        .badge-event {
            background-color: #9C27B0;
            color: white;
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="section-header">
        <h2>
            <i class="material-icons me-3" style="font-size: 2rem;">assignment</i>
            Kelola Misi UKKI
        </h2>
    </div>

    <!-- Stats Section -->
    <div class="stats-section">
        <div class="row g-3">
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="material-icons mb-2" style="font-size: 2.5rem;">assignment</i>
                    <h3 class="fw-bold">{{ $misis->total() ?? 0 }}</h3>
                    <p class="mb-0">Total Misi</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="material-icons mb-2" style="font-size: 2.5rem;">check_circle</i>
                    <h3 class="fw-bold">{{ $misisAktif ?? 0 }}</h3>
                    <p class="mb-0">Misi Aktif</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="material-icons mb-2" style="font-size: 2.5rem;">today</i>
                    <h3 class="fw-bold">{{ $misisHarian ?? 0 }}</h3>
                    <p class="mb-0">Misi Harian</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <i class="material-icons mb-2" style="font-size: 2.5rem;">event</i>
                    <h3 class="fw-bold">{{ $misisEvent ?? 0 }}</h3>
                    <p class="mb-0">Misi Event</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Button -->
    <div class="misi-section-box d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-1">Manajemen Misi</h5>
            <p class="mb-0 text-muted">Kelola misi harian, mingguan, dan event untuk anggota UKKI</p>
        </div>
        <a href="{{ route('admin.misi.create') }}" class="btn btn-success-custom btn-lg">
            <i class="material-icons me-2" style="vertical-align: middle;">add_circle</i>
            Tambah Misi Baru
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="search-filter-box">
        <form method="GET" action="{{ route('admin.misi.index') }}">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label fw-semibold">Cari Misi</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}"
                        placeholder="Nama misi...">
                </div>
                <div class="col-md-3">
                    <label for="tipe" class="form-label fw-semibold">Filter Tipe</label>
                    <select class="form-select" id="tipe" name="tipe">
                        <option value="">Semua Tipe</option>
                        <option value="harian" {{ request('tipe') == 'harian' ? 'selected' : '' }}>Harian</option>
                        <option value="mingguan" {{ request('tipe') == 'mingguan' ? 'selected' : '' }}>Mingguan</option>
                        <option value="event" {{ request('tipe') == 'event' ? 'selected' : '' }}>Event</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label fw-semibold">Filter Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
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
                Daftar Misi UKKI
            </h5>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="5%">#</th>
                        <th width="8%">Icon</th>
                        <th width="25%">Nama Misi</th>
                        <th width="10%">Tipe</th>
                        <th width="10%">XP Reward</th>
                        <th width="15%">Periode</th>
                        <th width="10%">Status</th>
                        <th width="17%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($misis as $index => $misi)
                        <tr>
                            <td>{{ $misis->firstItem() + $index }}</td>
                            <td>
                                <img src="{{ $misi->icon_url }}" alt="Icon" width="40" height="40"
                                    class="rounded">
                            </td>
                            <td>
                                <div>
                                    <div class="fw-semibold">{{ $misi->nama_misi }}</div>
                                    <small class="text-muted">{{ Str::limit($misi->deskripsi, 50) }}</small>
                                </div>
                            </td>
                            <td>
                                @php
                                    $badgeClass = 'badge-harian';
                                    if ($misi->tipe_misi == 'mingguan') {
                                        $badgeClass = 'badge-mingguan';
                                    } elseif ($misi->tipe_misi == 'event') {
                                        $badgeClass = 'badge-event';
                                    }
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($misi->tipe_misi) }}</span>
                            </td>
                            <td>
                                <div class="text-center">
                                    <div class="fw-bold text-warning" style="font-size: 1.1rem;">
                                        {{ number_format($misi->xp_reward) }}</div>
                                    <small class="text-muted">XP</small>
                                </div>
                            </td>
                            <td>
                                <small class="d-block">{{ $misi->tanggal_mulai->format('d/m/Y') }} -</small>
                                <small>{{ $misi->tanggal_selesai->format('d/m/Y') }}</small>
                            </td>
                            <td>
                                <form action="{{ route('admin.misi.toggle-status', $misi) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="btn btn-sm btn-{{ $misi->status == 'aktif' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($misi->status) }}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.misi.show', $misi) }}"
                                        class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                        <i class="material-icons" style="font-size: 16px;">visibility</i>
                                    </a>
                                    <a href="{{ route('admin.misi.edit', $misi) }}"
                                        class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="material-icons" style="font-size: 16px;">edit</i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus"
                                        data-id="{{ $misi->id_misi }}" data-nama="{{ $misi->nama_misi }}"
                                        data-aktivitas="{{ $misi->aktivitas->count() }}" onclick="confirmDelete(this)">
                                        <i class="material-icons" style="font-size: 16px;">delete</i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <i class="material-icons text-muted mb-3" style="font-size: 4rem;">assignment_outlined</i>
                                <p class="text-muted mb-0 h5">Belum ada data misi</p>
                                <a href="{{ route('admin.misi.create') }}" class="btn btn-success-custom mt-3">
                                    <i class="material-icons me-1" style="font-size: 18px;">add_circle</i>
                                    Tambah Misi Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($misis->hasPages())
            <!-- Pagination -->
            <div class="p-3 border-top">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="text-muted">
                        Menampilkan {{ $misis->firstItem() }}-{{ $misis->lastItem() }} dari {{ $misis->total() }} misi
                    </div>
                    {{ $misis->links() }}
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
                        Konfirmasi Hapus Misi
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="material-icons text-danger" style="font-size: 4rem;">delete_forever</i>
                    </div>
                    <h5 class="text-center mb-3">Apakah Anda yakin ingin menghapus misi ini?</h5>

                    <div class="alert alert-light border">
                        <div class="mb-2">
                            <small class="text-muted">Nama Misi:</small>
                            <div class="fw-bold" id="deleteMisiNama">-</div>
                        </div>
                        <div>
                            <small class="text-muted">Total Aktivitas Terkait:</small>
                            <div class="fw-bold text-danger" id="deleteMisiAktivitas">0 aktivitas</div>
                        </div>
                    </div>

                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="material-icons me-2">info</i>
                        <div>
                            <strong>Perhatian!</strong> Tindakan ini tidak dapat dibatalkan.
                            Semua data aktivitas yang terkait dengan misi ini akan ikut terhapus.
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
                            Ya, Hapus Misi
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
        document.querySelectorAll('#tipe, #status').forEach(element => {
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
            const id = button.getAttribute('data-id');
            const nama = button.getAttribute('data-nama');
            const totalAktivitas = button.getAttribute('data-aktivitas');

            // Set data ke modal
            document.getElementById('deleteMisiNama').textContent = nama;
            document.getElementById('deleteMisiAktivitas').textContent = totalAktivitas + ' aktivitas';

            // Set action URL ke form
            const deleteForm = document.getElementById('deleteForm');
            const baseUrl = "{{ route('admin.misi.destroy', '__id__') }}";
            deleteForm.action = baseUrl.replace('__id__', id);

            // Show modal
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endpush
