<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Login - AdEx Worldwide</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 400px;
            width: 100%;
        }
        .login-header {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .login-header h2 {
            margin: 0;
            font-weight: 700;
            font-size: 2em;
        }
        .login-header p {
            margin: 10px 0 0 0;
            opacity: 0.9;
        }
        .login-body {
            padding: 40px 30px;
        }
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 15px 20px;
            font-size: 1.1em;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #213F60;
            box-shadow: 0 0 0 0.2rem rgba(33, 63, 96, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
            border: none;
            border-radius: 10px;
            padding: 15px;
            font-size: 1.1em;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            color: white;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(229, 43, 59, 0.4);
            background: linear-gradient(135deg, #1a3250 0%, #cc2333 100%);
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-right: none;
            border-radius: 10px 0 0 10px;
        }
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        .input-group:focus-within .input-group-text {
            border-color: #213F60;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2><i class="fas fa-building me-2"></i>Company Login</h2>
            <p>Access your AdEx Worldwide account</p>
        </div>
        <div class="login-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Login Failed!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('company.login') }}">
                @csrf
                
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" class="form-control" id="email" name="email" 
                               value="{{ old('email') }}" placeholder="Enter your email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Enter your password" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-login">
                    <i class="fas fa-sign-in-alt me-2"></i>Login
                </button>
            </form>

            <div class="text-center mt-4">
                <p class="text-muted">
                    Don't have an account? 
                    <a href="{{ route('company.register') }}" class="text-decoration-none">Register here</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>










