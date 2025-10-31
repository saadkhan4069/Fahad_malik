@extends('layouts.app')

@section('title', 'Invoice Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Invoice Details</h1>
    <div>
        <a href="{{ route('user.invoices.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Invoices
        </a>
        <a href="{{ route('user.invoices.pdf', $invoice) }}" class="btn btn-success" target="_blank">
            <i class="fas fa-download me-1"></i> Download PDF
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-file-invoice me-2"></i>Invoice Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Invoice Number:</strong>
                        <p>{{ $invoice->invoice_number }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Invoice Date:</strong>
                        <p>{{ $invoice->invoice_date->format('M d, Y') }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Due Date:</strong>
                        <p>{{ $invoice->due_date->format('M d, Y') }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Status:</strong>
                        <p>
                            <span class="badge bg-{{ $invoice->status == 'paid' ? 'success' : 'warning' }}">
                                {{ ucfirst($invoice->status) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Payment Status:</strong>
                        <p>
                            <span class="badge bg-{{ $invoice->payment_status == 'paid' ? 'success' : ($invoice->payment_status == 'overdue' ? 'danger' : 'warning') }}">
                                {{ ucfirst($invoice->payment_status) }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Invoice Items -->
        <div class="card shadow mt-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-list me-2"></i>Invoice Details
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Subtotal:</strong>
                        <p>PKR {{ number_format($invoice->subtotal, 2) }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Tax Amount:</strong>
                        <p>PKR {{ number_format($invoice->tax_amount, 2) }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Discount:</strong>
                        <p>PKR {{ number_format($invoice->discount_amount ?? 0, 2) }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong class="h5 text-primary">Total Amount:</strong>
                        <p class="h4 text-primary">PKR {{ number_format($invoice->total_amount, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Related Booking -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-calendar-alt me-2"></i>Related Booking
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Booking Number:</strong>
                    <p>{{ $invoice->booking->booking_number }}</p>
                </div>
                <div class="mb-3">
                    <strong>Service Type:</strong>
                    <p><span class="badge bg-info">{{ ucfirst($invoice->booking->service_type) }}</span></p>
                </div>
                <div class="mb-3">
                    <strong>Booking Status:</strong>
                    <p>
                        <span class="badge bg-{{ $invoice->booking->status == 'confirmed' ? 'success' : 'warning' }}">
                            {{ ucfirst($invoice->booking->status) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Related Shipment -->
        @if($invoice->shipment)
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-shipping-fast me-2"></i>Related Shipment
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Tracking Number:</strong>
                    <p>{{ $invoice->shipment->tracking_number }}</p>
                </div>
                <div class="mb-3">
                    <strong>Status:</strong>
                    <p>
                        <span class="badge bg-info">
                            {{ ucfirst(str_replace('_', ' ', $invoice->shipment->status)) }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
        @endif

        <!-- Payment Actions -->
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-credit-card me-2"></i>Payment Actions
                </h5>
            </div>
            <div class="card-body">
                @if($invoice->payment_status == 'unpaid')
                    <p class="text-muted mb-3">This invoice is pending payment.</p>
                    <a href="{{ route('user.invoices.pdf', $invoice) }}" class="btn btn-primary w-100 mb-2" target="_blank">
                        <i class="fas fa-download me-1"></i> Download Invoice
                    </a>
                @elseif($invoice->payment_status == 'paid')
                    <p class="text-success mb-3">
                        <i class="fas fa-check-circle me-1"></i> This invoice has been paid.
                    </p>
                @elseif($invoice->payment_status == 'overdue')
                    <p class="text-danger mb-3">
                        <i class="fas fa-exclamation-triangle me-1"></i> This invoice is overdue.
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection



