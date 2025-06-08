@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')
    <div class="main-content-about py-5">
        <div class="container-fluid px-3"> <!-- ganti container jadi container-fluid agar lebih lebar -->
            <div class="row justify-content-center">
                <div class="col-12 col-lg-11"> <!-- lebar hampir penuh layar -->
                    <!-- Header Judul Besar -->
                    <h2 class="about-header-title mb-4">About</h2>

                    <div class="about-section-box mb-4">
                        <h5 class="fw-bold mb-3">Tentang SIUKKI</h5>
                        <p>
                            SIUKKI adalah aplikasi gamifikasi yang dirancang khusus untuk anggota Unit Kegiatan Kerohanian
                            Islam di Universitas Pembangunan Nasional "Veteran" Jawa Timur. Aplikasi ini bertujuan untuk
                            meningkatkan keterlibatan mahasiswa dalam kegiatan islami kampus melalui mekanisme poin, XP, dan
                            badge pencapaian yang menarik dan edukatif.
                        </p>
                    </div>

                    <div class="about-section-box mb-4">
                        <h5 class="fw-bold mb-3">Misi SIUKKI</h5>
                        <p>
                            SIUKKI berfokus pada pemberian pengalaman yang menyenangkan dalam meningkatkan partisipasi
                            mahasiswa dalam kegiatan UKKI dengan cara:
                        </p>
                        <ul>
                            <li><b>Gamifikasi aktivitas</b> seperti membaca Al-Qur'an, sholat berjamaah, menghadiri kajian,
                                dapatkan XP dan motivasi.</li>
                            <li><b>Level & Badge</b> sistem pencapaian visual untuk mencerminkan progress dan kontribusi.
                            </li>
                            <li><b>Leaderboard</b> pemeringkatan untuk mendorong keterlibatan lebih tinggi.</li>
                        </ul>
                    </div>

                    <div class="about-section-box">
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
    </div>
@endsection