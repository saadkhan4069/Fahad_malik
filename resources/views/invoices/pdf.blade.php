<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice - {{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
        }
        .company-info {
            text-align: right;
        }
        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 10px;
        }
        .invoice-details {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .invoice-details table {
            width: 100%;
        }
        .invoice-details td {
            padding: 5px 0;
        }
        .invoice-details td:first-child {
            font-weight: bold;
            width: 40%;
        }
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #007bff;
            margin: 20px 0 10px 0;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .booking-info, .shipment-info {
            margin-bottom: 20px;
        }
        .booking-info table, .shipment-info table {
            width: 100%;
            border-collapse: collapse;
        }
        .booking-info td, .shipment-info td {
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }
        .booking-info td:first-child, .shipment-info td:first-child {
            font-weight: bold;
            width: 30%;
        }
        .amount-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .amount-table th, .amount-table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .amount-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .amount-table .text-right {
            text-align: right;
        }
        .total-row {
            font-weight: bold;
            background-color: #e9ecef;
        }
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        .status-badge {
            display: inline-block;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-paid {
            background-color: #d4edda;
            color: #155724;
        }
        .status-unpaid {
            background-color: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <div class="invoice-title">INVOICE</div>
            <div><strong>Shipment System</strong></div>
            <div>123 Business Street</div>
            <div>City, State 12345</div>
            <div>Phone: +92-XXX-XXXXXXX</div>
            <div>Email: info@shipmentsystem.com</div>
        </div>
        <div class="company-info">
            <div><strong>{{ $invoice->company->name }}</strong></div>
            <div>{{ $invoice->company->address }}</div>
            <div>{{ $invoice->company->city }}, {{ $invoice->company->state }} {{ $invoice->company->zip_code }}</div>
            <div>{{ $invoice->company->country }}</div>
            @if($invoice->company->tax_id)
                <div>Tax ID: {{ $invoice->company->tax_id }}</div>
            @endif
        </div>
    </div>

    <div class="invoice-details">
        <table>
            <tr>
                <td>Invoice Number:</td>
                <td>{{ $invoice->invoice_number }}</td>
            </tr>
            <tr>
                <td>Invoice Date:</td>
                <td>{{ $invoice->invoice_date->format('F d, Y') }}</td>
            </tr>
            <tr>
                <td>Due Date:</td>
                <td>{{ $invoice->due_date->format('F d, Y') }}</td>
            </tr>
            <tr>
                <td>Payment Status:</td>
                <td>
                    <span class="status-badge {{ $invoice->payment_status == 'paid' ? 'status-paid' : 'status-unpaid' }}">
                        {{ strtoupper($invoice->payment_status) }}
                    </span>
                </td>
            </tr>
        </table>
    </div>

    <div class="section-title">Invoice Details</div>
    <div class="booking-info">
        <table>
            <tr>
                <td>Billed To:</td>
                <td>{{ $invoice->billed_to ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>From Company:</td>
                <td>{{ $invoice->from_company ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Address:</td>
                <td>{{ $invoice->address ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Contact:</td>
                <td>{{ $invoice->contact ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td>Status:</td>
                <td>{{ ucfirst($invoice->status) }}</td>
            </tr>
            <tr>
                <td>Total Amount:</td>
                <td>PKR {{ number_format($invoice->total_amount, 2) }}</td>
            </tr>
        </table>
    </div>

    @if($invoice->services && is_array($invoice->services))
    <div class="section-title">Services</div>
    <table class="amount-table">
        <thead>
            <tr>
                <th>HRS/QTY</th>
                <th>SERVICE</th>
                <th class="text-right">Rate/Piece</th>
                <th class="text-right">Adjust</th>
                <th class="text-right">SUB TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->services as $service)
            <tr>
                <td>{{ $service['hrs_qty'] ?? 1 }}</td>
                <td>{{ $service['service_name'] ?? 'Service' }}</td>
                <td class="text-right">{{ ($service['rate_piece'] ?? 0) == 0 ? '-' : number_format($service['rate_piece'], 0) }}</td>
                <td class="text-right">{{ $service['adjust'] ?? 0 }}%</td>
                <td class="text-right">{{ number_format($service['sub_total'] ?? 0, 0) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div class="section-title">Invoice Summary</div>
    <table class="amount-table">
        <thead>
            <tr>
                <th>Description</th>
                <th class="text-right">Amount (PKR)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Shipping Cost</td>
                <td class="text-right">{{ number_format($invoice->subtotal, 2) }}</td>
            </tr>
            <tr>
                <td>Tax (5%)</td>
                <td class="text-right">{{ number_format($invoice->tax_amount, 2) }}</td>
            </tr>
            @if($invoice->discount_amount > 0)
            <tr>
                <td>Discount</td>
                <td class="text-right">-{{ number_format($invoice->discount_amount, 2) }}</td>
            </tr>
            @endif
            <tr class="total-row">
                <td><strong>Total Amount</strong></td>
                <td class="text-right"><strong>{{ number_format($invoice->total_amount, 2) }}</strong></td>
            </tr>
        </tbody>
    </table>

    @if($invoice->payment_status == 'paid')
    <div class="section-title">Payment Information</div>
    <div class="booking-info">
        <table>
            <tr>
                <td>Payment Method:</td>
                <td>{{ ucfirst(str_replace('_', ' ', $invoice->payment_method)) }}</td>
            </tr>
            <tr>
                <td>Payment Date:</td>
                <td>{{ $invoice->payment_date->format('F d, Y H:i') }}</td>
            </tr>
        </table>
    </div>
    @endif

    @if($invoice->notes)
    <div class="section-title">Notes</div>
    <p>{{ $invoice->notes }}</p>
    @endif

    <div class="footer">
        <p>Thank you for your business!</p>
        <p>This invoice was generated on {{ now()->format('F d, Y H:i') }}</p>
    </div>
</body>
</html>
