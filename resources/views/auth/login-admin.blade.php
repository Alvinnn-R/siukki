<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin SiUKKI</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Custom CSS (optional) -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

</head>

<body>

    <div class="container-fluid vh-100 d-flex flex-column flex-lg-row p-0">
        <!-- Ilustrasi Kiri -->
        <div class="d-none d-lg-flex col-lg-6 justify-content-center align-items-center bg-warning bg-opacity-25">
            <img src="{{ asset('assets/images/admin-illustration.png') }}" alt="Ilustrasi Admin SIUKKI"
                class="img-fluid p-4" style="max-width: 80%;">
        </div>

        <!-- Form Login Kanan -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center bg-light">
            <div class="w-75">
                <!-- Admin Badge -->
                <div class="text-center mb-3">
                    <span class="badge bg-warning text-dark fs-6 px-3 py-2">
                        <i class="material-icons me-1"
                            style="font-size: 18px; vertical-align: middle;">admin_panel_settings</i>
                        Admin Panel
                    </span>
                </div>

                <h1 class="mb-2">Admin Login</h1>
                <p class="text-muted mb-4">Akses panel administrasi SiUKKI</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.post') }}" class="needs-validation" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="id_admin" class="form-label">ID Admin</label>
                        <input type="text" class="form-control @error('id_admin') is-invalid @enderror"
                            id="id_admin" name="id_admin" placeholder="Masukkan ID admin ..."
                            value="{{ old('id_admin') }}" required>
                        @error('id_admin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                            placeholder="Masukkan password ..." required>
                        <div class="invalid-feedback">
                            Please enter your password.
                        </div>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>

                    <button class="btn btn-warning w-100 text-dark fw-semibold" type="submit">Login Admin</button>
                </form>

                <!-- Back to Anggota Login -->
                <p class="text-center mt-3">
                    <small class="text-muted">
                        Bukan admin? <a href="{{ route('login') }}" class="text-decoration-none">Login sebagai
                            anggota</a>
                    </small>
                </p>

                <!-- Admin Contact Info -->
                <div class="text-center mt-4">
                    <small class="text-muted">
                        <i class="material-icons me-1" style="font-size: 14px; vertical-align: middle;">security</i>
                        Akses terbatas untuk administrator UKKI
                    </small>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Bootstrap validation (opsional)
        (() => {
            'use strict'
            const forms = document.querySelectorAll('.needs-validation')
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
