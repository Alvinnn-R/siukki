@extends('layouts.admin')

@section('title', 'Login Admin')

@section('content')
    <div class="container py-5">
        <h2>Login Admin SiUKKI</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="mb-3">
                <label for="id_admin" class="form-label">ID Admin</label>
                <input type="text" name="id_admin" id="id_admin" class="form-control" value="{{ old('id_admin') }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button class="btn btn-primary w-100" type="submit">Login</button>
        </form>
    </div>
@endsection
