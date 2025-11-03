<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="dashboard-container">
    <!-- Header Section -->
    <div class="header-section mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="company-info">
                    <div class="company-badge">
                        <span class="company-id"><?php echo e(Auth::guard('company')->user()->id ?? '1001'); ?> - <?php echo e(Auth::guard('company')->user()->name ?? 'Shipment System'); ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <div class="date-info">
                    <span class="today-date">Today's Date: <?php echo e(now()->format('d/m/Y')); ?></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Date Range Section -->
    <div class="date-range-section mb-4">
        <div class="row align-items-center">
            <div class="col-md-1">
                <div class="date-icons">
                    <i class="fas fa-calendar-alt fa-2x text-primary"></i>
                    <div class="date-labels">
                        <small>Today</small>
                        <small>7</small>
                        <small>30</small>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="date-inputs">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Date From:</label>
                            <input type="date" class="form-control" value="<?php echo e(now()->subDays(3)->format('Y-m-d')); ?>">
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <span>To</span>
                        </div>
                        <div class="col-md-4">
                            <label>Date To:</label>
                            <input type="date" class="form-control" value="<?php echo e(now()->format('Y-m-d')); ?>">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn btn-primary">Refresh</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Section -->
    <div class="recent-activities-section mb-4">
        <h2 class="section-title">RECENT ACTIVITIES</h2>
        <div class="row">
            <!-- Card 1: Total Bookings -->
            <div class="col-md-2">
                <div class="activity-card card-red">
                    <div class="card-header-small"><?php echo e(now()->subDays(3)->format('d/m/Y')); ?>-<?php echo e(now()->format('d/m/Y')); ?></div>
                    <div class="card-body-split">
                        <div class="left-section">
                            <div class="big-number"><?php echo e($stats['total_bookings']); ?></div>
                            <div class="label">Total Bookings</div>
                        </div>
                        <div class="right-section">
                            <div class="big-number"><?php echo e($stats['total_revenue'] > 0 ? number_format($stats['total_revenue']) : '0'); ?></div>
                            <div class="label">Total Amount</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Last Booking Date -->
            <div class="col-md-2">
                <div class="activity-card card-green">
                    <div class="card-body-vertical">
                        <div class="top-section">
                            <div class="date-value"><?php echo e($recent_bookings->first() ? $recent_bookings->first()->booking_date->format('Y-m-d') : now()->format('Y-m-d')); ?></div>
                            <div class="label">Last Booking Date</div>
                        </div>
                        <div class="bottom-section">
                            <div class="big-number"><?php echo e($stats['active_shipments']); ?></div>
                            <div class="label">Active Days</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Credit Limit -->
            <div class="col-md-2">
                <div class="activity-card card-blue">
                    <div class="card-body-vertical">
                        <div class="top-section">
                            <div class="big-number">0.00</div>
                            <div class="label">Credit Limit</div>
                        </div>
                        <div class="bottom-section">
                            <div class="big-number">0</div>
                            <div class="label">Credit Limit Days</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4: Last Booking Number -->
            <div class="col-md-2">
                <div class="activity-card card-orange">
                    <div class="card-body-vertical">
                        <div class="top-section">
                            <div class="booking-number"><?php echo e($recent_bookings->first() ? $recent_bookings->first()->cn_number : '100001'); ?></div>
                            <div class="label">Last C/N No.</div>
                        </div>
                        <div class="bottom-section">
                            <div class="big-number"><?php echo e($recent_bookings->first() ? number_format($recent_bookings->first()->total_cost) : '0.00'); ?></div>
                            <div class="label">Last Booking Amount</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 5: Last Payment -->
            <div class="col-md-2">
                <div class="activity-card card-purple">
                    <div class="card-body-vertical">
                        <div class="top-section">
                            <div class="big-number"><?php echo e($stats['total_revenue'] > 0 ? number_format($stats['total_revenue']) : '0.00'); ?></div>
                            <div class="label">Last Payment</div>
                        </div>
                        <div class="bottom-section">
                            <div class="label">Last Payment Date</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Tables Section -->
    <div class="row">
        <!-- List of Bookings -->
        <div class="col-md-6">
            <div class="table-section">
                <div class="table-header">
                    <h5>List of Bookings <?php echo e(now()->subDays(3)->format('d/m/Y')); ?>-<?php echo e(now()->format('d/m/Y')); ?></h5>
                    <i class="fas fa-minus"></i>
                </div>
                <div class="table-controls">
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-select form-select-sm">
                                <option>Show All entries</option>
                                <option>10</option>
                                <option>25</option>
                                <option>50</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-sm" placeholder="Search:">
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>C/N No. <i class="fas fa-sort"></i></th>
                                <th>Booking Date <i class="fas fa-sort"></i></th>
                                <th>Run No. <i class="fas fa-sort"></i></th>
                                <th>Tracking No. <i class="fas fa-sort"></i></th>
                                <th>No. of Pkgs <i class="fas fa-sort"></i></th>
                                <th>Weight <i class="fas fa-sort"></i></th>
                                <th>Shipper <i class="fas fa-sort"></i></th>
                                <th>Consignee <i class="fas fa-sort"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recent_bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <i class="fas fa-eye text-primary me-1"></i>
                                    <a href="<?php echo e(route('bookings.show', $booking)); ?>" class="text-primary"><?php echo e($booking->cn_number); ?></a>
                                </td>
                                <td><?php echo e($booking->booking_date->format('Y-m-d')); ?></td>
                                <td><?php echo e(rand(100, 999)); ?></td>
                                <td>
                                    <?php if($booking->shipment): ?>
                                        <a href="#" class="text-primary"><?php echo e($booking->shipment->tracking_number); ?></a>
                                    <?php else: ?>
                                        <span class="text-muted">N/A</span>
                                    <?php endif; ?>
                                </td>
                                <td>1</td>
                                <td>
                                    <?php if($booking->shipment): ?>
                                        <a href="#" class="text-primary"><?php echo e($booking->weight); ?></a>
                                    <?php else: ?>
                                        <span class="text-muted"><?php echo e($booking->weight); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($booking->shipper_name); ?></td>
                                <td><?php echo e($booking->consignee_name); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted">No bookings found</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="table-footer">
                    <div class="pagination-info">
                        Showing 1 to <?php echo e($recent_bookings->count()); ?> of <?php echo e($recent_bookings->count()); ?> entries
                    </div>
                    <div class="pagination">
                        <button class="btn btn-sm btn-outline-secondary">Previous</button>
                        <button class="btn btn-sm btn-primary">1</button>
                        <button class="btn btn-sm btn-outline-secondary">Next</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- List of Invoices -->
        <div class="col-md-6">
            <div class="table-section">
                <div class="table-header">
                    <h5>List of Invoices <?php echo e(now()->subDays(3)->format('d/m/Y')); ?>-<?php echo e(now()->format('d/m/Y')); ?></h5>
                    <i class="fas fa-minus"></i>
                </div>
                <div class="table-controls">
                    <div class="row">
                        <div class="col-md-6">
                            <select class="form-select form-select-sm">
                                <option>Show All entries</option>
                                <option>10</option>
                                <option>25</option>
                                <option>50</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control form-control-sm" placeholder="Search:">
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Date <i class="fas fa-sort"></i></th>
                                <th>Invoice No. <i class="fas fa-sort"></i></th>
                                <th>Invoice Date <i class="fas fa-sort"></i></th>
                                <th>Amount <i class="fas fa-sort"></i></th>
                                <th>Status <i class="fas fa-sort"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $recent_invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($invoice->invoice_date->format('Y-m-d')); ?></td>
                                <td><?php echo e($invoice->invoice_number); ?></td>
                                <td><?php echo e($invoice->invoice_date->format('Y-m-d')); ?></td>
                                <td>PKR <?php echo e(number_format($invoice->total_amount, 2)); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo e($invoice->payment_status == 'paid' ? 'success' : 'warning'); ?>">
                                        <?php echo e(ucfirst($invoice->payment_status)); ?>

                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">No data available in table</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <div class="table-footer">
                    <div class="pagination-info">
                        Showing 1 to <?php echo e($recent_invoices->count()); ?> of <?php echo e($recent_invoices->count()); ?> entries
                    </div>
                    <div class="pagination">
                        <button class="btn btn-sm btn-outline-secondary">Previous</button>
                        <button class="btn btn-sm btn-primary">1</button>
                        <button class="btn btn-sm btn-outline-secondary">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.dashboard-container {
    background: #f8f9fa;
    min-height: 100vh;
    padding: 20px;
}

