@extends('layouts.app')

@section('title', 'My Invoices')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">My Invoices</h1>
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
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $invoice)
                        <tr>
                            <td>
                                <strong>{{ $invoice->invoice_number }}</strong>
                            </td>
                            <td>{{ $invoice->booking->booking_number }}</td>
                            <td>{{ $invoice->invoice_date->format('M d, Y') }}</td>
                            <td>{{ $invoice->due_date->format('M d, Y') }}</td>
                            <td class="h6 text-primary">PKR {{ number_format($invoice->total_amount, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $invoice->payment_status == 'paid' ? 'success' : ($invoice->payment_status == 'overdue' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($invoice->payment_status) }}
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('user.invoices.show', $invoice) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('user.invoices.pdf', $invoice) }}" class="btn btn-sm btn-outline-success" target="_blank">
                                        <i class="fas fa-download"></i>
                                    </a>
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
                <p class="text-muted">Invoices will appear here once your bookings are confirmed.</p>
            </div>
        @endif
    </div>
</div>
@endsection



