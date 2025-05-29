<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin | SiUKKI')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
</head>

<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            {{-- Sidebar --}}
            {{-- @include('partials.admin.sidebar') --}}

            {{-- Main Content --}}
            <div class="col-md-9 col-lg-10 content">
                <main class="p-3">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
