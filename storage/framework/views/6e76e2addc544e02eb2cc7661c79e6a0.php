

<?php $__env->startSection('title', 'Edit Booking'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Override custom fonts for booking edit page */
    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif !important;
    }
    
    h1, h2, h3, h4, h5, h6,
    .navbar-brand,
    .card-title,
    .card-header h6,
    .modal-title {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif !important;
    }
    
    .btn {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif !important;
    }
    
    .form-control,
    .form-select,
    .form-label,
    .input-group-text {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif !important;
    }
    
    .table,
    .table th,
    .table td {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif !important;
    }
    
    .navbar-nav .nav-link {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif !important;
    }
    
    .card {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif !important;
    }
    
    .alert {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif !important;
    }
    
    .badge {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif !important;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <div class="col-12">
            <div class="booking-form-container">
                <h2 class="form-title">Edit Shipment Booking</h2>
                <p class="form-description">Please update the form below to modify your booking. Fields marked with * are required.</p>

                <form id="booking-form" method="POST" action="<?php echo e(route('user.bookings.update', $booking)); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    
                    <!-- Error Messages -->
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            <?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Shipper Information Section -->
                    <div class="form-section">
                        <h3 class="section-title">Shipper Information</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipper_name" class="form-label">Name *</label>
                                    <input type="text" class="form-control" id="shipper_name" name="shipper_name" value="<?php echo e(old('shipper_name', $booking->shipper_name)); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipper_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="shipper_email" name="shipper_email" value="<?php echo e(old('shipper_email', $booking->shipper_email)); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipper_address" class="form-label">Address *</label>
                                    <input type="text" class="form-control" id="shipper_address" name="shipper_address" value="<?php echo e(old('shipper_address', $booking->shipper_address)); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipper_city" class="form-label">City *</label>
                                    <input type="text" class="form-control" id="shipper_city" name="shipper_city" value="<?php echo e(old('shipper_city', $booking->shipper_city)); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="shipper_zip" class="form-label">Postal Code *</label>
                                    <input type="text" class="form-control" id="shipper_zip" name="shipper_zip" value="<?php echo e(old('shipper_zip', $booking->shipper_zip)); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="shipper_country" class="form-label">Country *</label>
                                    <select class="form-control" id="shipper_country" name="shipper_country" required>
                                        <option value="">Select Country</option>
                                        <?php $__currentLoopData = \DB::table('countries')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($country->code); ?>" <?php echo e(old('shipper_country', $booking->shipper_country) == $country->code ? 'selected' : ''); ?>>
                                                <?php echo e($country->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="shipper_state" class="form-label">State *</label>
                                    <input type="text" class="form-control" id="shipper_state" name="shipper_state" value="<?php echo e(old('shipper_state', $booking->shipper_state)); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="shipper_phone" class="form-label">Phone *</label>
                                    <input type="tel" class="form-control" id="shipper_phone" name="shipper_phone" value="<?php echo e(old('shipper_phone', $booking->shipper_phone)); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="shipper_cnic" class="form-label">CNIC *</label>
                                    <input type="text" class="form-control" id="shipper_cnic" name="shipper_cnic" value="<?php echo e(old('shipper_cnic', $booking->shipper_cnic)); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="shipper_ntn" class="form-label">NTN</label>
                                    <input type="text" class="form-control" id="shipper_ntn" name="shipper_ntn" value="<?php echo e(old('shipper_ntn', $booking->shipper_ntn)); ?>" placeholder="Enter NTN Number">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Consignee Information Section -->
                    <div class="form-section">
                        <h3 class="section-title">Consignee Information</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="consignee_name" class="form-label">Name *</label>
                                    <input type="text" class="form-control" id="consignee_name" name="consignee_name" value="<?php echo e(old('consignee_name', $booking->consignee_name)); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="consignee_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="consignee_email" name="consignee_email" value="<?php echo e(old('consignee_email', $booking->consignee_email)); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="consignee_address" class="form-label">Address *</label>
                                    <input type="text" class="form-control" id="consignee_address" name="consignee_address" value="<?php echo e(old('consignee_address', $booking->consignee_address)); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="consignee_city" class="form-label">City *</label>
                                    <input type="text" class="form-control" id="consignee_city" name="consignee_city" value="<?php echo e(old('consignee_city', $booking->consignee_city)); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="consignee_zip" class="form-label">Postal Code *</label>
                                    <input type="text" class="form-control" id="consignee_zip" name="consignee_zip" value="<?php echo e(old('consignee_zip', $booking->consignee_zip)); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="consignee_country" class="form-label">Country *</label>
                                    <select class="form-control" id="consignee_country" name="consignee_country" required>
                                        <option value="">Select Country</option>
                                        <?php $__currentLoopData = \DB::table('countries')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($country->code); ?>" <?php echo e(old('consignee_country', $booking->consignee_country) == $country->code ? 'selected' : ''); ?>>
                                                <?php echo e($country->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="consignee_state" class="form-label">State *</label>
                                    <input type="text" class="form-control" id="consignee_state" name="consignee_state" value="<?php echo e(old('consignee_state', $booking->consignee_state)); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="consignee_phone" class="form-label">Phone *</label>
                                    <input type="tel" class="form-control" id="consignee_phone" name="consignee_phone" value="<?php echo e(old('consignee_phone', $booking->consignee_phone)); ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                            
                    <!-- Shipment Information Section -->
                    <div class="form-section">
                        <h3 class="section-title">Shipment Information</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estimated_date" class="form-label">Estimated Date *</label>
                                    <input type="date" class="form-control" id="estimated_date" name="estimated_date" value="<?php echo e(old('estimated_date', $booking->estimated_date ? $booking->estimated_date->format('Y-m-d') : date('Y-m-d'))); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service" class="form-label">Service Type *</label>
                                    <select class="form-control" id="service" name="service" required>
                                        <option value="">Select service type</option>
                                        <?php $__currentLoopData = \DB::table('services')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($service->code); ?>" <?php echo e(old('service', $booking->service_type) == $service->code ? 'selected' : ''); ?>>
                                                <?php echo e($service->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="package_type" class="form-label">Package Type *</label>
                                    <select class="form-control" id="package_type" name="package_type" required>
                                        <option value="">Select package type</option>
                                        <option value="document" <?php echo e(old('package_type', $booking->dox_type) == 'document' ? 'selected' : ''); ?>>Document</option>
                                        <option value="box" <?php echo e(old('package_type', $booking->dox_type) == 'box' ? 'selected' : ''); ?>>Box</option>
                                        <option value="flyer" <?php echo e(old('package_type', $booking->dox_type) == 'flyer' ? 'selected' : ''); ?>>Flyer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="package_value" class="form-label">Declared value for customs * ($)</label>
                                    <input type="number" step="0.01" class="form-control" id="package_value" name="package_value" value="<?php echo e(old('package_value', $booking->package_value)); ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="length" class="form-label">Length (CM) *</label>
                                    <input type="number" step="0.01" class="form-control" id="length" name="length" value="<?php echo e(old('length', $booking->dimensions['length'] ?? '')); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="width" class="form-label">Width (CM) *</label>
                                    <input type="number" step="0.01" class="form-control" id="width" name="width" value="<?php echo e(old('width', $booking->dimensions['width'] ?? '')); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="height" class="form-label">Height (CM) *</label>
                                    <input type="number" step="0.01" class="form-control" id="height" name="height" value="<?php echo e(old('height', $booking->dimensions['height'] ?? '')); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="vol_weight" class="form-label">Vol. Wt.</label>
                                    <input type="number" step="0.01" class="form-control" id="vol_weight" name="vol_weight" value="<?php echo e(old('vol_weight', $booking->dimensions['vol_weight'] ?? '')); ?>" readonly>
                                    <small class="form-text text-muted">Calculated as: (L×W×H)/5000</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="weight" class="form-label">Ch. Wt. (KG) *</label>
                                    <input type="number" step="0.01" class="form-control" id="weight" name="weight" value="<?php echo e(old('weight', $booking->weight)); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="package_description" class="form-label">Description of Contents *</label>
                                    <textarea class="form-control" id="package_description" name="package_description" rows="3" placeholder="Detailed description of package contents" required><?php echo e(old('package_description', $booking->package_description)); ?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="hs_code" class="form-label">HS Code</label>
                                    <input type="text" class="form-control" id="hs_code" name="hs_code" value="<?php echo e(old('hs_code', $booking->hs_code)); ?>" placeholder="e.g., 8517.12.00">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="financial_instrument" class="form-label">Financial Instrument Required</label>
                                    <select class="form-control" id="financial_instrument" name="financial_instrument">
                                        <option value="">Select F.I. Required (Y/N)</option>
                                        <option value="Y" <?php echo e(old('financial_instrument', $booking->financial_instrument) == 'Y' ? 'selected' : ''); ?>>Yes</option>
                                        <option value="N" <?php echo e(old('financial_instrument', $booking->financial_instrument) == 'N' ? 'selected' : ''); ?>>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="form_e_number" class="form-label">Form E Number</label>
                                    <input type="text" class="form-control" id="form_e_number" name="form_e_number" value="<?php echo e(old('form_e_number', $booking->form_e_number)); ?>" placeholder="Enter Form E Number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipment_charges" class="form-label">Shipment Charges *</label>
                                    <input type="number" step="0.01" class="form-control" id="shipment_charges" name="shipment_charges" value="<?php echo e(old('shipment_charges', $booking->shipment_charges)); ?>" required>
                                    <small class="form-text text-muted">Amount to be shown on proforma invoice and label</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inco_terms" class="form-label">Inco Terms</label>
                                    <select class="form-control" id="inco_terms" name="inco_terms">
                                        <option value="">Select Inco Terms</option>
                                        <option value="EXW" <?php echo e(old('inco_terms', $booking->inco_terms) == 'EXW' ? 'selected' : ''); ?>>EXW - Ex Works</option>
                                        <option value="FCA" <?php echo e(old('inco_terms', $booking->inco_terms) == 'FCA' ? 'selected' : ''); ?>>FCA - Free Carrier</option>
                                        <option value="CPT" <?php echo e(old('inco_terms', $booking->inco_terms) == 'CPT' ? 'selected' : ''); ?>>CPT - Carriage Paid To</option>
                                        <option value="CIP" <?php echo e(old('inco_terms', $booking->inco_terms) == 'CIP' ? 'selected' : ''); ?>>CIP - Carriage and Insurance Paid To</option>
                                        <option value="DAP" <?php echo e(old('inco_terms', $booking->inco_terms) == 'DAP' ? 'selected' : ''); ?>>DAP - Delivered at Place</option>
                                        <option value="DPU" <?php echo e(old('inco_terms', $booking->inco_terms) == 'DPU' ? 'selected' : ''); ?>>DPU - Delivered at Place Unloaded</option>
                                        <option value="DDP" <?php echo e(old('inco_terms', $booking->inco_terms) == 'DDP' ? 'selected' : ''); ?>>DDP - Delivered Duty Paid</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pickup & Instructions Section -->
                    <div class="form-section">
                        <h3 class="section-title">Pickup & Instructions</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipment_reference" class="form-label">Shipment Reference *</label>
                                    <input type="text" class="form-control" id="shipment_reference" name="shipment_reference" value="<?php echo e(old('shipment_reference', $booking->shipment_reference)); ?>" required readonly>
                                    <small class="form-text text-muted">Auto-generated from company name and user name (readonly)</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="special_instructions" class="form-label">Special Instructions *</label>
                                    <textarea class="form-control" id="special_instructions" name="special_instructions" rows="3" placeholder="Special delivery instructions" required><?php echo e(old('special_instructions', $booking->special_instructions)); ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="form-actions">
                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('user.bookings.show', $booking)); ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back to Booking
                            </a>
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-save me-2"></i>Update Booking
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
$(document).ready(function() {
    // Enhanced Select2 initialization for booking forms
    $('#shipper_country, #consignee_country').select2({
        placeholder: 'Search and select country',
        allowClear: true,
        width: '100%',
        language: {
            noResults: function() {
                return "No countries found";
            }
        }
    });
    
    $('#service').select2({
        placeholder: 'Select service type',
        allowClear: true,
        width: '100%'
    });
    
    $('#package_type').select2({
        placeholder: 'Select package type',
        allowClear: true,
        width: '100%'
    });
    
    $('#financial_instrument').select2({
        placeholder: 'Select financial instrument',
        allowClear: true,
        width: '100%'
    });
    
    $('#inco_terms').select2({
        placeholder: 'Select Inco Terms',
        allowClear: true,
        width: '100%'
    });
    
    // Calculate volume weight automatically
    function calculateVolumeWeight() {
        var length = parseFloat($('#length').val()) || 0;
        var width = parseFloat($('#width').val()) || 0;
        var height = parseFloat($('#height').val()) || 0;
        var volWeight = (length * width * height) / 5000;
        $('#vol_weight').val(volWeight.toFixed(4));
    }
    
    $('#length, #width, #height').on('input', calculateVolumeWeight);
    calculateVolumeWeight(); // Calculate on page load
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* Main Content Styles */
.main-content {
    padding: 30px;
    background-color: #ffffff;
}

.booking-form-container {
    max-width: 100%;
    margin: 0 auto;
}

.form-title {
    color: #2c3e50;
    margin-bottom: 10px;
    font-weight: bold;
}

.form-description {
    color: #6c757d;
    margin-bottom: 30px;
    font-size: 0.95em;
}

/* Form Section Styles */
.form-section {
    background-color: #ffffff;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    border-left: 4px solid #213F60;
}

.section-title {
    color: #2c3e50;
    font-size: 1.3em;
    font-weight: 600;
    margin-bottom: 25px;
    padding-bottom: 12px;
    border-bottom: 2px solid #213F60;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Form Group Styles */
.form-group {
    margin-bottom: 20px;
}

.form-label {
    font-weight: 500;
    color: #495057;
    margin-bottom: 8px;
    display: block;
}

.form-control {
    border: 1px solid #ced4da;
    border-radius: 4px;
    padding: 0.75rem;
    font-size: 0.95rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus {
    border-color: #213F60;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(33, 63, 96, 0.25);
}

.form-control[readonly] {
    background-color: #e9ecef;
    opacity: 1;
}

/* Form Actions */
.form-actions {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 2px solid #e9ecef;
}

/* Button Styles */
.btn-primary {
    background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
    border: none;
    color: white;
    padding: 0.75rem 2rem;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #1a3250 0%, #cc2333 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(33, 63, 96, 0.4);
}

.btn-outline-secondary {
    border: 2px solid #6c757d;
    color: #6c757d;
    padding: 0.75rem 2rem;
}

.btn-outline-secondary:hover {
    background-color: #6c757d;
    border-color: #6c757d;
    color: white;
}

/* Alert Styles */
.alert {
    border-radius: 8px;
    border: none;
    padding: 1rem 1.5rem;
    margin-bottom: 1.5rem;
}

.alert-danger {
    background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
    color: white;
}

.alert-success {
    background: linear-gradient(135deg, #51cf66 0%, #40c057 100%);
    color: white;
}

/* Responsive Design */
@media (max-width: 768px) {
    .booking-form-container {
        padding: 1rem;
    }
    
    .form-section {
        padding: 1rem;
    }
    
    .form-title {
        font-size: 1.5rem;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel\shipment_fahad_malik\resources\views/user/bookings/edit.blade.php ENDPATH**/ ?>