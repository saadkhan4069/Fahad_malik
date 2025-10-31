@extends('layouts.app')

@section('title', 'Company Register')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
        min-height: 100vh;
    }
    .card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }
    .text-primary {
        color: #213F60 !important;
    }
    .btn-primary {
        background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
        border: none;
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(229, 43, 59, 0.4);
        background: linear-gradient(135deg, #1a3250 0%, #cc2333 100%);
    }
    .form-control:focus {
        border-color: #213F60;
        box-shadow: 0 0 0 0.2rem rgba(33, 63, 96, 0.25);
    }
    a.text-decoration-none {
        color: #213F60 !important;
        font-weight: 500;
    }
    a.text-decoration-none:hover {
        color: #E52B3B !important;
    }
</style>
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="fas fa-building fa-3x text-primary mb-3"></i>
                    <h2 class="h4 text-gray-900 mb-2">Company Registration</h2>
                    <p class="text-muted">Create your company account</p>
                </div>

                <form method="POST" action="{{ route('company.register') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="company_name" class="form-label">Company Name *</label>
                            <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" 
                                   name="company_name" value="{{ old('company_name') }}" required autocomplete="company_name" autofocus>
                            @error('company_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email Address *</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="password" class="form-label">Password *</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                   name="password" required autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password *</label>
                            <input id="password_confirmation" type="password" class="form-control" 
                                   name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="contact_person" class="form-label">Contact Person *</label>
                            <input id="contact_person" type="text" class="form-control @error('contact_person') is-invalid @enderror" 
                                   name="contact_person" value="{{ old('contact_person') }}" required>
                            @error('contact_person')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number *</label>
                            <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                   name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address *</label>
                        <textarea id="address" class="form-control @error('address') is-invalid @enderror" 
                                  name="address" rows="2" required>{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-user-plus me-1"></i> Register Company
                        </button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <p class="text-muted">Already have an account? 
                        <a href="{{ route('company.login') }}" class="text-decoration-none">Login here</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
