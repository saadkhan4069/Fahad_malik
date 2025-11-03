<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Shipment;
use App\Models\Invoice;
use App\Models\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UserBookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $bookings = $user->bookings()->with(['shipment', 'invoices'])->latest()->paginate(10);
        
        return view('user.bookings.index', compact('bookings'));
    }

    public function getBookingsData(Request $request)
    {
        $user = Auth::user();
        
        $query = $user->bookings()->with(['shipment', 'invoices']);
        
        // Search functionality
        if ($request->has('search') && !empty($request->search['value'])) {
            $searchValue = $request->search['value'];
            $query->where(function($q) use ($searchValue) {
                $q->where('booking_number', 'like', "%{$searchValue}%")
                  ->orWhere('shipper_name', 'like', "%{$searchValue}%")
                  ->orWhere('consignee_name', 'like', "%{$searchValue}%")
                  ->orWhere('service_type', 'like', "%{$searchValue}%")
                  ->orWhere('status', 'like', "%{$searchValue}%");
            });
        }
        
        // Order by
        $orderColumn = $request->order[0]['column'] ?? 0;
        $orderDir = $request->order[0]['dir'] ?? 'desc';
        
        $columns = ['booking_number', 'shipper_name', 'consignee_name', 'service_type', 'status', 'total_cost', 'booking_date'];
        $orderBy = $columns[$orderColumn] ?? 'booking_date';
        
        if ($orderBy === 'booking_date') {
            $query->orderBy('created_at', $orderDir);
        } else {
            $query->orderBy($orderBy, $orderDir);
        }
        
        // Pagination
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;
        
        $totalRecords = $user->bookings()->count();
        $bookings = $query->skip($start)->take($length)->get();
        
        $data = [];
        foreach ($bookings as $booking) {
            $data[] = [
                'booking_number' => '<strong>' . $booking->booking_number . '</strong>',
                'shipper_name' => $booking->shipper_name,
                'consignee_name' => $booking->consignee_name,
                'service_type' => '<span class="badge bg-info">' . ucfirst($booking->service_type) . '</span>',
                'status' => '<span class="badge bg-' . ($booking->status == 'confirmed' ? 'success' : ($booking->status == 'pending' ? 'warning' : 'secondary')) . '">' . ucfirst($booking->status) . '</span>',
                'total_cost' => ($booking->goods_value_currency ?? 'PKR') . ' ' . number_format($booking->total_cost, 2),
                'booking_date' => $booking->booking_date->format('M d, Y'),
                'actions' => $this->getUserActionButtons($booking)
            ];
        }
        
        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data
        ]);
    }
    
    private function getUserActionButtons($booking)
    {
        $buttons = '<div class="btn-group" role="group">';
        $buttons .= '<a href="' . route('user.bookings.show', $booking) . '" class="btn btn-sm btn-outline-primary" title="View"><i class="fas fa-eye"></i></a>';
        
        // Edit button - Always visible
        $buttons .= '<a href="' . route('user.bookings.edit', $booking) . '" class="btn btn-sm btn-primary" title="Edit"><i class="fas fa-edit"></i></a>';
        
        if ($booking->status == 'pending') {
            $buttons .= '<form method="POST" action="' . route('user.bookings.confirm', $booking) . '" style="display: inline;">';
            $buttons .= csrf_field();
            $buttons .= '<button type="submit" class="btn btn-sm btn-outline-success" onclick="return confirm(\'Are you sure you want to confirm this booking?\')" title="Confirm"><i class="fas fa-check"></i></button>';
            $buttons .= '</form>';
        }
        
        // Add label generation button if shipment exists
        if ($booking->shipment) {
            $buttons .= '<form method="POST" action="' . route('user.labels.generate', $booking->shipment) . '" style="display: inline;">';
            $buttons .= csrf_field();
            $buttons .= '<button type="submit" class="btn btn-sm btn-outline-warning" title="Generate Label"><i class="fas fa-tag"></i></button>';
            $buttons .= '</form>';
        }
        
        // Add view label button if shipment and label exist
        if ($booking->shipment && $booking->shipment->labels && $booking->shipment->labels->count() > 0) {
            $labelCount = $booking->shipment->labels->count();
            $buttons .= '<a href="' . route('user.labels.show', $booking->shipment->labels->first()) . '" class="btn btn-sm btn-outline-info" title="View Label (' . $labelCount . ' label' . ($labelCount > 1 ? 's' : '') . ')"><i class="fas fa-eye"></i></a>';
        }
        
        $buttons .= '</div>';
        return $buttons;
    }

    public function create()
    {
        $services = \DB::table('services')->get();
        $countries = \DB::table('countries')->get();
        $currencies = \DB::table('currencies')->get();
        $units = \DB::table('units')->get();
        $branches = \DB::table('branches')->get();
        
        return view('user.bookings.create', compact('services', 'countries', 'currencies', 'units', 'branches'));
    }

    public function store(Request $request)
    {
        try {
            // Debug: Log the request data
            \Log::info('User Booking form submitted with data:', $request->all());
            
            $request->validate([
                'estimated_date' => 'required|date',
                'service' => 'required|string',
                'shipper_name' => 'required|string|max:255',
                'shipper_email' => 'nullable|email|max:255',
                'shipper_address' => 'nullable|string|max:255',
                'shipper_city' => 'nullable|string|max:255',
                'shipper_country' => 'nullable|string|max:255',
                'shipper_state' => 'nullable|string|max:255',
                'shipper_phone' => 'nullable|string|max:20',
                'shipper_cnic' => 'nullable|string|max:20',
                'shipper_ntn' => 'nullable|string|max:20',
                'shipper_zip' => 'nullable|string|max:20',
                'consignee_name' => 'required|string|max:255',
                'consignee_email' => 'nullable|email|max:255',
                'consignee_address' => 'nullable|string|max:255',
                'consignee_city' => 'nullable|string|max:255',
                'consignee_country' => 'nullable|string|max:255',
                'consignee_state' => 'nullable|string|max:255',
                'consignee_phone' => 'nullable|string|max:20',
                'consignee_zip' => 'nullable|string|max:20',
                'package_type' => 'required|string|max:50',
                'package_value' => 'required|numeric|min:0',
                'length' => 'required|numeric|min:0.1',
                'width' => 'required|numeric|min:0.1',
                'height' => 'required|numeric|min:0.1',
                'weight' => 'required|numeric|min:0.1',
                'package_description' => 'required|string|max:1000',
                'hs_code' => 'nullable|string|max:20',
                'financial_instrument' => 'nullable|in:Y,N',
                'form_e_number' => 'nullable|string|max:50',
                'shipment_charges' => 'required|numeric|min:0',
                'inco_terms' => 'nullable|string|max:10',
                'shipment_reference' => 'required|string|max:255',
                'special_instructions' => 'required|string|max:1000',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('User Booking Validation failed:', $e->errors());
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        }

        $user = Auth::user();
        
        // Validate user has company_id
        if (!$user->company_id) {
            return redirect()->back()
                ->withErrors(['error' => 'Your account is not associated with a company. Please contact administrator.'])
                ->withInput();
        }
        
        // Calculate volume weight
        $length = $request->length ?? 10;
        $width = $request->width ?? 10;
        $height = $request->height ?? 10;
        $weight = $request->weight ?? 1;
        $volWeight = ($length * $width * $height) / 5000;
        
        // Calculate shipping cost based on weight, dimensions, and service type
        $shippingCost = $this->calculateShippingCost(
            $weight,
            $length,
            $width,
            $height,
            $request->service
        );

        // Generate unique CN Number (Consignment Note Number) with retry logic
        $cnNumber = null;
        $attempts = 0;
        do {
            $cnNumber = $user->company_id . str_pad(rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $exists = Booking::where('cn_number', $cnNumber)->exists();
            $attempts++;
        } while ($exists && $attempts < 10);
        
        if ($attempts >= 10) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to generate unique CN number. Please try again.'])
                ->withInput();
        }
        
        // Generate unique booking number with retry logic
        $bookingNumber = null;
        $attempts = 0;
        do {
            $bookingNumber = 'BK' . strtoupper(Str::random(8));
            $exists = Booking::where('booking_number', $bookingNumber)->exists();
            $attempts++;
        } while ($exists && $attempts < 10);
        
        if ($attempts >= 10) {
            return redirect()->back()
                ->withErrors(['error' => 'Failed to generate unique booking number. Please try again.'])
                ->withInput();
        }
        
        try {
            $booking = Booking::create([
                'company_id' => $user->company_id,
                'user_id' => $user->id,
                'booking_number' => $bookingNumber,
                'cn_number' => $cnNumber,
                'status' => 'confirmed',
                'shipper_name' => $request->shipper_name,
                'shipper_email' => $request->shipper_email,
                'shipper_phone' => $request->shipper_phone,
                'shipper_address' => $request->shipper_address,
                'shipper_city' => $request->shipper_city,
                'shipper_country' => $request->shipper_country,
                'shipper_state' => $request->shipper_state,
                'shipper_zip' => $request->shipper_zip ?? '',
                'shipper_cnic' => $request->shipper_cnic,
                'shipper_ntn' => $request->shipper_ntn ?? '',
                'consignee_name' => $request->consignee_name,
                'consignee_email' => $request->consignee_email,
                'consignee_phone' => $request->consignee_phone,
                'consignee_address' => $request->consignee_address,
                'consignee_city' => $request->consignee_city,
                'consignee_country' => $request->consignee_country,
                'consignee_state' => $request->consignee_state,
                'consignee_zip' => $request->consignee_zip ?? '',
                'package_description' => $request->package_description,
                'package_value' => (float)($request->package_value ?? 0),
                'weight' => (float)($weight),
                'dimensions' => [
                    'length' => (float)($length),
                    'width' => (float)($width),
                    'height' => (float)($height),
                    'vol_weight' => (float)($volWeight)
                ],
                'service_type' => $request->service,
                'dox_type' => $request->package_type ?? 'NON-DOX',
                'pickup_date' => $request->estimated_date ? \Carbon\Carbon::parse($request->estimated_date) : now(),
                'hs_code' => $request->hs_code ?? '',
                'financial_instrument' => $request->financial_instrument ?? '',
                'form_e_number' => $request->form_e_number ?? '',
                'inco_terms' => $request->inco_terms,
                'special_instructions' => $request->special_instructions,
                'shipment_charges' => (float)($request->shipment_charges ?? 0),
                'estimated_date' => $request->estimated_date,
                'shipment_reference' => $request->shipment_reference,
                'total_cost' => $shippingCost,
                'booking_date' => now()->setTimezone(config('app.timezone')),
            ]);

            \Log::info('User Booking created successfully:', ['booking_id' => $booking->id]);

            // Auto-create shipment and invoice since booking is confirmed
            $shipment = Shipment::create([
                'company_id' => $booking->company_id,
                'user_id' => $booking->user_id,
                'booking_id' => $booking->id,
                'tracking_number' => str_pad(rand(1000000000, 9999999999), 10, '0', STR_PAD_LEFT),
                'status' => 'pending',
                'origin_address' => $booking->shipper_address,
                'destination_address' => $booking->consignee_address,
                'origin_city' => $booking->shipper_city,
                'destination_city' => $booking->consignee_city,
                'origin_country' => $booking->shipper_country,
                'destination_country' => $booking->consignee_country,
                'weight' => $booking->weight,
                'dimensions' => $booking->dimensions,
                'shipping_date' => $booking->pickup_date,
                'shipping_cost' => $booking->total_cost,
            ]);

            // Create invoice
            $invoice = Invoice::create([
                'company_id' => $booking->company_id,
                'user_id' => $booking->user_id,
                'booking_id' => $booking->id,
                'shipment_id' => $shipment->id,
                'invoice_number' => 'INV' . strtoupper(Str::random(8)),
                'invoice_date' => now()->toDateString(),
                'due_date' => now()->addDays(30)->toDateString(),
                'status' => 'sent',
                'subtotal' => $booking->total_cost,
                'tax_amount' => $booking->total_cost * 0.05, // 5% tax
                'total_amount' => $booking->total_cost * 1.05,
            ]);

            return redirect()->route('user.bookings.show', $booking)->with('success', 'Booking created and confirmed successfully!');
        } catch (\Illuminate\Database\QueryException $e) {
            \Log::error('Database error creating user booking:', [
                'error' => $e->getMessage(),
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString()
            ]);
            
            $errorMessage = 'Failed to create booking. ';
            
            // Check for specific database errors
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                if (strpos($e->getMessage(), 'booking_number') !== false) {
                    $errorMessage .= 'Booking number already exists. Please try again.';
                } elseif (strpos($e->getMessage(), 'cn_number') !== false) {
                    $errorMessage .= 'CN number already exists. Please try again.';
                } else {
                    $errorMessage .= 'Duplicate entry detected. Please try again.';
                }
            } elseif (strpos($e->getMessage(), 'Column') !== false && strpos($e->getMessage(), 'cannot be null') !== false) {
                $errorMessage .= 'Some required fields are missing. Please fill all required fields.';
            } else {
                $errorMessage .= 'Database error: ' . $e->getMessage();
            }
            
            return redirect()->back()
                ->withErrors(['error' => $errorMessage])
                ->withInput();
        } catch (\Exception $e) {
            \Log::error('Error creating user booking:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->except(['password', '_token'])
            ]);
            
            $errorMessage = 'Failed to create booking. ';
            
            // More specific error messages
            if (strpos($e->getMessage(), 'Invalid datetime format') !== false) {
                $errorMessage .= 'Invalid date format. Please check your date fields.';
            } elseif (strpos($e->getMessage(), 'Incorrect decimal value') !== false) {
                $errorMessage .= 'Invalid numeric value. Please check your numeric fields.';
            } elseif (strpos($e->getMessage(), 'Data too long') !== false) {
                $errorMessage .= 'Some fields contain too much data. Please shorten your input.';
            } else {
                $errorMessage .= 'Error: ' . $e->getMessage();
            }
            
            return redirect()->back()
                ->withErrors(['error' => $errorMessage])
                ->withInput();
        }
    }

    public function show(Booking $booking)
    {
        // Check if user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking.');
        }
        
        $booking->load(['shipment', 'invoices', 'company', 'user']);
        
        // Get country names
        $shipperCountry = \DB::table('countries')->where('code', $booking->shipper_country)->first();
        $consigneeCountry = \DB::table('countries')->where('code', $booking->consignee_country)->first();
        
        return view('user.bookings.show', compact('booking', 'shipperCountry', 'consigneeCountry'));
    }

    public function edit(Booking $booking)
    {
        // Check if user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking.');
        }
        
        return view('user.bookings.edit', compact('booking'));
    }

    public function update(Request $request, Booking $booking)
    {
        // Check if user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking.');
        }
        
        $request->validate([
            'shipper_name' => 'required|string|max:255',
            'shipper_email' => 'nullable|email|max:255',
            'shipper_phone' => 'nullable|string|max:20',
            'shipper_address' => 'nullable|string|max:500',
            'shipper_city' => 'nullable|string|max:255',
            'shipper_state' => 'nullable|string|max:255',
            'shipper_zip' => 'nullable|string|max:20',
            'shipper_country' => 'required|string|max:255',
            'shipper_cnic' => 'nullable|string|max:20',
            'consignee_name' => 'required|string|max:255',
            'consignee_email' => 'nullable|email|max:255',
            'consignee_phone' => 'nullable|string|max:20',
            'consignee_address' => 'nullable|string|max:500',
            'consignee_city' => 'nullable|string|max:255',
            'consignee_state' => 'nullable|string|max:255',
            'consignee_zip' => 'nullable|string|max:20',
            'consignee_country' => 'required|string|max:255',
            'consignee_attention' => 'nullable|string|max:255',
            'service' => 'required|string|max:255',
            'package_type' => 'required|string|max:255',
            'package_description' => 'nullable|string',
            'weight' => 'nullable|numeric|min:0',
            'length' => 'nullable|numeric|min:0',
            'width' => 'nullable|numeric|min:0',
            'height' => 'nullable|numeric|min:0',
            'package_value' => 'nullable|numeric|min:0',
            'hs_code' => 'nullable|string|max:20',
            'quantity' => 'nullable|integer|min:1',
            'rate' => 'nullable|numeric|min:0',
            'unit' => 'nullable|string|max:20',
            'total_cost' => 'nullable|numeric|min:0',
            'dox_type' => 'nullable|string|max:255',
            'goods_value' => 'nullable|numeric|min:0',
            'goods_value_currency' => 'nullable|string|max:10',
            'export_reason' => 'nullable|string|max:255',
            'financial_instrument' => 'nullable|string|max:255',
            'inco_terms' => 'nullable|string|max:10',
            'estimated_date' => 'nullable|date',
            'shipment_charges' => 'nullable|numeric|min:0',
            'shipment_reference' => 'nullable|string|max:255',
            'special_instructions' => 'nullable|string',
        ]);

        // Prepare data for update
        $data = $request->all();
        
        // Handle dimensions array
        if ($request->has(['length', 'width', 'height'])) {
            $data['dimensions'] = [
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
            ];
        }
        
        $booking->update($data);

        return redirect()->route('user.bookings.show', $booking)->with('success', 'Booking updated successfully!');
    }

    public function markPaid(Booking $booking)
    {
        // Check if user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking.');
        }
        
        $booking->update(['payment_status' => 'paid']);
        
        return redirect()->back()->with('success', 'Booking marked as paid!');
    }

    public function confirm(Booking $booking)
    {
        // Check if user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking.');
        }
        
        $booking->update(['status' => 'confirmed']);
        
        // Create shipment
        $shipment = Shipment::create([
            'company_id' => $booking->company_id,
            'user_id' => $booking->user_id,
            'booking_id' => $booking->id,
            'tracking_number' => str_pad(rand(1000000000, 9999999999), 10, '0', STR_PAD_LEFT),
            'status' => 'pending',
            'origin_address' => $booking->shipper_address,
            'destination_address' => $booking->consignee_address,
            'origin_city' => 'Origin City', // You can extract from address
            'destination_city' => 'Destination City', // You can extract from consignee address
            'origin_country' => $booking->company->country ?? 'Pakistan',
            'destination_country' => 'Pakistan', // Default or extract from consignee address
            'weight' => $booking->weight,
            'dimensions' => $booking->dimensions,
            'shipping_date' => $booking->pickup_date,
            'shipping_cost' => $booking->total_cost,
        ]);

        // Create invoice
        $invoice = Invoice::create([
            'company_id' => $booking->company_id,
            'user_id' => $booking->user_id,
            'booking_id' => $booking->id,
            'shipment_id' => $shipment->id,
            'invoice_number' => 'INV' . strtoupper(Str::random(8)),
            'invoice_date' => now()->toDateString(),
            'due_date' => now()->addDays(30)->toDateString(),
            'status' => 'sent',
            'subtotal' => $booking->total_cost,
            'tax_amount' => $booking->total_cost * 0.05, // 5% tax
            'total_amount' => $booking->total_cost * 1.05,
        ]);

        return redirect()->route('user.bookings.show', $booking)->with('success', 'Booking confirmed and shipment created!');
    }

    public function destroy(Booking $booking)
    {
        // Check if user owns this booking
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking.');
        }
        
        $booking->delete();
        
        return redirect()->route('user.bookings.index')->with('success', 'Booking deleted successfully!');
    }

    private function calculateShippingCost($weight, $length, $width, $height, $serviceType)
    {
        $baseCost = 100; // Base cost in PKR
        $weightCost = $weight * 50; // 50 PKR per kg
        $volumeCost = ($length * $width * $height) / 1000 * 10; // 10 PKR per cubic cm
        
        $totalCost = $baseCost + $weightCost + $volumeCost;
        
        // Apply service type multiplier
        switch ($serviceType) {
            case 'express':
                $totalCost *= 1.5;
                break;
            case 'overnight':
                $totalCost *= 2;
                break;
            case 'international':
                $totalCost *= 3;
                break;
            default: // standard
                $totalCost *= 1;
        }
        
        return round($totalCost, 2);
    }
}
