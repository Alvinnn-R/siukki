@extends('layouts.app')

@section('title', 'Tentang SiUKKI')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="section-header mb-4">
                    <h2 class="welcome-title text-center">About</h2>
                </div>

                <div class="about-section-box mb-4">
                    <h5 class="fw-bold mb-3">Tentang SIUKKI</h5>
                    <p>
                        SIUKKI adalah aplikasi gamifikasi yang dirancang khusus untuk anggota Unit Kegiatan Kerohanian Islam
                        di
                        Universitas Pembangunan Nasional ‘Veteran’ Jawa Timur. Aplikasi ini bertujuan untuk meningkatkan
                        keterlibatan mahasiswa dalam kegiatan islami kampus melalui mekanisme poin, XP, dan badge pencapaian
                        yang
                        menarik dan edukatif.
                    </p>
                </div>

                <div class="about-section-box mb-4">
                    <h5 class="fw-bold mb-3">Misi SIUKKI</h5>
                    <p>SIUKKI berfokus pada pemberian pengalaman yang menyenangkan dalam meningkatkan partisipasi mahasiswa
                        dalam
                        kegiatan UKKI dengan cara:</p>
                    <ul>
                        <li><strong>Gamifikasi aktivitas</strong> seperti membaca Al-Qur’an, sholat berjamaah, menghadiri
                            kajian,
                            dapatkan XP dan motivasi.</li>
                        <li><strong>Level & Badge</strong> sistem pencapaian visual untuk mencerminkan progress dan
                            kontribusi.</li>
                        <li><strong>Leaderboard</strong> pemeringkatan untuk mendorong keterlibatan lebih tinggi.</li>
                    </ul>
                </div>

                <div class="about-section-box mb-4">
                    <h5 class="fw-bold mb-3">Tujuan SIUKKI</h5>
                    <ul>
                        <li>Meningkatkan Partisipasi Mahasiswa</li>
                        <li>Menjadikan kegiatan UKKI lebih menyenangkan dan terukur</li>
                        <li>Mendorong kontribusi aktif & pengembangan karakter</li>
                        <li>Memberi apresiasi melalui XP, level, dan badge</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection