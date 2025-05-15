@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="login-container">
        <!-- Left side illustration -->
        <div class="login-illustration">
            <img src="{{ asset('assets/images/login-illustration.png') }}" alt="Ilustrasi SIUKKI" />
        </div>

        <!-- Right side form -->
        <div class="login-form-wrapper">
            <h1>Login to your Account</h1>
            <p>Login to access your SIUKKI account</p>

            <!-- Form action ke route login.post -->
            <form method="POST" action="{{ route('login.post') }}" id="loginForm" novalidate>
                @csrf

                <label for="npm">NPM atau ID</label>
                <input type="text" id="npm" {{-- harus sama dengan yang dipakai di JS --}} name="identifier" placeholder="e.g. 23081010xxx"
                    value="{{ old('identifier') }}" required />
                <p class="error-message" id="errorMsg" style="display:none; color:red;">
                    Wrong NPM or password, please try again!
                </p>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••••" required />
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror

                <div class="remember-me">
                    <input type="checkbox" id="remember" name="remember" />
                    <label for="remember">Remember Me</label>
                </div>

                <button type="submit" id="btnLogin">Login</button>
            </form>


            <p class="register-link">
                Not Registered Yet? <a href="{{ url('register') }}">Register</a>
            </p>
        </div>
    </div>
@endsection
