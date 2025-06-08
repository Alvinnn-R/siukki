@extends('layouts.app')

@section('title', 'Poin SiUKKI')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/poin.css') }}">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row g-4 mb-4">
                <!-- Card XP -->
                <div class="col-md-6 d-flex">
                    <div class="xp-card bg-success-subtle p-4 flex-fill d-flex flex-column align-items-center justify-content-center rounded-3 shadow-sm">
                        <div class="badge-label">XP</div>
                        <img src="{{ asset('assets/images/logo xp.png') }}" alt="XP Badge" class="xp-img mb-3" style="height:120px;">
                        <h4 class="fw-bold text-dark mb-0">732 XP</h4>
                    </div>
                </div>
                <!-- Card Badge -->
                <div class="col-md-6 d-flex">
                    <div class="badge-card bg-success-subtle p-4 flex-fill d-flex flex-column align-items-center justify-content-center rounded-3 shadow-sm">
                        <div class="badge-label">Badge</div>
                        <img src="{{ asset('assets/images/logo badge.png') }}" alt="Badge Icon" class="badge-img mb-3" style="height:120px;">
                        <h5 class="fw-bold text-dark mb-0">Penuntut Kebaikan!</h5>
                    </div>
                </div>
            </div>
            <!-- Riwayat XP -->
            <div class="history-card bg-success-subtle p-4 rounded-3 shadow-sm">
                <div class="badge-label ms-5">History XP</div>
                <!-- Item Riwayat XP -->
                <div class="xp-history-item border border-success rounded-3 p-3 mb-2 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/images/logo koin.png') }}" alt="XP Icon" class="xp-history-icon me-3">
                        <div>
                            <div class="fw-bold text-success">+5 XP</div>
                            <div class="text-dark">Check-in harian</div>
                        </div>
                    </div>
                </div>
                <div class="xp-history-item border border-success rounded-3 p-3 mb-2 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/images/logo koin.png') }}" alt="XP Icon" class="xp-history-icon me-3">
                        <div>
                            <div class="fw-bold text-success">+27 XP</div>
                            <div class="text-dark">Membaca Doa</div>
                        </div>
                    </div>
                </div>
                <div class="xp-history-item border border-success rounded-3 p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('assets/images/logo koin.png') }}" alt="XP Icon" class="xp-history-icon me-3">
                        <div>
                            <div class="fw-bold text-success">+700 XP</div>
                            <div class="text-dark">Mengikuti Haji 2025</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection