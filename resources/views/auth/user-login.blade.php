@extends('layouts.app')

@section('title', 'User Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="fas fa-user fa-3x text-primary mb-3"></i>
                    <h2 class="h4 text-gray-900 mb-2">User Login</h2>
                    <p class="text-muted">Employee Login Portal</p>
                </div>

                <form method="POST" action="{{ route('user.login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                               name="password" required autocomplete="current-password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt me-1"></i> Login
                        </button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p class="text-muted">Don't have an account? 
                        <a href="{{ route('user.register') }}" class="text-decoration-none">Register here</a>
                    </p>
                    <hr>
                    <p class="text-muted small">Company Login? 
                        <a href="{{ route('login') }}" class="text-decoration-none">Click here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



