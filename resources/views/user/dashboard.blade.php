@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Welcome, {{ $user->name }}</h1>
    <div>
        <a href="{{ route('user.bookings.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-1"></i> New Booking
        </a>
    </div>
</div>

<!-- User Info -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5 class="text-primary">User Information</h5>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Role:</strong> <span class="badge bg-info">{{ ucfirst($user->role) }}</span></p>
            </div>
            <div class="col-md-6">
                <h5 class="text-primary">Company Information</h5>
                <p><strong>Company:</strong> {{ $user->company->name }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge bg-{{ $user->is_active ? 'success' : 'danger' }}">
                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">My Bookings</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_bookings'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active Shipments</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['active_shipments'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-shipping-fast fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">My Invoices</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_invoices'] }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-file-invoice fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">My Revenue</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">PKR {{ number_format($stats['total_revenue'], 2) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">My Recent Bookings</h6>
                <a href="{{ route('user.bookings.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                @if($recent_bookings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Booking #</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_bookings as $booking)
                                <tr>
                                    <td>
                                        <a href="{{ route('user.bookings.show', $booking) }}" class="text-decoration-none">
                                            {{ $booking->booking_number }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'secondary') }}">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $booking->booking_date->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center">No bookings found.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Shipments -->
    <div class="col-lg-6 mb-4">
        <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">My Recent Shipments</h6>
                <a href="{{ route('user.labels.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                @if($recent_shipments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Tracking #</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_shipments as $shipment)
                                <tr>
                                    <td>
                                        <span class="text-muted">{{ $shipment->tracking_number }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $shipment->status == 'delivered' ? 'success' : 'info' }}">
                                            {{ ucfirst(str_replace('_', ' ', $shipment->status)) }}
                                        </span>
                                    </td>
                                    <td>{{ $shipment->created_at->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center">No shipments found.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Recent Invoices -->
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">My Recent Invoices</h6>
                <a href="{{ route('user.invoices.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                @if($recent_invoices->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Invoice #</th>
                                    <th>Booking #</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recent_invoices as $invoice)
                                <tr>
                                    <td>
                                        <a href="{{ route('user.invoices.show', $invoice) }}" class="text-decoration-none">
                                            {{ $invoice->invoice_number }}
                                        </a>
                                    </td>
                                    <td>{{ $invoice->booking->booking_number }}</td>
                                    <td>PKR {{ number_format($invoice->total_amount, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $invoice->payment_status == 'paid' ? 'success' : 'warning' }}">
                                            {{ ucfirst($invoice->payment_status) }}
                                        </span>
                                    </td>
                                    <td>{{ $invoice->invoice_date->format('M d, Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center">No invoices found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}
.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}
.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}
.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}
</style>
@endpush



