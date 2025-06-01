@extends('layouts.app')

@section('title', 'Detail Misi - Admin SiUKKI')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .misi-header {
            background: linear-gradient(135deg, #4CAF50 0%, #2E7D32 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
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

        .info-row {
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .misi-section-box {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin-bottom: 1.5rem;
            padding: 1.5rem;
        }

        .modal-header.bg-danger {
            background: linear-gradient(135deg, #f44336 0%, #d32f2f 100%);
        }

        .btn-close-white {
            filter: invert(1);
        }
    </style>
@endpush

@section('content')
    <!-- Page Header -->
    <div class="section-header">
        <h2>
            <i class="material-icons me-3" style="font-size: 2rem;">assignment</i>
            Detail Misi
        </h2>
    </div>

    <!-- Back Button -->
    <div class="mb-4">
        <a href="{{ route('admin.misi.index') }}" class="btn btn-outline-secondary">
            <i class="material-icons me-1" style="font-size: 18px;">arrow_back</i>
            Kembali ke Daftar
        </a>
    </div>

    <!-- Misi Header -->
    <div class="misi-header">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="d-flex align-items-center">
                    @if ($misi->icon)
                        <img src="{{ asset('assets/icons/' . $misi->icon . '.svg') }}" alt="{{ $misi->nama_misi }}"
                            class="me-4" style="width: 64px; height: 64px;">
                    @else
                        <i class="material-icons me-4" style="font-size: 64px;">assignment</i>
                    @endif
                    <div>
                        <h2 class="mb-1">{{ $misi->nama_misi }}</h2>
                        <div class="d-flex gap-3 align-items-center">
                            <span class="badge bg-light text-dark">{{ ucfirst($misi->tipe_misi) }}</span>
                            <span class="badge {{ $misi->status === 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($misi->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="{{ route('admin.misi.edit', $misi->id_misi) }}" class="btn btn-light">
                    <i class="material-icons me-1" style="font-size: 18px;">edit</i>
                    Edit Misi
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="stats-card">
                <i class="material-icons text-warning mb-2" style="font-size: 2.5rem;">stars</i>
                <h3 class="fw-bold mb-0">{{ $misi->xp_reward }}</h3>
                <p class="mb-0 text-muted">XP Reward</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <i class="material-icons text-info mb-2" style="font-size: 2.5rem;">event</i>
                <h3 class="fw-bold mb-0">{{ $misi->jadwal->format('d M') }}</h3>
                <p class="mb-0 text-muted">Jadwal</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <i class="material-icons text-success mb-2" style="font-size: 2.5rem;">calendar_today</i>
                <h3 class="fw-bold mb-0">{{ $misi->tanggal_mulai->format('d M') }}</h3>
                <p class="mb-0 text-muted">Mulai</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <i class="material-icons text-danger mb-2" style="font-size: 2.5rem;">event_busy</i>
                <h3 class="fw-bold mb-0">{{ $misi->tanggal_selesai->format('d M') }}</h3>
                <p class="mb-0 text-muted">Selesai</p>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Left Column - Misi Info -->
        <div class="col-md-12">
            <div class="misi-section-box">
                <h5 class="mb-3">
                    <i class="material-icons me-2" style="vertical-align: middle;">info</i>
                    Informasi Misi
                </h5>

                <div class="row">
                    <div class="col-md-6">
                        <div class="info-row">
                            <small class="text-muted d-block">Nama Misi</small>
                            <strong>{{ $misi->nama_misi }}</strong>
                        </div>

                        <div class="info-row">
                            <small class="text-muted d-block">Tipe Misi</small>
                            <strong>{{ ucfirst($misi->tipe_misi) }}</strong>
                        </div>

                        <div class="info-row">
                            <small class="text-muted d-block">XP Reward</small>
                            <strong>{{ $misi->xp_reward }} XP</strong>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-row">
                            <small class="text-muted d-block">Status</small>
                            <span class="badge {{ $misi->status === 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($misi->status) }}
                            </span>
                        </div>

                        <div class="info-row">
                            <small class="text-muted d-block">Periode</small>
                            <strong>{{ $misi->tanggal_mulai->format('d M Y') }} -
                                {{ $misi->tanggal_selesai->format('d M Y') }}</strong>
                        </div>

                        <div class="info-row">
                            <small class="text-muted d-block">Jadwal</small>
                            <strong>{{ $misi->jadwal->format('d F Y') }}</strong>
                        </div>
                    </div>
                </div>

                @if ($misi->deskripsi)
                    <div class="mt-3">
                        <small class="text-muted d-block">Deskripsi</small>
                        <p class="mb-0">{{ $misi->deskripsi }}</p>
                    </div>
                @endif
            </div>

            <!-- Actions -->
            <div class="misi-section-box">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">Aksi Lainnya</h6>
                        <p class="mb-0 text-muted">Kelola misi ini</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.misi.edit', $misi->id_misi) }}" class="btn btn-warning">
                            <i class="material-icons me-1" style="font-size: 18px;">edit</i>
                            Edit Misi
                        </a>
                        <button type="button" class="btn btn-danger" onclick="showDeleteModal()">
                            <i class="material-icons me-1" style="font-size: 18px;">delete</i>
                            Hapus Misi
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
                            <div class="fw-bold">{{ $misi->nama_misi }}</div>
                        </div>
                        <div class="mb-2">
                            <small class="text-muted">Tipe:</small>
                            <div class="fw-bold">{{ ucfirst($misi->tipe_misi) }}</div>
                        </div>
                        <div>
                            <small class="text-muted">XP Reward:</small>
                            <div class="fw-bold">{{ $misi->xp_reward }} XP</div>
                        </div>
                    </div>

                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class="material-icons me-2">info</i>
                        <div>
                            <strong>Perhatian!</strong> Tindakan ini tidak dapat dibatalkan.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="material-icons me-1" style="font-size: 18px;">close</i>
                        Batal
                    </button>
                    <form action="{{ route('admin.misi.destroy', $misi->id_misi) }}" method="POST" class="d-inline">
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
        function showDeleteModal() {
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    </script>
@endpush
