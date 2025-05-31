@extends('layouts.app')

@section('title', 'Detail Anggota - Admin SiUKKI')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .profile-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
        }

        .profile-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s;
        }

        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .badge-level {
            background: #4CAF50;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .progress-bar-custom {
            background: linear-gradient(90deg, #4CAF50 0%, #8BC34A 100%);
        }

        .activity-timeline {
            position: relative;
            padding-left: 30px;
        }

        .activity-timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 2px;
            background: #e0e0e0;
        }

        .activity-item {
            position: relative;
            padding-bottom: 1.5rem;
        }

        .activity-item::before {
            content: '';
            position: absolute;
            left: -34px;
            top: 5px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #4CAF50;
            border: 2px solid white;
            box-shadow: 0 0 0 2px #e0e0e0;
        }

        .info-row {
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

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
            <i class="material-icons me-3" style="font-size: 2rem;">person</i>
            Detail Anggota UKKI
        </h2>
    </div>

    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('admin.anggota.index') }}" class="btn btn-outline-secondary">
            <i class="material-icons me-1" style="font-size: 18px;">arrow_back</i>
            Kembali ke Daftar
        </a>
    </div>

    <!-- Profile Header -->
    <div class="profile-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center">
                    <img src="{{ $anggota->profile_url }}" alt="{{ $anggota->nama }}"
                        class="rounded-circle profile-img me-4">
                    <div>
                        <h2 class="mb-1">{{ $anggota->nama }}</h2>
                        <p class="mb-2 fs-5 opacity-75">NPM: {{ $anggota->npm }}</p>
                        <div class="d-flex gap-3 align-items-center">
                            <span class="badge-level">Level {{ $anggota->level }}</span>
                            @php
                                $badgeClass = 'badge bg-secondary';
                                if ($anggota->badge == 'Penuntut Kebaikan') {
                                    $badgeClass = 'badge bg-info';
                                }
                                if ($anggota->badge == 'Cendekiawan Islami') {
                                    $badgeClass = 'badge bg-warning text-dark';
                                }
                            @endphp
                            <span class="{{ $badgeClass }} fs-6 px-3 py-2">{{ $anggota->badge ?? 'Murid Ilmu' }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('admin.anggota.edit', $anggota->npm) }}" class="btn btn-light">
                    <i class="material-icons me-1" style="font-size: 18px;">edit</i>
                    Edit Profil
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stats-card">
                <i class="material-icons text-warning mb-2" style="font-size: 2.5rem;">stars</i>
                <h3 class="fw-bold mb-0">{{ $anggota->xp }}</h3>
                <p class="mb-0 text-muted">Total XP</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <i class="material-icons text-success mb-2" style="font-size: 2.5rem;">task_alt</i>
                <h3 class="fw-bold mb-0">{{ $anggota->aktivitas->count() }}</h3>
                <p class="mb-0 text-muted">Total Aktivitas</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <i class="material-icons text-primary mb-2" style="font-size: 2.5rem;">today</i>
                <h3 class="fw-bold mb-0">{{ $anggota->aktivitasToday()->count() }}</h3>
                <p class="mb-0 text-muted">Aktivitas Hari Ini</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <i class="material-icons text-info mb-2" style="font-size: 2.5rem;">calendar_month</i>
                <h3 class="fw-bold mb-0">{{ $anggota->aktivitasThisMonth()->count() }}</h3>
                <p class="mb-0 text-muted">Aktivitas Bulan Ini</p>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Profile Info -->
        <div class="col-md-4">
            <!-- Profile Information -->
            <div class="misi-section-box">
                <h5 class="mb-3">
                    <i class="material-icons me-2" style="vertical-align: middle;">info</i>
                    Informasi Profil
                </h5>

                <div class="info-row">
                    <small class="text-muted d-block">Nama Lengkap</small>
                    <strong>{{ $anggota->nama }}</strong>
                </div>

                <div class="info-row">
                    <small class="text-muted d-block">NPM</small>
                    <strong>{{ $anggota->npm }}</strong>
                </div>

                <div class="info-row">
                    <small class="text-muted d-block">Bergabung Sejak</small>
                    <strong>{{ $anggota->created_at->format('d F Y') }}</strong>
                    <small class="text-muted d-block">{{ $anggota->created_at->diffForHumans() }}</small>
                </div>

                <div class="info-row">
                    <small class="text-muted d-block">Terakhir Diperbarui</small>
                    <strong>{{ $anggota->updated_at->format('d F Y H:i') }}</strong>
                </div>
            </div>

            <!-- Progress Level -->
            <div class="misi-section-box mt-3">
                <h5 class="mb-3">
                    <i class="material-icons me-2" style="vertical-align: middle;">trending_up</i>
                    Progress Level
                </h5>

                <div class="text-center mb-3">
                    <div class="badge-level mb-2" style="font-size: 2rem;">
                        Level {{ $anggota->level }}
                    </div>
                    <p class="mb-0 text-muted">{{ $anggota->xp }} / {{ $anggota->level * 300 }} XP</p>
                </div>

                <div class="progress mb-2" style="height: 20px;">
                    <div class="progress-bar progress-bar-custom" role="progressbar"
                        style="width: {{ $anggota->progress_percentage }}%"
                        aria-valuenow="{{ $anggota->progress_percentage }}" aria-valuemin="0" aria-valuemax="100">
                        {{ round($anggota->progress_percentage) }}%
                    </div>
                </div>

                <small class="text-muted">
                    Butuh {{ $anggota->xp_to_next_level }} XP lagi untuk naik ke Level {{ $anggota->level + 1 }}
                </small>
            </div>
        </div>

        <!-- Right Column - Activities -->
        <div class="col-md-8">
            <!-- Recent Activities -->
            <div class="misi-section-box">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">
                        <i class="material-icons me-2" style="vertical-align: middle;">history</i>
                        Aktivitas Terbaru
                    </h5>
                    <span class="badge bg-primary">{{ $anggota->aktivitas->count() }} Total</span>
                </div>

                @if ($anggota->aktivitas->count() > 0)
                    <div class="activity-timeline">
                        @foreach ($anggota->aktivitas->take(10) as $aktivitas)
                            <div class="activity-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="mb-1">{{ $aktivitas->misi->nama_misi ?? 'Misi Tidak Diketahui' }}</h6>
                                        <p class="mb-1 text-muted small">
                                            {{ $aktivitas->keterangan ?? 'Tidak ada keterangan' }}
                                        </p>
                                        <div class="d-flex gap-3 align-items-center">
                                            <small class="text-muted">
                                                <i class="material-icons" style="font-size: 14px;">calendar_today</i>
                                                {{ $aktivitas->tanggal->format('d M Y') }}
                                            </small>
                                            <small class="text-success fw-bold">
                                                <i class="material-icons" style="font-size: 14px;">add_circle</i>
                                                +{{ $aktivitas->xp_diperoleh }} XP
                                            </small>
                                            @if ($aktivitas->status == 'approved')
                                                <span class="badge bg-success">Disetujui</span>
                                            @elseif($aktivitas->status == 'pending')
                                                <span class="badge bg-warning">Menunggu</span>
                                            @else
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($anggota->aktivitas->count() > 10)
                        <div class="text-center mt-3">
                            <p class="text-muted">Menampilkan 10 dari {{ $anggota->aktivitas->count() }} aktivitas</p>
                        </div>
                    @endif
                @else
                    <div class="text-center py-5">
                        <i class="material-icons text-muted mb-3" style="font-size: 4rem;">history_toggle_off</i>
                        <p class="text-muted mb-0">Belum ada aktivitas tercatat</p>
                    </div>
                @endif
            </div>

            <!-- Actions -->
            <div class="misi-section-box mt-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">Aksi Lainnya</h6>
                        <p class="mb-0 text-muted">Kelola data anggota ini</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.anggota.edit', $anggota->npm) }}" class="btn btn-warning">
                            <i class="material-icons me-1" style="font-size: 18px;">edit</i>
                            Edit Data
                        </a>
                        <button type="button" class="btn btn-danger" onclick="showDeleteModal()">
                            <i class="material-icons me-1" style="font-size: 18px;">delete</i>
                            Hapus Anggota
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                            <div class="fw-bold">{{ $anggota->nama }}</div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">NPM:</small>
                            <div class="fw-bold">{{ $anggota->npm }}</div>
                        </div>
                        <div>
                            <small class="text-muted">Total Aktivitas:</small>
                            <div class="fw-bold text-danger">{{ $anggota->aktivitas->count() }} aktivitas</div>
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
                    <form action="{{ route('admin.anggota.destroy', $anggota->npm) }}" method="POST" class="d-inline">
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
        function showDeleteModal() {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endpush
