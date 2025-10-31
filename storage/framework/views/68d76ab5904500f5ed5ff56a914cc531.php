

<?php $__env->startSection('title', 'Generate Invoice'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <!-- Main Content -->
        <div class="col-12">
            <div class="invoice-form-container">
                <h2 class="form-title">Generate Invoice</h2>
                <p class="form-description">Create a professional invoice with all necessary details.</p>

                <form id="invoice-form" method="POST" action="<?php echo e(route('invoices.store')); ?>">
                    <?php echo csrf_field(); ?>
                    
                    <!-- Error/Success Messages -->
                    <?php if($errors->any()): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i>
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

                    <!-- Invoice Header -->
                    <div class="form-section">
                        <h3 class="section-title">Invoice Header</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="invoice_number" class="form-label">Invoice Number *</label>
                                    <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="Adex 7860011" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="invoice_date" class="form-label">Invoice Date *</label>
                                    <input type="date" class="form-control" id="invoice_date" name="invoice_date" value="<?php echo e(date('Y-m-d')); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="due_date" class="form-label">Due Date *</label>
                                    <input type="date" class="form-control" id="due_date" name="due_date" value="<?php echo e(date('Y-m-d')); ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Billing Information -->
                    <div class="form-section">
                        <h3 class="section-title">Billing Information</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="billed_to" class="form-label">Billed To *</label>
                                    <input type="text" class="form-control" id="billed_to" name="billed_to" value="Habib Rice" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="from_company" class="form-label">From Company *</label>
                                    <input type="text" class="form-control" id="from_company" name="from_company" value="Adex Worldwide Logistics" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address" class="form-label">Address *</label>
                                    <input type="text" class="form-control" id="address" name="address" value="13 A Block A SMCHS Karachi, 74200" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="contact" class="form-label">Contact *</label>
                                    <input type="text" class="form-control" id="contact" name="contact" value="www.adexworldwide.com | +92 339 1231239" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Services -->
                    <div class="form-section">
                        <h3 class="section-title">Services</h3>
                        <div class="services-table">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="services-table">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>HRS/QTY</th>
                                            <th>SERVICE</th>
                                            <th>Rate/Piece</th>
                                            <th>Adjust</th>
                                            <th>SUB TOTAL</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="services-tbody">
                                        <tr class="service-row">
                                            <td>
                                                <input type="number" class="form-control hrs-qty" name="services[0][hrs_qty]" value="1" min="0" step="0.01" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control service-name" name="services[0][service_name]" value="International Logistics" required>
                                                <input type="text" class="form-control service-desc mt-1" name="services[0][description]" value="Logistic Service, Prediscussed" placeholder="Description">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control rate-piece" name="services[0][rate_piece]" value="0" min="0" step="0.01" required>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control adjust" name="services[0][adjust]" value="0" min="0" step="0.01" required>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control sub-total" name="services[0][sub_total]" value="297495" min="0" step="0.01" readonly>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm remove-service">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" class="btn btn-primary" id="add-service">
                                <i class="fas fa-plus"></i> Add Service
                            </button>
                        </div>
                    </div>

                    <!-- Totals -->
                    <div class="form-section">
                        <h3 class="section-title">Totals</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sub_total" class="form-label">Sub Total *</label>
                                    <input type="number" class="form-control" id="sub_total" name="sub_total" value="297495" min="0" step="0.01" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tax" class="form-label">Tax</label>
                                    <input type="number" class="form-control" id="tax" name="tax" value="0" min="0" step="0.01">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="total" class="form-label">Total *</label>
                                    <input type="number" class="form-control" id="total" name="total" value="297495" min="0" step="0.01" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bank Details -->
                    <div class="form-section">
                        <h3 class="section-title">Bank Details</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bank_title" class="form-label">Title of Account *</label>
                                    <input type="text" class="form-control" id="bank_title" name="bank_title" value="ADEX WORLDWIDE EXPRESS" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account_number" class="form-label">Account Number *</label>
                                    <input type="text" class="form-control" id="account_number" name="account_number" value="118900150750001" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="iban" class="form-label">IBAN *</label>
                                    <input type="text" class="form-control" id="iban" name="iban" value="PK48BKIP0118900150750001" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bank_name" class="form-label">Bank *</label>
                                    <input type="text" class="form-control" id="bank_name" name="bank_name" value="Bank Islami Pakistan Limited" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            <i class="fas fa-file-invoice me-2"></i>Generate Invoice
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
    background: linear-gradient(180deg, #ffffff 0%, #f8f9fa 100%);
    min-height: 100vh;
    padding: 0;
    border-right: 2px solid #e9ecef;
    box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    position: relative;
    display: flex;
    flex-direction: column;
}

.sidebar-header {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    color: white;
    padding: 25px 20px;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0,123,255,0.3);
}

