@extends('layouts.app')

@section('title', 'Label Details')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Label Details</h1>
    <div>
        <a href="{{ route('user.labels.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Back to Labels
        </a>
        <a href="{{ route('user.labels.download', $label) }}" class="btn btn-success" target="_blank">
            <i class="fas fa-download me-1"></i> Download PDF
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-tags me-2"></i>Label Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Label Number:</strong>
                        <p>{{ $label->label_number }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Label Type:</strong>
                        <p><span class="badge bg-info">{{ ucfirst($label->label_type) }}</span></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Status:</strong>
                        <p>
                            <span class="badge bg-{{ $label->status == 'generated' ? 'success' : 'warning' }}">
                                {{ ucfirst($label->status) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Generated At:</strong>
                        <p>{{ $label->generated_at->format('M d, Y H:i') }}</p>
                    </div>
                    @if($label->printed_at)
                    <div class="col-md-6 mb-3">
                        <strong>Printed At:</strong>
                        <p>{{ $label->printed_at->format('M d, Y H:i') }}</p>
                    </div>
                    @endif
                    @if($label->file_size)
                    <div class="col-md-6 mb-3">
                        <strong>File Size:</strong>
                        <p>{{ number_format($label->file_size / 1024, 2) }} KB</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Shipment Information -->
        <div class="card shadow mt-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-shipping-fast me-2"></i>Shipment Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Tracking Number:</strong>
                        <p class="h6 text-primary">{{ $label->individual_tracking_number ?? $label->shipment->tracking_number }}</p>
                        @if($label->individual_tracking_number)
                            <small class="text-muted">Individual tracking for this label</small>
                        @else
                            <small class="text-muted">Shared tracking with shipment</small>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Status:</strong>
                        <p>
                            <span class="badge bg-info">
                                {{ ucfirst(str_replace('_', ' ', $label->individual_status ?? $label->shipment->status)) }}
                            </span>
                        </p>
                        @if($label->individual_status)
                            <small class="text-muted">Individual status for this label</small>
                        @else
                            <small class="text-muted">Shared status with shipment</small>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Origin:</strong>
                        <p>{{ $label->shipment->origin_address }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Destination:</strong>
                        <p>{{ $label->shipment->destination_address }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Weight:</strong>
                        <p>{{ $label->shipment->weight }} kg</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Shipping Cost:</strong>
                        <p class="h6 text-primary">PKR {{ number_format($label->shipment->shipping_cost, 2) }}</p>
                    </div>
                </div>
                
                <!-- Tracking Update Button -->
                <div class="mt-3">
                    <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#labelTrackingModal">
                        <i class="fas fa-route me-1"></i> Update Tracking for This Label
                    </button>
                </div>
            </div>
        </div>

        <!-- Booking Information -->
        <div class="card shadow mt-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-calendar-alt me-2"></i>Booking Information
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Booking Number:</strong>
                        <p>{{ $label->shipment->booking->booking_number }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Service Type:</strong>
                        <p><span class="badge bg-info">{{ ucfirst($label->shipment->booking->service_type) }}</span></p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Shipper:</strong>
                        <p>{{ $label->shipment->booking->shipper_name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Consignee:</strong>
                        <p>{{ $label->shipment->booking->consignee_name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Label Preview -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-eye me-2"></i>Label Preview
                </h5>
            </div>
            <div class="card-body text-center">
                @if($label->file_path && file_exists(public_path('storage/' . $label->file_path)))
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $label->file_path) }}" 
                             alt="Label Preview" 
                             class="img-fluid border"
                             style="max-height: 300px;">
                    </div>
                @else
                    <div class="mb-3">
                        <i class="fas fa-file-pdf fa-4x text-muted"></i>
                    </div>
                    <p class="text-muted">PDF label preview not available</p>
                @endif
                
                <a href="{{ route('user.labels.download', $label) }}" class="btn btn-primary w-100" target="_blank">
                    <i class="fas fa-download me-1"></i> Download Label
                </a>
            </div>
        </div>

      

<!-- Label-Specific Tracking Update Modal -->
<div class="modal fade" id="labelTrackingModal" tabindex="-1" aria-labelledby="labelTrackingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelTrackingModalLabel">
                    <i class="fas fa-route me-2"></i>Update Tracking for Label: {{ $label->label_number }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('user.labels.update-tracking', $label) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Note:</strong> This will update tracking information specifically for this label ({{ $label->label_number }}).
                    </div>
                    
                    <div class="mb-3">
                        <label for="label_tracking_number" class="form-label">Tracking Number</label>
                        <input type="text" class="form-control" id="label_tracking_number" name="tracking_number" 
                               value="{{ $label->individual_tracking_number ?? $label->shipment->tracking_number }}" required>
                        <small class="form-text text-muted">Update the tracking number for this specific label only</small>
                    </div>
                    <div class="mb-3">
                        <label for="label_tracking_status" class="form-label">Tracking Status</label>
                        <select class="form-control" id="label_tracking_status" name="status" required>
                            @php
                                $currentStatus = $label->individual_status ?? $label->shipment->status;
                            @endphp
                            <option value="pending" {{ $currentStatus == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="picked_up" {{ $currentStatus == 'picked_up' ? 'selected' : '' }}>Picked Up</option>
                            <option value="in_transit" {{ $currentStatus == 'in_transit' ? 'selected' : '' }}>In Transit</option>
                            <option value="out_for_delivery" {{ $currentStatus == 'out_for_delivery' ? 'selected' : '' }}>Out for Delivery</option>
                            <option value="delivered" {{ $currentStatus == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="returned" {{ $currentStatus == 'returned' ? 'selected' : '' }}>Returned</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="label_tracking_notes" class="form-label">Tracking Notes</label>
                        <textarea class="form-control" id="label_tracking_notes" name="tracking_notes" rows="3" placeholder="Add tracking notes specific to this label...">{{ $label->individual_tracking_notes }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="label_estimated_delivery" class="form-label">Estimated Delivery</label>
                        <input type="datetime-local" class="form-control" id="label_estimated_delivery" name="estimated_delivery" 
                               value="{{ $label->individual_estimated_delivery ? $label->individual_estimated_delivery->format('Y-m-d\TH:i') : '' }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Update Tracking for This Label
                    </button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection



