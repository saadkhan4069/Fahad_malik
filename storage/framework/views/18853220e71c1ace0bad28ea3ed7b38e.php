<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <div class="col-12">
            <div class="booking-form-container">
                <h2 class="form-title">New Shipment Booking</h2>
                <p class="form-description">Please fill out the form below to book your shipment. Fields marked with * are required.</p>

                    <form id="booking-form" method="POST" action="<?php echo e(route('bookings.store')); ?>">
                        <?php echo csrf_field(); ?>
                        
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
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        
                    <!-- Success Messages -->
                    <?php if(session('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                    <?php endif; ?>

                    <!-- Shipper Information Section -->
                    <div class="form-section">
                        <h3 class="section-title">Shipper Information</h3>
                    <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                    <label for="shipper_name" class="form-label">Name *</label>
                                    <input type="text" class="form-control" id="shipper_name" name="shipper_name" value="John Doe" required>
                            </div>
                        </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                    <label for="shipper_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="shipper_email" name="shipper_email" value="john.doe@example.com">
                            </div>
                        </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="shipper_address" class="form-label">Address *</label>
                                    <input type="text" class="form-control" id="shipper_address" name="shipper_address" value="123 Main St" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="shipper_city" class="form-label">City *</label>
                                    <input type="text" class="form-control" id="shipper_city" name="shipper_city" value="Anytown" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="shipper_zip" class="form-label">Postal Code *</label>
                                    <input type="text" class="form-control" id="shipper_zip" name="shipper_zip" value="12345" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="shipper_country" class="form-label">Country *</label>
                                        <select class="form-control" id="shipper_country" name="shipper_country" required>
                                            <option value="">Select Country</option>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($country->code); ?>"><?php echo e($country->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="shipper_state" class="form-label">State *</label>
                                    <input type="text" class="form-control" id="shipper_state" name="shipper_state" value="California" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="shipper_phone" class="form-label">Phone *</label>
                                    <input type="tel" class="form-control" id="shipper_phone" name="shipper_phone" value="+1-234-567-890" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="shipper_cnic" class="form-label">CNIC *</label>
                                    <input type="text" class="form-control" id="shipper_cnic" name="shipper_cnic" value="12345-6789012-3" required>
                                    </div>
                                </div>
                            <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="shipper_ntn" class="form-label">NTN</label>
                                    <input type="text" class="form-control" id="shipper_ntn" name="shipper_ntn" placeholder="Enter NTN Number">
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
                                    <input type="text" class="form-control" id="consignee_name" name="consignee_name" value="Jane Smith" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="consignee_email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="consignee_email" name="consignee_email" value="jane.smith@example.com">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="consignee_address" class="form-label">Address *</label>
                                    <input type="text" class="form-control" id="consignee_address" name="consignee_address" value="456 International Blvd" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="consignee_city" class="form-label">City *</label>
                                    <input type="text" class="form-control" id="consignee_city" name="consignee_city" value="Otherville" required>
                            </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="consignee_zip" class="form-label">Postal Code *</label>
                                    <input type="text" class="form-control" id="consignee_zip" name="consignee_zip" value="67890" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="consignee_country" class="form-label">Country *</label>
                                        <select class="form-control" id="consignee_country" name="consignee_country" required>
                                            <option value="">Select Country</option>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($country->code); ?>"><?php echo e($country->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="consignee_state" class="form-label">State *</label>
                                    <input type="text" class="form-control" id="consignee_state" name="consignee_state" value="Other State" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="consignee_phone" class="form-label">Phone *</label>
                                    <input type="tel" class="form-control" id="consignee_phone" name="consignee_phone" value="+098-765-432-1" required>
                                    </div>
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
                                    <input type="date" class="form-control" id="estimated_date" name="estimated_date" value="<?php echo e(date('Y-m-d')); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="service" class="form-label">Service Type *</label>
                                    <select class="form-control" id="service" name="service" required>
                                        <option value="">Select service type</option>
                                        <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($service->code); ?>"><?php echo e($service->name); ?></option>
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
                                        <option value="document">Document</option>
                                        <option value="box">Box</option>
                                        <option value="flyer">Flyer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="package_value" class="form-label">Declared value for customs * ($)</label>
                                    <input type="number" step="0.01" class="form-control" id="package_value" name="package_value" value="100.00" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="length" class="form-label">Length (CM) *</label>
                                    <input type="number" step="0.01" class="form-control" id="length" name="length" value="10" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="width" class="form-label">Width (CM) *</label>
                                    <input type="number" step="0.01" class="form-control" id="width" name="width" value="10" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="height" class="form-label">Height (CM) *</label>
                                    <input type="number" step="0.01" class="form-control" id="height" name="height" value="10" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="vol_weight" class="form-label">Vol. Wt.</label>
                                    <input type="number" step="0.01" class="form-control" id="vol_weight" name="vol_weight" readonly>
                                    <small class="form-text text-muted">Calculated as: (L×W×H)/5000</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="weight" class="form-label">Ch. Wt. (KG) *</label>
                                    <input type="number" step="0.01" class="form-control" id="weight" name="weight" value="10" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="package_description" class="form-label">Description of Contents *</label>
                                    <textarea class="form-control" id="package_description" name="package_description" rows="3" placeholder="Detailed description of package contents" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="hs_code" class="form-label">HS Code</label>
                                    <input type="text" class="form-control" id="hs_code" name="hs_code" placeholder="e.g., 8517.12.00">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="financial_instrument" class="form-label">Financial Instrument Required</label>
                                    <select class="form-control" id="financial_instrument" name="financial_instrument">
                                        <option value="">Select F.I. Required (Y/N)</option>
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                    <label for="form_e_number" class="form-label">Form E Number</label>
                                    <input type="text" class="form-control" id="form_e_number" name="form_e_number" placeholder="Enter Form E Number">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="shipment_charges" class="form-label">Shipment Charges *</label>
                                    <input type="number" step="0.01" class="form-control" id="shipment_charges" name="shipment_charges" value="0" required>
                                    <small class="form-text text-muted">Amount to be shown on proforma invoice and label</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                    <label for="inco_terms" class="form-label">Inco Terms</label>
                                    <select class="form-control" id="inco_terms" name="inco_terms">
                                        <option value="">Select Inco Terms</option>
                                        <option value="EXW">EXW - Ex Works</option>
                                        <option value="FCA">FCA - Free Carrier</option>
                                        <option value="CPT">CPT - Carriage Paid To</option>
                                        <option value="CIP">CIP - Carriage and Insurance Paid To</option>
                                        <option value="DAP">DAP - Delivered at Place</option>
                                        <option value="DPU">DPU - Delivered at Place Unloaded</option>
                                        <option value="DDP">DDP - Delivered Duty Paid</option>
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
                                    <input type="text" class="form-control" id="shipment_reference" name="shipment_reference" value="<?php echo e(Auth::guard('company')->user()->name ?? 'Admin'); ?>" required>
                                    <small class="form-text text-muted">Auto-filled with company name</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="special_instructions" class="form-label">Special Instructions *</label>
                                    <textarea class="form-control" id="special_instructions" name="special_instructions" rows="3" placeholder="Special delivery instructions" required></textarea>
                                </div>
                            </div>
                        </div>
                        </div>
                        
                    <!-- Submit Button -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            <i class="fas fa-shipping-fast me-2"></i>Book Shipment & Generate Airwaybill
                        </button>
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
    font-weight: 600;
    color: #495057;
    margin-bottom: 5px;
    display: block;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 6px;
    padding: 12px 15px;
    font-size: 0.95em;
    transition: all 0.3s ease;
    background-color: #fafafa;
}

.form-control:focus {
    border-color: #213F60;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
    background-color: #ffffff;
    transform: translateY(-1px);
}

.form-control:hover {
    border-color: #213F60;
    background-color: #ffffff;
}

.form-control.is-invalid {
    border-color: #dc3545;
}

.form-control.is-valid {
    border-color: #28a745;
}

/* Required field indicator */
.form-label:after {
    content: "";
    color: #dc3545;
}

/* Submit Button */
.form-actions {
    margin-top: 40px;
    text-align: center;
}

.btn-primary {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border: none;
    padding: 18px 50px;
    font-size: 1.2em;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #c82333 0%, #a71e2a 100%);
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(220, 53, 69, 0.4);
}

.btn-primary:active {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
}

.btn-block {
    width: 100%;
}

/* Alert Styles */
.alert {
    border-radius: 6px;
    border: none;
    padding: 15px 20px;
    margin-bottom: 20px;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
}

.alert i {
    margin-right: 8px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .main-content {
        padding: 20px 15px;
    }
    
    .form-section {
        padding: 20px 15px;
    }
    
    .btn-primary {
        padding: 12px 30px;
        font-size: 1em;
    }
}

@media (max-width: 576px) {
    .form-title {
        font-size: 1.5em;
    }
    
    .section-title {
        font-size: 1.1em;
    }
    
    .form-control {
        font-size: 0.9em;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Volume weight calculation
    function calculateVolumeWeight() {
        const length = parseFloat(document.getElementById('length').value) || 0;
        const width = parseFloat(document.getElementById('width').value) || 0;
        const height = parseFloat(document.getElementById('height').value) || 0;
        const volWeight = (length * width * height) / 5000;
        document.getElementById('vol_weight').value = volWeight.toFixed(2);
    }

    // Add event listeners for volume weight calculation
    document.getElementById('length').addEventListener('input', calculateVolumeWeight);
    document.getElementById('width').addEventListener('input', calculateVolumeWeight);
    document.getElementById('height').addEventListener('input', calculateVolumeWeight);

    // Form validation
    const form = document.getElementById('booking-form');
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value.trim() === '') {
                this.classList.add('is-invalid');
                this.classList.remove('is-valid');
        } else {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });
        
        input.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            }
        });
    });
    
    // Form submission
    form.addEventListener('submit', function(e) {
        let isValid = true;
        let errorMessages = [];
        
        inputs.forEach(input => {
            if (input.hasAttribute('required') && input.value.trim() === '') {
                input.classList.add('is-invalid');
                isValid = false;
            }
        });
        
        // Validate numeric fields
        const packageValue = document.getElementById('package_value');
        const weight = document.getElementById('weight');
        const length = document.getElementById('length');
        const width = document.getElementById('width');
        const height = document.getElementById('height');
        const shipmentCharges = document.getElementById('shipment_charges');
        
        if (packageValue && (isNaN(packageValue.value) || parseFloat(packageValue.value) < 0)) {
            packageValue.classList.add('is-invalid');
            errorMessages.push('Package value must be a valid number greater than or equal to 0.');
            isValid = false;
        }
        
        if (weight && (isNaN(weight.value) || parseFloat(weight.value) <= 0)) {
            weight.classList.add('is-invalid');
            errorMessages.push('Weight must be a valid number greater than 0.');
            isValid = false;
        }
        
        if (length && (isNaN(length.value) || parseFloat(length.value) <= 0)) {
            length.classList.add('is-invalid');
            errorMessages.push('Length must be a valid number greater than 0.');
            isValid = false;
        }
        
        if (width && (isNaN(width.value) || parseFloat(width.value) <= 0)) {
            width.classList.add('is-invalid');
            errorMessages.push('Width must be a valid number greater than 0.');
            isValid = false;
        }
        
        if (height && (isNaN(height.value) || parseFloat(height.value) <= 0)) {
            height.classList.add('is-invalid');
            errorMessages.push('Height must be a valid number greater than 0.');
            isValid = false;
        }
        
        if (shipmentCharges && (isNaN(shipmentCharges.value) || parseFloat(shipmentCharges.value) < 0)) {
            shipmentCharges.classList.add('is-invalid');
            errorMessages.push('Shipment charges must be a valid number greater than or equal to 0.');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
            const message = errorMessages.length > 0 ? errorMessages.join(' ') : 'Please fill in all required fields.';
            showAlert(message, 'danger');
        }
    });
    
    // Alert function
    function showAlert(message, type) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            <i class="fas fa-${type === 'danger' ? 'exclamation-circle' : 'check-circle'} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        form.insertBefore(alertDiv, form.firstChild);
        
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel\shipment_fahad_malik\resources\views/bookings/create.blade.php ENDPATH**/ ?>