.logo-container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 50px;
}

.company-logo {
    max-width: 140px;
    max-height: 60px;
    object-fit: contain;
    filter: brightness(0) invert(1);
    border-radius: 4px;
}

.logo-text {
    font-size: 1.4em;
    font-weight: 800;
    letter-spacing: 2px;
    text-transform: uppercase;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.sidebar-nav {
    padding: 20px 0;
    flex: 1;
}

.sidebar-nav .nav {
    padding: 0 15px;
}

.sidebar-nav .nav-item {
    margin-bottom: 5px;
}

.sidebar-nav .nav-link {
    color: #495057;
    padding: 15px 20px;
    border: none;
    background: none;
    text-decoration: none;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
    border-radius: 8px;
    margin-bottom: 2px;
    position: relative;
    font-weight: 500;
}

.sidebar-nav .nav-link:hover {
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
    color: #007bff;
    transform: translateX(5px);
    box-shadow: 0 2px 8px rgba(0,123,255,0.2);
}

.sidebar-nav .nav-link.active {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(0,123,255,0.4);
}

.sidebar-nav .nav-link i {
    width: 20px;
    text-align: center;
    margin-right: 12px;
    font-size: 1.1em;
}

.nav-text {
    flex: 1;
    font-size: 0.95em;
}

.submenu-arrow {
    font-size: 0.8em;
    transition: transform 0.3s ease;
}

.nav-link[aria-expanded="true"] .submenu-arrow {
    transform: rotate(180deg);
}

.sidebar-nav .sub-nav {
    list-style: none;
    padding: 0;
    margin: 0;
    background: rgba(0,123,255,0.05);
    border-radius: 8px;
    margin-top: 5px;
    padding: 8px 0;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease, padding 0.3s ease;
}

.sidebar-nav .sub-nav.show {
    max-height: 200px;
    padding: 8px 0;
}

.sidebar-nav .sub-nav .nav-link {
    padding: 10px 20px 10px 50px;
    font-size: 0.9em;
    color: #6c757d;
    margin: 0;
    border-radius: 0;
}

.sidebar-nav .sub-nav .nav-link:hover {
    background: rgba(0,123,255,0.1);
    color: #007bff;
    transform: translateX(3px);
}

.sidebar-nav .sub-nav .nav-link.active {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    color: white;
    transform: translateX(3px);
}

.sidebar-footer {
    position: relative;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 20px;
    background: linear-gradient(180deg, #f8f9fa 0%, #e9ecef 100%);
    border-top: 2px solid #dee2e6;
}

.user-info {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    padding: 20px;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border-radius: 12px;
    box-shadow: 0 6px 25px rgba(0,0,0,0.15);
    border: 2px solid #e9ecef;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.user-info:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.2);
}

.user-info::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #007bff 0%, #0056b3 50%, #28a745 100%);
}

.user-avatar {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.4em;
    box-shadow: 0 4px 15px rgba(0,123,255,0.3);
    border: 3px solid white;
    flex-shrink: 0;
}

.user-logo {
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 50%;
}

.user-details {
    flex: 1;
    min-width: 0;
}

.user-name {
    margin: 0 0 5px 0;
    font-weight: 700;
    color: #2c3e50;
    font-size: 1em;
    line-height: 1.2;
}

.user-email {
    margin: 0 0 12px 0;
    font-weight: 500;
    color: #6c757d;
    font-size: 0.85em;
    line-height: 1.2;
}

.user-actions {
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.view-profile-link,
.settings-link {
    color: #007bff;
    text-decoration: none;
    font-size: 0.8em;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 4px 8px;
    border-radius: 6px;
    background: rgba(0,123,255,0.1);
}

.view-profile-link:hover,
.settings-link:hover {
    color: #0056b3;
    background: rgba(0,123,255,0.2);
    transform: translateX(3px);
}

.view-profile-link i,
.settings-link i {
    font-size: 0.9em;
}

.notification-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
}

.notification-badge {
    position: relative;
    width: 35px;
    height: 35px;
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1em;
    box-shadow: 0 4px 15px rgba(220,53,69,0.4);
    cursor: pointer;
    transition: all 0.3s ease;
}

.notification-badge:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 20px rgba(220,53,69,0.6);
}

.badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: linear-gradient(135deg, #ffc107 0%, #ff8c00 100%);
    color: #2c3e50;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.7em;
    font-weight: 700;
    box-shadow: 0 2px 8px rgba(255,193,7,0.4);
    border: 2px solid white;
}

/* Main Content Styles */
.main-content {
    padding: 30px;
    background: #f8f9fa;
    min-height: 100vh;
}

.invoice-form-container {
    background: white;
    border-radius: 12px;
    padding: 40px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    border: 1px solid #e9ecef;
}

.form-title {
    color: #2c3e50;
    font-size: 2.5em;
    font-weight: 700;
    margin-bottom: 10px;
    text-align: center;
}

.form-description {
    color: #6c757d;
    font-size: 1.1em;
    margin-bottom: 40px;
    text-align: center;
}

.form-section {
    margin-bottom: 40px;
    padding: 30px;
    background: #f8f9fa;
    border-radius: 12px;
    border: 1px solid #e9ecef;
}

.section-title {
    color: #2c3e50;
    font-size: 1.5em;
    font-weight: 600;
    margin-bottom: 25px;
    padding-bottom: 10px;
    border-bottom: 3px solid #007bff;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 8px;
    display: block;
}

.form-control {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 12px 15px;
    font-size: 1em;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
}

.services-table {
    margin-top: 20px;
}

.table {
    margin-bottom: 20px;
}

.table-dark th {
    background-color: #dc3545;
    border-color: #dc3545;
    color: white;
    font-weight: 600;
    text-align: center;
    padding: 15px 10px;
}

.table td {
    padding: 15px 10px;
    vertical-align: middle;
}

.service-row input {
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 8px 10px;
    font-size: 0.9em;
}

.service-row input:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.1rem rgba(0,123,255,0.25);
}

.form-actions {
    text-align: center;
    margin-top: 40px;
    padding-top: 30px;
    border-top: 2px solid #e9ecef;
}

.btn-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    border: none;
    padding: 15px 40px;
    font-size: 1.2em;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(0,123,255,0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,123,255,0.4);
}

.btn-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border: none;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.btn-danger:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 15px rgba(220,53,69,0.4);
}

