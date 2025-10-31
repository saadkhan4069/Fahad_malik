<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Booking;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index()
    {
        try {
            $company = Auth::guard('company')->user();
            
            if (!$company) {
                return redirect()->route('login')->with('error', 'Please login to access invoices.');
            }
            
            $invoices = $company->invoices()->with(['booking', 'shipment'])->latest()->paginate(10);
            
            return view('invoices.index', compact('invoices'));
        } catch (\Exception $e) {
            \Log::error('Invoice index error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading invoices.');
        }
    }

    public function show(Invoice $invoice)
    {
        $this->authorize('view', $invoice);
        
        $invoice->load(['booking', 'shipment', 'company']);
        return view('invoices.show', compact('invoice'));
    }

    public function generatePdf(Invoice $invoice)
    {
        $this->authorize('view', $invoice);
        
        $invoice->load(['booking', 'shipment', 'company']);
        
        $pdf = Pdf::loadView('invoices.pdf', compact('invoice'));
        
        return $pdf->download("invoice-{$invoice->invoice_number}.pdf");
    }

    public function markAsPaid(Invoice $invoice)
    {
        $this->authorize('update', $invoice);
        
        $invoice->update([
            'payment_status' => 'paid',
            'payment_date' => now(),
            'status' => 'paid'
        ]);
        
        return redirect()->back()->with('success', 'Invoice marked as paid!');
    }

    public function updatePayment(Request $request, Invoice $invoice)
    {
        $this->authorize('update', $invoice);
        
        $request->validate([
            'payment_method' => 'required|in:cash,credit_card,bank_transfer,check,other',
            'payment_date' => 'required|date',
        ]);

        $invoice->update([
            'payment_method' => $request->payment_method,
            'payment_date' => $request->payment_date,
            'payment_status' => 'paid',
            'status' => 'paid'
        ]);
        
        return redirect()->back()->with('success', 'Payment information updated!');
    }

    public function sendInvoice(Invoice $invoice)
    {
        $this->authorize('update', $invoice);
        
        $invoice->update(['status' => 'sent']);
        
        // Here you would typically send an email to the company
        // Mail::to($invoice->company->email)->send(new InvoiceMail($invoice));
        
        return redirect()->back()->with('success', 'Invoice sent successfully!');
    }

    public function generateProformaInvoice(Booking $booking)
    {
        $this->authorize('view', $booking);
        
        $booking->load(['company']);
        
        // Get country names
        $shipperCountry = \DB::table('countries')->where('code', $booking->shipper_country)->first();
        $consigneeCountry = \DB::table('countries')->where('code', $booking->consignee_country)->first();
        
        return view('invoices.proforma', compact('booking', 'shipperCountry', 'consigneeCountry'));
    }

    public function generateProformaPdf(Booking $booking)
    {
        $this->authorize('view', $booking);
        
        $booking->load(['company']);
        
        // Get country names
        $shipperCountry = \DB::table('countries')->where('code', $booking->shipper_country)->first();
        $consigneeCountry = \DB::table('countries')->where('code', $booking->consignee_country)->first();
        
        $pdf = Pdf::loadView('invoices.proforma', compact('booking', 'shipperCountry', 'consigneeCountry'));
        
        return $pdf->download("proforma-invoice-{$booking->booking_number}.pdf");
    }

    public function generateInvoice()
    {
        $companies = Company::all();
        return view('invoices.generate', compact('companies'));
    }

    public function storeInvoice(Request $request)
    {
        $request->validate([
            'invoice_number' => 'required|string|max:255',
            'billed_to' => 'required|string|max:255',
            'from_company' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'services' => 'required|array|min:1',
            'services.*.hrs_qty' => 'required|numeric|min:0',
            'services.*.service_name' => 'required|string|max:255',
            'services.*.description' => 'nullable|string|max:255',
            'services.*.rate_piece' => 'required|numeric|min:0',
            'services.*.adjust' => 'required|numeric|min:0',
            'services.*.sub_total' => 'required|numeric|min:0',
            'sub_total' => 'required|numeric|min:0',
            'tax' => 'nullable|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'bank_title' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'iban' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
        ]);

        $invoice = Invoice::create([
            'company_id' => 1, // Default company ID for standalone invoices
            'booking_id' => null, // No booking required for standalone invoices
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'status' => 'draft',
            'subtotal' => $request->sub_total,
            'tax_amount' => $request->tax ?? 0,
            'total_amount' => $request->total,
            'billed_to' => $request->billed_to,
            'from_company' => $request->from_company,
            'address' => $request->address,
            'contact' => $request->contact,
            'services' => $request->services,
            'bank_title' => $request->bank_title,
            'account_number' => $request->account_number,
            'iban' => $request->iban,
            'bank_name' => $request->bank_name,
        ]);

        return redirect()->route('invoices.generated', $invoice)->with('success', 'Invoice generated successfully!');
    }

    public function showGenerated(Invoice $invoice)
    {
        return view('invoices.generated', compact('invoice'));
    }
}
