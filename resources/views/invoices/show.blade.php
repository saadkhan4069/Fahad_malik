@extends('layouts.app')

@section('title', 'Invoice Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Invoice Details</h1>
    <div>
        <a href="{{ route('invoices.index') }}" class="btn btn-outline-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Back to Invoices
        </a>
        <a href="{{ route('invoices.pdf', $invoice) }}" class="btn btn-primary">
            <i class="fas fa-download me-1"></i> Download PDF
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <!-- Invoice Header -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="text-primary mb-3">Invoice</h4>
                        <p class="mb-1"><strong>Invoice Number:</strong> {{ $invoice->invoice_number }}</p>
                        <p class="mb-1"><strong>Invoice Date:</strong> {{ $invoice->invoice_date->format('M d, Y') }}</p>
                        <p class="mb-1"><strong>Due Date:</strong> {{ $invoice->due_date->format('M d, Y') }}</p>
                        <p class="mb-0"><strong>Status:</strong> 
                            <span class="badge bg-{{ $invoice->status == 'paid' ? 'success' : 'warning' }}">
                                {{ ucfirst($invoice->status) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <h4 class="text-primary mb-3">{{ $invoice->company->name }}</h4>
                        <p class="mb-1">{{ $invoice->company->address }}</p>
                        <p class="mb-1">{{ $invoice->company->city }}, {{ $invoice->company->state }} {{ $invoice->company->zip_code }}</p>
                        <p class="mb-1">{{ $invoice->company->country }}</p>
                        @if($invoice->company->tax_id)
                            <p class="mb-0"><strong>Tax ID:</strong> {{ $invoice->company->tax_id }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

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
                                <td>{{ $invoice->booking->booking_number }}</td>
                            </tr>
                            <tr>
                                <td><strong>Service Type:</strong></td>
                                <td>
                                    <span class="badge bg-info">{{ ucfirst($invoice->booking->service_type) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Pickup Date:</strong></td>
                                <td>{{ $invoice->booking->pickup_date->format('M d, Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Package Weight:</strong></td>
                                <td>{{ $invoice->booking->weight }} kg</td>
                            </tr>
                            <tr>
                                <td><strong>Package Value:</strong></td>
                                <td>PKR {{ number_format($invoice->booking->package_value, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Shipper:</strong></td>
                                <td>{{ $invoice->booking->shipper_name }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shipment Information -->
        @if($invoice->shipment)
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
                                <td>{{ $invoice->shipment->tracking_number }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                                    <span class="badge bg-{{ $invoice->shipment->status == 'delivered' ? 'success' : 'info' }}">
                                        {{ ucfirst(str_replace('_', ' ', $invoice->shipment->status)) }}
                                    </span>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Shipping Date:</strong></td>
                                <td>{{ $invoice->shipment->shipping_date->format('M d, Y H:i') }}</td>
                            </tr>
                            @if($invoice->shipment->estimated_delivery)
                            <tr>
                                <td><strong>Estimated Delivery:</strong></td>
                                <td>{{ $invoice->shipment->estimated_delivery->format('M d, Y H:i') }}</td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="col-lg-4">
        <!-- Payment Information -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Payment Information</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Payment Status:</strong></td>
                        <td>
                            <span class="badge bg-{{ $invoice->payment_status == 'paid' ? 'success' : 'warning' }}">
                                {{ ucfirst($invoice->payment_status) }}
                            </span>
                        </td>
                    </tr>
                    @if($invoice->payment_method)
                    <tr>
                        <td><strong>Payment Method:</strong></td>
                        <td>{{ ucfirst(str_replace('_', ' ', $invoice->payment_method)) }}</td>
                    </tr>
                    @endif
                    @if($invoice->payment_date)
                    <tr>
                        <td><strong>Payment Date:</strong></td>
                        <td>{{ $invoice->payment_date->format('M d, Y H:i') }}</td>
                    </tr>
                    @endif
                </table>

                @if($invoice->payment_status == 'unpaid')
                <div class="mt-3">
                    <button type="button" class="btn btn-success btn-sm" 
                            data-bs-toggle="modal" data-bs-target="#paymentModal">
                        <i class="fas fa-credit-card me-1"></i> Mark as Paid
                    </button>
                </div>
                @endif
            </div>
        </div>

        <!-- Invoice Summary -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Invoice Summary</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Subtotal:</strong></td>
                        <td class="text-end">PKR {{ number_format($invoice->subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td><strong>Tax (5%):</strong></td>
                        <td class="text-end">PKR {{ number_format($invoice->tax_amount, 2) }}</td>
                    </tr>
                    @if($invoice->discount_amount > 0)
                    <tr>
                        <td><strong>Discount:</strong></td>
                        <td class="text-end text-success">-PKR {{ number_format($invoice->discount_amount, 2) }}</td>
                    </tr>
                    @endif
                    <tr class="border-top">
                        <td><strong>Total Amount:</strong></td>
                        <td class="text-end"><strong>PKR {{ number_format($invoice->total_amount, 2) }}</strong></td>
                    </tr>
                </table>
            </div>
        </div>

        @if($invoice->notes)
        <!-- Notes -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Notes</h6>
            </div>
            <div class="card-body">
                <p class="text-muted">{{ $invoice->notes }}</p>
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Payment Modal -->
@if($invoice->payment_status == 'unpaid')
<div class="modal fade" id="paymentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mark Invoice as Paid</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('invoices.payment', $invoice) }}">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Payment Method</label>
                        <select class="form-control" id="payment_method" name="payment_method" required>
                            <option value="">Select Payment Method</option>
                            <option value="cash">Cash</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="check">Check</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="payment_date" class="form-label">Payment Date</label>
                        <input type="date" class="form-control" id="payment_date" 
                               name="payment_date" value="{{ now()->toDateString() }}" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Mark as Paid</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
