# Local Development Setup Guide

## Environment Configuration

Since `.env.local` is blocked, here's how to set up your local environment:

### Option 1: Use .env file directly

1. Copy the example environment file:
   ```bash
   cp .env.example .env
   ```

2. Update your `.env` file with these local development settings:
   ```env
   APP_NAME="Shipment System"
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://localhost:8000

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=shipment_system
   DB_USERNAME=root
   DB_PASSWORD=

   # Shipment System Specific Settings
   SHIPMENT_BASE_COST=100
   SHIPMENT_WEIGHT_RATE=50
   SHIPMENT_VOLUME_RATE=10
   SHIPMENT_TAX_RATE=5
   SHIPMENT_EXPRESS_MULTIPLIER=1.5
   SHIPMENT_OVERNIGHT_MULTIPLIER=2
   SHIPMENT_INTERNATIONAL_MULTIPLIER=3

   INVOICE_PREFIX=INV
   INVOICE_DUE_DAYS=30
   INVOICE_TAX_RATE=5

   LABEL_WIDTH=400
   LABEL_HEIGHT=600
   LABEL_MARGIN=10

   MAX_FILE_SIZE=10240
   ALLOWED_FILE_TYPES="pdf,jpg,jpeg,png"

   BOOKING_AUTO_CONFIRM=false
   SHIPMENT_AUTO_GENERATE_TRACKING=true
   COMPANY_AUTO_APPROVE=true
   COMPANY_REQUIRE_VERIFICATION=false
   ```

### Option 2: Create .env.local manually

If you can create `.env.local` manually, use these settings:

```env
# Local Development Environment
APP_NAME="Shipment System - Local"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=shipment_system
DB_USERNAME=root
DB_PASSWORD=

# Mail Configuration (Local)
MAIL_MAILER=log
MAIL_HOST=localhost
MAIL_PORT=1025
MAIL_FROM_ADDRESS="hello@shipmentsystem.local"
MAIL_FROM_NAME="Shipment System"

# Cache Configuration
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

# Shipment System Configuration
SHIPMENT_BASE_COST=100
SHIPMENT_WEIGHT_RATE=50
SHIPMENT_VOLUME_RATE=10
SHIPMENT_TAX_RATE=5
SHIPMENT_EXPRESS_MULTIPLIER=1.5
SHIPMENT_OVERNIGHT_MULTIPLIER=2
SHIPMENT_INTERNATIONAL_MULTIPLIER=3

# Invoice Settings
INVOICE_PREFIX=INV
INVOICE_DUE_DAYS=30
INVOICE_TAX_RATE=5

# Label Settings
LABEL_WIDTH=400
LABEL_HEIGHT=600
LABEL_MARGIN=10

# File Upload Settings
MAX_FILE_SIZE=10240
ALLOWED_FILE_TYPES="pdf,jpg,jpeg,png"

# Development Settings
BOOKING_AUTO_CONFIRM=false
SHIPMENT_AUTO_GENERATE_TRACKING=true
COMPANY_AUTO_APPROVE=true
COMPANY_REQUIRE_VERIFICATION=false
```

## Quick Setup Commands

```bash
# 1. Install dependencies
composer install

# 2. Setup environment
cp .env.example .env
php artisan key:generate

# 3. Create database
mysql -u root -p -e "CREATE DATABASE shipment_system;"

# 4. Run migrations
php artisan migrate

# 5. Seed with demo data
php artisan db:seed

# 6. Start development server
php artisan serve
```

## Local Development Features

- **Debug Mode**: Enabled for detailed error reporting
- **Log Driver**: Mail uses log driver (emails saved to storage/logs)
- **File Cache**: Uses file-based caching for sessions and cache
- **Demo Data**: Pre-seeded with sample companies and data
- **Local URL**: http://localhost:8000

## Default Login Credentials

1. **Tech Solutions Ltd**
   - Email: admin@techsolutions.com
   - Password: password123

2. **E-Commerce Pro**
   - Email: info@ecommercepro.com
   - Password: password123

3. **Global Trading Co**
   - Email: contact@globaltrading.com
   - Password: password123

## Testing the System

1. **Register a new company** or use existing credentials
2. **Create a booking** with sample data
3. **Confirm the booking** to generate shipment and invoice
4. **Generate shipping label** for the shipment
5. **Download invoice PDF** and **label PDF**

## Troubleshooting

- **Database Connection**: Ensure MySQL is running and database exists
- **File Permissions**: Make sure storage/ and bootstrap/cache/ are writable
- **Composer Issues**: Run `composer install --no-dev` if needed
- **Migration Errors**: Check database credentials in .env file

## Fixed Issues

✅ **LabelPolicy Error Fixed**: 
- Removed duplicate `view` method in LabelPolicy
- Created separate ShipmentPolicy for Shipment authorization
- Updated AuthServiceProvider with correct policy mappings

✅ **Models Recreated**: 
- Company.php
- Shipment.php  
- Booking.php
- All models restored with proper relationships and fillable attributes
