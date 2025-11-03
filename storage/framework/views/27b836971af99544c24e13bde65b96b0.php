<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Adex Courier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .adex-logo {
            max-width: 200px;
            height: auto;
            margin-bottom: 20px;
        }
        .login-tabs {
            border-bottom: 1px solid #e9ecef;
        }
        .nav-link {
            border: none;
            border-radius: 0;
            color: #6c757d;
            font-weight: 500;
            padding: 15px 30px;
        }
        .nav-link.active {
            color: #213F60;
            background: none;
            border-bottom: 3px solid #E52B3B;
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
        .btn-login {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            color: white;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(229, 43, 59, 0.4);
            background: linear-gradient(135deg, #1a3250 0%, #cc2333 100%);
        }
        .register-link {
            color: #213F60;
            text-decoration: none;
            font-weight: 500;
        }
        .register-link:hover {
            color: #E52B3B;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="login-container">
                    <!-- Logo Section -->
                    <div class="text-center p-4">
                        <img src="storage/company/logos/EUF6Xc4fXfp5oIew8OM7SWMnwICEvoPT16rqUkfR.jpg" alt="Adex Courier" class="adex-logo">
                        <h2 class="h4 text-dark mb-0">Adex Courier System</h2>
                        <p class="text-muted">Login to your account</p>
                    </div>

                    <!-- Login Tabs -->
                    <ul class="nav nav-tabs login-tabs" id="loginTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="company-tab" data-bs-toggle="tab" data-bs-target="#company" type="button" role="tab">
                                <i class="fas fa-building me-2"></i>Company Login
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="user-tab" data-bs-toggle="tab" data-bs-target="#user" type="button" role="tab">
                                <i class="fas fa-user me-2"></i>User Login
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content p-4" id="loginTabsContent">
                        <!-- Company Login -->
                        <div class="tab-pane fade show active" id="company" role="tabpanel">
                            <form method="POST" action="<?php echo e(route('login')); ?>">
                                <?php echo csrf_field(); ?>
                                
                                <?php if($errors->any()): ?>
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label for="company_email" class="form-label">Email Address</label>
                                    <input id="company_email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="mb-3">
                                    <label for="company_password" class="form-label">Password</label>
                                    <input id="company_password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           name="password" required autocomplete="current-password">
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="mb-3 form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="company_remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="company_remember">
                                        Remember Me
                                    </label>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-login">
                                        <i class="fas fa-sign-in-alt me-2"></i> Company Login
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- User Login -->
                        <div class="tab-pane fade" id="user" role="tabpanel">
                            <form method="POST" action="<?php echo e(route('user.login')); ?>">
                                <?php echo csrf_field(); ?>
                                
                                <?php if($errors->any() && (session('tab') === 'user' || request()->routeIs('user.login'))): ?>
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($error); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label for="user_email" class="form-label">Email Address</label>
                                    <input id="user_email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email">
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="mb-3">
                                    <label for="user_password" class="form-label">Password</label>
                                    <input id="user_password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           name="password" required autocomplete="current-password">
                                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($message); ?>

                                        </div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="mb-3 form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="user_remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                    <label class="form-check-label" for="user_remember">
                                        Remember Me
                                    </label>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-login">
                                        <i class="fas fa-sign-in-alt me-2"></i> User Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Register Links -->
                    <div class="text-center p-4 border-top" style="display: none;">
                        <p class="text-muted mb-2">Don't have an account?</p>
                        <div class="row" >
                            <div class="col-6">
                                <a href="<?php echo e(route('register')); ?>" class="register-link">
                                    <i class="fas fa-building me-1"></i>Company Register
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="<?php echo e(route('user.register')); ?>" class="register-link">
                                    <i class="fas fa-user me-1"></i>User Register
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Agar user login page se aaya ho ya user login route par error ho, to user tab ko active karo
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const currentUrl = window.location.pathname;
            
            // Agar user/login route se aaya ho ya error user login ka ho (session se check), to user tab active karo
            <?php if(session('tab') === 'user' || request()->routeIs('user.login') || request()->url() === route('user.login')): ?>
                const userTab = new bootstrap.Tab(document.getElementById('user-tab'));
                userTab.show();
            <?php endif; ?>
            
            // URL parameter se bhi check kar sakte hain
            if (urlParams.get('tab') === 'user') {
                const userTab = new bootstrap.Tab(document.getElementById('user-tab'));
                userTab.show();
            }
        });
    </script>
</body>
</html>


<?php /**PATH D:\Laravel\Fahad_malik\resources\views/auth/login.blade.php ENDPATH**/ ?>