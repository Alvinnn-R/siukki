@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/leaderboard.css') }}">
@endpush

@section('content')
    <div class="main-content-about py-5">
        <div class="container-fluid px-3"> <!-- ganti container jadi container-fluid agar lebih lebar -->
            <div class="row justify-content-center">
                <div class="col-12 col-lg-11"> <!-- lebar hampir penuh layar -->
                    <!-- Header Judul Besar -->
                    <h2 class="about-header-title mb-4">Leaderboard</h2>

                    <div class="about-section-box mb-4">
                        <h5 class="fw-bold mb-3">Cooming Soon</h5>
                    </div>

@endsection