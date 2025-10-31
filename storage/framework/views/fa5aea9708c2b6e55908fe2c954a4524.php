

<?php $__env->startSection('title', 'Label Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Label Details</h1>
    <div>
        <a href="<?php echo e(route('labels.index')); ?>" class="btn btn-outline-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Back to Labels
        </a>
        <a href="<?php echo e(route('labels.download', $label)); ?>" class="btn btn-primary">
            <i class="fas fa-download me-1"></i> Download PDF
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Label Information -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Label Information</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Label Number:</strong></td>
                                <td><?php echo e($label->label_number); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Type:</strong></td>
                                <td>
                                    <span class="badge bg-info"><?php echo e(ucfirst($label->label_type)); ?></span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <span class="badge bg-<?php echo e($label->status == 'printed' ? 'success' : ($label->status == 'generated' ? 'primary' : 'warning')); ?>">
                                        <?php echo e(ucfirst($label->status)); ?>

                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Generated:</strong></td>
                                <td><?php echo e($label->generated_at ? $label->generated_at->format('M d, Y H:i') : '-'); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Tracking Number:</strong></td>
                                <td><?php echo e($label->shipment->tracking_number); ?></td>
                            </tr>
                            <tr>
                                <td><strong>File Name:</strong></td>
                                <td><?php echo e($label->file_name ?? '-'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>File Size:</strong></td>
                                <td><?php echo e($label->file_size ? number_format($label->file_size / 1024, 2) . ' KB' : '-'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Printed:</strong></td>
                                <td><?php echo e($label->printed_at ? $label->printed_at->format('M d, Y H:i') : '-'); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shipment Information -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Shipment Information</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Tracking Number:</strong></td>
                                <td>
                                    <?php echo e($label->individual_tracking_number ?? $label->shipment->tracking_number); ?>

                                    <?php if($label->individual_tracking_number): ?>
                                        <br><small class="text-muted">Individual tracking for this label</small>
                                    <?php else: ?>
                                        <br><small class="text-muted">Shared tracking with shipment</small>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <?php
                                        $currentStatus = $label->individual_status ?? $label->shipment->status;
                                    ?>
                                    <span class="badge bg-<?php echo e($currentStatus == 'delivered' ? 'success' : 'info'); ?>">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $currentStatus))); ?>

                                    </span>
                                    <?php if($label->individual_status): ?>
                                        <br><small class="text-muted">Individual status for this label</small>
                                    <?php else: ?>
                                        <br><small class="text-muted">Shared status with shipment</small>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Shipping Date:</strong></td>
                                <td><?php echo e($label->shipment->shipping_date->format('M d, Y H:i')); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Weight:</strong></td>
                                <td><?php echo e($label->shipment->weight); ?> kg</td>
                            </tr>
                            <tr>
                                <td><strong>Dimensions:</strong></td>
                                <td>
                                    <?php echo e($label->shipment->dimensions['length']); ?> x <?php echo e($label->shipment->dimensions['width']); ?> x <?php echo e($label->shipment->dimensions['height']); ?> cm
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Shipping Cost:</strong></td>
                                <td>PKR <?php echo e(number_format($label->shipment->shipping_cost, 2)); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <!-- Tracking Update Button -->
                <div class="mt-3">
                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#companyLabelTrackingModal">
                        <i class="fas fa-route me-1"></i> Update Tracking for This Label
                    </button>
                </div>
            </div>
        </div>

        <!-- Origin and Destination -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Origin & Destination</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-primary">From (Origin)</h6>
                        <p class="text-muted"><?php echo e($label->shipment->origin_address); ?></p>
                        <p class="text-muted"><?php echo e($label->shipment->origin_city); ?>, <?php echo e($label->shipment->origin_country); ?></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-primary">To (Destination)</h6>
                        <p class="text-muted"><?php echo e($label->shipment->destination_address); ?></p>
                        <p class="text-muted"><?php echo e($label->shipment->destination_city); ?>, <?php echo e($label->shipment->destination_country); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Actions -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?php echo e(route('labels.download', $label)); ?>" class="btn btn-primary">
                        <i class="fas fa-download me-1"></i> Download PDF
                    </a>
                    
                    <?php if($label->status == 'generated'): ?>
                        <form method="POST" action="<?php echo e(route('labels.print', $label)); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-success w-100" 
                                    onclick="return confirm('Mark this label as printed?')">
                                <i class="fas fa-print me-1"></i> Mark as Printed
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Barcode Information -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tracking Information</h6>
            </div>
            <div class="card-body">
                <div class="text-center">
                    <div class="mb-3">
                        <strong>Tracking Number:</strong>
                        <div class="h5 text-primary"><?php echo e($label->tracking_code); ?></div>
                    </div>
                    
                    <?php if($label->barcode_data): ?>
                    <div class="mb-3">
                        <p class="text-muted small">Barcode Data:</p>
                        <div class="border p-2 bg-light">
                            <code><?php echo e(base64_decode($label->barcode_data)); ?></code>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Related Information -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Related Information</h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Booking:</strong>
                    <div>
                        <a href="<?php echo e(route('bookings.show', $label->shipment->booking)); ?>" class="text-decoration-none">
                            <?php echo e($label->shipment->booking->booking_number); ?>

                        </a>
                    </div>
                </div>
                
                <?php if($label->shipment->booking->invoices->count() > 0): ?>
                <div class="mb-3">
                    <strong>Invoice:</strong>
                    <div>
                        <a href="<?php echo e(route('invoices.show', $label->shipment->booking->invoices->first())); ?>" class="text-decoration-none">
                            <?php echo e($label->shipment->booking->invoices->first()->invoice_number); ?>

                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Company Label-Specific Tracking Update Modal -->
<div class="modal fade" id="companyLabelTrackingModal" tabindex="-1" aria-labelledby="companyLabelTrackingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="companyLabelTrackingModalLabel">
                    <i class="fas fa-route me-2"></i>Update Tracking for Label: <?php echo e($label->label_number); ?>

                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?php echo e(route('labels.update-tracking', $label)); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Note:</strong> This will update tracking information specifically for this label (<?php echo e($label->label_number); ?>).
                    </div>
                    
                    <div class="mb-3">
                        <label for="company_label_tracking_number" class="form-label">Tracking Number</label>
                        <input type="text" class="form-control" id="company_label_tracking_number" name="tracking_number" 
                               value="<?php echo e($label->individual_tracking_number ?? $label->shipment->tracking_number); ?>" required>
                        <small class="form-text text-muted">Update the tracking number for this specific label only</small>
                    </div>
                    <div class="mb-3">
                        <label for="company_label_tracking_status" class="form-label">Tracking Status</label>
                        <select class="form-control" id="company_label_tracking_status" name="status" required>
                            <?php
                                $currentStatus = $label->individual_status ?? $label->shipment->status;
                            ?>
                            <option value="pending" <?php echo e($currentStatus == 'pending' ? 'selected' : ''); ?>>Pending</option>
                            <option value="picked_up" <?php echo e($currentStatus == 'picked_up' ? 'selected' : ''); ?>>Picked Up</option>
                            <option value="in_transit" <?php echo e($currentStatus == 'in_transit' ? 'selected' : ''); ?>>In Transit</option>
                            <option value="out_for_delivery" <?php echo e($currentStatus == 'out_for_delivery' ? 'selected' : ''); ?>>Out for Delivery</option>
                            <option value="delivered" <?php echo e($currentStatus == 'delivered' ? 'selected' : ''); ?>>Delivered</option>
                            <option value="returned" <?php echo e($currentStatus == 'returned' ? 'selected' : ''); ?>>Returned</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="company_label_tracking_notes" class="form-label">Tracking Notes</label>
                        <textarea class="form-control" id="company_label_tracking_notes" name="tracking_notes" rows="3" placeholder="Add tracking notes specific to this label..."><?php echo e($label->individual_tracking_notes); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="company_label_estimated_delivery" class="form-label">Estimated Delivery</label>
                        <input type="datetime-local" class="form-control" id="company_label_estimated_delivery" name="estimated_delivery" 
                               value="<?php echo e($label->individual_estimated_delivery ? $label->individual_estimated_delivery->format('Y-m-d\TH:i') : ''); ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update Tracking for This Label
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel\shipment_fahad_malik\resources\views/labels/show.blade.php ENDPATH**/ ?>