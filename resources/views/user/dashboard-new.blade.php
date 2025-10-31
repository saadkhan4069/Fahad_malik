@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="dashboard-container">
    <!-- Header Section -->
    <div class="header-section mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="company-info">
                    <div class="user-badge">
                        <span class="user-id">{{ $user->id }} - {{ $user->name }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <div class="date-info">
                    <span class="today-date">Today's Date: {{ now()->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Date Range Section -->
    <div class="date-range-section mb-4">
        <div class="row align-items-center">
            <div class="col-md-1">
                <div class="date-icons">
                    <i class="fas fa-calendar-alt fa-2x text-success"></i>
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
                            <input type="date" class="form-control" value="{{ now()->subDays(3)->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <span>To</span>
                        </div>
                        <div class="col-md-4">
                            <label>Date To:</label>
                            <input type="date" class="form-control" value="{{ now()->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn btn-success">Refresh</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities Section -->
    <div class="recent-activities-section mb-4">
        <h2 class="section-title">MY RECENT ACTIVITIES</h2>
        <div class="row">
            <!-- Card 1: Total Bookings -->
            <div class="col-md-2">
                <div class="activity-card card-red">
                    <div class="card-header-small">{{ now()->subDays(3)->format('d/m/Y') }}-{{ now()->format('d/m/Y') }}</div>
                    <div class="card-body-split">
                        <div class="left-section">
                            <div class="big-number">{{ $stats['total_bookings'] }}</div>
                            <div class="label">My Bookings</div>
                        </div>
                        <div class="right-section">
                            <div class="big-number">{{ $stats['total_revenue'] > 0 ? number_format($stats['total_revenue']) : '0' }}</div>
                            <div class="label">My Revenue</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Last Booking Date -->
            <div class="col-md-2">
                <div class="activity-card card-green">
                    <div class="card-body-vertical">
                        <div class="top-section">
                            <div class="date-value">{{ $recent_bookings->first() ? $recent_bookings->first()->booking_date->format('Y-m-d') : now()->format('Y-m-d') }}</div>
                            <div class="label">Last Booking Date</div>
                        </div>
                        <div class="bottom-section">
                            <div class="big-number">{{ $stats['active_shipments'] }}</div>
                            <div class="label">Active Shipments</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Pending Invoices -->
            <div class="col-md-2">
                <div class="activity-card card-blue">
                    <div class="card-body-vertical">
                        <div class="top-section">
                            <div class="big-number">{{ $stats['unpaid_invoices'] }}</div>
                            <div class="label">Pending Invoices</div>
                        </div>
                        <div class="bottom-section">
                            <div class="big-number">{{ $stats['overdue_invoices'] }}</div>
                            <div class="label">Overdue Invoices</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4: Last Booking Number -->
            <div class="col-md-2">
                <div class="activity-card card-orange">
                    <div class="card-body-vertical">
                        <div class="top-section">
                            <div class="booking-number">{{ $recent_bookings->first() ? $recent_bookings->first()->cn_number : '100001' }}</div>
                            <div class="label">Last C/N No.</div>
                        </div>
                        <div class="bottom-section">
                            <div class="big-number">{{ $recent_bookings->first() ? number_format($recent_bookings->first()->total_cost) : '0.00' }}</div>
                            <div class="label">Last Booking Amount</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 5: My Company -->
            <div class="col-md-2">
                <div class="activity-card card-purple">
                    <div class="card-body-vertical">
                        <div class="top-section">
                            <div class="big-number">{{ $user->company->name }}</div>
                            <div class="label">My Company</div>
                        </div>
                        <div class="bottom-section">
                            <div class="big-number">{{ ucfirst($user->role) }}</div>
                            <div class="label">My Role</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Tables Section -->
    <div class="row">
        <!-- List of My Bookings -->
        <div class="col-md-6">
            <div class="table-section">
                <div class="table-header">
                    <h5>My Bookings {{ now()->subDays(3)->format('d/m/Y') }}-{{ now()->format('d/m/Y') }}</h5>
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
                                <th>Service Type <i class="fas fa-sort"></i></th>
                                <th>Tracking No. <i class="fas fa-sort"></i></th>
                                <th>Weight <i class="fas fa-sort"></i></th>
                                <th>Amount <i class="fas fa-sort"></i></th>
                                <th>Status <i class="fas fa-sort"></i></th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_bookings as $booking)
                            <tr>
                                <td>
                                    <a href="{{ route('user.bookings.show', $booking) }}" class="text-success">{{ $booking->cn_number }}</a>
                                </td>
                                <td>{{ $booking->booking_date->format('Y-m-d') }}</td>
                                <td>
                                    <span class="badge bg-info">{{ ucfirst($booking->service_type) }}</span>
                                </td>
                                <td>
                                    @if($booking->shipment)
                                        <span class="text-success">{{ $booking->shipment->tracking_number }}</span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $booking->weight }} kg</td>
                                <td>{{ $booking->goods_value_currency ?? 'PKR' }} {{ number_format($booking->total_cost, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('user.bookings.show', $booking) }}" class="btn btn-sm btn-outline-success">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No bookings found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="table-footer">
                    <div class="pagination-info">
                        Showing 1 to {{ $recent_bookings->count() }} of {{ $recent_bookings->count() }} entries
                    </div>
                    <div class="pagination">
                        <button class="btn btn-sm btn-outline-secondary">Previous</button>
                        <button class="btn btn-sm btn-success">1</button>
                        <button class="btn btn-sm btn-outline-secondary">Next</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- List of My Invoices -->
        <div class="col-md-6">
            <div class="table-section">
                <div class="table-header">
                    <h5>My Invoices {{ now()->subDays(3)->format('d/m/Y') }}-{{ now()->format('d/m/Y') }}</h5>
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
                                <th>C/N No. <i class="fas fa-sort"></i></th>
                                <th>Amount <i class="fas fa-sort"></i></th>
                                <th>Status <i class="fas fa-sort"></i></th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->invoice_date->format('Y-m-d') }}</td>
                                <td>{{ $invoice->invoice_number }}</td>
                                <td>{{ $invoice->booking->cn_number }}</td>
                                <td>PKR {{ number_format($invoice->total_amount, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $invoice->payment_status == 'paid' ? 'success' : 'warning' }}">
                                        {{ ucfirst($invoice->payment_status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('user.invoices.show', $invoice) }}" class="btn btn-sm btn-outline-success">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No data available in table</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="table-footer">
                    <div class="pagination-info">
                        Showing 1 to {{ $recent_invoices->count() }} of {{ $recent_invoices->count() }} entries
                    </div>
                    <div class="pagination">
                        <button class="btn btn-sm btn-outline-secondary">Previous</button>
                        <button class="btn btn-sm btn-success">1</button>
                        <button class="btn btn-sm btn-outline-secondary">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
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

.user-badge {
    background: #28a745;
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

.card-red { background: linear-gradient(135deg, #dc3545, #c82333); }
.card-green { background: linear-gradient(135deg, #28a745, #1e7e34); }
.card-blue { background: linear-gradient(135deg, #213F60, #E52B3B); }
.card-orange { background: linear-gradient(135deg, #fd7e14, #e55a00); }
.card-purple { background: linear-gradient(135deg, #6f42c1, #5a2d91); }

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
@endpush
