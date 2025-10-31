

<?php $__env->startSection('title', 'My Bookings'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">My Bookings</h1>
    <div>
        <a href="<?php echo e(route('user.bookings.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> New Booking
        </a>
    </div>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table id="userBookingsTable" class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Booking #</th>
                        <th>Shipper</th>
                        <th>Consignee</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Total Cost</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be loaded via AJAX -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#userBookingsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?php echo e(route('user.bookings.data')); ?>",
            type: 'GET'
        },
        columns: [
            { data: 'booking_number', name: 'booking_number' },
            { data: 'shipper_name', name: 'shipper_name' },
            { data: 'consignee_name', name: 'consignee_name' },
            { data: 'service_type', name: 'service_type' },
            { data: 'status', name: 'status' },
            { data: 'total_cost', name: 'total_cost' },
            { data: 'booking_date', name: 'booking_date' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        order: [[6, 'desc']], // Default order by date
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100, 500, 1000], [10, 25, 50, 100, 500, 1000]],
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> Excel',
                className: 'btn btn-success btn-sm'
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                className: 'btn btn-danger btn-sm'
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> Print',
                className: 'btn btn-info btn-sm'
            }
        ],
        language: {
            processing: '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>',
            emptyTable: "No bookings found",
            zeroRecords: "No matching bookings found"
        },
        drawCallback: function(settings) {
            // Re-initialize tooltips after each draw
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    });
});
</script>
<?php $__env->stopPush(); ?>




<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/u796145342/domains/adexcourier.com/public_html/portal/resources/views/user/bookings/index.blade.php ENDPATH**/ ?>