

<?php $__env->startSection('title', 'User Profile'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- User Profile Section -->
            <div class="card shadow">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">User Profile</h5>
                    <button type="submit" form="profile-form" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                </div>
                
                <div class="card-body">
                    <form id="profile-form" method="POST" action="<?php echo e(route('user.profile.update')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <?php if(session('success')): ?>
                            <div class="alert alert-success">
                                <?php echo e(session('success')); ?>

                            </div>
                        <?php endif; ?>
                        
                        <?php if(session('error')): ?>
                            <div class="alert alert-danger">
                                <?php echo e(session('error')); ?>

                            </div>
                        <?php endif; ?>
                        
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="<?php echo e(old('name', $user->name)); ?>" required>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo e(old('email', $user->email)); ?>" required>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" 
                                           value="<?php echo e(old('phone', $user->phone ?? '')); ?>">
                                </div>
                            </div>
                            
                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="company_name" class="form-label">Company</label>
                                    <input type="text" class="form-control" id="company_name" 
                                           value="<?php echo e($user->company->name ?? 'N/A'); ?>" disabled>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <input type="text" class="form-control" id="role" 
                                           value="<?php echo e(ucfirst($user->role ?? 'user')); ?>" disabled>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password" 
                                           placeholder="Leave blank to keep current password">
                                    <small class="form-text text-muted">Minimum 8 characters</small>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" 
                                           placeholder="Confirm new password">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel\shipment_fahad_malik\resources\views/user/profile.blade.php ENDPATH**/ ?>