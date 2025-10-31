<?php

namespace App\Http\Controllers;

use App\Models\Label;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Barryvdh\DomPDF\Facade\Pdf;
use Picqer\Barcode\BarcodeGeneratorPNG;
use Picqer\Barcode\BarcodeGeneratorSVG;

class LabelController extends Controller
{
    public function index()
    {
        $company = Auth::guard('company')->user();
        $labels = $company->labels()->with(['shipment'])->latest()->paginate(10);
        
        return view('labels.index', compact('labels'));
    }

    public function getLabelsData(Request $request)
    {
        $company = Auth::guard('company')->user();

        $query = $company->labels()->with(['shipment']);

        // Search functionality
        if ($request->has('search') && !empty($request->search['value'])) {
            $searchValue = $request->search['value'];
            $query->where(function($q) use ($searchValue) {
                $q->where('label_number', 'like', "%{$searchValue}%")
                  ->orWhere('label_type', 'like', "%{$searchValue}%")
                  ->orWhere('status', 'like', "%{$searchValue}%")
                  ->orWhereHas('shipment', function($shipmentQuery) use ($searchValue) {
                      $shipmentQuery->where('tracking_number', 'like', "%{$searchValue}%");
                  });
            });
        }

        // Order by
        $orderColumn = $request->order[0]['column'] ?? 0;
        $orderDir = $request->order[0]['dir'] ?? 'desc';

        $columns = ['label_number', 'tracking_number', 'label_type', 'status', 'generated_at'];
        $orderBy = $columns[$orderColumn] ?? 'generated_at';

        if ($orderBy === 'tracking_number') {
            $query->join('shipments', 'labels.shipment_id', '=', 'shipments.id')
                  ->orderBy('shipments.tracking_number', $orderDir)
                  ->select('labels.*');
        } elseif ($orderBy === 'generated_at') {
            $query->orderBy('generated_at', $orderDir);
        } else {
            $query->orderBy($orderBy, $orderDir);
        }

        // Pagination
        $start = $request->start ?? 0;
        $length = $request->length ?? 10;

        $totalRecords = $company->labels()->count();
        $labels = $query->skip($start)->take($length)->get();

        $data = [];
        foreach ($labels as $label) {
            $data[] = [
                'label_number' => '<strong>' . $label->label_number . '</strong>',
                'tracking_number' => $label->individual_tracking_number ?? $label->shipment->tracking_number,
                'label_type' => '<span class="badge bg-info">' . ucfirst($label->label_type) . '</span>',
                'status' => '<span class="badge bg-' . ($label->status == 'printed' ? 'success' : ($label->status == 'generated' ? 'primary' : 'warning')) . '">' . ucfirst($label->status) . '</span>',
                'generated_at' => $label->generated_at ? $label->generated_at->format('M d, Y H:i') : '-',
                'actions' => $this->getLabelActionButtons($label)
            ];
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $data
        ]);
    }

    private function getLabelActionButtons($label)
    {
        $buttons = '<div class="btn-group" role="group">';
        
        // View button
        $buttons .= '<a href="' . route('labels.show', $label) . '" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="View Label">';
        $buttons .= '<i class="fas fa-eye"></i>';
        $buttons .= '</a>';
        
        // Download button
        $buttons .= '<a href="' . route('labels.download', $label) . '" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="Download PDF" target="_blank">';
        $buttons .= '<i class="fas fa-download"></i>';
        $buttons .= '</a>';
        
        // Print button (only for generated labels)
        if ($label->status == 'generated') {
            $buttons .= '<form method="POST" action="' . route('labels.print', $label) . '" style="display: inline;">';
            $buttons .= csrf_field();
            $buttons .= '<button type="submit" class="btn btn-sm btn-outline-success" data-bs-toggle="tooltip" title="Mark as Printed" onclick="return confirm(\'Mark this label as printed?\')">';
            $buttons .= '<i class="fas fa-print"></i>';
            $buttons .= '</button>';
            $buttons .= '</form>';
        }
        
        $buttons .= '</div>';
        
        return $buttons;
    }

    public function generate(Shipment $shipment)
    {
        $this->authorize('view', $shipment);
        
        // Get the authenticated user (company or user)
        $user = Auth::guard('company')->user() ?? Auth::user();
        
        if (!$user) {
            return redirect()->back()->with('error', 'Authentication required.');
        }
        
        // Get company ID based on user type
        $companyId = $user instanceof \App\Models\Company ? $user->id : $user->company_id;
        
        // Create a temporary label object for PDF generation (not stored in database)
        $label = new Label([
            'company_id' => $companyId,
            'shipment_id' => $shipment->id,
            'label_number' => 'LBL' . strtoupper(Str::random(8)),
            'label_type' => 'shipping',
            'status' => 'generated',
            'generated_at' => now(),
            'tracking_code' => $shipment->tracking_number,
            'barcode_data' => $this->generateBarcodeData($shipment),
        ]);
        
        // Load relationships for the temporary label
        $label->setRelation('shipment', $shipment);
        $label->setRelation('company', $shipment->company);
        
        // Get country names for the label
        $originCountry = \DB::table('countries')->where('code', $shipment->origin_country)->first();
        $destinationCountry = \DB::table('countries')->where('code', $shipment->destination_country)->first();
        
        // Generate and directly return the PDF
        return $this->generateAndReturnPdf($label, $originCountry, $destinationCountry);
    }

    public function updateLabelTracking(Request $request, Label $label)
    {
        $this->authorize('view', $label);
        
        // Get the authenticated user (company or user)
        $user = Auth::guard('company')->user() ?? Auth::user();
        
        if (!$user) {
            return redirect()->back()->with('error', 'Authentication required.');
        }
        
        $request->validate([
            'tracking_number' => 'required|string|max:255',
            'status' => 'required|in:pending,picked_up,in_transit,out_for_delivery,delivered,returned',
            'tracking_notes' => 'nullable|string|max:1000',
            'estimated_delivery' => 'nullable|date',
        ]);

        // Update individual tracking for this specific label only
        $label->update([
            'individual_tracking_number' => $request->tracking_number,
            'individual_status' => $request->status,
            'individual_tracking_notes' => $request->tracking_notes,
            'individual_estimated_delivery' => $request->estimated_delivery ? \Carbon\Carbon::parse($request->estimated_delivery) : null,
        ]);

        // Redirect based on user type
        if ($user instanceof \App\Models\Company) {
            return redirect()->route('labels.show', $label)->with('success', 'Tracking information updated successfully for label: ' . $label->label_number);
        } else {
            return redirect()->route('user.labels.show', $label)->with('success', 'Tracking information updated successfully for label: ' . $label->label_number);
        }
    }

    public function show(Label $label)
    {
        $this->authorize('view', $label);
        
        $label->load(['shipment', 'company']);
        
        // Get the authenticated user to determine which view to return
        $user = Auth::guard('company')->user() ?? Auth::user();
        
        if ($user instanceof \App\Models\Company) {
            return view('labels.show', compact('label'));
        } else {
            return view('user.labels.show', compact('label'));
        }
    }

    
    public function downloadPdf(Label $label)
    {
        $this->authorize('view', $label);
        $label->load(['shipment.booking', 'company']);
    
        // ----- Tracking to encode -----
        $tracking = $label->barcode_data
            ?? optional($label->shipment)->tracking_number
            ?? optional(optional($label->shipment)->booking)->cn_number
            ?? '0000000000';
        $tracking = preg_replace('/\s+/', '', $tracking);
    
        // ----- Generate a real 1D barcode (Code-128) as PNG -----
        $gen = new BarcodeGeneratorSVG();
        
        // widthScale=2, height=60 → tweak if needed
        $barcodePng = base64_encode(
            $gen->getBarcode($tracking, $gen::TYPE_CODE_128, 2, 60)
        );
    
        // ----- Logo path for DOMPDF (local file paths work best) -----
        $cLogo = $label->company && $label->company->logo ? public_path($label->company->logo) : null;
        $logoCandidates = [$cLogo, public_path('images/logo.svg'), public_path('images/logo.png')];
        $logoPath = null;
        foreach ($logoCandidates as $p) { if ($p && file_exists($p)) { $logoPath = $p; break; } }
    
        // ----- Render PDF -----
        $pdf = Pdf::loadView('labels.enhanced-pdf', [
            'label'      => $label,
            'tracking'   => $tracking,
            'barcodePng' => $barcodePng,
            'logoPath'   => $logoPath,
        ])->setPaper('A4', 'portrait');
    
        // Safer options
        $pdf->set_option('isHtml5ParserEnabled', true);
        $pdf->set_option('isRemoteEnabled', true);
        $pdf->set_option('dpi', 96);
        

        return $pdf->stream("label-{$label->label_number}.pdf", ['Attachment' => false]);
        // return $pdf->download("label-{$label->label_number}.pdf");
    }



    public function print(Label $label)
    {
        $this->authorize('update', $label);
        
        $label->update([
            'status' => 'printed',
            'printed_at' => now()
        ]);
        
        return redirect()->back()->with('success', 'Label marked as printed!');
    }

    private function generateBarcodeData($shipment)
    {
        // Generate a simple barcode using HTML/CSS
        // This creates a visual barcode pattern using CSS
        $trackingNumber = $shipment->tracking_number;
        $barcodePattern = $this->generateBarcodePattern($trackingNumber);
        return $barcodePattern;
    }

    private function generateBarcodePattern($text)
    {
        // Create a simple barcode pattern using CSS
        $pattern = '';
        $chars = str_split($text);
        
        foreach ($chars as $char) {
            $ascii = ord($char);
            // Create a simple pattern based on ASCII value
            $bars = $ascii % 8 + 1; // 1-8 bars
            for ($i = 0; $i < $bars; $i++) {
                $pattern .= '|';
            }
            $pattern .= ' '; // Space between characters
        }
        
        return $pattern;
    }

    private function generateLabelPdf($label)
    {
        $label->load(['shipment', 'company']);
        
        // Generate barcode data for the view
        $barcodePng = null;
        $barcodeSvg = null;
        
        // Try to generate PNG barcode
        try {
            $generator = new BarcodeGeneratorPNG();
            $barcodePng = base64_encode($generator->getBarcode($label->shipment->tracking_number, $generator::TYPE_CODE_128));
        } catch (\Exception $e) {
            // If PNG generation fails, try SVG
            try {
                $generator = new BarcodeGeneratorSVG();
                $barcodeSvg = $generator->getBarcode($label->shipment->tracking_number, $generator::TYPE_CODE_128);
            } catch (\Exception $e) {
                // If both fail, use the stored barcode data
                $barcodePng = null;
                $barcodeSvg = null;
            }
        }
        
        $pdf = Pdf::loadView('labels.enhanced-pdf', compact('label', 'barcodePng', 'barcodeSvg'));
        $pdf->setPaper('A4', 'portrait');
        
        $fileName = "label-{$label->label_number}.pdf";
        $filePath = storage_path("app/labels/{$fileName}");
        
        // Ensure directory exists
        if (!file_exists(dirname($filePath))) {
            mkdir(dirname($filePath), 0755, true);
        }
        
        $pdf->save($filePath);
        
        // Update label with file information
        $label->update([
            'file_path' => $filePath,
            'file_name' => $fileName,
            'file_size' => filesize($filePath),
        ]);
    }

    private function generateAndReturnPdf($label, $originCountry = null, $destinationCountry = null)
    {
        $label->load(['shipment.booking', 'company']);
    
        // ----- Tracking to encode -----
        $tracking = $label->barcode_data
            ?? optional($label->shipment)->tracking_number
            ?? optional(optional($label->shipment)->booking)->cn_number
            ?? '0000000000';
        $tracking = preg_replace('/\s+/', '', $tracking);
    
        // ----- Generate a real 1D barcode (Code-128) as PNG -----
        $gen = new BarcodeGeneratorSVG();
        
        // widthScale=2, height=60 → tweak if needed
        $barcodePng = base64_encode(
            $gen->getBarcode($tracking, $gen::TYPE_CODE_128, 2, 60)
        );
    
        // ----- Logo path for DOMPDF (local file paths work best) -----
        $cLogo = $label->company && $label->company->logo ? public_path($label->company->logo) : null;
        $logoCandidates = [$cLogo, public_path('images/logo.svg'), public_path('images/logo.png')];
        $logoPath = null;
        foreach ($logoCandidates as $p) { if ($p && file_exists($p)) { $logoPath = $p; break; } }
    
        // ----- Render PDF -----
        $pdf = Pdf::loadView('labels.enhanced-pdf', [
            'label'      => $label,
            'tracking'   => $tracking,
            'barcodePng' => $barcodePng,
            'logoPath'   => $logoPath,
            'originCountry' => $originCountry,
            'destinationCountry' => $destinationCountry,
        ])->setPaper('A4', 'portrait');
    
        // Safer options
        $pdf->set_option('isHtml5ParserEnabled', true);
        $pdf->set_option('isRemoteEnabled', true);
        $pdf->set_option('dpi', 96);
        
        return $pdf->stream("label-{$label->label_number}.pdf", ['Attachment' => false]);
    }
}
