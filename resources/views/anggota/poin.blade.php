@extends('layouts.app')

@section('title', 'Poin SiUKKI')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/poin.css') }}">
@endpush

@section('content')

    {{-- =========== MODAL 1 =========== --}}
    <div class="modal fade" id="poinModal1" tabindex="-1" aria-labelledby="poinModal1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-color">
                <div class="modal-body text-center">
                    <h2 class="fw-bold mb-4" style="color:#1a5f3f;">Mengumpulkan XP di SiUKKI</h2>
                    <img src="{{ asset('assets/images/modalmisi1.png') }}" alt="Ustadzah"
                        style="width:400px; max-width:90%; margin-bottom:20px;">
                    <div class="description-box mx-auto mb-3" style="max-width: 440px;">
                        Ustadzah: "Assalamu’alaikum, <strong>{{ Auth::user()->nama }}</strong>. Di halaman ini kamu bisa
                        melihat
                        jumlah XP yang telah kamu kumpulkan dari berbagai misi yang kamu kerjakan.
                        Gunakan poinmu sebagai motivasi untuk terus berkembang dan berkontribusi di SiUKKI!"
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
                    <h2 class="fw-bold mb-4" style="color:#1a5f3f;">Level & Badge</h2>
                    <img src="{{ asset('assets/images/modalmisi1.png') }}" alt="Ustadzah"
                        style="width:400px; max-width:90%; margin-bottom:20px;">
                    <div class="description-box mx-auto mb-3" style="max-width: 440px;">
                        Ustadzah: "Setiap beberapa XP yang kamu kumpulkan tujuannya untuk meningkatkan level dan badge.
                        Ayo kumpulkan XP sebanyak-banyaknya agar badge kamu adalah cendekiawan islam yang merupakan
                        badge tertinggi"
                    </div>
                    <div class="button-row mx-auto d-flex justify-content-between gap-2" style="max-width:440px;">
                        <button class="btn btn-primary-skip px-4 py-2" data-bs-dismiss="modal">Skip &gt;&gt;</button>
                        <button class="btn btn-primary-next px-4 py-2" data-bs-dismiss="modal">Next</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="row g-4 mb-4">
                    <!-- Card XP -->
                    <div class="col-md-6 d-flex">
                        <div
                            class="xp-card bg-success-subtle p-4 flex-fill d-flex flex-column align-items-center justify-content-center rounded-3 shadow-sm">
                            <div class="badge-label">XP</div>
                            <img src="{{ asset('assets/images/logo xp.png') }}" alt="XP Badge" class="xp-img mb-3"
                                style="height:120px;">
                            <h4 class="fw-bold text-dark mb-0">{{ $xp }} XP</h4>
                        </div>
                    </div>
                    <!-- Card Badge -->
                    <div class="col-md-6 d-flex">
                        <div
                            class="badge-card bg-success-subtle p-4 flex-fill d-flex flex-column align-items-center justify-content-center rounded-3 shadow-sm">
                            <div class="badge-label">Badge</div>
                            <img src="{{ asset('assets/images/logo badge.png') }}" alt="Badge Icon" class="badge-img mb-3"
                                style="height:120px;">
                            <h5 class="fw-bold text-dark mb-0">{{ $badge }}</h5>
                        </div>
                    </div>
                </div>

                <!-- Riwayat XP -->
                <div class="history-card bg-success-subtle p-4 rounded-3 shadow-sm">
                    <div class="badge-label ms-5">History XP</div>
                    <!-- Item Riwayat XP -->
                    @forelse($history as $item)
                        <div
                            class="xp-history-item border border-success rounded-3 p-3 mb-2 d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/logo koin.png') }}" alt="XP Icon"
                                    class="xp-history-icon me-3">
                                <div>
                                    <div class="fw-bold text-success">+{{ $item->xp_diperoleh }} XP</div>
                                    <div class="text-dark">{{ $item->misi->nama_misi }}</div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p Class="Text-muted">Belum ada aktifitas dalam 3 hari terakhir</p>
                    @endforelse
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