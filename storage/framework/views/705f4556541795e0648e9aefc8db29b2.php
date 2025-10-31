

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

                    <form id="booking-form" method="POST" action="<?php echo e(route('bookings.update', $booking)); ?>">
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

                        <!-- Shipper Information -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-user me-2"></i>Shipper Information
                            </h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shipper_name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="shipper_name" name="shipper_name" value="<?php echo e(old('shipper_name', $booking->shipper_name)); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shipper_email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="shipper_email" name="shipper_email" value="<?php echo e(old('shipper_email', $booking->shipper_email)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shipper_phone" class="form-label">Phone</label>
                                        <input type="tel" class="form-control" id="shipper_phone" name="shipper_phone" value="<?php echo e(old('shipper_phone', $booking->shipper_phone)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shipper_address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="shipper_address" name="shipper_address" value="<?php echo e(old('shipper_address', $booking->shipper_address)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="shipper_city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="shipper_city" name="shipper_city" value="<?php echo e(old('shipper_city', $booking->shipper_city)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="shipper_state" class="form-label">State</label>
                                        <input type="text" class="form-control" id="shipper_state" name="shipper_state" value="<?php echo e(old('shipper_state', $booking->shipper_state)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="shipper_zip" class="form-label">Zip Code</label>
                                        <input type="text" class="form-control" id="shipper_zip" name="shipper_zip" value="<?php echo e(old('shipper_zip', $booking->shipper_zip)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shipper_country" class="form-label">Country</label>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shipper_cnic" class="form-label">CNIC</label>
                                        <input type="text" class="form-control" id="shipper_cnic" name="shipper_cnic" value="<?php echo e(old('shipper_cnic', $booking->shipper_cnic)); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Consignee Information -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-user-tie me-2"></i>Consignee Information
                            </h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="consignee_name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="consignee_name" name="consignee_name" value="<?php echo e(old('consignee_name', $booking->consignee_name)); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="consignee_email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="consignee_email" name="consignee_email" value="<?php echo e(old('consignee_email', $booking->consignee_email)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="consignee_phone" class="form-label">Phone</label>
                                        <input type="tel" class="form-control" id="consignee_phone" name="consignee_phone" value="<?php echo e(old('consignee_phone', $booking->consignee_phone)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="consignee_address" class="form-label">Address</label>
                                        <input type="text" class="form-control" id="consignee_address" name="consignee_address" value="<?php echo e(old('consignee_address', $booking->consignee_address)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="consignee_city" class="form-label">City</label>
                                        <input type="text" class="form-control" id="consignee_city" name="consignee_city" value="<?php echo e(old('consignee_city', $booking->consignee_city)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="consignee_state" class="form-label">State</label>
                                        <input type="text" class="form-control" id="consignee_state" name="consignee_state" value="<?php echo e(old('consignee_state', $booking->consignee_state)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="consignee_zip" class="form-label">Zip Code</label>
                                        <input type="text" class="form-control" id="consignee_zip" name="consignee_zip" value="<?php echo e(old('consignee_zip', $booking->consignee_zip)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="consignee_country" class="form-label">Country</label>
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
                            </div>
                        </div>

                        <!-- Shipment Information Section -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-shipping-fast me-2"></i>Shipment Details
                            </h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="service" class="form-label">Service</label>
                                        <select class="form-control" id="service" name="service" required>
                                            <option value="">Select Service</option>
                                            <?php $__currentLoopData = \DB::table('services')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($service->name); ?>" <?php echo e(old('service', $booking->service_type) == $service->name ? 'selected' : ''); ?>>
                                                    <?php echo e($service->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="package_type" class="form-label">Package Type</label>
                                        <select class="form-control" id="package_type" name="package_type" required>
                                            <option value="">Select Package Type</option>
                                            <option value="NON-DOX" <?php echo e(old('package_type', $booking->package_type) == 'NON-DOX' ? 'selected' : ''); ?>>NON-DOX</option>
                                            <option value="DOX" <?php echo e(old('package_type', $booking->package_type) == 'DOX' ? 'selected' : ''); ?>>DOX</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="package_description" class="form-label">Package Description</label>
                                        <textarea class="form-control" id="package_description" name="package_description" rows="3"><?php echo e(old('package_description', $booking->package_description)); ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="weight" class="form-label">Weight (KG)</label>
                                        <input type="number" step="0.01" class="form-control" id="weight" name="weight" value="<?php echo e(old('weight', $booking->weight)); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Dimensions -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-ruler-combined me-2"></i>Dimensions
                            </h3>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="length" class="form-label">Length (CM)</label>
                                        <input type="number" step="0.01" class="form-control" id="length" name="length" value="<?php echo e(old('length', $booking->dimensions['length'] ?? '')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="width" class="form-label">Width (CM)</label>
                                        <input type="number" step="0.01" class="form-control" id="width" name="width" value="<?php echo e(old('width', $booking->dimensions['width'] ?? '')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="height" class="form-label">Height (CM)</label>
                                        <input type="number" step="0.01" class="form-control" id="height" name="height" value="<?php echo e(old('height', $booking->dimensions['height'] ?? '')); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Financial Information -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-dollar-sign me-2"></i>Financial Information
                            </h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="package_value" class="form-label">Package Value</label>
                                        <input type="number" step="0.01" class="form-control" id="package_value" name="package_value" value="<?php echo e(old('package_value', $booking->package_value)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hs_code" class="form-label">HS Code</label>
                                        <input type="text" class="form-control" id="hs_code" name="hs_code" value="<?php echo e(old('hs_code', $booking->hs_code)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo e(old('quantity', $booking->quantity)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="rate" class="form-label">Rate</label>
                                        <input type="number" step="0.01" class="form-control" id="rate" name="rate" value="<?php echo e(old('rate', $booking->rate)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="unit" class="form-label">Unit</label>
                                        <select class="form-control" id="unit" name="unit">
                                            <option value="">Select Unit</option>
                                            <?php $__currentLoopData = \DB::table('units')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($unit->name); ?>" <?php echo e(old('unit', $booking->unit) == $unit->name ? 'selected' : ''); ?>>
                                                    <?php echo e($unit->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="total_cost" class="form-label">Total Cost</label>
                                        <input type="number" step="0.01" class="form-control" id="total_cost" name="total_cost" value="<?php echo e(old('total_cost', $booking->total_cost)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dox_type" class="form-label">DOX Type</label>
                                        <input type="text" class="form-control" id="dox_type" name="dox_type" value="<?php echo e(old('dox_type', $booking->dox_type)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="goods_value" class="form-label">Goods Value</label>
                                        <input type="number" step="0.01" class="form-control" id="goods_value" name="goods_value" value="<?php echo e(old('goods_value', $booking->goods_value)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="goods_value_currency" class="form-label">Goods Value Currency</label>
                                        <select class="form-control" id="goods_value_currency" name="goods_value_currency">
                                            <option value="">Select Currency</option>
                                            <?php $__currentLoopData = \DB::table('currencies')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($currency->code); ?>" <?php echo e(old('goods_value_currency', $booking->goods_value_currency) == $currency->code ? 'selected' : ''); ?>>
                                                    <?php echo e($currency->code); ?> - <?php echo e($currency->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="export_reason" class="form-label">Export Reason</label>
                                        <input type="text" class="form-control" id="export_reason" name="export_reason" value="<?php echo e(old('export_reason', $booking->export_reason)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="financial_instrument" class="form-label">Financial Instrument</label>
                                        <select class="form-control" id="financial_instrument" name="financial_instrument">
                                            <option value="">Select Financial Instrument</option>
                                            <option value="Y" <?php echo e(old('financial_instrument', $booking->financial_instrument) == 'Y' ? 'selected' : ''); ?>>Yes</option>
                                            <option value="N" <?php echo e(old('financial_instrument', $booking->financial_instrument) == 'N' ? 'selected' : ''); ?>>No</option>
                                        </select>
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="estimated_date" class="form-label">Estimated Date</label>
                                        <input type="date" class="form-control" id="estimated_date" name="estimated_date" value="<?php echo e(old('estimated_date', $booking->estimated_date ? $booking->estimated_date->format('Y-m-d') : '')); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shipment_charges" class="form-label">Shipment Charges</label>
                                        <input type="number" step="0.01" class="form-control" id="shipment_charges" name="shipment_charges" value="<?php echo e(old('shipment_charges', $booking->shipment_charges)); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="shipment_reference" class="form-label">Shipment Reference</label>
                                        <input type="text" class="form-control" id="shipment_reference" name="shipment_reference" value="<?php echo e(old('shipment_reference', $booking->shipment_reference)); ?>" readonly>
                                        <small class="form-text text-muted">Auto-generated from company name and user name (readonly)</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Special Instructions -->
                        <div class="form-section">
                            <h3 class="section-title">
                                <i class="fas fa-sticky-note me-2"></i>Special Instructions
                            </h3>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="special_instructions" class="form-label">Instructions</label>
                                        <textarea class="form-control" id="special_instructions" name="special_instructions" rows="4"><?php echo e(old('special_instructions', $booking->special_instructions)); ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-actions">
                            <div class="d-flex justify-content-between">
                                <a href="<?php echo e(route('bookings.show', $booking)); ?>" class="btn btn-outline-secondary">
                                    <i class="fas fa-arrow-left me-1"></i> Back to Booking
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update Booking
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
    padding: 2rem 0;
}

/* Booking Form Container */
.booking-form-container {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    margin-bottom: 2rem;
}

.form-title {
    color: #2c3e50;
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    text-align: center;
}

.form-description {
    color: #6c757d;
    text-align: center;
    margin-bottom: 2rem;
    font-size: 1.1rem;
}

/* Form Sections */
.form-section {
    margin-bottom: 2.5rem;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #213F60;
}

.section-title {
    color: #2c3e50;
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
}

/* Form Groups */
.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 500;
    color: #495057;
    margin-bottom: 0.5rem;
    display: block;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 6px;
    padding: 0.75rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #213F60;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.form-control:invalid {
    border-color: #dc3545;
}

/* Readonly field styling */
.form-control[readonly] {
    background-color: #f8f9fa;
    border-color: #e9ecef;
    color: #6c757d;
    cursor: not-allowed;
}

.form-control[readonly]:focus {
    border-color: #e9ecef;
    box-shadow: none;
}

/* Form Actions */
.form-actions {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 2px solid #e9ecef;
}

/* Button Styles */
.btn {
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #1a3250 0%, #cc2333 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
}

.btn-outline-secondary {
    border: 2px solid #6c757d;
    color: #6c757d;
}

.btn-outline-secondary:hover {
    background-color: #6c757d;
    border-color: #6c757d;
    transform: translateY(-2px);
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
        margin: 1rem;
    }
    
    .form-title {
        font-size: 1.5rem;
    }
    
    .form-section {
        padding: 1rem;
    }
    
    .section-title {
        font-size: 1.1rem;
    }
}

/* Loading States */
.form-control:disabled {
    background-color: #e9ecef;
    opacity: 0.6;
    cursor: not-allowed;
}

/* Success States */
.form-control.is-valid {
    border-color: #28a745;
}

.form-control.is-invalid {
    border-color: #dc3545;
}

/* Custom Checkbox and Radio Styles */
.form-check-input:checked {
    background-color: #213F60;
    border-color: #213F60;
}

/* Textarea Specific Styles */
textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

/* Select Specific Styles */
select.form-control {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m1 6 7 7 7-7'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 16px 12px;
}

/* Focus States for Better Accessibility */
.form-control:focus,
.btn:focus {
    outline: none;
}

/* Animation for Form Sections */
.form-section {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Print Styles */
@media print {
    .booking-form-container {
        box-shadow: none;
        border: 1px solid #ddd;
    }
    
    .btn {
        display: none;
    }
    
    .form-section {
        break-inside: avoid;
        page-break-inside: avoid;
    }
}
</style>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel\shipment_fahad_malik\resources\views/bookings/edit.blade.php ENDPATH**/ ?>