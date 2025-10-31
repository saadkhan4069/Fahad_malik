<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Label;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TrackingController extends Controller
{
    public function index()
    {
        return view('tracking.index');
    }

    public function track(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string|max:255'
        ]);

        $trackingNumber = $request->tracking_number;
        
        // Search for shipment by tracking number
        $shipment = Shipment::where('tracking_number', $trackingNumber)->first();
        
        if (!$shipment) {
            return redirect()->back()->with('error', 'No shipment found with tracking number: ' . $trackingNumber);
        }

        // Get tracking events for this shipment
        $trackingEvents = $this->getTrackingEvents($shipment);
        
        return view('tracking.result', compact('shipment', 'trackingEvents', 'trackingNumber'));
    }

    private function getTrackingEvents($shipment)
    {
        $events = [];
        
        // Event 1: Shipment Booked
        $events[] = [
            'id' => 1,
            'title' => 'Shipment Booked',
            'description' => 'Your shipment has been booked and is being prepared for pickup.',
            'date' => $shipment->created_at->format('Y-m-d'),
            'time' => $shipment->created_at->format('H:i'),
            'location' => $shipment->origin_address ?? 'Origin',
            'status' => 'completed',
            'icon' => 'fas fa-calendar-plus'
        ];

        // Event 2: Handed Over to Courier
        $events[] = [
            'id' => 2,
            'title' => 'Handed Over to Courier',
            'description' => 'Shipment has been handed over to our logistics partner.',
            'date' => $shipment->created_at->addHours(2)->format('Y-m-d'),
            'time' => $shipment->created_at->addHours(2)->format('H:i'),
            'location' => $shipment->origin_address ?? 'Origin',
            'status' => 'completed',
            'icon' => 'fas fa-handshake'
        ];

        // Event 3: In Transit
        $inTransitDate = $shipment->created_at->addDays(1);
        $events[] = [
            'id' => 3,
            'title' => 'In Transit',
            'description' => 'Your shipment is on its way to the destination.',
            'date' => $inTransitDate->format('Y-m-d'),
            'time' => $inTransitDate->format('H:i'),
            'location' => 'In Transit',
            'status' => $shipment->status === 'in_transit' || $shipment->status === 'out_for_delivery' || $shipment->status === 'delivered' ? 'completed' : 'pending',
            'icon' => 'fas fa-truck'
        ];

        // Event 4: At Destination Warehouse
        $warehouseDate = $shipment->created_at->addDays(2);
        $events[] = [
            'id' => 4,
            'title' => 'At Destination Warehouse',
            'description' => 'Shipment has arrived at the destination warehouse.',
            'date' => $warehouseDate->format('Y-m-d'),
            'time' => $warehouseDate->format('H:i'),
            'location' => $shipment->destination_address ?? 'Destination',
            'status' => $shipment->status === 'out_for_delivery' || $shipment->status === 'delivered' ? 'completed' : 'pending',
            'icon' => 'fas fa-warehouse'
        ];

        // Event 5: Out for Delivery
        $deliveryDate = $shipment->created_at->addDays(3);
        $events[] = [
            'id' => 5,
            'title' => 'Out for Delivery',
            'description' => 'Your shipment is out for delivery and will reach you soon.',
            'date' => $deliveryDate->format('Y-m-d'),
            'time' => $deliveryDate->format('H:i'),
            'location' => $shipment->destination_address ?? 'Destination',
            'status' => $shipment->status === 'out_for_delivery' || $shipment->status === 'delivered' ? 'completed' : 'pending',
            'icon' => 'fas fa-shipping-fast'
        ];

        // Event 6: Delivered
        $deliveredDate = $shipment->created_at->addDays(4);
        $events[] = [
            'id' => 6,
            'title' => 'Delivered',
            'description' => 'Your shipment has been successfully delivered.',
            'date' => $deliveredDate->format('Y-m-d'),
            'time' => $deliveredDate->format('H:i'),
            'location' => $shipment->destination_address ?? 'Destination',
            'status' => $shipment->status === 'delivered' ? 'completed' : 'pending',
            'icon' => 'fas fa-check-circle'
        ];

        return $events;
    }
}