.alert {
    border-radius: 8px;
    border: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.alert-danger {
    background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
    color: #721c24;
}

.alert-success {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    color: #155724;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sidebar submenu functionality
    const submenuToggles = document.querySelectorAll('[data-bs-toggle="collapse"]');
    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const targetId = this.getAttribute('data-bs-target');
            const target = document.querySelector(targetId);
            const arrow = this.querySelector('.submenu-arrow');
            
            if (!target) return;
            
            // Close all other submenus first
            document.querySelectorAll('.sub-nav').forEach(submenu => {
                if (submenu !== target && submenu.classList.contains('show')) {
                    submenu.classList.remove('show');
                    const otherArrow = submenu.previousElementSibling?.querySelector('.submenu-arrow');
                    if (otherArrow) {
                        otherArrow.style.transform = 'rotate(0deg)';
                    }
                }
            });
            
            // Toggle current submenu
            if (target.classList.contains('show')) {
                target.classList.remove('show');
                if (arrow) arrow.style.transform = 'rotate(0deg)';
            } else {
                target.classList.add('show');
                if (arrow) arrow.style.transform = 'rotate(180deg)';
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.sidebar')) {
            document.querySelectorAll('.sub-nav.show').forEach(submenu => {
                submenu.classList.remove('show');
                const arrow = submenu.previousElementSibling?.querySelector('.submenu-arrow');
                if (arrow) {
                    arrow.style.transform = 'rotate(0deg)';
                }
            });
        }
    });

    // Service calculation
    function calculateServiceTotal(row) {
        const hrsQty = parseFloat(row.querySelector('.hrs-qty').value) || 0;
        const ratePiece = parseFloat(row.querySelector('.rate-piece').value) || 0;
        const adjust = parseFloat(row.querySelector('.adjust').value) || 0;
        const subTotal = (hrsQty * ratePiece) + adjust;
        row.querySelector('.sub-total').value = subTotal.toFixed(2);
        calculateGrandTotal();
    }

    function calculateGrandTotal() {
        let subTotal = 0;
        document.querySelectorAll('.sub-total').forEach(input => {
            subTotal += parseFloat(input.value) || 0;
        });
        
        const tax = parseFloat(document.getElementById('tax').value) || 0;
        const total = subTotal + tax;
        
        document.getElementById('sub_total').value = subTotal.toFixed(2);
        document.getElementById('total').value = total.toFixed(2);
    }

    // Add service row
    document.getElementById('add-service').addEventListener('click', function() {
        const tbody = document.getElementById('services-tbody');
        const rowCount = tbody.children.length;
        const newRow = document.createElement('tr');
        newRow.className = 'service-row';
        newRow.innerHTML = `
            <td>
                <input type="number" class="form-control hrs-qty" name="services[${rowCount}][hrs_qty]" value="1" min="0" step="0.01" required>
            </td>
            <td>
                <input type="text" class="form-control service-name" name="services[${rowCount}][service_name]" value="" required>
                <input type="text" class="form-control service-desc mt-1" name="services[${rowCount}][description]" value="" placeholder="Description">
            </td>
            <td>
                <input type="number" class="form-control rate-piece" name="services[${rowCount}][rate_piece]" value="0" min="0" step="0.01" required>
            </td>
            <td>
                <input type="number" class="form-control adjust" name="services[${rowCount}][adjust]" value="0" min="0" step="0.01" required>
            </td>
            <td>
                <input type="number" class="form-control sub-total" name="services[${rowCount}][sub_total]" value="0" min="0" step="0.01" readonly>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-service">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        `;
        tbody.appendChild(newRow);
        
        // Add event listeners to new row
        addServiceRowListeners(newRow);
    });

    // Remove service row
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-service')) {
            e.target.closest('tr').remove();
            calculateGrandTotal();
        }
    });

    // Add event listeners to service row
    function addServiceRowListeners(row) {
        row.querySelector('.hrs-qty').addEventListener('input', () => calculateServiceTotal(row));
        row.querySelector('.rate-piece').addEventListener('input', () => calculateServiceTotal(row));
        row.querySelector('.adjust').addEventListener('input', () => calculateServiceTotal(row));
    }

    // Add event listeners to existing rows
    document.querySelectorAll('.service-row').forEach(row => {
        addServiceRowListeners(row);
    });

    // Tax calculation
    document.getElementById('tax').addEventListener('input', calculateGrandTotal);

    // Calculate on page load
    calculateGrandTotal();
});
</script>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>






<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u796145342/domains/adexcourier.com/public_html/portal/resources/views/invoices/generate.blade.php ENDPATH**/ ?>