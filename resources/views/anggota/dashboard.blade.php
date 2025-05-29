@extends('layouts.app')

@section('title', 'Dashboard SiUKKI')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
@endpush

@section('content')
<!-- Welcome Banner -->
<div class="welcome-banner mb-4">
    <div class="row g-0 align-items-center">
        <div class="col-auto ps-3">
            <img src="{{ asset('assets/images/pak ustad.png') }}" alt="Ustadz" class="img-fluid ustadz-image">
        </div>
        <div class="col">
            <div class="p-3">
                <h2 class="welcome-title">Selamat datang di SiUKKI {{ auth()->user()->nama }}</h2>
                <p class="mb-0">
                    Aplikasi gamifikasi untuk meningkatkan keterlibatanmu dalam kegiatan UKKI!<br>
                    Ayo ambil tantangan, kumpulkan XP, dan raih penghargaan.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Gambar Kegiatan -->
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="activity-card">
            <img src="{{ asset('assets/images/Beranda 1.png') }}" alt="Kegiatan 1" class="activity-img">
        </div>
    </div>
    <div class="col-md-6">
        <div class="activity-card">
            <img src="{{ asset('assets/images/Beranda 2.png') }}" alt="Kegiatan 2" class="activity-img">
        </div>
    </div>
</div>

<!-- Logo & Sambutan -->
<div class="container-fluid px-0">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="text-center">
                <img src="{{ asset('assets/images/Beranda 3.png') }}" alt="Logo dan Sambutan" class="img-fluid logo-banner">
            </div>
        </div>
    </div>
</div>
@endsection
