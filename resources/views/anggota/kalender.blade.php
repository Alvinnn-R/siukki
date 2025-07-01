@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/kalender.css') }}">
@endpush

@section('content')
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