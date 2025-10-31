<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Shipment - Adex Courier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .tracking-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 600px;
            overflow: hidden;
        }
        .adex-logo {
            max-width: 200px;
            height: auto;
            margin-bottom: 20px;
        }
        .tracking-header {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .tracking-form {
            padding: 40px;
        }
        .form-control {
            border-radius: 15px;
            border: 2px solid #e9ecef;
            padding: 15px 20px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #213F60;
            box-shadow: 0 0 0 0.2rem rgba(33, 63, 96, 0.25);
        }
        .btn-track {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
            border: none;
            border-radius: 15px;
            padding: 15px 40px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            color: white;
        }
        .btn-track:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }
        .tracking-input {
            position: relative;
        }
        .tracking-input i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #213F60;
            font-size: 1.2rem;
        }
        .tracking-input input {
            padding-left: 60px;
        }
        .features {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            margin: 20px;
        }
        .feature-item {
            text-align: center;
            padding: 20px;
        }
        .feature-item i {
            font-size: 2.5rem;
            color: #213F60;
            margin-bottom: 15px;
        }
        .alert {
            border-radius: 15px;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="tracking-container">
                    <!-- Header -->
                    <div class="tracking-header">
                        <img src="storage/company/logos/EUF6Xc4fXfp5oIew8OM7SWMnwICEvoPT16rqUkfR.jpg" alt="Adex Courier" class="adex-logo">
                        <h1 class="h3 mb-0">Track Your Shipment</h1>
                        <p class="mb-0">Enter your tracking number to get real-time updates</p>
                    </div>

                    <!-- Tracking Form -->
                    <div class="tracking-form">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                {{ session('error') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('tracking.track') }}">
                            @csrf
                            
                            <div class="tracking-input mb-4">
                                <i class="fas fa-search"></i>
                                <input type="text" 
                                       class="form-control @error('tracking_number') is-invalid @enderror" 
                                       name="tracking_number" 
                                       placeholder="Enter your tracking number (e.g., TRHJA8TTAAAA)"
                                       value="{{ old('tracking_number') }}"
                                       required>
                                @error('tracking_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-track">
                                    <i class="fas fa-search me-2"></i>Track Shipment
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <p class="text-muted">
                                <small>
                                    <i class="fas fa-info-circle me-1"></i>
                                    Don't have a tracking number? Contact your sender or check your email.
                                </small>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Features Section -->
                <div class="features">
                    <h4 class="text-center mb-4">Why Choose Adex Courier?</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="feature-item">
                                <i class="fas fa-clock"></i>
                                <h6>Real-time Tracking</h6>
                                <p class="text-muted">Get instant updates on your shipment status</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-item">
                                <i class="fas fa-shield-alt"></i>
                                <h6>Secure Delivery</h6>
                                <p class="text-muted">Your packages are handled with utmost care</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="feature-item">
                                <i class="fas fa-globe"></i>
                                <h6>Global Network</h6>
                                <p class="text-muted">Worldwide delivery to your doorstep</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
