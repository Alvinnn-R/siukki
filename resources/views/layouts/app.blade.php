<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SiUKKI')</title>
    <link rel="stylesheet" href="{{ asset('css/beranda.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- google font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Aref+Ruqaa:wght@400;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    @stack('styles')
</head>

<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            @include('partials.sidebar')

            <div class="col-md-9 col-lg-10 content">
                {{-- @include('partials.navbar') --}}

                <main class="p-3">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
