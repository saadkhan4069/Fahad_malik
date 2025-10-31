<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Shipment;
use App\Models\Invoice;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $company = Auth::guard('company')->user();
        
        // Get dashboard statistics
        $stats = [
            'total_bookings' => $company->bookings()->count(),
            'pending_bookings' => $company->bookings()->where('status', 'pending')->count(),
            'confirmed_bookings' => $company->bookings()->where('status', 'confirmed')->count(),
            'total_shipments' => $company->shipments()->count(),
            'active_shipments' => $company->shipments()->whereIn('status', ['pending', 'picked_up', 'in_transit', 'out_for_delivery'])->count(),
            'delivered_shipments' => $company->shipments()->where('status', 'delivered')->count(),
            'total_invoices' => $company->invoices()->count(),
            'unpaid_invoices' => $company->invoices()->where('payment_status', 'unpaid')->count(),
            'overdue_invoices' => $company->invoices()->where('due_date', '<', now())->where('payment_status', 'unpaid')->count(),
            'total_revenue' => $company->invoices()->where('payment_status', 'paid')->sum('total_amount'),
        ];
        
        // Get recent bookings
        $recent_bookings = $company->bookings()->with(['shipment'])->latest()->limit(5)->get();
        
        // Get recent shipments
        $recent_shipments = $company->shipments()->with(['booking'])->latest()->limit(5)->get();
        
        // Get recent invoices
        $recent_invoices = $company->invoices()->with(['booking', 'shipment'])->latest()->limit(5)->get();
        
        return view('dashboard-new', compact('stats', 'recent_bookings', 'recent_shipments', 'recent_invoices'));
    }

    public function updateShipmentTracking(Request $request, Shipment $shipment)
    {
        // Check if company owns this shipment
        if ($shipment->company_id !== Auth::guard('company')->id()) {
            abort(403, 'Unauthorized access to this shipment.');
        }
        
        $request->validate([
            'tracking_number' => 'required|string|max:255|unique:shipments,tracking_number,' . $shipment->id,
            'status' => 'required|in:pending,picked_up,in_transit,out_for_delivery,delivered,returned',
            'tracking_notes' => 'nullable|string|max:1000',
            'estimated_delivery' => 'nullable|date',
        ]);

        $shipment->update([
            'tracking_number' => $request->tracking_number,
            'status' => $request->status,
            'tracking_notes' => $request->tracking_notes,
            'estimated_delivery' => $request->estimated_delivery ? \Carbon\Carbon::parse($request->estimated_delivery) : null,
        ]);

        return redirect()->back()->with('success', 'Tracking information updated successfully!');
    }
}
