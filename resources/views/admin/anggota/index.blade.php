@extends('layouts.app')

@section('title', 'Kelola Anggota - Admin SiUKKI')

@push('styles')
    <style>
        .content-bg {
            background-color: #F4FDF0;
            min-height: calc(100vh - 2rem);
            border-radius: 15px;
        }

        .stats-card {
            background: linear-gradient(135deg, #d2ebbc 0%, #a6cf90 100%);
            border-radius: 10px;
            border: none;
            color: white;
        }

        .table-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(166, 207, 144, 0.2);
        }

        .table-header {
            background-color: #a6cf90;
            color: white;
            border-radius: 15px 15px 0 0;
        }

        .btn-success-custom {
            background-color: #a6cf90;
            border-color: #a6cf90;
            color: white;
        }

        .btn-success-custom:hover {
            background-color: #8fb876;
            border-color: #8fb876;
            color: white;
        }

        .badge-status-aktif {
            background-color: #a6cf90;
            color: white;
        }

        .badge-status-nonaktif {
            background-color: #dc3545;
            color: white;
        }

        .search-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(166, 207, 144, 0.2);
        }
    </style>
@endpush

@section('content')
    <div class="content-bg p-4">
        <!-- Page Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="mb-1" style="color: #2d5016;">
                            <i class="material-icons me-2" style="vertical-align: middle; color: #a6cf90;">people</i>
                            Kelola Anggota
                        </h2>
                        <p class="text-muted mb-0">Manajemen data anggota UKKI</p>
                    </div>
                    <a href="{{ route('admin.anggota.create') }}" class="btn btn-success-custom">
                        <i class="material-icons me-1" style="font-size: 18px; vertical-align: middle;">person_add</i>
                        Tambah Anggota
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <i class="material-icons mb-2" style="font-size: 2.5rem;">people</i>
                        <h4 class="fw-bold">{{ $totalAnggota ?? 25 }}</h4>
                        <p class="mb-0 small">Total Anggota</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <i class="material-icons mb-2" style="font-size: 2.5rem;">person_add</i>
                        <h4 class="fw-bold">{{ $anggotaBaru ?? 5 }}</h4>
                        <p class="mb-0 small">Anggota Baru (Bulan Ini)</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <i class="material-icons mb-2" style="font-size: 2.5rem;">trending_up</i>
                        <h4 class="fw-bold">{{ $anggotaAktif ?? 23 }}</h4>
                        <p class="mb-0 small">Anggota Aktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <i class="material-icons mb-2" style="font-size: 2.5rem;">military_tech</i>
                        <h4 class="fw-bold">{{ $totalBadges ?? 3 }}</h4>
                        <p class="mb-0 small">Jenis Badge</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="search-container p-3 mb-4">
            <form method="GET" action="{{ route('admin.anggota.index') }}">
                <div class="row align-items-end">
                    <div class="col-md-4 mb-2">
                        <label for="search" class="form-label fw-semibold">Cari Anggota</label>
                        <input type="text" class="form-control" id="search" name="search"
                            value="{{ request('search') }}" placeholder="NPM atau Nama">
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="level" class="form-label fw-semibold">Level</label>
                        <select class="form-select" id="level" name="level">
                            <option value="">Semua Level</option>
                            @for ($i = 1; $i <= 20; $i++)
                                <option value="{{ $i }}" {{ request('level') == $i ? 'selected' : '' }}>Level
                                    {{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="badge" class="form-label fw-semibold">Badge</label>
                        <select class="form-select" id="badge" name="badge">
                            <option value="">Semua Badge</option>
                            <option value="Murid Ilmu" {{ request('badge') == 'Murid Ilmu' ? 'selected' : '' }}>Murid Ilmu
                            </option>
                            <option value="Penuntut Kebaikan"
                                {{ request('badge') == 'Penuntut Kebaikan' ? 'selected' : '' }}>Penuntut Kebaikan</option>
                            <option value="Cendekiawan Islami"
                                {{ request('badge') == 'Cendekiawan Islami' ? 'selected' : '' }}>Cendekiawan Islami
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <button type="submit" class="btn btn-success-custom w-100">
                            <i class="material-icons" style="font-size: 18px;">search</i>
                        </button>
                    </div>
                </div>
            </form>
        </div><input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}"
            placeholder="Nama, NPM, atau Email">
    </div>
    <div class="col-md-3 mb-2">
        <label for="fakultas" class="form-label fw-semibold">Fakultas</label>
        <select class="form-select" id="fakultas" name="fakultas">
            <option value="">Semua Fakultas</option>
            <option value="Fakultas Ilmu Komputer" {{ request('fakultas') == 'Fakultas Ilmu Komputer' ? 'selected' : '' }}>
                Fakultas Ilmu Komputer</option>
            <option value="Fakultas Teknik" {{ request('fakultas') == 'Fakultas Teknik' ? 'selected' : '' }}>Fakultas
                Teknik</option>
            <option value="Fakultas Ekonomi dan Bisnis"
                {{ request('fakultas') == 'Fakultas Ekonomi dan Bisnis' ? 'selected' : '' }}>Fakultas Ekonomi dan Bisnis
            </option>
            <option value="Fakultas Ilmu Sosial dan Ilmu Politik"
                {{ request('fakultas') == 'Fakultas Ilmu Sosial dan Ilmu Politik' ? 'selected' : '' }}>Fakultas Ilmu Sosial
                dan Ilmu Politik</option>
            <option value="Fakultas Hukum" {{ request('fakultas') == 'Fakultas Hukum' ? 'selected' : '' }}>Fakultas Hukum
            </option>
        </select>
    </div>
    <div class="col-md-2 mb-2">
        <label for="angkatan" class="form-label fw-semibold">Angkatan</label>
        <select class="form-select" id="angkatan" name="angkatan">
            <option value="">Semua</option>
            @for ($year = date('Y'); $year >= 2020; $year--)
                <option value="{{ $year }}" {{ request('angkatan') == $year ? 'selected' : '' }}>
                    {{ $year }}</option>
            @endfor
        </select>
    </div>
    <div class="col-md-2 mb-2">
        <label for="status" class="form-label fw-semibold">Status</label>
        <select class="form-select" id="status" name="status">
            <option value="">Semua</option>
            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Non-aktif</option>
        </select>
    </div>
    <div class="col-md-1 mb-2">
        <button type="submit" class="btn btn-success-custom w-100">
            <i class="material-icons" style="font-size: 18px;">search</i>
        </button>
    </div>
    </div>
    </form>
    </div>

    <!-- Table Container -->
    <div class="table-container">
        <div class="table-header p-3">
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
                        <th width="25%">Nama</th>
                        <th width="10%">Level</th>
                        <th width="15%">Badge</th>
                        <th width="10%">Total XP</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Sample Data - Replace with actual data --}}
                    @forelse(range(1, 10) as $index)
                        <tr>
                            <td>{{ $index }}</td>
                            <td>
                                <span class="fw-semibold">23081010{{ sprintf('%03d', $index) }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/images/Avater.png') }}" alt="Avatar"
                                        class="rounded-circle me-2" style="width: 32px; height: 32px;">
                                    <div>
                                        <div class="fw-semibold">Anggota {{ $index }}</div>
                                        <small class="text-muted">Member sejak {{ date('M Y') }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <span class="badge bg-primary fs-6">{{ ($index % 10) + 1 }}</span>
                                    <div class="progress mt-1" style="height: 4px;">
                                        <div class="progress-bar bg-success" style="width: {{ ($index * 10) % 100 }}%">
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @php
                                    $level = ($index % 10) + 1;
                                    $badge =
                                        $level >= 9
                                            ? 'Cendekiawan Islami'
                                            : ($level >= 5
                                                ? 'Penuntut Kebaikan'
                                                : 'Murid Ilmu');
                                    $badgeColor = $level >= 9 ? 'warning' : ($level >= 5 ? 'info' : 'secondary');
                                @endphp
                                <span class="badge bg-{{ $badgeColor }}">{{ $badge }}</span>
                            </td>
                            <td>
                                <div class="text-center">
                                    <div class="fw-bold text-warning">{{ $index * 150 }}</div>
                                    <small class="text-muted">XP</small>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-primary" title="Lihat Detail">
                                        <i class="material-icons" style="font-size: 16px;">visibility</i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-warning" title="Edit">
                                        <i class="material-icons" style="font-size: 16px;">edit</i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" title="Hapus">
                                        <i class="material-icons" style="font-size: 16px;">delete</i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="material-icons text-muted mb-2" style="font-size: 3rem;">people_outline</i>
                                <p class="text-muted mb-0">Belum ada data anggota</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-3 border-top">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Menampilkan 1-10 dari 25 anggota
                </div>
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                        <li class="page-item active">
                            <span class="page-link">1</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Auto submit form when filter changes
        document.querySelectorAll('#fakultas, #angkatan, #status').forEach(element => {
            element.addEventListener('change', function() {
                this.form.submit();
            });
        });
    </script>
@endpush
