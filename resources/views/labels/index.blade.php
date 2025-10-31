@extends('layouts.app')

@section('title', 'Labels')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Shipping Labels</h1>
</div>

<div class="card shadow">
    <div class="card-body">
        <div class="table-responsive">
            <table id="labelsTable" class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Label #</th>
                        <th>Tracking #</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Generated</th>
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
@endsection

@push('styles')
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
@endpush

@push('scripts')
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
    $('#labelsTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('labels.data') }}",
            type: 'GET'
        },
        columns: [
            { data: 'label_number', name: 'label_number' },
            { data: 'tracking_number', name: 'tracking_number' },
            { data: 'label_type', name: 'label_type' },
            { data: 'status', name: 'status' },
            { data: 'generated_at', name: 'generated_at' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        order: [[4, 'desc']], // Default order by generated date
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
            emptyTable: "No labels found",
            zeroRecords: "No matching labels found"
        },
        drawCallback: function(settings) {
            // Re-initialize tooltips after each draw
            $('[data-bs-toggle="tooltip"]').tooltip();
        }
    });
});
</script>
@endpush
