<?php $__env->startSection('title', 'Booking Details'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Override custom fonts for booking detail page */
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
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Booking Details</h1>
    <div>
        <a href="<?php echo e(route('bookings.index')); ?>" class="btn btn-outline-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Back to Bookings
        </a>
        
        <!-- Edit Button -->
        <a href="<?php echo e(route('bookings.edit', $booking)); ?>" class="btn btn-primary me-2">
            <i class="fas fa-edit me-1"></i> Edit Booking
        </a>
        
        <!-- Proforma Invoice Button -->
        <a href="<?php echo e(route('invoices.proforma', $booking)); ?>" class="btn btn-info me-2" target="_blank">
            <i class="fas fa-file-invoice me-1"></i> Proforma Invoice
        </a>
        <!--<a href="<?php echo e(route('invoices.proforma.pdf', $booking)); ?>" class="btn btn-outline-info">-->
        <!--    <i class="fas fa-download me-1"></i> Download PDF-->
        <!--</a>-->
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Booking Information -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Booking Information</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Booking Number:</strong></td>
                                <td><?php echo e($booking->booking_number); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                            <span class="badge bg-<?php echo e($booking->status == 'confirmed' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'secondary')); ?>">
                                <?php echo e(ucfirst($booking->status)); ?>

                            </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Service Type:</strong></td>
                                <td>
                                    <span class="badge bg-info"><?php echo e(ucfirst($booking->service_type)); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Booking Date:</strong></td>
                                <td><?php echo e($booking->booking_date ? $booking->booking_date->setTimezone(config('app.timezone'))->format('M d, Y H:i') : 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Estimated Date:</strong></td>
                                <td><?php echo e($booking->estimated_date ? $booking->estimated_date->format('M d, Y') : 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Package Type:</strong></td>
                                <td><?php echo e(ucfirst($booking->package_type ?? 'N/A')); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Package Value:</strong></td>
                                <td><?php echo e($booking->goods_value_currency ?? 'USD'); ?> <?php echo e(number_format($booking->package_value ?? 0, 2)); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Length:</strong></td>
                                <td><?php echo e($booking->dimensions['length'] ?? 'N/A'); ?> cm</td>
                            </tr>
                            <tr>
                                <td><strong>Width:</strong></td>
                                <td><?php echo e($booking->dimensions['width'] ?? 'N/A'); ?> cm</td>
                            </tr>
                            <tr>
                                <td><strong>Height:</strong></td>
                                <td><?php echo e($booking->dimensions['height'] ?? 'N/A'); ?> cm</td>
                            </tr>
                            <tr>
                                <td><strong>Vol. Wt.:</strong></td>
                                <td><?php echo e($booking->dimensions['vol_weight'] ?? 'N/A'); ?> kg</td>
                            </tr>
                            <tr>
                                <td><strong>Ch. Wt.:</strong></td>
                                <td><?php echo e($booking->weight ?? 'N/A'); ?> kg</td>
                            </tr>
                            <tr>
                                <td><strong>HS Code:</strong></td>
                                <td><?php echo e($booking->hs_code ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Financial Instrument:</strong></td>
                                <td><?php echo e($booking->financial_instrument ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Form E Number:</strong></td>
                                <td><?php echo e($booking->form_e_number ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Inco Terms:</strong></td>
                                <td><?php echo e($booking->inco_terms ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Shipment Charges:</strong></td>
                                <td><?php echo e($booking->goods_value_currency ?? 'USD'); ?> <?php echo e(number_format($booking->shipment_charges ?? 0, 2)); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <?php if($booking->package_description): ?>
                <div class="mt-3">
                    <h6>Description of Contents:</h6>
                    <p class="text-muted"><?php echo e($booking->package_description); ?></p>
                </div>
                <?php endif; ?>
                
                <?php if($booking->special_instructions): ?>
                <div class="mt-3">
                    <h6>Special Instructions:</h6>
                    <p class="text-muted"><?php echo e($booking->special_instructions); ?></p>
                </div>
                <?php endif; ?>
                
                <?php if($booking->shipment_reference): ?>
                <div class="mt-3">
                    <h6>Shipment Reference:</h6>
                    <p class="text-muted"><?php echo e($booking->shipment_reference); ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Shipper Information -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user me-2"></i>Shipper Information
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td><?php echo e($booking->shipper_name); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td><?php echo e($booking->shipper_email); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Phone:</strong></td>
                                <td><?php echo e($booking->shipper_phone); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Address:</strong></td>
                                <td><?php echo e($booking->shipper_address); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>City:</strong></td>
                                <td><?php echo e($booking->shipper_city ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>State:</strong></td>
                                <td><?php echo e($booking->shipper_state ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Zip Code:</strong></td>
                                <td><?php echo e($booking->shipper_zip ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Country:</strong></td>
                                <td><?php echo e($shipperCountry->name ?? $booking->shipper_country ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>CNIC:</strong></td>
                                <td><?php echo e($booking->shipper_cnic ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>NTN:</strong></td>
                                <td><?php echo e($booking->shipper_ntn ?? 'N/A'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Consignee Information -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user-tie me-2"></i>Consignee Information
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td><?php echo e($booking->consignee_name); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td><?php echo e($booking->consignee_email); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Phone:</strong></td>
                                <td><?php echo e($booking->consignee_phone); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Address:</strong></td>
                                <td><?php echo e($booking->consignee_address); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>City:</strong></td>
                                <td><?php echo e($booking->consignee_city ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>State:</strong></td>
                                <td><?php echo e($booking->consignee_state ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Zip Code:</strong></td>
                                <td><?php echo e($booking->consignee_zip ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Country:</strong></td>
                                <td><?php echo e($consigneeCountry->name ?? $booking->consignee_country ?? 'N/A'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Quick Actions -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                        <!-- Edit Button - Always Visible -->
                        <a href="<?php echo e(route('bookings.edit', $booking)); ?>" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> Edit Booking
                        </a>
                        
                        <?php if($booking->status == 'pending'): ?>
                        <form method="POST" action="<?php echo e(route('bookings.confirm', $booking)); ?>" style="display: inline;">
                        <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-success w-100" 
                                    onclick="return confirm('Are you sure you want to confirm this booking? This will create a shipment and invoice.')">
                            <i class="fas fa-check me-1"></i> Confirm Booking
                        </button>
                    </form>
                <?php endif; ?>

                    <!-- Label Actions -->
                <?php if($booking->shipment): ?>
                        <div class="border-top pt-3 mt-3">
                            <h6 class="text-muted mb-2">Label Actions</h6>
                            <form method="POST" action="<?php echo e(route('labels.generate', $booking->shipment)); ?>" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-warning w-100 mb-2">
                                    <i class="fas fa-tag me-1"></i> Generate New Label
                                </button>
                            </form>
                            
                            <?php if($booking->shipment->labels && $booking->shipment->labels->count() > 0): ?>
                                <a href="<?php echo e(route('labels.show', $booking->shipment->labels->first())); ?>" class="btn btn-outline-info w-100 mb-2">
                                    <i class="fas fa-eye me-1"></i> View Existing Label
                                </a>
                                <a href="<?php echo e(route('labels.download', $booking->shipment->labels->first())); ?>" class="btn btn-outline-success w-100" target="_blank">
                                    <i class="fas fa-download me-1"></i> Download Label
                                </a>
                            <?php endif; ?>
                        </div>
                <?php endif; ?>

                    <!-- Invoice Actions -->
                    <!-- <div class="border-top pt-3 mt-3">
                        <h6 class="text-muted mb-2">Invoice Actions</h6>
                        <a href="<?php echo e(route('invoices.proforma', $booking)); ?>" class="btn btn-info w-100 mb-2" target="_blank">
                            <i class="fas fa-file-invoice me-1"></i> View Proforma
                        </a>
                        <a href="<?php echo e(route('invoices.proforma.pdf', $booking)); ?>" class="btn btn-outline-info w-100">
                            <i class="fas fa-download me-1"></i> Download PDF
                        </a>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- Package Details -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-box me-2"></i>Package Details
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Description:</strong></td>
                        <td><?php echo e($booking->package_description ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Weight:</strong></td>
                        <td><?php echo e($booking->weight ?? 'N/A'); ?> kg</td>
                    </tr>
                    <tr>
                        <td><strong>Dimensions:</strong></td>
                        <td>
                            <?php if($booking->dimensions): ?>
                                <?php echo e($booking->dimensions['length'] ?? 'N/A'); ?> x <?php echo e($booking->dimensions['width'] ?? 'N/A'); ?> x <?php echo e($booking->dimensions['height'] ?? 'N/A'); ?> cm
                            <?php else: ?>
                                N/A
                <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Vol. Wt.:</strong></td>
                        <td><?php echo e($booking->dimensions['vol_weight'] ?? 'N/A'); ?> kg</td>
                    </tr>
                    <tr>
                        <td><strong>Value:</strong></td>
                        <td><?php echo e($booking->goods_value_currency ?? 'USD'); ?> <?php echo e(number_format($booking->package_value ?? 0, 2)); ?></td>
                    </tr>
                    <tr>
                        <td><strong>HS Code:</strong></td>
                        <td><?php echo e($booking->hs_code ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Shipment Charges:</strong></td>
                        <td><?php echo e($booking->goods_value_currency ?? 'USD'); ?> <?php echo e(number_format($booking->shipment_charges ?? 0, 2)); ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <?php if($booking->shipment): ?>
        <!-- Shipment Information -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-shipping-fast me-2"></i>Shipment Information
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Tracking Number:</strong></td>
                        <td><?php echo e($booking->shipment->tracking_number); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            <span class="badge bg-<?php echo e($booking->shipment->status == 'delivered' ? 'success' : 'info'); ?>">
                            <?php echo e(ucfirst(str_replace('_', ' ', $booking->shipment->status))); ?>

                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Shipping Date:</strong></td>
                        <td><?php echo e($booking->shipment->shipping_date->format('M d, Y H:i')); ?></td>
                    </tr>
                    <?php if($booking->shipment->estimated_delivery): ?>
                    <tr>
                        <td><strong>Estimated Delivery:</strong></td>
                        <td><?php echo e($booking->shipment->estimated_delivery->format('M d, Y H:i')); ?></td>
                    </tr>
                    <?php endif; ?>
                </table>
                
                <div class="mt-3">
                    <div class="row">
                        <div class="col-6">
                            <form method="POST" action="<?php echo e(route('labels.generate', $booking->shipment)); ?>" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-outline-primary btn-sm w-100">
                                    <i class="fas fa-tag me-1"></i> Generate Label
                                </button>
                            </form>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-info btn-sm w-100" data-bs-toggle="modal" data-bs-target="#trackingModal">
                                <i class="fas fa-route me-1"></i> Update Tracking
                            </button>
                        </div>
                </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Payment Status and Mark as Paid -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-credit-card me-2"></i>Payment Status
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Payment Status:</strong></p>
                        <span class="badge bg-<?php echo e($booking->payment_status == 'paid' ? 'success' : 'warning'); ?> fs-6">
                            <?php echo e(ucfirst($booking->payment_status ?? 'unpaid')); ?>

                        </span>
                    </div>
                    <div class="col-md-6">
                        <?php if($booking->payment_status != 'paid'): ?>
                        <form method="POST" action="<?php echo e(route('bookings.mark-paid', $booking)); ?>" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-success" 
                                    onclick="return confirm('Are you sure you want to mark this booking as paid?')">
                                <i class="fas fa-check me-1"></i> Mark as Paid
                            </button>
                        </form>
                        <?php else: ?>
                        <p class="text-success mb-0">
                            <i class="fas fa-check-circle me-1"></i> Payment Completed
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tracking Update Modal -->
<?php if($booking->shipment): ?>
<div class="modal fade" id="trackingModal" tabindex="-1" aria-labelledby="trackingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trackingModalLabel">
                    <i class="fas fa-route me-2"></i>Update Tracking Status
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?php echo e(route('shipments.update-tracking', $booking->shipment)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tracking_number" class="form-label">Tracking Number</label>
                        <input type="text" class="form-control" id="tracking_number" name="tracking_number" 
                               value="<?php echo e($booking->shipment->tracking_number); ?>" required>
                        <small class="form-text text-muted">Update the tracking number if needed</small>
                    </div>
                    <div class="mb-3">
                        <label for="tracking_status" class="form-label">Tracking Status</label>
                        <select class="form-control no-select2" id="tracking_status" name="status" required>
                            <option value="pending" <?php echo e($booking->shipment->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                            <option value="picked_up" <?php echo e($booking->shipment->status == 'picked_up' ? 'selected' : ''); ?>>Picked Up</option>
                            <option value="in_transit" <?php echo e($booking->shipment->status == 'in_transit' ? 'selected' : ''); ?>>In Transit</option>
                            <option value="out_for_delivery" <?php echo e($booking->shipment->status == 'out_for_delivery' ? 'selected' : ''); ?>>Out for Delivery</option>
                            <option value="delivered" <?php echo e($booking->shipment->status == 'delivered' ? 'selected' : ''); ?>>Delivered</option>
                            <option value="returned" <?php echo e($booking->shipment->status == 'returned' ? 'selected' : ''); ?>>Returned</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tracking_notes" class="form-label">Tracking Notes</label>
                        <textarea class="form-control" id="tracking_notes" name="tracking_notes" rows="3" placeholder="Add tracking notes or location updates..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="estimated_delivery" class="form-label">Estimated Delivery</label>
                        <input type="datetime-local" class="form-control" id="estimated_delivery" name="estimated_delivery" 
                               value="<?php echo e($booking->shipment->estimated_delivery ? $booking->shipment->estimated_delivery->format('Y-m-d\TH:i') : ''); ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update Tracking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u796145342/domains/adexcourier.com/public_html/portal/resources/views/bookings/show.blade.php ENDPATH**/ ?>