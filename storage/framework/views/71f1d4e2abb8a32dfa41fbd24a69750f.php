<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?> - <?php echo $__env->yieldContent('title'); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Inter', 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            font-weight: 400;
            line-height: 1.6;
        }
        .navbar-brand, h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', 'Inter', sans-serif;
            font-weight: 600;
        }
        .btn {
            font-family: 'Inter', sans-serif;
            font-weight: 500;
        }
        .form-control, .form-select {
            font-family: 'Inter', sans-serif;
        }
        .table {
            font-family: 'Inter', sans-serif;
        }
        .card-title, .card-header h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }
    </style>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Professional Fonts CSS -->
    <link href="<?php echo e(asset('css/professional-fonts.css')); ?>" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-container--default .select2-selection--single {
            height: 38px;
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 36px;
            padding-left: 12px;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }
        .select2-container--default .select2-dropdown {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
        }
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
        }
        
        /* Enhanced Select2 styling */
        .select2-container--default .select2-selection--single:focus {
            border-color: #213F60;
            box-shadow: 0 0 0 0.2rem rgba(33, 63, 96, 0.25);
        }
        
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #213F60;
        }
        
        /* Adex Theme Colors */
        :root {
            --adex-blue: #213F60;
            --adex-red: #E52B3B;
            --adex-blue-hover: #1a3250;
            --adex-red-hover: #cc2333;
        }
        
        .bg-primary, .navbar-dark.bg-primary {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%) !important;
        }
        
        .bg-success, .navbar-dark.bg-success {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%) !important;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%) !important;
            border: none;
            color: white;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #1a3250 0%, #cc2333 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(229, 43, 59, 0.4);
        }
        
        .text-primary {
            color: #213F60 !important;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #213F60;
            box-shadow: 0 0 0 0.2rem rgba(33, 63, 96, 0.25);
        }
        
        .border-primary {
            border-color: #213F60 !important;
        }
        
        .alert-primary {
            background-color: rgba(33, 63, 96, 0.1);
            border-color: #213F60;
            color: #213F60;
        }
        
        .card-header.bg-primary {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%) !important;
            color: white;
        }
        
        .border-left-primary {
            border-left: 4px solid #213F60 !important;
        }
        
        .btn-outline-primary {
            color: #213F60;
            border-color: #213F60;
        }
        
        .btn-outline-primary:hover {
            background-color: #213F60;
            border-color: #213F60;
            color: white;
        }
        
        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #e9ecef;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #6c757d;
        }
        
        /* Loading state */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #495057;
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-light">
    <div id="app">
        <?php if(auth()->guard('company')->check()): ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>">
                    <i class="fas fa-shipping-fast me-2"></i>
                    Shipment System
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">
                                <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-shipping-fast me-1"></i> Booking
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?php echo e(route('bookings.index')); ?>">
                                    <i class="fas fa-list me-1"></i> All Bookings
                                </a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('bookings.create')); ?>">
                                    <i class="fas fa-plus me-1"></i> New Booking
                                </a></li>
                            </ul>
                        </li>
                         <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-file-invoice me-1"></i> Invoice
                            </a>
                            <ul class="dropdown-menu">
                                <!--<li><a class="dropdown-item" href="<?php echo e(route('invoices.index')); ?>">-->
                                <!--    <i class="fas fa-list me-1"></i> All Invoices-->
                                <!--</a></li>-->
                                <li><a class="dropdown-item" href="<?php echo e(route('invoices.generate')); ?>">
                                    <i class="fas fa-plus me-1"></i> Generate Invoice
                                </a></li>
                            </ul>
                        </li>
                      <!----  <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-chart-line me-1"></i> Accounts
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">
                                    <i class="fas fa-chart-bar me-1"></i> Reports
                                </a></li>
                                <li><a class="dropdown-item" href="#">
                                    <i class="fas fa-calculator me-1"></i> Calculator
                                </a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-table me-1"></i> Sheets
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('labels.index')); ?>">
                                <i class="fas fa-tag me-1"></i> Label
                            </a>
                        </li> -->
                    </ul>
                    
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-building me-1"></i> <?php echo e(Auth::guard('company')->user()->name); ?>

                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('company.profile')); ?>">
                                        <i class="fas fa-user-edit me-1"></i> Update Profile
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php endif; ?>

        <?php if(auth()->guard()->check()): ?>
        <?php if(auth()->guard('company')->guest()): ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <i class="fas fa-shipping-fast me-2"></i>
                    Shipment System - User
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavUser">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNavUser">
                    <ul class="navbar-nav me-auto">
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('user.dashboard')); ?>">
                                <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('user.bookings.index')); ?>">
                                <i class="fas fa-calendar-plus me-1"></i> My Bookings
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('user.invoices.index')); ?>">
                                <i class="fas fa-file-invoice me-1"></i> My Invoices
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('user.labels.index')); ?>">
                                <i class="fas fa-tags me-1"></i> My Labels
                            </a>
                        </li> -->
                    </ul>
                    
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i> <?php echo e(Auth::user()->name); ?>

                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="<?php echo e(route('user.profile')); ?>">
                                        <i class="fas fa-user-edit me-1"></i> Update Profile
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="<?php echo e(route('user.logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-1"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php endif; ?>
        <?php endif; ?>

        <main class="py-4">
            <div class="container">
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo e(session('error')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if(session('info')): ?>
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <?php echo e(session('info')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <!-- Initialize Select2 for all select elements -->
    <script>
        $(document).ready(function() {
            // Initialize Select2 on all select elements except those with no-select2 class
            $('select:not(.no-select2)').select2({
                placeholder: 'Select an option',
                allowClear: true,
                width: '100%'
            });
        });
    </script>
    
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /home/u796145342/domains/adexcourier.com/public_html/portal/resources/views/layouts/app.blade.php ENDPATH**/ ?>