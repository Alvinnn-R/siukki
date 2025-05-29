@extends('layouts.app')

@section('title', 'Admin Dashboard - SiUKKI')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
    <!-- Admin Welcome Banner -->
    <div class="admin-welcome-banner mb-4">
        <div class="row g-0 align-items-center">
            <div class="col-auto ps-3">
                <img src="{{ asset('assets/images/avater.png') }}" alt="Admin" class="img-fluid admin-image">
            </div>
            <div class="col">
                <div class="p-3">
                    <h2 class="welcome-title">
                        <i class="material-icons me-2" style="font-size: 2rem; vertical-align: middle;">dashboard</i>
                        Dashboard Admin SiUKKI
                    </h2>
                    <p class="mb-0">
                        Kelola sistem gamifikasi UKKI dengan mudah dan efisien.<br>
                        Pantau aktivitas anggota, kelola event, dan tingkatkan engagement.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 stats-card">
                <div class="card-body text-center">
                    <div class="stats-icon text-primary mb-3">
                        <i class="material-icons" style="font-size: 3rem;">people</i>
                    </div>
                    <h3 class="fw-bold text-primary">{{ \App\Models\Anggota::count() ?? 0 }}</h3>
                    <p class="mb-0 text-muted">Total Anggota</p>
                    <small class="text-success">
                        <i class="material-icons" style="font-size: 14px;">trending_up</i> +5 bulan ini
                    </small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 stats-card">
                <div class="card-body text-center">
                    <div class="stats-icon text-success mb-3">
                        <i class="material-icons" style="font-size: 3rem;">event_available</i>
                    </div>
                    {{-- <h3 class="fw-bold text-success">{{ \App\Models\Event::where('status', 'aktif')->count() ?? 0 }}</h3> --}}
                    <h3 class="fw-bold text-success">0</h3>
                    <p class="mb-0 text-muted">Event Aktif</p>
                    <small class="text-info">
                        <i class="material-icons" style="font-size: 14px;">schedule</i> 3 akan datang
                    </small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 stats-card">
                <div class="card-body text-center">
                    <div class="stats-icon text-warning mb-3">
                        <i class="material-icons" style="font-size: 3rem;">assignment</i>
                    </div>
                    {{-- <h3 class="fw-bold text-warning">{{ \App\Models\Misi::where('status', 'aktif')->count() ?? 0 }}</h3> --}}
                    <h3 class="fw-bold text-warning">0</h3>
                    <p class="mb-0 text-muted">Misi Aktif</p>
                    <small class="text-warning">
                        <i class="material-icons" style="font-size: 14px;">warning</i> 2 expired soon
                    </small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 stats-card">
                <div class="card-body text-center">
                    <div class="stats-icon text-info mb-3">
                        <i class="material-icons" style="font-size: 3rem;">stars</i>
                    </div>
                    {{-- <h3 class="fw-bold text-info">{{ \App\Models\Poin::sum('jumlah') ?? 0 }}</h3> --}}
                    <h3 class="fw-bold text-info">0</h3>
                    <p class="mb-0 text-muted">Total XP Terdistribusi</p>
                    <small class="text-success">
                        <i class="material-icons" style="font-size: 14px;">trending_up</i> +150 hari ini
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="material-icons me-2" style="vertical-align: middle;">rocket_launch</i>Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    {{-- <div class="d-grid gap-2">
                        <a href="{{ route('admin.anggota.create') }}" class="btn btn-outline-primary">
                            <i class="material-icons me-2"
                                style="vertical-align: middle; font-size: 18px;">person_add</i>Tambah Anggota Baru
                        </a>
                        <a href="{{ route('admin.event.create') }}" class="btn btn-outline-success">
                            <i class="material-icons me-2"
                                style="vertical-align: middle; font-size: 18px;">event_note</i>Buat Event Baru
                        </a>
                        <a href="{{ route('admin.misi.create') }}" class="btn btn-outline-warning">
                            <i class="material-icons me-2"
                                style="vertical-align: middle; font-size: 18px;">add_task</i>Tambah Misi Baru
                        </a>
                        <a href="{{ route('admin.laporan.index') }}" class="btn btn-outline-info">
                            <i class="material-icons me-2"
                                style="vertical-align: middle; font-size: 18px;">bar_chart</i>Lihat Laporan
                        </a>
                    </div> --}}
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-outline-primary">
                            <i class="material-icons me-2"
                                style="vertical-align: middle; font-size: 18px;">person_add</i>Tambah Anggota Baru
                        </a>
                        <a href="#" class="btn btn-outline-success">
                            <i class="material-icons me-2"
                                style="vertical-align: middle; font-size: 18px;">event_note</i>Buat Event Baru
                        </a>
                        <a href="#" class="btn btn-outline-warning">
                            <i class="material-icons me-2"
                                style="vertical-align: middle; font-size: 18px;">add_task</i>Tambah Misi Baru
                        </a>
                        <a href="#" class="btn btn-outline-info">
                            <i class="material-icons me-2"
                                style="vertical-align: middle; font-size: 18px;">bar_chart</i>Lihat Laporan
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-line me-2"></i>Aktivitas Terbaru
                    </h5>
                </div>
                <div class="card-body">
                    <div class="activity-list">
                        <div class="activity-item d-flex align-items-center mb-3">
                            <div class="activity-icon bg-primary text-white rounded-circle me-3">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-semibold">Anggota baru bergabung</p>
                                <small class="text-muted">Ahmad Rizki - 5 menit lalu</small>
                            </div>
                        </div>
                        <div class="activity-item d-flex align-items-center mb-3">
                            <div class="activity-icon bg-success text-white rounded-circle me-3">
                                <i class="fas fa-star"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-semibold">XP baru diberikan</p>
                                <small class="text-muted">Event Kajian Mingguan - 1 jam lalu</small>
                            </div>
                        </div>
                        <div class="activity-item d-flex align-items-center mb-3">
                            <div class="activity-icon bg-warning text-white rounded-circle me-3">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div>
                                <p class="mb-0 fw-semibold">Event baru dibuat</p>
                                <small class="text-muted">Seminar Keislaman - 2 jam lalu</small>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="#" class="btn btn-sm btn-outline-secondary">Lihat Semua Aktivitas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts/Analytics Section -->
    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-area me-2"></i>Statistik Partisipasi Bulanan
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="participationChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Sample chart data - replace with real data
        const ctx = document.getElementById('participationChart').getContext('2d');
        const participationChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Partisipasi Event',
                    data: [65, 78, 90, 81, 95, 88],
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    tension: 0.4
                }, {
                    label: 'Penyelesaian Misi',
                    data: [45, 65, 72, 68, 85, 79],
                    borderColor: 'rgb(255, 99, 132)',
                    backgroundColor: 'rgba(255, 99, 132, 0.1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
