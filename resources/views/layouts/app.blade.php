<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') — SIUKKI</title>

    <!-- Include CSS -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />
</head>

<body>

    @yield('content')

    <!-- Include JS -->
    {{-- <script src="{{ asset('js/login.js') }}"></script>git --}}

</body>

</html>
