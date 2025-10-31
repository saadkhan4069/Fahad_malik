<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration - Adex Courier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
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
            max-width: 600px;
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
            border-color: #213F60;
            box-shadow: 0 0 0 0.2rem rgba(33, 63, 96, 0.25);
        }
        .btn-register {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: white;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(229, 43, 59, 0.4);
            background: linear-gradient(135deg, #1a3250 0%, #cc2333 100%);
        }
        .login-link {
            color: #213F60;
            text-decoration: none;
            font-weight: 500;
        }
        .login-link:hover {
            color: #E52B3B;
            text-decoration: underline;
        }
        .form-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .section-title {
            color: #213F60;
            font-weight: 600;
            margin-bottom: 15px;
            border-bottom: 2px solid #E52B3B;
            padding-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="register-container">
                    <!-- Logo Section -->
                    <div class="text-center p-4">
                        <img src="../storage/company/logos/EUF6Xc4fXfp5oIew8OM7SWMnwICEvoPT16rqUkfR.jpg" alt="Adex Courier" class="adex-logo">
                        <h2 class="h4 text-dark mb-0">Adex Courier System</h2>
                        <p class="text-muted">User Registration</p>
                    </div>

                    <!-- User Registration Form -->
                    <div class="p-4">
                        <form method="POST" action="{{ route('user.register') }}">
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

                            <!-- User Information -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="fas fa-user me-2"></i>User Information
                                </h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Full Name *</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                                               name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
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
                                        <label for="phone" class="form-label">Phone Number *</label>
                                        <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                               name="phone" value="{{ old('phone') }}" required>
                                        @error('phone')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="company_id" class="form-label">Company *</label>
                                        <select id="company_id" class="form-control @error('company_id') is-invalid @enderror" 
                                                name="company_id" required>
                                            <option value="">Select Company</option>
                                            @foreach(\App\Models\Company::all() as $company)
                                                <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('company_id')
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
                                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                            <!-- <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option> -->
                                            <!-- <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Manager</option> -->
                                        </select>
                                        @error('role')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="department" class="form-label">Department</label>
                                        <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" 
                                               name="department" value="{{ old('department') }}" placeholder="Enter Department">
                                        @error('department')
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

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-register">
                                    <i class="fas fa-user-plus me-2"></i> Register User
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center p-4 border-top">
                        <p class="text-muted mb-0">Already have an account? 
                            <a href="{{ route('login') }}" class="login-link">Login here</a>
                        </p>
                        <!-- <p class="text-muted mt-2">
                            <small>Want to register as Company? 
                                <a href="{{ route('register') }}" class="login-link">Company Registration</a>
                            </small>
                        </p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

