<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Proforma Invoice - <?php echo e($booking->booking_number ?? 'INV-001'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    /* ===== Base (A4 exact feel) ===== */
    *{box-sizing:border-box}
    html,body{margin:0;padding:0;font-family:"Inter","Poppins",Arial,Helvetica,sans-serif;color:#000}
    body{background:#fff;font-size:12px;line-height:1.35}
    .page{width:210mm;min-height:297mm;margin:0 auto;padding:10mm 8mm}

    /* ===== Helpers ===== */
    .row{display:flex;gap:10px}
    .col{flex:1 1 0}
    .b1{border:1px solid #000}
    .b2{border:2px solid #000}
    .b3{border:3px solid #000}
    .mb6{margin-bottom:6px}.mb8{margin-bottom:8px}.mb10{margin-bottom:10px}.mb12{margin-bottom:12px}.mb14{margin-bottom:14px}
    .p6{padding:6px}.p8{padding:8px}.p10{padding:10px}
    .center{text-align:center}.right{text-align:right}.upper{text-transform:uppercase}
    .small{font-size:11px}.bold{font-weight:700}
    .muted{color:#111}

    /* ===== Header ===== */
    .hdr{display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:8px}
    .hdr-left{width:95mm;height:17mm; solid #000;display:flex;align-items:center;justify-content:center}
    .logo{max-height:30mm;max-width:78mm}
    .logo-fallback{line-height:1;text-align:center}
    .logo-fallback .main{font-size:34px;font-weight:700;color:#213F60}
    .logo-fallback .sub{font-size:11px;font-weight:700;letter-spacing:1px;margin-top:2px}
    .hdr-right{width:90mm}
    .hdr-right .brand{font-weight:700;margin-bottom:2px}
    .hdr-right .addr{white-space:pre-line}

    /* ===== Title Banner (big gray bar) ===== */
    .banner{background:#d1d5db;border:2px solid #000;padding:10px 0;margin:10px 0 12px}
    .banner .title{font-size:22px;font-weight:700;text-align:center}

    /* ===== Two Column Boxes ===== */
    .twocol{display:flex;gap:14px}
    .box{flex:1 1 0;border:1px solid #000}
    table.grid{width:100%;border-collapse:collapse}
    table.grid td{border:1px solid #000;padding:7px 6px;vertical-align:top}
    td.lbl{width:30%;background:#f3f4f6;font-weight:700}
    td.val{width:70%;background:#fff}

    /* Inline split rows like "Country/CNIC" and "Phone/NTN" */
    .split{display:flex;align-items:stretch}
    .split .l{flex:1}
    .split .mid{flex:0 0 70px;text-align:right;font-weight:700;font-size:11px;padding-right:6px}
    .split .r{flex:0 0 150px}

    /* ===== Items Table ===== */
    table.items{width:100%;border-collapse:collapse;margin-top:8px}
    table.items th,table.items td{border:1px solid #000;padding:8px 6px;text-align:center}
    table.items th{background:#f3f4f6;font-weight:700}
    table.items tfoot td{font-weight:700}
    .nowrap{white-space:nowrap}

    /* ===== Undertaking ===== */
    .undertitle{letter-spacing:4px;text-align:center;font-weight:700;margin:12px 0 8px}
    .underline{margin-bottom:8px;text-align:center}
    .underbox{border:1px solid #000}

    /* ===== Consent & Signature ===== */
    .consent{border:1px solid #000;margin-top:10px}
    .sigtable{width:100%;border-collapse:collapse;margin-top:10px}
    .sigtable th,.sigtable td{border:1px solid #000;padding:8px 6px;text-align:center}
    .sigcell{height:26mm} /* big empty area like scan */

    /* ===== Print ===== */
    @media print{
      @page{size:A4;margin:10mm 8mm}
      .page{padding:0}
      .no-print{display:none!important}
    }
  </style>
</head>
<body>
  <div class="page">

    <!-- Header -->
    <div class="hdr">
      <div class="hdr-left">
        <?php if($booking->company && $booking->company->logo): ?>
          <img class="logo" src="<?php echo e(Storage::url($booking->company->logo)); ?>" alt="AdEx Logo">
        <?php elseif(file_exists(public_path('images/logo.svg'))): ?>
          <img class="logo" src="<?php echo e(asset('images/logo.svg')); ?>" alt="AdEx Logo">
        <?php elseif(file_exists(public_path('images/logo.png'))): ?>
          <img class="logo" src="<?php echo e(asset('images/logo.png')); ?>" alt="AdEx Logo">
        <?php else: ?>
          <div class="logo-fallback">
            <div class="main">AdEx.</div>
            <div class="sub">WORLDWIDE EXPRESS</div>
          </div>
        <?php endif; ?>
      </div>
      <div class="hdr-right">
        <div class="brand">adex</div>
        <div class="addr">
Plot 13-A, Street#5, Sindhi Muslim Corporative
Housing Society  SMCHS, Near KFC, Karachi,
Pakistan.
        </div>
      </div>
    </div>

    <!-- Big Gray Title Bar -->
    <div class="banner">
      <div class="title upper">Proforma Invoice</div>
    </div>

    <!-- Two column info section -->
    <div class="twocol mb12">
      <!-- Left: shipper/consignee -->
      <div class="box">
        <table class="grid">
          <tr><td class="lbl">Customer</td><td class="val">adex</td></tr>
          <tr>
            <td class="lbl">Shipper</td>
            <td class="val">
              <?php echo e($booking->shipper_name ?? 'MUHAMMAD SHOAIB ISMAIL'); ?><br>
              <?php echo e($booking->shipper_address ?? 'H NO L-582 SEC 5, A-4 AREA NORTH KARACHI'); ?>

            </td>
          </tr>
          <tr><td class="lbl">City</td><td class="val"><?php echo e($booking->shipper_city ?? 'KARACHI'); ?></td></tr>
          <tr>
            <td class="lbl">Country</td>
            <td class="val">
              <div class="split">
                <div class="l"><?php echo e($shipperCountry->name ?? $booking->shipper_country ?? 'PAKISTAN'); ?></div>
                <div class="mid">CNIC</div>
                <div class="r"><?php echo e($booking->shipper_cnic ?? '42101-0417726-5'); ?></div>
              </div>
            </td>
          </tr>
          <tr>
            <td class="lbl">Phone No</td>
            <td class="val">
              <div class="split">
                <div class="l"><?php echo e($booking->shipper_phone ?? '3100034399'); ?></div>
                <div class="mid">NTN No.</div>
                <div class="r"><?php echo e($booking->shipper_ntn ?? ''); ?></div>
              </div>
            </td>
          </tr>

          <tr><td class="lbl">Consignee</td><td class="val"><?php echo e($booking->consignee_name ?? 'MR ZULFI'); ?></td></tr>
          <tr><td class="lbl">Attention</td><td class="val"><?php echo e($booking->consignee_attention ?? ''); ?></td></tr>
          <tr>
            <td class="lbl">Address</td>
            <td class="val"><?php echo e($booking->consignee_address ?? 'C18, NAJMAT MARAFID TOWER, FLAT NO 703, 7TH FLOOR.. REEM ISLAND, ABU DHABI, UAE'); ?></td>
          </tr>
          <tr><td class="lbl">City</td><td class="val"><?php echo e($booking->consignee_city ?? 'ABU DHABI'); ?></td></tr>
          <tr>
            <td class="lbl">Country</td>
            <td class="val">
              <div class="split">
                <div class="l"><?php echo e($consigneeCountry->name ?? $booking->consignee_country ?? 'UNITED ARAB EMIRATES'); ?></div>
                <div class="mid">Post/Zip</div>
                <div class="r"><?php echo e($booking->consignee_zip ?? ''); ?></div>
              </div>
            </td>
          </tr>
          <tr><td class="lbl">Phone No</td><td class="val"><?php echo e($booking->consignee_phone ?? '1559419961'); ?></td></tr>
        </table>
      </div>

      <!-- Right: AWB etc -->
      <div class="box">
        <table class="grid">
          <tr><td class="lbl">AWB No.</td><td class="val"><?php echo e($booking->shipment->tracking_number ?? '7610007585'); ?></td></tr>
          <tr><td class="lbl">Date</td><td class="val"><?php echo e($booking->booking_date ? $booking->booking_date->setTimezone(config('app.timezone'))->format('d/m/Y H:i') : now()->setTimezone(config('app.timezone'))->format('d/m/Y H:i')); ?></td></tr>
          <tr><td class="lbl">Estimated Date</td><td class="val"><?php echo e($booking->estimated_date ? $booking->estimated_date->format('d/m/Y') : 'N/A'); ?></td></tr>
          <tr><td class="lbl">Service</td><td class="val"><?php echo e($booking->service_type ?? 'LAST MILE UAE DELIVERY'); ?></td></tr>
          <tr><td class="lbl">Origin</td><td class="val"><?php echo e($booking->shipper_city ?? 'KARACHI'); ?></td></tr>
          <tr><td class="lbl">Currency</td><td class="val"><?php echo e($booking->goods_value_currency ?? 'USD'); ?></td></tr>
          <tr><td class="lbl">Form 'E' No.</td><td class="val"><?php echo e($booking->form_e_number ?? ''); ?></td></tr>
          <tr><td class="lbl">Dox/Non-Dox</td><td class="val"><?php echo e($booking->dox_type ?? 'NON-DOX'); ?></td></tr>
          <tr><td class="lbl">Shipment Charges</td><td class="val"><?php echo e($booking->goods_value_currency ?? 'USD'); ?> <?php echo e(number_format($booking->shipment_charges ?? 0, 2)); ?></td></tr>
        </table>
      </div>
    </div>

    <!-- Items table -->
    <table class="items">
      <thead>
        <tr>
          <th class="nowrap">Sr.No.</th>
          <th>Description</th>
          <th>Made Of</th>
          <th>Weight</th>
          <th>Hs Code</th>
          <th>QTY</th>
          <th>Unit</th>
          <th>Rate</th>
          <th class="nowrap">USD Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php if(isset($booking->invoice_items) && count($booking->invoice_items)): ?>
          <?php $__currentLoopData = $booking->invoice_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td><?php echo e($i+1); ?></td>
              <td><?php echo e($item['description'] ?? ''); ?></td>
              <td><?php echo e($item['made_of'] ?? ''); ?></td>
              <td><?php echo e($item['weight'] ?? ''); ?></td>
              <td><?php echo e($item['hs_code'] ?? ''); ?></td>
              <td><?php echo e($item['quantity'] ?? ''); ?></td>
              <td><?php echo e($item['unit'] ?? ''); ?></td>
              <td><?php echo e(number_format($item['rate'] ?? 0, 2)); ?></td>
              <td><?php echo e(number_format((float)($item['quantity'] ?? 0) * (float)($item['rate'] ?? 0), 2)); ?></td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
          <tr>
            <td>1</td>
            <td><?php echo e($booking->package_description ?? 'Package'); ?></td>
            <td></td>
            <td><?php echo e($booking->weight ?? '0.00'); ?></td>
            <td><?php echo e($booking->hs_code ?? ''); ?></td>
            <td>1.00</td>
            <td>PCS</td>
            <td><?php echo e(number_format($booking->package_value ?? 0, 2)); ?></td>
            <td><?php echo e(number_format($booking->package_value ?? 0, 2)); ?></td>
          </tr>
        <?php endif; ?>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="6"></td>
          <td><span class="bold">TOTAL</span></td>
          <td class="bold"><?php echo e(number_format($booking->package_value ?? 0, 2)); ?></td>
          <td class="bold"><?php echo e(number_format($booking->package_value ?? 0, 2)); ?></td>
        </tr>
      </tfoot>
    </table>

    <!-- Undertaking -->
    <div class="undertitle upper">U N D E R T A K I N G</div>
    <div class="underline small">May be Opened Officially and Origin and Destination Customs, Documents to be validated for export.</div>
    <div class="underbox mb10">
      <table class="grid">
        <tr>
          <td class="lbl">Declaration</td>
          <td class="val">
            I Certify that the particulars given in this customs declaration are correct and this item does not contains any
            dangerous articles prohibited by legislation or by postal or customs regulation.
          </td>
        </tr>
        <tr><td class="lbl">For and on Behalf of</td><td class="val">adex</td></tr>
      </table>
    </div>

    <!-- Consent -->
    <div class="consent">
      <table class="grid">
        <tr>
          <td class="lbl">Shipper Consent</td>
          <td class="val">
            If due to none filling of any required information then in that case if shippment hold or delay in Pakistan or at any
            destination, we will not be responsible in any way.
          </td>
        </tr>
      </table>
    </div>

    <!-- Signature framed table like scan -->
    <table class="sigtable">
      <thead>
        <tr>
          <th>Name</th>
          <th>Signature</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="sigcell"></td>
          <td class="sigcell"></td>
        </tr>
      </tbody>
    </table>

    <!-- Buttons (screen only) -->
    <div class="no-print center" style="margin-top:12px">
      <button onclick="window.print()" style="padding:9px 16px;border:0;background:#213F60;color:#fff;border-radius:4px;cursor:pointer">Print Proforma Invoice</button>
      <button onclick="downloadPDF()" style="padding:9px 16px;border:0;background:#198754;color:#fff;border-radius:4px;cursor:pointer;margin-left:8px">Download PDF</button>
    </div>

  </div>

  <script>
    function downloadPDF(){
      window.location.href='<?php echo e(route("invoices.proforma.pdf", $booking->id ?? 1)); ?>';
    }
  </script>
</body>
</html>
<?php /**PATH D:\Fahad_malik_logisitic\shipment_booking_fahad_malik\resources\views/invoices/proforma.blade.php ENDPATH**/ ?>