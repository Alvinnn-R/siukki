<!DOCTYPE html>
<html>

<head>
    <title>Dashboard SiUKKI</title>
</head>

<body>
    <h1>Selamat datang, {{ auth()->user()->nama }}</h1>
    <p>Role: {{ session('role') }}</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>

</html>
