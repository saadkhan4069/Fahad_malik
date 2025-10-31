<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Adex Courier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            font-weight: 400;
            line-height: 1.6;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', 'Inter', sans-serif;
            font-weight: 600;
        }
        .btn {
            font-family: 'Inter', sans-serif;
            font-weight: 500;
        }
        body {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
            min-height: 100vh;
        }
        .welcome-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            margin: 20px;
            overflow: hidden;
        }
        .adex-logo {
            max-width: 200px;
            height: auto;
            margin-bottom: 20px;
        }
        .btn-unified {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
            border: none;
            border-radius: 15px;
            padding: 15px 40px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            color: white;
        }
        .btn-unified:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(229, 43, 59, 0.4);
            background: linear-gradient(135deg, #1a3250 0%, #cc2333 100%);
            color: white;
        }
        .btn-outline-unified {
            border: 2px solid #213F60;
            border-radius: 15px;
            padding: 15px 40px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            color: #213F60;
            background: transparent;
        }
        .btn-outline-unified:hover {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
            border-color: #213F60;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(229, 43, 59, 0.4);
        }
        .feature-card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .demo-section {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 30px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="welcome-container">
                    <!-- Header Section -->
                    <div class="text-center p-5">
                        <img src="storage/company/logos/EUF6Xc4fXfp5oIew8OM7SWMnwICEvoPT16rqUkfR.jpg" alt="Adex Courier" class="adex-logo">
                        <h1 class="display-4 text-dark mb-3">Adex Courier System</h1>
                        <p class="lead text-muted">Complete shipment booking and management solution</p>
                    </div>

                    <!-- Login/Register Section -->
                    <div class="text-center p-5">
                        <h2 class="h3 mb-4">Get Started</h2>
                        <p class="text-muted mb-4">Access your account or create a new one</p>
                        
                        <!-- Track Shipment Button -->
                        <div class="row justify-content-center mb-4" >
                            <div class="col-md-6">
                                <a href="<?php echo e(route('tracking.index')); ?>" class="btn btn-unified w-100">
                                    <i class="fas fa-search me-2"></i>Track Your Shipment
                                </a>
                            </div>
                        </div>
                        
                        <!-- Login Button -->
                        <div class="row justify-content-center mb-4">
                            <div class="col-md-6">
                                <a href="<?php echo e(route('login')); ?>" class="btn btn-unified w-100">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login to Your Account
                                </a>
                            </div>
                        </div>
                        
                        <!-- Register Buttons -->
                        <div class="row justify-content-center" >
                            <div class="col-md-6 mb-3" style="display: none;">
                                <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-unified w-100">
                                    <i class="fas fa-building me-2"></i>Register Company
                                </a>
                            </div>
                            <div class="col-md-6 mb-3" >
                                <a href="<?php echo e(route('user.register')); ?>" class="btn btn-outline-unified w-100">
                                    <i class="fas fa-user me-2"></i>Register User
                                </a>
                            </div>
                        </div>
                        
                        <p class="text-muted mt-3">
                            <small>Track shipments, unified login for both Company and User. Separate registration pages.</small>
                        </p>
                    </div>

                    <!-- Demo Credentials Section -->
                    <div class="demo-section" style="display: none;">
                        <h4 class="text-center mb-4">Demo Login Credentials</h4>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="text-primary">Company Accounts:</h6>
                                <ul class="list-unstyled">
                                    <li><strong>Tech Solutions Ltd</strong><br>
                                        Email: admin@techsolutions.com<br>
                                        Password: password123
                                    </li>
                                    <li><strong>E-Commerce Pro</strong><br>
                                        Email: info@ecommercepro.com<br>
                                        Password: password123
                                    </li>
                                    <li><strong>Global Trading Co</strong><br>
                                        Email: contact@globaltrading.com<br>
                                        Password: password123
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="col-md-6">
                                <h6 class="text-success">User Accounts:</h6>
                                <ul class="list-unstyled">
                                    <li><strong>Admin User</strong><br>
                                        Email: admin@techsolutions.com<br>
                                        Password: password123
                                    </li>
                                    <li><strong>Manager User</strong><br>
                                        Email: manager@techsolutions.com<br>
                                        Password: password123
                                    </li>
                                    <li><strong>Regular User</strong><br>
                                        Email: user@techsolutions.com<br>
                                        Password: password123
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Features Section -->
                    <div class="demo-section">
                        <h4 class="text-center mb-4">Features</h4>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="feature-card text-center">
                                    <i class="fas fa-calendar-plus fa-2x text-primary mb-2"></i>
                                    <h6>Booking Management</h6>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="feature-card text-center">
                                    <i class="fas fa-shipping-fast fa-2x text-info mb-2"></i>
                                    <h6>Shipment Tracking</h6>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="feature-card text-center">
                                    <i class="fas fa-file-invoice fa-2x text-warning mb-2"></i>
                                    <h6>Invoice Generation</h6>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="feature-card text-center">
                                    <i class="fas fa-tags fa-2x text-success mb-2"></i>
                                    <h6>Label Printing</h6>
                                </div>
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


<?php /**PATH /home/u796145342/domains/adexcourier.com/public_html/portal/resources/views/welcome.blade.php ENDPATH**/ ?>