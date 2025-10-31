@extends('layouts.app')

@section('title', 'Booking Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Booking Details</h1>
    <div>
        <a href="{{ route('user.bookings.index') }}" class="btn btn-outline-secondary me-2">
            <i class="fas fa-arrow-left me-1"></i> Back to Bookings
        </a>
        
        <!-- Edit Button -->
        <a href="{{ route('user.bookings.edit', $booking) }}" class="btn btn-primary me-2">
            <i class="fas fa-edit me-1"></i> Edit Booking
        </a>
        
        <!-- Proforma Invoice Button -->
        <a href="{{ route('user.invoices.proforma', $booking) }}" class="btn btn-info me-2" target="_blank">
            <i class="fas fa-file-invoice me-1"></i> Proforma Invoice
        </a>
        <a href="{{ route('user.invoices.proforma.pdf', $booking) }}" class="btn btn-outline-info">
            <i class="fas fa-download me-1"></i> Download PDF
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
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
                                <td>{{ $booking->booking_number }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status:</strong></td>
                                <td>
                            <span class="badge bg-{{ $booking->status == 'confirmed' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'secondary') }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Service Type:</strong></td>
                                <td>
                                    <span class="badge bg-info">{{ ucfirst($booking->service_type) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Booking Date:</strong></td>
                                <td>{{ $booking->booking_date ? $booking->booking_date->setTimezone(config('app.timezone'))->format('M d, Y H:i') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Estimated Date:</strong></td>
                                <td>{{ $booking->estimated_date ? $booking->estimated_date->format('M d, Y') : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Package Type:</strong></td>
                                <td>{{ ucfirst($booking->package_type ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Package Value:</strong></td>
                                <td>{{ $booking->goods_value_currency ?? 'USD' }} {{ number_format($booking->package_value ?? 0, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Length:</strong></td>
                                <td>{{ $booking->dimensions['length'] ?? 'N/A' }} cm</td>
                            </tr>
                            <tr>
                                <td><strong>Width:</strong></td>
                                <td>{{ $booking->dimensions['width'] ?? 'N/A' }} cm</td>
                            </tr>
                            <tr>
                                <td><strong>Height:</strong></td>
                                <td>{{ $booking->dimensions['height'] ?? 'N/A' }} cm</td>
                            </tr>
                            <tr>
                                <td><strong>Vol. Wt.:</strong></td>
                                <td>{{ $booking->dimensions['vol_weight'] ?? 'N/A' }} kg</td>
                            </tr>
                            <tr>
                                <td><strong>Ch. Wt.:</strong></td>
                                <td>{{ $booking->weight ?? 'N/A' }} kg</td>
                            </tr>
                            <tr>
                                <td><strong>HS Code:</strong></td>
                                <td>{{ $booking->hs_code ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Financial Instrument:</strong></td>
                                <td>{{ $booking->financial_instrument ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Form E Number:</strong></td>
                                <td>{{ $booking->form_e_number ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Inco Terms:</strong></td>
                                <td>{{ $booking->inco_terms ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Shipment Charges:</strong></td>
                                <td>{{ $booking->goods_value_currency ?? 'USD' }} {{ number_format($booking->shipment_charges ?? 0, 2) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                @if($booking->package_description)
                <div class="mt-3">
                    <h6>Description of Contents:</h6>
                    <p class="text-muted">{{ $booking->package_description }}</p>
                </div>
                @endif
                
                @if($booking->special_instructions)
                <div class="mt-3">
                    <h6>Special Instructions:</h6>
                    <p class="text-muted">{{ $booking->special_instructions }}</p>
                </div>
                @endif
                
                @if($booking->shipment_reference)
                <div class="mt-3">
                    <h6>Shipment Reference:</h6>
                    <p class="text-muted">{{ $booking->shipment_reference }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Shipper Information -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user me-2"></i>Shipper Information
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td>{{ $booking->shipper_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $booking->shipper_email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Phone:</strong></td>
                                <td>{{ $booking->shipper_phone }}</td>
                            </tr>
                            <tr>
                                <td><strong>Address:</strong></td>
                                <td>{{ $booking->shipper_address }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>City:</strong></td>
                                <td>{{ $booking->shipper_city ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>State:</strong></td>
                                <td>{{ $booking->shipper_state ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Zip Code:</strong></td>
                                <td>{{ $booking->shipper_zip ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Country:</strong></td>
                                <td>{{ $shipperCountry->name ?? $booking->shipper_country ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>CNIC:</strong></td>
                                <td>{{ $booking->shipper_cnic ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>NTN:</strong></td>
                                <td>{{ $booking->shipper_ntn ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Consignee Information -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user-tie me-2"></i>Consignee Information
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Name:</strong></td>
                                <td>{{ $booking->consignee_name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email:</strong></td>
                                <td>{{ $booking->consignee_email }}</td>
                            </tr>
                            <tr>
                                <td><strong>Phone:</strong></td>
                                <td>{{ $booking->consignee_phone }}</td>
                            </tr>
                            <tr>
                                <td><strong>Address:</strong></td>
                                <td>{{ $booking->consignee_address }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>City:</strong></td>
                                <td>{{ $booking->consignee_city ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>State:</strong></td>
                                <td>{{ $booking->consignee_state ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Zip Code:</strong></td>
                                <td>{{ $booking->consignee_zip ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <td><strong>Country:</strong></td>
                                <td>{{ $consigneeCountry->name ?? $booking->consignee_country ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Quick Actions -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-bolt me-2"></i>Quick Actions
                </h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                        <!-- Edit Button - Always Visible -->
                        <a href="{{ route('user.bookings.edit', $booking) }}" class="btn btn-primary">
                            <i class="fas fa-edit me-1"></i> Edit Booking
                        </a>
                        
                        @if($booking->status == 'pending')
                        <form method="POST" action="{{ route('user.bookings.confirm', $booking) }}" style="display: inline;">
                        @csrf
                            <button type="submit" class="btn btn-success w-100" 
                                    onclick="return confirm('Are you sure you want to confirm this booking? This will create a shipment and invoice.')">
                            <i class="fas fa-check me-1"></i> Confirm Booking
                        </button>
                    </form>
                @endif

                    <!-- Label Actions -->
                @if($booking->shipment)
                        <div class="border-top pt-3 mt-3">
                            <h6 class="text-muted mb-2">Label Actions</h6>
                            <form method="POST" action="{{ route('user.labels.generate', $booking->shipment) }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-warning w-100 mb-2">
                                    <i class="fas fa-tag me-1"></i> Generate New Label
                                </button>
                            </form>
                            
                            @if($booking->shipment->labels && $booking->shipment->labels->count() > 0)
                                <a href="{{ route('user.labels.show', $booking->shipment->labels->first()) }}" class="btn btn-outline-info w-100 mb-2">
                                    <i class="fas fa-eye me-1"></i> View Existing Label
                                </a>
                                <a href="{{ route('user.labels.download', $booking->shipment->labels->first()) }}" class="btn btn-outline-success w-100" target="_blank">
                                    <i class="fas fa-download me-1"></i> Download Label
                                </a>
                            @endif
                        </div>
                @endif

                    <!-- Invoice Actions -->
                    <!-- <div class="border-top pt-3 mt-3">
                        <h6 class="text-muted mb-2">Invoice Actions</h6>
                        <a href="{{ route('user.invoices.proforma', $booking) }}" class="btn btn-info w-100 mb-2" target="_blank">
                            <i class="fas fa-file-invoice me-1"></i> View Proforma
                        </a>
                        <a href="{{ route('user.invoices.proforma.pdf', $booking) }}" class="btn btn-outline-info w-100">
                            <i class="fas fa-download me-1"></i> Download PDF
                        </a>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- Package Details -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-box me-2"></i>Package Details
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Description:</strong></td>
                        <td>{{ $booking->package_description ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Weight:</strong></td>
                        <td>{{ $booking->weight ?? 'N/A' }} kg</td>
                    </tr>
                    <tr>
                        <td><strong>Dimensions:</strong></td>
                        <td>
                            @if($booking->dimensions)
                                {{ $booking->dimensions['length'] ?? 'N/A' }} x {{ $booking->dimensions['width'] ?? 'N/A' }} x {{ $booking->dimensions['height'] ?? 'N/A' }} cm
                            @else
                                N/A
                @endif
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Vol. Wt.:</strong></td>
                        <td>{{ $booking->dimensions['vol_weight'] ?? 'N/A' }} kg</td>
                    </tr>
                    <tr>
                        <td><strong>Value:</strong></td>
                        <td>{{ $booking->goods_value_currency ?? 'USD' }} {{ number_format($booking->package_value ?? 0, 2) }}</td>
                    </tr>
                    <tr>
                        <td><strong>HS Code:</strong></td>
                        <td>{{ $booking->hs_code ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Shipment Charges:</strong></td>
                        <td>{{ $booking->goods_value_currency ?? 'USD' }} {{ number_format($booking->shipment_charges ?? 0, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if($booking->shipment)
        <!-- Shipment Information -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-shipping-fast me-2"></i>Shipment Information
                </h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <td><strong>Tracking Number:</strong></td>
                        <td>{{ $booking->shipment->tracking_number }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            <span class="badge bg-{{ $booking->shipment->status == 'delivered' ? 'success' : 'info' }}">
                            {{ ucfirst(str_replace('_', ' ', $booking->shipment->status)) }}
                        </span>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Shipping Date:</strong></td>
                        <td>{{ $booking->shipment->shipping_date->format('M d, Y H:i') }}</td>
                    </tr>
                    @if($booking->shipment->estimated_delivery)
                    <tr>
                        <td><strong>Estimated Delivery:</strong></td>
                        <td>{{ $booking->shipment->estimated_delivery->format('M d, Y H:i') }}</td>
                    </tr>
                    @endif
                </table>
                
                <div class="mt-3">
                    <div class="row">
                        <div class="col-6">
                            <form method="POST" action="{{ route('user.labels.generate', $booking->shipment) }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm w-100">
                                    <i class="fas fa-tag me-1"></i> Generate Label
                                </button>
                            </form>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-outline-info btn-sm w-100" data-bs-toggle="modal" data-bs-target="#trackingModal">
                                <i class="fas fa-route me-1"></i> Update Tracking
                            </button>
                        </div>
                </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Payment Status and Mark as Paid -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-credit-card me-2"></i>Payment Status
                </h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Payment Status:</strong></p>
                        <span class="badge bg-{{ $booking->payment_status == 'paid' ? 'success' : 'warning' }} fs-6">
                            {{ ucfirst($booking->payment_status ?? 'unpaid') }}
                        </span>
                    </div>
                    <div class="col-md-6">
                        @if($booking->payment_status != 'paid')
                        <form method="POST" action="{{ route('user.bookings.mark-paid', $booking) }}" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-success" 
                                    onclick="return confirm('Are you sure you want to mark this booking as paid?')">
                                <i class="fas fa-check me-1"></i> Mark as Paid
                            </button>
                        </form>
                        @else
                        <p class="text-success mb-0">
                            <i class="fas fa-check-circle me-1"></i> Payment Completed
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tracking Update Modal -->
@if($booking->shipment)
<div class="modal fade" id="trackingModal" tabindex="-1" aria-labelledby="trackingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trackingModalLabel">
                    <i class="fas fa-route me-2"></i>Update Tracking Status
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('user.shipments.update-tracking', $booking->shipment) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tracking_number" class="form-label">Tracking Number</label>
                        <input type="text" class="form-control" id="tracking_number" name="tracking_number" 
                               value="{{ $booking->shipment->tracking_number }}" required>
                        <small class="form-text text-muted">Update the tracking number if needed</small>
                    </div>
                    <div class="mb-3">
                        <label for="tracking_status" class="form-label">Tracking Status</label>
                        <select class="form-control no-select2" id="tracking_status" name="status" required>
                            <option value="pending" {{ $booking->shipment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="picked_up" {{ $booking->shipment->status == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                            <option value="in_transit" {{ $booking->shipment->status == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                            <option value="out_for_delivery" {{ $booking->shipment->status == 'out_for_delivery' ? 'selected' : '' }}>Out for Delivery</option>
                            <option value="delivered" {{ $booking->shipment->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="returned" {{ $booking->shipment->status == 'returned' ? 'selected' : '' }}>Returned</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tracking_notes" class="form-label">Tracking Notes</label>
                        <textarea class="form-control" id="tracking_notes" name="tracking_notes" rows="3" placeholder="Add tracking notes or location updates..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="estimated_delivery" class="form-label">Estimated Delivery</label>
                        <input type="datetime-local" class="form-control" id="estimated_delivery" name="estimated_delivery" 
                               value="{{ $booking->shipment->estimated_delivery ? $booking->shipment->estimated_delivery->format('Y-m-d\TH:i') : '' }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update Tracking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection

