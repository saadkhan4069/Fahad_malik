<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Airwaybill - <?php echo e($label->label_number); ?></title>
  <style>
    @page { size: A4; margin: 12mm 12mm; }
    *{ box-sizing:border-box }
    html,body{ margin:0; padding:0; font-family: "Inter", "Poppins", "DejaVu Sans", Arial, Helvetica, sans-serif; color:#111; background:#fff }
    body{ font-size:11.5px; line-height:1.35 }

    .muted{ color:#666 }
    .bold{ font-weight:700 }
    .right{ text-align:right }
    .section{ margin-top:12px }
    .divider{ height:1px; background:#e5e7eb; margin:10px 0 }

    .card{ border:1.5px solid #e5e7eb; border-radius:6px; padding:12px 14px; background:#fff }

    .hdr{ display:table; width:100%; }
    .hdr .left{ display:table-cell; vertical-align:middle; width:60%; }
    .hdr .right{ display:table-cell; vertical-align:middle; width:40%; text-align:right; }
    .logo{ max-height:18mm; max-width:100% }
    .title{ font-size:15px; font-weight:700; margin:4px 0 0 0 }
    .sub{ font-size:11px; color:#444; margin-top:2px }

    .barcode-box{ display:inline-block; vertical-align:middle; }
    .barcode-img{ height:46px; width:auto; display:block; }
    .barcode-fallback{ font-family:monospace; font-size:12px; letter-spacing:2px; color:#000; background:#fff; padding:4px; border:1px solid #ccc; }
    .trk{ font-family:monospace; letter-spacing:2px; font-size:12px; margin-top:3px; }

    .grid2{ display:table; width:100%; table-layout:fixed }
    .col{ display:table-cell; width:50%; vertical-align:top; padding:0 8px }
    .block h3{ font-size:12.5px; margin:0 0 8px; font-weight:700 }

    .dl{ margin:0; }
    .row{ display:table; width:100%; margin:0 0 6px 0 }
    .dt{ display:table-cell; width:42%; color:#555 }
    .dd{ display:table-cell; width:58%; font-weight:600; color:#111; word-break:break-word }

    .sep{ height:1px; background:#e5e7eb; margin:12px 0 }

    .sign-grid{ display:table; width:100%; table-layout:fixed; margin-top:8px }
    .sign-cell{ display:table-cell; padding:8px 6px; vertical-align:top }
    .sign-line{ border-top:1px solid #cbd5e1; margin-top:24px; padding-top:4px; font-size:10.5px; color:#444; text-align:center }
  </style>
</head>
<body>

  
  <div class="card">
    <div class="hdr">
      <div class="left">
      <img class="logo" src="storage/company/logos/EUF6Xc4fXfp5oIew8OM7SWMnwICEvoPT16rqUkfR.jpg" alt="Logo">
      
       
      </div>

      <div class="right">
        <div class="barcode-box">
          <?php if(isset($barcodeSvg)): ?>
            <?php echo $barcodeSvg; ?>

          <?php endif; ?>
          <?php if(empty($barcodeSvg)): ?>
            <?php if(isset($barcodePng)): ?>
              <img style="width: 100%; height: 5%;" class="barcode-img" src="data:image/png;base64,<?php echo e($barcodePng); ?>" alt="barcode">
            <?php endif; ?>
          <?php endif; ?>
          <?php if(empty($barcodeSvg) && empty($barcodePng)): ?>
            <div class="barcode-fallback"><?php echo e($label->shipment->tracking_number); ?></div>
          <?php endif; ?>
        </div>
        <div style="font-size: 10px; text-align: center;" class="trk"><?php echo e($label->shipment->tracking_number); ?></div>
      </div>
    </div>
  </div>

  
  <div class="card section">
    <div class="grid2">
      <div class="col block">
        <h3>Shipper</h3>
        <div class="dl">
          <div class="row"><div class="dt">Name:</div><div class><?php echo e($label->shipment->booking->shipper_name ?? '-'); ?></div></div>
          <div class="row"><div class="dt">Address:</div><div class><?php echo e($label->shipment->booking->shipper_address ?? '-'); ?></div></div>
          <div class="row"><div class="dt">Phone:</div><div class><?php echo e($label->shipment->booking->shipper_phone ?? '-'); ?></div></div>
          <div class="row"><div class="dt">City, Country:</div><div class><?php echo e($label->shipment->origin_city ?? '-'); ?>, <?php echo e($originCountry->name ?? $label->shipment->origin_country ?? '-'); ?></div></div>
        </div>
      </div>

      <div class="col block">
        <h3>Consignee</h3>
        <div class="dl">
          <div class="row"><div class="dt">Name:</div><div class="dd"><?php echo e($label->shipment->booking->consignee_name ?? '-'); ?></div></div>
          <div class="row"><div class="dt">Address:</div><div class="dd"><?php echo e($label->shipment->booking->consignee_address ?? '-'); ?></div></div>
          <div class="row"><div class="dt">Phone:</div><div class="dd"><?php echo e($label->shipment->booking->consignee_phone ?? '-'); ?></div></div>
          <div class="row"><div class="dt">City, Country:</div><div class="dd"><?php echo e($label->shipment->destination_city ?? '-'); ?>, <?php echo e($destinationCountry->name ?? $label->shipment->destination_country ?? '-'); ?></div></div>
        </div>
      </div>
    </div>
  </div>

  
  <div class="card section">
    <h3>Shipment Details</h3>
    <div class="grid2">
      <div class="col">
        <div class="dl">
          <div class="row"><div class="dt">Service Type:</div><div class="dd"><?php echo e($label->shipment->booking->service_type ?? '-'); ?></div></div>
          <div class="row"><div class="dt">Actual Weight:</div><div class="dd"><?php echo e($label->shipment->weight ?? '0.00'); ?> kg</div></div>
          <?php
            $dims = is_array($label->shipment->dimensions)
              ? $label->shipment->dimensions
              : (json_decode($label->shipment->dimensions ?? '[]', true) ?: []);
            $len = $dims['length'] ?? null; $wid = $dims['width'] ?? null; $hei = $dims['height'] ?? null; $vw = $dims['vol_weight'] ?? ($dims['volumetric_weight'] ?? null);
          ?>
          <?php if($len && $wid && $hei): ?>
            <div class="row"><div class="dt">Dimensions (L×W×H):</div><div class="dd"><?php echo e($len); ?> × <?php echo e($wid); ?> × <?php echo e($hei); ?> cm</div></div>
          <?php endif; ?>
          <?php if($vw): ?>
            <div class="row"><div class="dt">Volumetric Weight:</div><div class="dd"><?php echo e($vw); ?> kg</div></div>
          <?php endif; ?>
          <div class="row"><div class="dt">Description of Contents:</div><div class="dd"><?php echo e($label->shipment->booking->package_description ?? '-'); ?></div></div>
          <div class="row"><div class="dt">Estimated Date:</div><div class="dd"><?php echo e($label->shipment->booking->estimated_date ? $label->shipment->booking->estimated_date->format('d/m/Y') : '-'); ?></div></div>
        </div>
      </div>
      <div class="col">
        <div class="dl">
          <div class="row"><div class="dt">Package Type:</div><div class="dd"><?php echo e($label->shipment->booking->package_type ?? ($label->shipment->booking->package_description ?? '-')); ?></div></div>
          <div class="row"><div class="dt">Declared value for customs:</div><div class="dd"><?php echo e($label->shipment->booking->goods_value_currency ?? 'USD'); ?> <?php echo e(number_format($label->shipment->booking->package_value ?? 0, 2)); ?></div></div>
          <div class="row"><div class="dt">HS Code:</div><div class="dd"><?php echo e($label->shipment->booking->hs_code ?? '-'); ?></div></div>
          <div class="row"><div class="dt">Financial Instrument:</div><div class="dd"><?php echo e($label->shipment->booking->financial_instrument ?? '-'); ?></div></div>
          <div class="row"><div class="dt">Shipment Charges:</div><div class="dd"><?php echo e('PKR'); ?> <?php echo e(number_format($label->shipment->booking->shipment_charges ?? 0, 2)); ?></div></div>
        </div>
      </div>
    </div>
  </div>

  
  <div class="card section">
    <h3>Booking & Pickup Details</h3>
    <div class="grid2">
      <div class="col">
        <div class="dl">
          <div class="row"><div class="dt">Booking Date:</div><div class="dd">
            <?php echo e($label->shipment->booking->booking_date ? $label->shipment->booking->booking_date->setTimezone(config('app.timezone'))->format('d/m/Y H:i') : now()->setTimezone(config('app.timezone'))->format('d/m/Y H:i')); ?>

          </div></div>
          <div class="row"><div class="dt">Shipment Reference:</div><div class="dd"><?php echo e($label->shipment->booking->shipment_reference ?? '-'); ?></div></div>
          <div class="row"><div class="dt">Special Instructions:</div><div class="dd"><?php echo e($label->shipment->booking->special_instructions ?? '-'); ?></div></div>
        </div>
      </div>
      <div class="col">
        <div class="dl">
          <div class="row"><div class="dt">AWB No.:</div><div class="dd"><?php echo e($label->shipment->tracking_number ?? '-'); ?></div></div>
          <div class="row"><div class="dt">Form E Number:</div><div class="dd"><?php echo e($label->shipment->booking->form_e_number ?? '-'); ?></div></div>
          <div class="row"><div class="dt">Inco Terms:</div><div class="dd"><?php echo e($label->shipment->booking->inco_terms ?? '-'); ?></div></div>
        </div>
      </div>
    </div>
  </div>

  
  <div class="card section">
    <h3>Terms and Conditions</h3>
    <div class="muted" style="font-size:10.5px; line-height:1.45">
      AdEx Worldwide Express takes no responsibility if the shipment is Lost / Damaged / Broken / Delayed in Transit.
      Every shipment is processed and handled at the Shipper’s Risk.
      The chargeable weight of an Air Shipment is determined by the actual or volumetric weight (L × W × H ÷ 5000)
      whichever is higher. The rates are inclusive of fuel and handling surcharges, special handling fee and other duties & taxes.
      A CLAIM IS ONLY ACCEPTABLE if an invoice is submitted at the time of booking, which shows the declared value & nature of complete items.
      A claim can only be raised within 10 days of the initial booking.
      Thank you for using AdEx Worldwide Express.
    </div>

    <div class="divider"></div>
    <div class="grid2">
      <div class="col">
        <div class="sign-line">Shipper’s Signature</div>
      </div>
      <div class="col">
        <div class="sign-line">AdEx Representative</div>
      </div>
    </div>
  </div>

</body>
</html>
<?php /**PATH D:\Laravel\Fahad_malik\resources\views/labels/enhanced-pdf.blade.php ENDPATH**/ ?>