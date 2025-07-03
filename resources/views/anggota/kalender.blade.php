@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/kalender.css') }}">
@endpush

@section('content')

    {{-- =========== MODAL 1 =========== --}}
    <div class="modal fade" id="poinModal1" tabindex="-1" aria-labelledby="poinModal1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-color">
                <div class="modal-body text-center">
                    <h2 class="fw-bold mb-4" style="color:#1a5f3f;">Kalender Event di SiUKKI</h2>
                    <img src="{{ asset('assets/images/modalmisi1.png') }}" alt="Ustadzah"
                        style="width:400px; max-width:90%; margin-bottom:20px;">
                    <div class="description-box mx-auto mb-3" style="max-width: 440px;">
                        Ustadzah: "Assalamu’alaikum, <strong>{{ Auth::user()->nama }}</strong>. Di sini kamu bisa melihat
                        jadwal berbagai event Islami yang akan berlangsung di kampus.
                        Jangan lewatkan kesempatan untuk ikut serta dalam setiap kegiatan dan menambah pengalamanmu!"
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
                    <h2 class="fw-bold mb-4" style="color:#1a5f3f;">Ikut Event</h2>
                    <img src="{{ asset('assets/images/modalmisi1.png') }}" alt="Ustadzah"
                        style="width:400px; max-width:90%; margin-bottom:20px;">
                    <div class="description-box mx-auto mb-3" style="max-width: 440px;">
                        Ustadzah: "Aktiflah mengikuti event agar kamu bisa mendapatkan pengalaman baru, memperluas
                        jaringan, dan semakin berkembang bersama teman-teman di UKKI."
                    </div>
                    <div class="button-row mx-auto d-flex justify-content-between gap-2" style="max-width:440px;">
                        <button class="btn btn-primary-skip px-4 py-2" data-bs-dismiss="modal">Skip &gt;&gt;</button>
                        <button class="btn btn-primary-next px-4 py-2" data-bs-dismiss="modal">Next</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="main-content-kalender py-5 d-flex align-items-center" style="min-height:90vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-11">
                    <!-- Judul Kalender -->
                    <div class="section-header mb-2">
                        <h2 class="text-center">Kalender Event</h2>
                    </div>
                    <!-- Kalender dengan shadow -->
                    <div class="calendar-shadow-box mx-auto">
                        <iframe
                            src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=Asia%2FJakarta&hl=id&src=ODU0NTYyOTM4MjFmNDA1MWIyZTBkYmJmYmIxN2ZkMGQzNzhmMDlkYTE4NjZkOTA3YWZmYjBiNjJkZjRmMGI3N0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=ZmIxOTI1MDdkMzAxY2IxYTE5NDQ4MjgwMTMxODg0YTY2MzNkZmY1YjZhZTA1NjAwNGNlNDExMGU4MWFmNmMxYUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=MmZlNTFlNWViYTEyNzY0NjNlNzUyNzhiZDM2Yzg1MDdhNDA3NmU5MjgyMThiNjgwNDIzYzEyNTY0ODllMzM0NUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=MWM4MWQyMTM1NjY0ZWQ5MGE4MDdlMDUyZjNiYWRmOGNlNzgzMDIwZTFjMGQ3OTZjM2QzYmY0OTJhYzc3ZjkwY0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=NTZiMjJkMjhmMzU5NTYzOTYzNjI1OTM1MDI1YThkMzczM2VhOGFjODhlMDNlMDBmOGQ3YmIzOTQ5OTI2NzYyMUBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=aWQuaW5kb25lc2lhbiNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&color=%23ef6c00&color=%234285f4&color=%23a79b8e&color=%238e24aa&color=%230b8043&color=%23d50000"
                            style="border:solid 1px #777" width="900" height="800" frameborder="0" scrolling="no"></iframe>
                    </div>
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