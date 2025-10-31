<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Shipment;
use App\Models\Invoice;
use App\Models\Label;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LabelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get dashboard statistics for the logged-in user
        $stats = [
            'total_bookings' => $user->bookings()->count(),
            'pending_bookings' => $user->bookings()->where('status', 'pending')->count(),
            'confirmed_bookings' => $user->bookings()->where('status', 'confirmed')->count(),
            'total_shipments' => $user->shipments()->count(),
            'active_shipments' => $user->shipments()->whereIn('status', ['pending', 'picked_up', 'in_transit', 'out_for_delivery'])->count(),
            'delivered_shipments' => $user->shipments()->where('status', 'delivered')->count(),
            'total_invoices' => $user->invoices()->count(),
            'unpaid_invoices' => $user->invoices()->where('payment_status', 'unpaid')->count(),
            'overdue_invoices' => $user->invoices()->where('due_date', '<', now())->where('payment_status', 'unpaid')->count(),
            'total_revenue' => $user->invoices()->where('payment_status', 'paid')->sum('total_amount'),
        ];
        
        // Get recent bookings for the user
        $recent_bookings = $user->bookings()->with(['shipment'])->latest()->limit(5)->get();
        
        // Get recent shipments for the user
        $recent_shipments = $user->shipments()->with(['booking'])->latest()->limit(5)->get();
        
        // Get recent invoices for the user
        $recent_invoices = $user->invoices()->with(['booking', 'shipment'])->latest()->limit(5)->get();
        
        return view('user.dashboard-new', compact('stats', 'recent_bookings', 'recent_shipments', 'recent_invoices', 'user'));
    }

    public function updateShipmentTracking(Request $request, Shipment $shipment)
    {
        // Check if user owns this shipment
        if ($shipment->user_id !== Auth::id()) {
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

    public function invoices()
    {
        $user = Auth::user();
        $invoices = $user->invoices()->with(['booking', 'shipment'])->latest()->paginate(10);
        
        return view('user.invoices.index', compact('invoices'));
    }

    public function showInvoice(Invoice $invoice)
    {
        // Check if user owns this invoice
        if ($invoice->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this invoice.');
        }
        
        $invoice->load(['booking', 'shipment']);
        return view('user.invoices.show', compact('invoice'));
    }

    public function invoicePdf(Invoice $invoice)
    {
        // Check if user owns this invoice
        if ($invoice->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this invoice.');
        }
        
        // Use the existing InvoiceController method
        return app(InvoiceController::class)->generatePdf($invoice);
    }

    public function labels()
    {
        $user = Auth::user();
        $labels = Label::whereHas('shipment', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with(['shipment.booking'])->latest()->paginate(10);
        
        return view('user.labels.index', compact('labels'));
    }

    public function showLabel(Label $label)
    {
        // Check if user owns this label through shipment
        if ($label->shipment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this label.');
        }
        
        $label->load(['shipment.booking']);
        return view('user.labels.show', compact('label'));
    }

    public function downloadLabel(Label $label)
    {
        // Check if user owns this label through shipment
        if ($label->shipment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this label.');
        }
        
        // Use the existing LabelController method
        return app(LabelController::class)->downloadPdf($label);
    }
}
