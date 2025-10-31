<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice - AdEx Worldwide</title>
  <style>
    * {margin:0; padding:0; box-sizing:border-box;}
    body {font-family:'Arial',sans-serif; background:#f8f9fa; padding:20px;}
    .invoice-container {max-width:800px; margin:0 auto; background:white; box-shadow:0 0 20px rgba(0,0,0,0.1);}
    .invoice-header {display:flex; justify-content:space-between; align-items:flex-start; padding:30px; background:white;}
    .company-info {flex:1;}
    .logo-section {display:flex; align-items:center; margin-bottom:15px;}
    .logo-text {font-size:2.5em; font-weight:bold; margin-right:10px;}
    .logo-ad {color:#1e3a8a;} .logo-ex {color:#e43f50;}
    .airplane-icon {width:30px; height:30px; margin-left:10px;}
    .tagline {color:#e43f50; font-size:0.9em; font-weight:bold; text-transform:uppercase; letter-spacing:1px; margin-bottom:10px;}
    .company-name {color:#000; font-size:1.1em; font-weight:500;}
    .invoice-title {background:#e43f50; color:white; padding:15px 25px; font-size:1.5em; font-weight:bold; text-align:center; border-radius:5px;}
    .billing-section {display:flex; justify-content:space-between; padding:30px; background:white;}
    .billed-to-box {background:#e43f50; color:white; padding:20px; border-radius:5px; flex:1; margin-right:20px;}
    .billed-to-title {font-weight:bold; margin-bottom:10px;}
    .billed-to-content {line-height:1.6;}
    .invoice-details {flex:1; padding:20px;}
    .detail-row {display:flex; justify-content:space-between; margin-bottom:10px; padding:5px 0;}
    .detail-label {font-weight:500; color:#374151;}
    .detail-value {font-weight:600; color:#000;}
    .total-due-box {background:#e43f50; color:white; padding:15px 20px; border-radius:5px; margin-top:20px;}
    .total-due-content {display:flex; justify-content:space-between; align-items:center;}
    .total-due-label {font-weight:bold; font-size:1.1em;}
    .total-due-amount {font-weight:bold; font-size:1.3em;}
    .services-section {padding:30px; background:white;}
    .services-table {width:100%; border-collapse:collapse; margin-bottom:20px;}
    .services-table th {background:#e43f50; color:white; padding:15px 10px; text-align:center; font-weight:bold;}
    .services-table td {padding:15px 10px; border-bottom:1px solid #e5e7eb; text-align:center;}
    .service-name {text-align:left;}
    .service-description {font-size:0.9em; color:#6b7280; margin-top:5px;}
    .totals-section {display:flex; justify-content:flex-end; padding:0 30px 30px;}
    .totals-box {width:300px;}
    .total-row {display:flex; justify-content:space-between; margin-bottom:10px; padding:5px 0;}
    .total-label {font-weight:500; color:#374151;}
    .total-value {font-weight:600; color:#000;}
    .final-total-box {background:#e43f50; color:white; padding:15px 20px; border-radius:5px; margin-top:15px;}
    .final-total-content {display:flex; justify-content:space-between; align-items:center;}
    .final-total-label {font-weight:bold; font-size:1.1em;}
    .final-total-amount {font-weight:bold; font-size:1.3em;}
    .bank-details {background:#f3f4f6; padding:20px 30px; margin:0 30px 30px; border-radius:5px;}
    .bank-details h4 {color:#374151; margin-bottom:15px; font-size:1.1em;}
    .bank-info {color:#000; line-height:1.6;}
    .bank-info div {margin-bottom:5px;}
    .actions {text-align:center; padding:30px; background:white;}
    .btn {display:inline-block; padding:12px 30px; margin:0 10px; text-decoration:none; border-radius:5px; font-weight:600; transition:all .3s ease;}
    .btn-primary {background:#e43f50; color:white;}
    .btn-primary:hover {background:#b91c1c; transform:translateY(-2px);}
    .btn-secondary {background:#6b7280; color:white;}
    .btn-secondary:hover {background:#4b5563; transform:translateY(-2px);}
    @page {margin:10mm;}
    @media print {
  .actions {
    display: none !important;
  }
}
  </style>
</head>
<body>
  <div class="invoice-container" id="invoice">
    <!-- Header -->
    <div class="invoice-header">
      <div class="company-info">
        <div class="logo-section">
         <img class="logo" src="/storage/company/logos/EUF6Xc4fXfp5oIew8OM7SWMnwICEvoPT16rqUkfR.jpg" alt="Logo" style="width: 41%;margin-top: -30px;">
        </div>
       
        <div class="company-name">Adex Worldwide Courier SMC Private Limited</div>
      </div>
      <div class="invoice-title">INVOICE</div>
    </div>

    <!-- Billing Section -->
    <div class="billing-section">
      <div class="billed-to-box">
        <div class="billed-to-title">Billed To</div>
        <div class="billed-to-content">
          <?php echo e($invoice->billed_to); ?><br>
          From: <?php echo e($invoice->from_company); ?><br>
          <?php echo e($invoice->address); ?><br>
          <?php echo e($invoice->contact); ?>

        </div>
      </div>
      <div class="invoice-details">
        <div class="detail-row"><span class="detail-label">Invoice Number:</span><span class="detail-value"><?php echo e($invoice->invoice_number); ?></span></div>
        <div class="detail-row"><span class="detail-label">Invoice Date:</span><span class="detail-value"><?php echo e($invoice->invoice_date->format('M jS, Y')); ?></span></div>
        <div class="detail-row"><span class="detail-label">Due Date:</span><span class="detail-value"><?php echo e($invoice->due_date->format('M jS, Y')); ?></span></div>
        <div class="total-due-box">
          <div class="total-due-content">
            <span class="total-due-label">TOTAL DUE</span>
            <span class="total-due-amount"><?php echo e(number_format($invoice->total_amount, 0)); ?></span>
          </div>
        </div>
      </div>
    </div>

    <!-- Services Section -->
    <div class="services-section">
      <table class="services-table">
        <thead>
          <tr>
            <th>HRS/QTY</th>
            <th>SERVICE</th>
            <th>Rate/Piece</th>
            <th>Adjust</th>
            <th>SUB TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <?php if(is_array($invoice->services)): ?>
            <?php $__currentLoopData = $invoice->services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($service['hrs_qty'] ?? 1); ?></td>
                <td class="service-name">
                  <?php echo e($service['service_name'] ?? 'Service'); ?>

                  <?php if(isset($service['description']) && $service['description']): ?>
                    <div class="service-description"><?php echo e($service['description']); ?></div>
                  <?php endif; ?>
                </td>
                <td><?php echo e(($service['rate_piece'] ?? 0) == 0 ? '-' : number_format($service['rate_piece'], 0)); ?></td>
                <td><?php echo e($service['adjust'] ?? 0); ?>%</td>
                <td><?php echo e(number_format($service['sub_total'] ?? 0, 0)); ?></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php else: ?>
            <tr>
              <td>1</td>
              <td class="service-name">International Logistics</td>
              <td>-</td>
              <td>0%</td>
              <td><?php echo e(number_format($invoice->total_amount, 0)); ?></td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <!-- Totals Section -->
    <div class="totals-section">
      <div class="totals-box">
        <div class="total-row"><span class="total-label">Sub Total:</span><span class="total-value"><?php echo e(number_format($invoice->subtotal, 0)); ?></span></div>
        <div class="total-row"><span class="total-label">Tax:</span><span class="total-value"><?php echo e($invoice->tax_amount > 0 ? number_format($invoice->tax_amount, 0) : '--'); ?></span></div>
        <div class="final-total-box">
          <div class="final-total-content">
            <span class="final-total-label">Total</span>
            <span class="final-total-amount"><?php echo e(number_format($invoice->total_amount, 0)); ?></span>
          </div>
        </div>
      </div>
    </div>

    <!-- Bank Details -->
    <div class="bank-details">
      <h4>Bank Details</h4>
      <div class="bank-info">
        <div><strong>Title of Account:</strong> <?php echo e($invoice->bank_title); ?></div>
        <div><strong>Account Number:</strong> <?php echo e($invoice->account_number); ?></div>
        <div><strong>IBAN:</strong> <?php echo e($invoice->iban); ?></div>
        <div><strong>Bank:</strong> <?php echo e($invoice->bank_name); ?></div>
      </div>
    </div>

    <!-- Actions -->
    <div class="actions">
      <a href="#" id="downloadPdf" class="btn btn-primary">
        <i class="fas fa-download"></i> Download PDF
      </a>
      <a href="<?php echo e(route('invoices.generate')); ?>" class="btn btn-secondary">
        <i class="fas fa-plus"></i> Generate New Invoice
      </a>
    </div>
  </div>

  <!-- jQuery + html2pdf -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

  <script>
    $(function () {
    $('#downloadPdf').on('click', function (e) {
      e.preventDefault();

      const element = document.getElementById('invoice');
      const actions = document.querySelector('.actions');
      
      // 👇 Hide buttons before creating PDF
      actions.style.display = 'none';

      const opt = {
        margin: [10, 10, 10, 10],
        filename: 'invoice-<?php echo e($invoice->invoice_number ?? "invoice"); ?>.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2, useCORS: true, scrollY: 0 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
        pagebreak: { mode: ['avoid-all', 'css', 'legacy'] }
      };

      html2pdf()
        .set(opt)
        .from(element)
        .save()
        .then(() => {
          // 👇 Show buttons again after PDF is done
          actions.style.display = 'block';
        });
    });
  });
  </script>
</body>
</html>
<?php /**PATH /home/u796145342/domains/adexcourier.com/public_html/portal/resources/views/invoices/generated.blade.php ENDPATH**/ ?>