<?php $__env->startSection('title', 'Company Profile'); ?>

<?php
use Illuminate\Support\Facades\Storage;
?>

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
                    <form id="profile-form" method="POST" action="<?php echo e(route('company.profile.update')); ?>" enctype="multipart/form-data">
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
                        
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" 
                                           value="<?php echo e(old('first_name', $company->contact_first_name ?? 'FAHAD')); ?>">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="cell_no" class="form-label">Cell No.</label>
                                    <input type="text" class="form-control" id="cell_no" name="cell_no" 
                                           value="<?php echo e(old('cell_no', $company->phone ?? '03391231239')); ?>">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="website" class="form-label">Website</label>
                                    <input type="url" class="form-control" id="website" name="website" 
                                           value="<?php echo e(old('website', $company->website ?? '')); ?>">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="gst_no" class="form-label">GST No.</label>
                                    <input type="text" class="form-control" id="gst_no" name="gst_no" 
                                           value="<?php echo e(old('gst_no', $company->gst_no ?? '')); ?>">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="<?php echo e(old('email', $company->email ?? 'adexworldwideexpress@gmail.com')); ?>">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="accounts_email" class="form-label">Accounts Email Address</label>
                                    <input type="text" class="form-control" id="accounts_email" name="accounts_email" 
                                           value="<?php echo e(old('accounts_email', $company->accounts_email ?? 'adexworldwideexpress@gmail.com')); ?>">
                                    <small class="form-text text-muted">Separate the Email with Semicolon like 'xyz@mail.com;abc@mail.com'</small>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="company_address" class="form-label">Company Address</label>
                                    <textarea class="form-control" id="company_address" name="company_address" rows="3"><?php echo e(old('company_address', $company->address ?? 'Plot 13-A, Street#5, Sindhi Muslim Corporative Housing Society SMCHS, Near KFC, Karachi, Pakistan.')); ?></textarea>
                                </div>
                            </div>
                            
                            <!-- Right Column -->
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" 
                                           value="<?php echo e(old('last_name', $company->contact_last_name ?? 'MALIK')); ?>">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="company_name" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" id="company_name" name="company_name" 
                                           value="<?php echo e(old('company_name', $company->name ?? 'ADEX WORLDWIDE EXPRESS')); ?>">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="cnic_no" class="form-label">CNIC No.</label>
                                    <input type="text" class="form-control" id="cnic_no" name="cnic_no" 
                                           value="<?php echo e(old('cnic_no', $company->cnic_no ?? '42301-8322355-3')); ?>">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="ntn_no" class="form-label">NTN No.</label>
                                    <input type="text" class="form-control" id="ntn_no" name="ntn_no" 
                                           value="<?php echo e(old('ntn_no', $company->ntn_no ?? 'B066709-1')); ?>">
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="account_activity" class="form-label">Account Activity</label>
                                    <select class="form-control" id="account_activity" name="account_activity">
                                        <option value="Courier / Bucket Shop" <?php echo e(old('account_activity', $company->account_activity ?? 'Courier / Bucket Shop') == 'Courier / Bucket Shop' ? 'selected' : ''); ?>>Courier / Bucket Shop</option>
                                        <option value="Logistics" <?php echo e(old('account_activity', $company->account_activity ?? '') == 'Logistics' ? 'selected' : ''); ?>>Logistics</option>
                                        <option value="Freight Forwarding" <?php echo e(old('account_activity', $company->account_activity ?? '') == 'Freight Forwarding' ? 'selected' : ''); ?>>Freight Forwarding</option>
                                        <option value="Other" <?php echo e(old('account_activity', $company->account_activity ?? '') == 'Other' ? 'selected' : ''); ?>>Other</option>
                                    </select>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label for="accounts_mobile" class="form-label">Accounts Mobile No.</label>
                                    <input type="text" class="form-control" id="accounts_mobile" name="accounts_mobile" 
                                           value="<?php echo e(old('accounts_mobile', $company->accounts_mobile ?? '03062917233')); ?>">
                                </div>
                                
                                <!-- Document Upload Section -->
                                <div class="row mt-4">
                                    <div class="col-12">
                                        <h6 class="text-primary mb-3">Documents & Logo</h6>
                                        
                                        <!-- Company Logo -->
                                        <div class="form-group mb-3">
                                            <label class="form-label">Company Logo</label>
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <?php if($company->logo && Storage::disk('public')->exists($company->logo)): ?>
                                                        <img src="<?php echo e(asset('storage/' . $company->logo)); ?>" alt="Company Logo" class="img-thumbnail" style="width: 80px; height: 50px; object-fit: contain;" onerror="this.style.display='none'; this.parentElement.innerHTML='<div class=\'border rounded p-2 text-center\' style=\'width: 80px; height: 50px; background: #f8f9fa;\'><i class=\'fas fa-image text-muted\'></i></div>';">
                                                    <?php elseif($company->logo): ?>
                                                        <div class="border rounded p-2 text-center" style="width: 80px; height: 50px; background: #f8f9fa;">
                                                            <i class="fas fa-image text-muted"></i>
                                                            <small class="d-block text-muted" style="font-size: 8px;">File not found</small>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="border rounded p-2 text-center" style="width: 80px; height: 50px; background: #f8f9fa;">
                                                            <svg width="60" height="30" viewBox="0 0 200 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <text x="0" y="35" font-family="Arial, sans-serif" font-weight="bold" font-size="30" fill="#213F60">Ad</text>
                                                                <text x="45" y="35" font-family="Arial, sans-serif" font-weight="bold" font-size="30" fill="#E52B3B">Ex.</text>
                                                                <path d="M40 25 C 50 15, 70 15, 80 25" stroke="#333333" stroke-width="1.5" fill="none"/>
                                                                <path d="M65 20 L 75 25 L 65 30 L 68 25 L 65 20 Z" fill="#333333"/>
                                                                <text x="0" y="48" font-family="Arial, sans-serif" font-size="10" font-weight="bold" fill="#333333">WORLDWIDE EXPRESS</text>
                                                            </svg>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <input type="file" class="form-control" id="company_logo" name="company_logo" accept="image/*">
                                                    <small class="form-text text-muted">Upload company logo (PNG, JPG, SVG)</small>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- CNIC Front Image -->
                                        <div class="form-group mb-3">
                                            <label class="form-label">CNIC Front Image</label>
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <?php if($company->cnic_front && Storage::disk('public')->exists($company->cnic_front)): ?>
                                                        <img src="<?php echo e(asset('storage/' . $company->cnic_front)); ?>" alt="CNIC Front" class="img-thumbnail" style="width: 60px; height: 40px; object-fit: cover;">
                                                    <?php elseif($company->cnic_front): ?>
                                                        <div class="border rounded p-1 text-center" style="width: 60px; height: 40px; background: #f8f9fa;">
                                                            <i class="fas fa-id-card text-muted"></i>
                                                            <small class="d-block text-muted" style="font-size: 7px;">Not found</small>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="border rounded p-1 text-center" style="width: 60px; height: 40px; background: #f8f9fa;">
                                                            <i class="fas fa-id-card text-muted"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <input type="file" class="form-control" id="cnic_front" name="cnic_front" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- CNIC Back Image -->
                                        <div class="form-group mb-3">
                                            <label class="form-label">CNIC Back Image</label>
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <?php if($company->cnic_back && Storage::disk('public')->exists($company->cnic_back)): ?>
                                                        <img src="<?php echo e(asset('storage/' . $company->cnic_back)); ?>" alt="CNIC Back" class="img-thumbnail" style="width: 60px; height: 40px; object-fit: cover;">
                                                    <?php elseif($company->cnic_back): ?>
                                                        <div class="border rounded p-1 text-center" style="width: 60px; height: 40px; background: #f8f9fa;">
                                                            <i class="fas fa-id-card text-muted"></i>
                                                            <small class="d-block text-muted" style="font-size: 7px;">Not found</small>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="border rounded p-1 text-center" style="width: 60px; height: 40px; background: #f8f9fa;">
                                                            <i class="fas fa-id-card text-muted"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <input type="file" class="form-control" id="cnic_back" name="cnic_back" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- NTN Image -->
                                        <div class="form-group mb-3">
                                            <label class="form-label">NTN Image</label>
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <?php if($company->ntn_image && Storage::disk('public')->exists($company->ntn_image)): ?>
                                                        <img src="<?php echo e(asset('storage/' . $company->ntn_image)); ?>" alt="NTN Image" class="img-thumbnail" style="width: 60px; height: 40px; object-fit: cover;">
                                                    <?php elseif($company->ntn_image): ?>
                                                        <div class="border rounded p-1 text-center" style="width: 60px; height: 40px; background: #f8f9fa;">
                                                            <i class="fas fa-file-alt text-muted"></i>
                                                            <small class="d-block text-muted" style="font-size: 7px;">Not found</small>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="border rounded p-1 text-center" style="width: 60px; height: 40px; background: #f8f9fa;">
                                                            <i class="fas fa-file-alt text-muted"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <input type="file" class="form-control" id="ntn_image" name="ntn_image" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-control {
    border: 1px solid #ced4da;
    border-radius: 4px;
    padding: 8px 12px;
    font-size: 14px;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.form-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 5px;
}

.card-header {
    background: #007bff !important;
    border-bottom: 1px solid #dee2e6;
}

.btn-success {
    background-color: #28a745;
    border-color: #28a745;
}

.btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
}

.img-thumbnail {
    border: 1px solid #dee2e6;
    border-radius: 4px;
}

.text-primary {
    color: #007bff !important;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel\Fahad_malik\resources\views/company/profile.blade.php ENDPATH**/ ?>