@extends('layouts.app')

@section('title', 'Invoices')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Invoices</h1>
</div>

<div class="card shadow">
    <div class="card-body">
        @if($invoices->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Invoice #</th>
                            <th>Booking #</th>
                            <th>Date</th>
                            <th>Due Date</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                        <tr>
                            <td>
                                <strong>{{ $invoice->invoice_number }}</strong>
                            </td>
                            <td>{{ $invoice->booking ? $invoice->booking->booking_number : 'N/A' }}</td>
                            <td>{{ $invoice->invoice_date->format('M d, Y') }}</td>
                            <td>{{ $invoice->due_date->format('M d, Y') }}</td>
                            <td>PKR {{ number_format($invoice->total_amount, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $invoice->payment_status == 'paid' ? 'success' : ($invoice->due_date < now() && $invoice->payment_status == 'unpaid' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($invoice->payment_status) }}
                                    @if($invoice->due_date < now() && $invoice->payment_status == 'unpaid')
                                        (Overdue)
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('invoices.pdf', $invoice) }}" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    @if($invoice->payment_status == 'unpaid')
                                        <button type="button" class="btn btn-sm btn-outline-success" 
                                                data-bs-toggle="modal" data-bs-target="#paymentModal{{ $invoice->id }}">
                                            <i class="fas fa-credit-card"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                {{ $invoices->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-file-invoice fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No invoices found</h5>
                <p class="text-muted">Invoices will appear here once bookings are confirmed.</p>
            </div>
        @endif
    </div>
</div>

<!-- Payment Modal -->
@foreach($invoices as $invoice)
@if($invoice->payment_status == 'unpaid')
<div class="modal fade" id="paymentModal{{ $invoice->id }}" tabindex="-1">
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
                        <label for="payment_method{{ $invoice->id }}" class="form-label">Payment Method</label>
                        <select class="form-control" id="payment_method{{ $invoice->id }}" name="payment_method" required>
                            <option value="">Select Payment Method</option>
                            <option value="cash">Cash</option>
                            <option value="credit_card">Credit Card</option>
                            <option value="bank_transfer">Bank Transfer</option>
                            <option value="check">Check</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="payment_date{{ $invoice->id }}" class="form-label">Payment Date</label>
                        <input type="date" class="form-control" id="payment_date{{ $invoice->id }}" 
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
@endforeach
@endsection