.header-section {
    background: white;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.company-badge {
    background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
    color: white;
    padding: 8px 15px;
    border-radius: 5px;
    display: inline-block;
    font-weight: bold;
}

.today-date {
    font-weight: 500;
    color: #666;
}

.date-range-section {
    background: white;
    padding: 15px 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.date-icons {
    text-align: center;
    position: relative;
}

.date-labels {
    position: absolute;
    bottom: -20px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 10px;
    color: #666;
}

.recent-activities-section {
    text-align: center;
}

.section-title {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    color: #333;
}

.activity-card {
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 10px;
    color: white;
    text-align: center;
    min-height: 120px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card-red { background: linear-gradient(135deg, #E52B3B, #cc2333); }
.card-green { background: linear-gradient(135deg, #213F60, #1a3250); }
.card-blue { background: linear-gradient(135deg, #213F60, #E52B3B); }
.card-orange { background: linear-gradient(135deg, #E52B3B, #cc2333); }
.card-purple { background: linear-gradient(135deg, #213F60, #E52B3B); }

.card-header-small {
    font-size: 10px;
    opacity: 0.9;
    margin-bottom: 10px;
}

.card-body-split {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-body-vertical {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}

.left-section, .right-section {
    flex: 1;
    text-align: center;
}

.top-section, .bottom-section {
    margin-bottom: 10px;
}

.big-number {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 5px;
}

.date-value {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 5px;
}

.booking-number {
    font-size: 12px;
    font-weight: bold;
    margin-bottom: 5px;
    word-break: break-all;
}

.label {
    font-size: 10px;
    opacity: 0.9;
}

.table-section {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    margin-bottom: 20px;
}

.table-header {
    background: #f8f9fa;
    padding: 15px 20px;
    border-bottom: 1px solid #dee2e6;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 8px 8px 0 0;
}

.table-header h5 {
    margin: 0;
    font-weight: 600;
    color: #333;
}

.table-controls {
    padding: 15px 20px;
    border-bottom: 1px solid #dee2e6;
    background: #f8f9fa;
}

.table-footer {
    padding: 15px 20px;
    background: #f8f9fa;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 0 0 8px 8px;
}

.pagination-info {
    font-size: 14px;
    color: #666;
}

.pagination {
    display: flex;
    gap: 5px;
}

.table th {
    font-size: 12px;
    font-weight: 600;
    padding: 12px 8px;
}

.table td {
    font-size: 12px;
    padding: 12px 8px;
    vertical-align: middle;
}

.table td a {
    text-decoration: none;
}

.table td a:hover {
    text-decoration: underline;
}

.form-select-sm, .form-control-sm {
    font-size: 12px;
}

.btn-sm {
    font-size: 12px;
    padding: 4px 8px;
}
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel\Fahad_malik\resources\views/dashboard-new.blade.php ENDPATH**/ ?>