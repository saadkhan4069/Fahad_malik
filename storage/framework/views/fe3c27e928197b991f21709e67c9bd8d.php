<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking Status - Adex Courier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .tracking-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            margin: 30px auto;
            max-width: 900px;
            overflow: hidden;
        }
        .adex-logo {
            max-width: 150px;
            height: auto;
            margin-bottom: 15px;
        }
        .tracking-header {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .shipment-info {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 25px;
            margin: 20px;
        }
        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e9ecef;
        }
        .info-item:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 600;
            color: #213F60;
        }
        .info-value {
            color: #333;
        }
        .timeline {
            position: relative;
            padding: 20px;
        }
        .timeline::before {
            content: '';
            position: absolute;
            left: 30px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e9ecef;
        }
        .timeline-item {
            position: relative;
            margin-bottom: 30px;
            padding-left: 80px;
        }
        .timeline-icon {
            position: absolute;
            left: 0;
            top: 0;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            z-index: 2;
            transition: all 0.3s ease;
        }
        .timeline-icon.completed {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            animation: pulse 2s infinite;
        }
        .timeline-icon.pending {
            background: linear-gradient(135deg, #6c757d 0%, #adb5bd 100%);
        }
        .timeline-content {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #213F60;
        }
        .timeline-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }
        .timeline-description {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        .timeline-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: #888;
        }
        .status-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        .status-completed {
            background: #d4edda;
            color: #155724;
        }
        .status-pending {
            background: #f8d7da;
            color: #721c24;
        }
        .btn-back {
            background: linear-gradient(135deg, #213F60 0%, #E52B3B 100%);
            border: none;
            border-radius: 10px;
            padding: 10px 25px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
        }
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
            }
        }
        .checkmark {
            animation: checkmark 0.6s ease-in-out;
        }
        @keyframes checkmark {
            0% {
                transform: scale(0);
            }
            50% {
                transform: scale(1.2);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="tracking-container">
                    <!-- Header -->
                    <div class="tracking-header">
                        <img src="storage/company/logos/EUF6Xc4fXfp5oIew8OM7SWMnwICEvoPT16rqUkfR.jpg" alt="Adex Courier" class="adex-logo">
                        <h1 class="h3 mb-0">Tracking Status</h1>
                        <p class="mb-0">Real-time shipment tracking information</p>
                    </div>

                    <!-- Shipment Information -->
                    <div class="shipment-info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="info-label">Tracking #:</span>
                                    <span class="info-value"><?php echo e($trackingNumber); ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Packages:</span>
                                    <span class="info-value"><?php echo e($shipment->weight ?? 1); ?> kg</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item">
                                    <span class="info-label">Destination:</span>
                                    <span class="info-value"><?php echo e(strtoupper($shipment->destination_address ?? 'Destination')); ?></span>
                                </div>
                                <!-- <div class="info-item">
                                    <span class="info-label">Current Status:</span>
                                    <span class="info-value">
                                        <span class="status-badge <?php echo e($shipment->status === 'delivered' ? 'status-completed' : 'status-pending'); ?>">
                                            <?php echo e(ucfirst(str_replace('_', ' ', $shipment->status))); ?>

                                        </span>
                                    </span>
                                </div> -->
                            </div>
                        </div>
                        <?php if($shipment->tracking_notes): ?>
                        <div class="info-item">
                            <span class="info-label">Remarks:</span>
                            <span class="info-value"><?php echo e($shipment->tracking_notes); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>

                    <!-- Timeline -->
                    <div class="timeline">
                        <?php $__currentLoopData = $trackingEvents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="timeline-item">
                            <div class="timeline-icon <?php echo e($event['status'] === 'completed' ? 'completed checkmark' : 'pending'); ?>">
                                <?php if($event['status'] === 'completed'): ?>
                                    <i class="fas fa-check"></i>
                                <?php else: ?>
                                    <span><?php echo e($event['id']); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-title">
                                    <i class="<?php echo e($event['icon']); ?> me-2"></i>
                                    <?php echo e($event['title']); ?>

                                </div>
                                <div class="timeline-description">
                                    <?php echo e($event['description']); ?>

                                </div>
                                <div class="timeline-meta">
                                    <span>
                                        <i class="fas fa-calendar me-1"></i>
                                        <?php echo e($event['date']); ?> at <?php echo e($event['time']); ?>

                                    </span>
                                    <span>
                                        <i class="fas fa-map-marker-alt me-1"></i>
                                        <?php echo e($event['location']); ?>

                                    </span>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Back Button -->
                    <div class="text-center p-4">
                        <a href="<?php echo e(route('tracking.index')); ?>" class="btn-back">
                            <i class="fas fa-arrow-left me-2"></i>Track Another Shipment
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add animation delay for each completed item
        document.addEventListener('DOMContentLoaded', function() {
            const completedItems = document.querySelectorAll('.timeline-icon.completed');
            completedItems.forEach((item, index) => {
                setTimeout(() => {
                    item.style.animationDelay = `${index * 0.2}s`;
                }, 100);
            });
        });
    </script>
</body>
</html>
<?php /**PATH D:\Laravel\shipment_fahad_malik\resources\views/tracking/result.blade.php ENDPATH**/ ?>