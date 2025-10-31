<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Registration - Adex Courier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        .register-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 800px;
            width: 100%;
        }
        .adex-logo {
            max-width: 150px;
            height: auto;
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .login-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }
        .login-link:hover {
            color: #764ba2;
            text-decoration: underline;
        }
        .form-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .section-title {
            color: #667eea;
            font-weight: 600;
            margin-bottom: 15px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="register-container">
                    <!-- Logo Section -->
                    <div class="text-center p-4">
                        <img src="storage/company/logos/EUF6Xc4fXfp5oIew8OM7SWMnwICEvoPT16rqUkfR.jpg" alt="Adex Courier" class="adex-logo">
                        <h2 class="h4 text-dark mb-0">Adex Courier System</h2>
                        <p class="text-muted">Company Registration</p>
                    </div>

                    <!-- Company Registration Form -->
                    <div class="p-4">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Company Information -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="fas fa-building me-2"></i>Company Information
                                </h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="company_name" class="form-label">Company Name *</label>
                                        <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" 
                                               name="company_name" value="{{ old('company_name') }}" required autocomplete="organization" autofocus>
                                        @error('company_name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
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
                                </div>
                                <div class="row">
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
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="role" class="form-label">Role *</label>
                                        <select id="role" class="form-control @error('role') is-invalid @enderror" 
                                                name="role" required>
                                            <option value="">Select Role</option>
                                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option>
                                            <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="tax_id" class="form-label">Tax ID</label>
                                        <input id="tax_id" type="text" class="form-control @error('tax_id') is-invalid @enderror" 
                                               name="tax_id" value="{{ old('tax_id') }}" placeholder="Enter Tax ID">
                                        @error('tax_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Account Information -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="fas fa-lock me-2"></i>Account Information
                                </h5>
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
                            </div>

                            <!-- Address Information -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="fas fa-map-marker-alt me-2"></i>Address Information
                                </h5>
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
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="city" class="form-label">City *</label>
                                        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" 
                                               name="city" value="{{ old('city') }}" required>
                                        @error('city')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="state" class="form-label">State *</label>
                                        <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" 
                                               name="state" value="{{ old('state') }}" required>
                                        @error('state')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="zip_code" class="form-label">ZIP Code *</label>
                                        <input id="zip_code" type="text" class="form-control @error('zip_code') is-invalid @enderror" 
                                               name="zip_code" value="{{ old('zip_code') }}" required>
                                        @error('zip_code')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-register">
                                    <i class="fas fa-building me-2"></i> Register Company
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center p-4 border-top">
                        <p class="text-muted mb-0">Already have an account? 
                            <a href="{{ route('login') }}" class="login-link">Login here</a>
                        </p>
                        <p class="text-muted mt-2">
                            <small>Want to register as User? 
                                <a href="{{ route('user.register') }}" class="login-link">User Registration</a>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
