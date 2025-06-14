@extends('layouts.app')

@section('title', 'Leaderboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/leaderboard.css') }}">
@endpush

@section('content')
@php
    // Cek filter aktif (default 'day' jika tidak ada)
    $activeFilter = $filter ?? 'day';
@endphp
<div class="container-fluid">
    <div class="row justify-content-center">
        <!-- Card Leaderboard Utama (Kiri) -->
        <div class="col-lg-7 mb-4">
            <div class="p-4 rounded-3 leaderboard-bg">
                <!-- Judul Leaderboard di atas filter -->
                <div class="mb-3">
                    <h2 class="leaderboard-title">Leaderboard</h2>
                </div>
                <!-- Filter Buttons -->
                <div class="mb-4">
                    <div class="btn-group leaderboard-filter-group" role="group">
                        <a href="{{ route('leaderboard', ['filter' => 'day']) }}" class="btn leaderboard-btn {{ $activeFilter === 'day' ? 'active' : '' }}">Today</a>
                        <a href="{{ route('leaderboard', ['filter' => 'week']) }}" class="btn leaderboard-btn {{ $activeFilter === 'week' ? 'active' : '' }}">Week</a>
                        <a href="{{ route('leaderboard', ['filter' => 'month']) }}" class="btn leaderboard-btn {{ $activeFilter === 'month' ? 'active' : '' }}">Month</a>
                    </div>
                </div>
                <!-- Top 3 Crown & Avatar Centered -->
                @php
                    $top3 = $anggota->take(3);
                    // Susun urutan: [2nd, 1st, 3rd] jika ada 3 user
                    $top3Display = [];
                    if(count($top3) == 3) {
                        $top3Display = [$top3[1], $top3[0], $top3[2]];
                    } elseif(count($top3) == 2) {
                        $top3Display = [$top3[1], $top3[0]];
                    } else {
                        $top3Display = $top3;
                    }
                    $crowns = ['silver', 'gold', 'bronze'];
                    $crownIcons = [
                        'gold' => asset('assets/images/crown-gold.png'),
                        'silver' => asset('assets/images/crown-silver.png'),
                        'bronze' => asset('assets/images/crown-bronze.png'),
                    ];
                @endphp
                <div class="leaderboard-top3-row">
                    @foreach($top3Display as $i => $user)
                    <div class="leaderboard-top3-col leaderboard-top3-{{ $crowns[$i] }}">
                        @if($i == 1)
                            <img src="{{ $crownIcons['gold'] }}" class="leaderboard-crown leaderboard-crown-gold" alt="Crown">
                        @elseif($i == 0)
                            <img src="{{ $crownIcons['silver'] }}" class="leaderboard-crown leaderboard-crown-silver" alt="Crown">
                        @elseif($i == 2)
                            <img src="{{ $crownIcons['bronze'] }}" class="leaderboard-crown leaderboard-crown-bronze" alt="Crown">
                        @endif
                        <img 
                            src="{{ $user->profile_url }}" 
                            class="leaderboard-avatar-top3 @if($i==0) leaderboard-avatar-top2 @elseif($i==1) leaderboard-avatar-top1 @endif"
                            alt="Avatar"
                        >
                        <div class="leaderboard-top3-name @if($i==1) leaderboard-top3-name-main @endif">
                            {{ $user->nama }}
                        </div>
                        <div class="leaderboard-top3-level">
                            level {{ $user->level ?? '-' }}
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- Top 3 Cards (Ranking 1, 2, 3) -->
                @php
                    // Cek filter aktif (default 'day' jika tidak ada)
                    $activeFilter = $filter ?? 'day';
                @endphp

                @php
                    // Untuk menampilkan XP sesuai filter
                    $getXp = function($user) use ($activeFilter) {
                        if ($activeFilter === 'week') {
                            return $user->xp_minggu ?? 0;
                        } elseif ($activeFilter === 'month') {
                            return $user->xp_bulan ?? 0;
                        } elseif ($activeFilter === 'day') {
                            return $user->xp_hari ?? 0;
                        }
                        return $user->xp ?? 0;
                    };
                @endphp

                @foreach($top3 as $i => $user)
                <div class="leaderboard-card {{ ['gold','silver','bronze'][$i] }} rank-{{ $i+1 }}">
                    <span class="leaderboard-rank rank-{{ $i+1 }}">{{ $i+1 }}</span>
                    <img src="{{ $user->profile_url }}" class="leaderboard-avatar rank-{{ $i+1 }}" alt="Avatar">
                    <span class="fw-bold">{{ $user->nama }}</span>
                    <span class="ms-auto leaderboard-xp">{{ $getXp($user) }} Xp.</span>
                </div>
                @endforeach
            </div>
        </div>
        <!-- Card Ranking 1-10 (Kanan) -->
        <div class="col-lg-5 mb-4">
            <div class="p-4 rounded-3 leaderboard-bg">
                <h5 class="fw-bold mb-3 leaderboard-top10-title">Top 10 Ranking</h5>
                <!-- Top 10 Cards -->
                @foreach($anggota->take(10) as $i => $user)
                <div class="d-flex align-items-center mb-2 leaderboard-card 
                    @if($i==0) gold rank-1 
                    @elseif($i==1) silver rank-2 
                    @elseif($i==2) bronze rank-3 
                    @endif">
                    <span class="leaderboard-rank rank-{{ $i+1 }}">{{ $i+1 }}</span>
                    <img src="{{ $user->profile_url}}" class="rounded-circle leaderboard-avatar-top10 rank-{{ $i+1 }}" alt="Avatar">
                    <span class="fw-bold">{{ $user->nama }}</span>
                    <span class="ms-auto leaderboard-xp">{{ $getXp($user) }} Xp.</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection