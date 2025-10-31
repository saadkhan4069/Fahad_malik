@extends('layouts.app')

@section('title', 'New Shipment Booking')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <div class="col-12">
            <div class="booking-form-container">
                <h2 class="form-title">New Shipment Booking</h2>
                <p class="form-description">Please fill out the form below to book your shipment. Fields marked with * are required.</p>

                <form id="booking-form" method="POST" action="{{ route('bookings.store') }}">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h5>Please fix the following errors:</h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="shipper_zip" class="form-label">Postal Code *</label>
                                    <input type="text" class="form-control" id="shipper_zip" name="shipper_zip" value="12345" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="shipper_country" class="form-label">Country *</label>
                                    <select class="form-control" id="shipper_country" name="shipper_country" required>
                                        <option value="">Select Country</option>
                                        <option value="US">United States</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="GB">United Kingdom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="shipper_phone" class="form-label">Phone *</label>
                                    <input type="tel" class="form-control" id="shipper_phone" name="shipper_phone" value="+1-234-567-890" required>
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
                                        <option value="US">United States</option>
                                        <option value="PK">Pakistan</option>
                                        <option value="AE">United Arab Emirates</option>
                                        <option value="GB">United Kingdom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="consignee_attention" class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" id="consignee_attention" name="consignee_attention" value="Jane Smith">
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

                    <!-- Shipment Information Section -->
                    <div class="form-section">
                        <h3 class="section-title">Shipment Information</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="service_type" class="form-label">Service Type *</label>
                                    <select class="form-control" id="service_type" name="service_type" required>
                                        <option value="">Select service type</option>
                                        <option value="express">Express</option>
                                        <option value="standard">Standard</option>
                                        <option value="economy">Economy</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="package_type" class="form-label">Package Type *</label>
                                    <select class="form-control" id="package_type" name="package_type" required>
                                        <option value="">Select package type</option>
                                        <option value="document">Document</option>
                                        <option value="parcel">Parcel</option>
                                        <option value="cargo">Cargo</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="pieces" class="form-label">Number of Pieces *</label>
                                    <input type="number" class="form-control" id="pieces" name="pieces" value="1" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="weight" class="form-label">Total Weight *</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="weight" name="weight" value="10" required>
                                        <select class="form-control" name="weight_unit">
                                            <option value="kg">kg</option>
                                            <option value="lb">lb</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="package_value" class="form-label">Declared value for customs</label>
                                    <input type="text" class="form-control" id="package_value" name="package_value" value="$ 100">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="package_description" class="form-label">Description of Contents</label>
                                    <textarea class="form-control" id="package_description" name="package_description" rows="3" placeholder="e.g., Documents, Electronics, Apparel"></textarea>
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
                                    <label for="pickup_date" class="form-label">Requested Pickup Date</label>
                                    <input type="date" class="form-control" id="pickup_date" name="pickup_date" placeholder="Pick a date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reference" class="form-label">Shipment Reference</label>
                                    <input type="text" class="form-control" id="reference" name="reference" placeholder="Your reference number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="special_instructions" class="form-label">Special Instructions</label>
                                    <textarea class="form-control" id="special_instructions" name="special_instructions" rows="3" placeholder="e.g., Leave at front desk"></textarea>
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

<style>
/* Sidebar Styles */
.sidebar {
    background-color: #f8f9fa;
    min-height: 100vh;
    padding: 20px 0;
    border-right: 1px solid #dee2e6;
}

.sidebar-header {
    padding: 0 20px 20px;
    border-bottom: 1px solid #dee2e6;
    margin-bottom: 20px;
}

.sidebar-header h4 {
    color: #333;
    font-weight: 600;
    margin: 0;
}

.sidebar-nav .nav-link {
    color: #666;
    padding: 12px 20px;
    border: none;
    background: none;
    text-decoration: none;
    display: block;
    transition: all 0.3s ease;
}

.sidebar-nav .nav-link:hover {
    background-color: #e9ecef;
    color: #333;
}

.sidebar-nav .nav-link.active {
    background-color: #007bff;
    color: white;
}

.sub-nav {
    margin-left: 20px;
    margin-top: 5px;
}

.sub-nav .nav-link {
    padding: 8px 20px;
    font-size: 14px;
}

.sidebar-footer {
    position: absolute;
    bottom: 20px;
    left: 20px;
    right: 20px;
}

.user-info {
    text-align: center;
    padding: 15px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.user-info p {
    margin: 0 0 10px 0;
    font-weight: 500;
}

.user-info .btn-link {
    color: #007bff;
    text-decoration: none;
    font-size: 14px;
}

.badge {
    margin-top: 10px;
    display: block;
}

/* Main Content Styles */
.main-content {
    padding: 30px;
    background-color: #f8f9fa;
    min-height: 100vh;
}

.booking-form-container {
    background: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.form-title {
    color: #333;
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 10px;
}

.form-description {
    color: #666;
    margin-bottom: 30px;
    font-size: 14px;
}

/* Form Section Styles */
.form-section {
    margin-bottom: 40px;
    padding-bottom: 30px;
    border-bottom: 1px solid #eee;
}

.form-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.section-title {
    color: #333;
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #007bff;
}

/* Form Group Styles */
.form-group {
    margin-bottom: 20px;
}

.form-label {
    font-weight: 500;
    color: #333;
    margin-bottom: 8px;
    display: block;
}

.form-control {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 12px;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
}

.input-group {
    display: flex;
}

.input-group .form-control {
    border-radius: 4px 0 0 4px;
}

.input-group select {
    border-radius: 0 4px 4px 0;
    border-left: none;
}

/* Required field indicator */
.form-label:after {
    content: " *";
    color: #dc3545;
}

/* Submit Button */
.form-actions {
    margin-top: 40px;
    text-align: center;
}

.btn-primary {
    background-color: #dc3545;
    border-color: #dc3545;
    padding: 15px 40px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 4px;
    width: 100%;
}

.btn-primary:hover {
    background-color: #c82333;
    border-color: #bd2130;
}

/* Alert Styles */
.alert {
    border-radius: 4px;
    margin-bottom: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        display: none;
    }
    
    .main-content {
        padding: 20px;
    }
    
    .booking-form-container {
        padding: 20px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.getElementById('booking-form');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Basic validation
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (isValid) {
            // Submit form
            form.submit();
        } else {
            alert('Please fill in all required fields.');
        }
    });
    
    // Remove validation classes on input
    form.addEventListener('input', function(e) {
        if (e.target.hasAttribute('required')) {
            e.target.classList.remove('is-invalid');
        }
    });
});
</script>
        </div>
    </div>
</div>
@endsection





