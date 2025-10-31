<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Shipping Label - {{ $label->label_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.2;
            color: #333;
            margin: 0;
            padding: 10px;
            width: 400px; /* 4 inch width */
        }
        .label-container {
            border: 2px solid #000;
            padding: 15px;
            margin: 0;
            background-color: white;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }
        .company-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .label-number {
            font-size: 12px;
            font-weight: bold;
            color: #007bff;
        }
        .tracking-section {
            background-color: #f8f9fa;
            padding: 10px;
            border: 1px solid #000;
            margin-bottom: 15px;
            text-align: center;
        }
        .tracking-number {
            font-size: 14px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 5px;
        }
        .barcode-placeholder {
            height: 40px;
            background-color: #000;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: monospace;
            letter-spacing: 2px;
            margin: 5px 0;
        }
        .address-section {
            margin-bottom: 15px;
        }
        .address-title {
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 5px;
            text-transform: uppercase;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
        }
        .address-content {
            font-size: 9px;
            line-height: 1.3;
        }
        .package-info {
            background-color: #f8f9fa;
            padding: 8px;
            border: 1px solid #000;
            margin-bottom: 15px;
        }
        .package-info table {
            width: 100%;
            font-size: 8px;
        }
        .package-info td {
            padding: 2px 0;
        }
        .package-info td:first-child {
            font-weight: bold;
            width: 40%;
        }
        .service-type {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            background-color: #007bff;
            color: white;
            padding: 5px;
            margin-bottom: 10px;
        }
        .footer {
            text-align: center;
            font-size: 8px;
            color: #666;
            border-top: 1px solid #000;
            padding-top: 8px;
            margin-top: 15px;
        }
        .instructions {
            font-size: 8px;
            margin-top: 10px;
            padding: 5px;
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
        }
        @media print {
            body {
                margin: 0;
                padding: 0;
            }
            .label-container {
                border: none;
                margin: 0;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="label-container">
        <div class="header">
            <div class="company-name">SHIPMENT SYSTEM</div>
            <div class="label-number">LABEL #{{ $label->label_number }}</div>
        </div>

        <div class="tracking-section">
            <div class="tracking-number">{{ $label->shipment->tracking_number }}</div>
            <div class="barcode-placeholder">
                {{ $label->shipment->tracking_number }}
            </div>
            <div style="font-size: 8px;">TRACKING NUMBER</div>
        </div>

        <div class="service-type">
            {{ strtoupper($label->shipment->booking->service_type) }} SERVICE
        </div>

        <div class="row">
            <div class="col-6">
                <div class="address-section">
                    <div class="address-title">FROM</div>
                    <div class="address-content">
                        <strong>{{ $label->shipment->booking->shipper_name }}</strong><br>
                        {{ $label->shipment->booking->shipper_address }}<br>
                        {{ $label->shipment->origin_city }}<br>
                        {{ $label->shipment->origin_country }}
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="address-section">
                    <div class="address-title">TO</div>
                    <div class="address-content">
                        <strong>{{ $label->shipment->booking->consignee_name }}</strong><br>
                        {{ $label->shipment->booking->consignee_address }}<br>
                        {{ $label->shipment->destination_city }}<br>
                        {{ $label->shipment->destination_country }}
                    </div>
                </div>
            </div>
        </div>

        <div class="package-info">
            <table>
                <tr>
                    <td>Weight:</td>
                    <td>{{ $label->shipment->weight }} kg</td>
                </tr>
                <tr>
                    <td>Dimensions:</td>
                    <td>{{ $label->shipment->dimensions['length'] }} x {{ $label->shipment->dimensions['width'] }} x {{ $label->shipment->dimensions['height'] }} cm</td>
                </tr>
                <tr>
                    <td>Package Value:</td>
                    <td>PKR {{ number_format($label->shipment->booking->package_value, 2) }}</td>
                </tr>
                <tr>
                    <td>Shipping Date:</td>
                    <td>{{ $label->shipment->shipping_date->format('M d, Y') }}</td>
                </tr>
                @if($label->shipment->estimated_delivery)
                <tr>
                    <td>Est. Delivery:</td>
                    <td>{{ $label->shipment->estimated_delivery->format('M d, Y') }}</td>
                </tr>
                @endif
            </table>
        </div>

        @if($label->shipment->booking->special_instructions)
        <div class="instructions">
            <strong>Special Instructions:</strong><br>
            {{ $label->shipment->booking->special_instructions }}
        </div>
        @endif

        <div class="footer">
            <div><strong>SHIPMENT SYSTEM</strong></div>
            <div>Phone: +92-XXX-XXXXXXX | Email: info@shipmentsystem.com</div>
            <div>Generated on: {{ $label->generated_at->format('M d, Y H:i') }}</div>
        </div>
    </div>
</body>
</html>
