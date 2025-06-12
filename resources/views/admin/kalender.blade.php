@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-12">
                <!-- Box Kelola Kalender Event -->
                <div class="section-header mb-4" style="background-color: #99C281; padding: 20px; border-radius: 10px;">
                    <h2 class="text-center text-white">Kelola Kalender Event</h2>
                </div>

                <!-- Kalender Event dengan Embed Google Kalender -->
                <div class="calendar-shadow-box mx-auto">
                    <iframe
                        src="https://calendar.google.com/calendar/embed?height=600&wkst=1&ctz=Asia%2FBangkok&bgcolor=%23ffffff&src=ZXZlbnQudWtraUBnbWFpbC5jb20&src=ZThiZjZlNWU5YWZlMTYxMWE0NWYzYmViMDQ0MjIxZDk5NzBhMGM4YTM3Nzg2Yzk0MTM2ZTM5MWI4YTc4ZDI5ZkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=NmQ5NWNkNTFiN2I1NThkNTVkNjcwNTgxMTkzN2E5OWNlNDc5ODI5Mzc4ZjczMjM0YWQ4YWY5MmIzNjcxNzlhNkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=Njc1NGU3YzA3NGVjMzQwYWRlOGM3MDFjMDE1ZmY5OGUyYTRhNTc4OWQxNzZlYmYzNDk3ZTBmNjM5NDk1Yzc0Y0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=NmE5MGU5YWJlNDJkMGI3ZDM3MGY1Y2JlODNiMWFiNTk1NjQ5MmUyNDRlNWFlZGY1OTQ0NGJjOGQzMDQ1MTdmM0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=MGVlYzAzNGY3YmJkZDgzZWE1NWI1MzUwNjkwMDRjNGZmMTMzZWI4M2UxMTk0ZmIzYTc4NzU1MDYzOTliNjgyZkBncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=NGI0OGEyMDdjOGNkNTVlYmRiNTg2YmJkMThmZDljMTc0MjgzOGY1NjNkMmNhMmIyOTBmNjNmMTIyZTUzNGJjY0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=aWQuaW5kb25lc2lhbiNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&src=ZW4uaW5kb25lc2lhbiNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&src=ZW4uaXNsYW1pYyNob2xpZGF5QGdyb3VwLnYuY2FsZW5kYXIuZ29vZ2xlLmNvbQ&color=%23D50000&color=%23EF6C00&color=%234285F4&color=%230B8043&color=%238E24AA&color=%23F6BF26&color=%23E67C73&color=%230B8043&color=%230B8043&color=%237CB342"
                        style="border: 0" width="1170" height="600" frameborder="0" scrolling="no"></iframe>
                </div>

                <!-- Add New Button -->
                <div class="misi-section-box d-flex justify-content-between align-items-center mt-3">
                    <div>
                        <h5 class="mb-1">Manajemen Kalender Event</h5>
                        <p class="mb-0 text-muted">Kelola kalender untuk jadwal atau event UKKI</p>
                    </div>
                    <a href="https://calendar.google.com/calendar/u/0?cid=MjMwODEwMTAyNDZAc3R1ZGVudC51cG5qYXRpbS5hYy5pZA"
                        class="btn btn-success-custom btn-lg" target="_blank">
                        <i class="material-icons me-2" style="font-size: 1.2rem; margin-button: 1rem;">edit</i>
                        Edit Kalender Event
                    </a>
                </div>
            </div>
        </div>


    </div>
@endsection
