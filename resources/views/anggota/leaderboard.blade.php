@extends('layouts.app')

@section('title', 'Leaderboard')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/leaderboard.css') }}">
@endpush

@section('content')

    {{-- =========== MODAL 1 =========== --}}
    <div class="modal fade" id="poinModal1" tabindex="-1" aria-labelledby="poinModal1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-color">
                <div class="modal-body text-center">
                    <h2 class="fw-bold mb-4" style="color:#1a5f3f;">Papan Peringkat di SiUKKI</h2>
                    <img src="{{ asset('assets/images/modalmisi1.png') }}" alt="Ustadzah"
                        style="width:400px; max-width:90%; margin-bottom:20px;">
                    <div class="description-box mx-auto mb-3" style="max-width: 440px;">
                        Ustadzah: "Assalamu’alaikum, <strong>{{ Auth::user()->nama }}</strong>. Di halaman leaderboard, kamu
                        bisa melihat urutan
                        peringkatmu dibandingkan teman-teman lain.
                        Jadikan posisi ini sebagai semangat untuk lebih aktif dan berprestasi dalam kegiatan Islami di
                        kampus."
                    </div>
                    <div class="button-row mx-auto d-flex justify-content-between gap-2" style="max-width:440px;">
                        <button class="btn btn-primary-skip px-4 py-2" data-bs-dismiss="modal">Skip &gt;&gt;</button>
                        <button class="btn btn-primary-next px-4 py-2" id="toPoinModal2">Next</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- =========== MODAL 2 =========== --}}
    <div class="modal fade" id="poinModal2" tabindex="-1" aria-labelledby="poinModal2Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-color">
                <div class="modal-body text-center">
                    <h2 class="fw-bold mb-4" style="color:#1a5f3f;">Kejar Peringkat Terbaik</h2>
                    <img src="{{ asset('assets/images/modalmisi1.png') }}" alt="Ustadzah"
                        style="width:400px; max-width:90%; margin-bottom:20px;">
                    <div class="description-box mx-auto mb-3" style="max-width: 440px;">
                        Ustadzah: "Papan peringkat akan direset setiap pengumuman diklat UKKI tahunan. Raih 10 besar untuk
                        mendapatkan reward fantastis!"
                    </div>
                    <div class="button-row mx-auto d-flex justify-content-between gap-2" style="max-width:440px;">
                        <button class="btn btn-primary-skip px-4 py-2" data-bs-dismiss="modal">Skip &gt;&gt;</button>
                        <button class="btn btn-primary-next px-4 py-2" data-bs-dismiss="modal">Next</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @php
        // Cek filter aktif (default 'day' jika tidak ada)
        $activeFilter = $filter ?? 'day';

        // Function untuk mendapatkan URL profile image
        $getProfileImage = function ($user) {
            if (!$user->profile) {
                return asset('assets/images/default-avatar.png');
            }

            return str_contains($user->profile, 'avatar/')
                ? asset('assets/images/' . $user->profile)
                : asset('uploads/profiles/' . $user->profile);
        };
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
                            <a href="{{ route('leaderboard', ['filter' => 'day']) }}"
                                class="btn leaderboard-btn {{ $activeFilter === 'day' ? 'active' : '' }}">Today</a>
                            <a href="{{ route('leaderboard', ['filter' => 'week']) }}"
                                class="btn leaderboard-btn {{ $activeFilter === 'week' ? 'active' : '' }}">Week</a>
                            <a href="{{ route('leaderboard', ['filter' => 'month']) }}"
                                class="btn leaderboard-btn {{ $activeFilter === 'month' ? 'active' : '' }}">Month</a>
                        </div>
                    </div>
                    <!-- Top 3 Crown & Avatar Centered -->
                    @php
                        $top3 = $anggota->take(3);
                        // Susun urutan: [2nd, 1st, 3rd] jika ada 3 user
                        $top3Display = [];
                        if (count($top3) == 3) {
                            $top3Display = [$top3[1], $top3[0], $top3[2]];
                        } elseif (count($top3) == 2) {
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
                        @foreach ($top3Display as $i => $user)
                            <div class="leaderboard-top3-col leaderboard-top3-{{ $crowns[$i] }}">
                                @if ($i == 1)
                                    <img src="{{ $crownIcons['gold'] }}" class="leaderboard-crown leaderboard-crown-gold"
                                        alt="Crown">
                                @elseif ($i == 0)
                                    <img src="{{ $crownIcons['silver'] }}" class="leaderboard-crown leaderboard-crown-silver"
                                        alt="Crown">
                                @elseif ($i == 2)
                                    <img src="{{ $crownIcons['bronze'] }}" class="leaderboard-crown leaderboard-crown-bronze"
                                        alt="Crown">
                                @endif
                                <img src="{{ $getProfileImage($user) }}"
                                    class="leaderboard-avatar-top3 @if ($i == 1) leaderboard-avatar-top1 @endif" alt="Avatar">
                                <div class="leaderboard-top3-name @if ($i == 1) leaderboard-top3-name-main @endif">
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
                        $getXp = function ($user) use ($activeFilter) {
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

                    @foreach ($top3 as $i => $user)
                        <div class="leaderboard-card {{ ['gold', 'silver', 'bronze'][$i] }} rank-{{ $i + 1 }}">
                            <span class="leaderboard-rank rank-{{ $i + 1 }}">{{ $i + 1 }}</span>
                            <img src="{{ $getProfileImage($user) }}" class="leaderboard-avatar rank-{{ $i + 1 }}" alt="Avatar">
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
                    @foreach ($anggota->take(10) as $i => $user)
                        <div class="d-flex align-items-center mb-2 leaderboard-card 
                                                                                                    @if ($i == 0) gold rank-1 
                                                                                                    @elseif($i == 1) silver rank-2 
                                                                                                    @elseif($i == 2) bronze rank-3 
                                                                                                    @endif">
                            <span class="leaderboard-rank rank-{{ $i + 1 }}">{{ $i + 1 }}</span>
                            <img src="{{ $getProfileImage($user) }}"
                                class="rounded-circle leaderboard-avatar-top10 rank-{{ $i + 1 }}" alt="Avatar">
                            <span class="fw-bold">{{ $user->nama }}</span>
                            <span class="ms-auto leaderboard-xp">{{ $getXp($user) }} Xp.</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var modal1 = new bootstrap.Modal(document.getElementById('poinModal1'));
            var modal2 = new bootstrap.Modal(document.getElementById('poinModal2'));

            // Tampilkan modal 1 saat halaman dimuat
            modal1.show();

            // Next (dari modal 1 ke modal 2)
            document.getElementById('toPoinModal2').onclick = function () {
                modal1.hide();
                setTimeout(function () { modal2.show(); }, 400);
            };
        });
    </script>
@endpush