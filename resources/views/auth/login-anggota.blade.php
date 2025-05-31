<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Anggota SiUKKI</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS (optional) -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

</head>

<body>

    <div class="container-fluid vh-100 d-flex flex-column flex-lg-row p-0">
        <!-- Ilustrasi Kiri -->
        <div class="d-none d-lg-flex col-lg-6 justify-content-center align-items-center bg-success bg-opacity-25">
            <img src="{{ asset('assets/images/login-illustration.png') }}" alt="Ilustrasi SIUKKI" class="img-fluid p-4"
                style="max-width: 80%;">
        </div>

        <!-- Form Login Kanan -->
        <div class="col-lg-6 d-flex align-items-center justify-content-center bg-light">
            <div class="w-75">
                <h1 class="mb-2">Login to your Account</h1>
                <p class="text-muted mb-4">Login to access your SIUKKI account</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.post') }}" class="needs-validation" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="npm" class="form-label">NPM</label>
                        <input type="text" class="form-control" id="npm" name="npm"
                            placeholder="e.g. 23081010xxx" value="{{ old('npm') }}" required>
                        <div class="invalid-feedback">
                            Please enter your NPM.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
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

                    <button class="btn btn-success w-100" type="submit">Login</button>
                </form>

                <p class="text-center mt-4 register-link">
                    Not Registered Yet? <a href="{{ url('register') }}">Register</a>
                </p>

                <p class="text-center mt-3">
                    Login as admin?
                    <small class="text-muted">
                        <a href="{{ route('admin.login') }}" class="text-decoration-none">Click here</a>
                    </small>
                </p>
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
