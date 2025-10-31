@extends('layouts.app')

@section('title', 'My Labels')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">My Labels</h1>
</div>

<div class="card shadow">
    <div class="card-body">
        @if($labels->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover">
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
                        @foreach($labels as $label)
                        <tr>
                            <td>
                                <strong>{{ $label->label_number }}</strong>
                            </td>
                            <td>
                                {{ $label->individual_tracking_number ?? $label->shipment->tracking_number }}
                                @if($label->individual_tracking_number)
                                    <br><small class="text-muted">Individual</small>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-info">{{ ucfirst($label->label_type) }}</span>
                            </td>
                            <td>
                                @php
                                    $currentStatus = $label->individual_status ?? $label->shipment->status;
                                @endphp
                                <span class="badge bg-{{ $currentStatus == 'delivered' ? 'success' : ($currentStatus == 'in_transit' ? 'info' : 'warning') }}">
                                    {{ ucfirst(str_replace('_', ' ', $currentStatus)) }}
                                </span>
                                @if($label->individual_status)
                                    <br><small class="text-muted">Individual</small>
                                @endif
                            </td>
                            <td>{{ $label->generated_at->format('M d, Y H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('user.labels.show', $label) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('user.labels.download', $label) }}" class="btn btn-sm btn-outline-success" target="_blank">
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
                {{ $labels->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No labels found</h5>
                <p class="text-muted">Labels will appear here once your bookings are confirmed and shipments are created.</p>
            </div>
        @endif
    </div>
</div>
@endsection



