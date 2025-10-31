# Shipment Booking System

A comprehensive Laravel-based shipment booking system designed for companies to manage their shipping operations efficiently.

## Features

- **Company Registration & Authentication**: Secure company-based authentication system
- **Booking Management**: Create, view, edit, and confirm shipment bookings
- **Shipment Tracking**: Complete shipment lifecycle management with tracking numbers
- **Invoice Generation**: Automatic invoice creation with PDF export functionality
- **Label Generation**: Shipping label creation with PDF printing support
- **Dashboard**: Comprehensive dashboard with statistics and recent activities
- **Responsive Design**: Mobile-friendly interface using Bootstrap 5

## System Architecture

### Models
- **Company**: Company information and authentication
- **Booking**: Shipment booking details
- **Shipment**: Actual shipment with tracking information
- **Invoice**: Billing and payment management
- **Label**: Shipping label generation and management

### Key Features
- Multi-company support with isolated data
- Automatic cost calculation based on weight, dimensions, and service type
- PDF generation for invoices and shipping labels
- Comprehensive booking workflow from creation to delivery
- Payment tracking and invoice management

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd shipment_system
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database configuration**
   - Update your `.env` file with database credentials
   - Create a MySQL database named `shipment_system`

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Seed the database**
   ```bash
   php artisan db:seed
   ```

7. **Start the development server**
   ```bash
   php artisan serve
   ```

## Default Login Credentials

The system comes with pre-seeded company accounts:

1. **Tech Solutions Ltd**
   - Email: admin@techsolutions.com
   - Password: password123

2. **E-Commerce Pro**
   - Email: info@ecommercepro.com
   - Password: password123

3. **Global Trading Co**
   - Email: contact@globaltrading.com
   - Password: password123

## Usage

### 1. Company Registration
- Companies can register with their business information
- Each company has isolated data and cannot access other companies' information

### 2. Creating Bookings
- Fill in shipper and consignee information
- Specify package details (weight, dimensions, value)
- Choose service type (Standard, Express, Overnight, International)
- System automatically calculates shipping costs

### 3. Confirming Bookings
- Review booking details
- Confirm to create shipment and generate invoice
- System generates tracking number and creates invoice

### 4. Managing Shipments
- Track shipment status
- Generate shipping labels
- Monitor delivery progress

### 5. Invoice Management
- View and download invoices
- Mark payments as received
- Track payment status

### 6. Label Generation
- Generate shipping labels for confirmed bookings
- Download PDF labels for printing
- Track label printing status

## Cost Calculation

The system calculates shipping costs based on:
- **Base Cost**: PKR 100
- **Weight Cost**: PKR 50 per kg
- **Volume Cost**: PKR 10 per cubic cm
- **Service Multiplier**:
  - Standard: 1x
  - Express: 1.5x
  - Overnight: 2x
  - International: 3x

## Technology Stack

- **Backend**: Laravel 10
- **Frontend**: Bootstrap 5, Blade Templates
- **Database**: MySQL
- **PDF Generation**: DomPDF
- **Authentication**: Laravel Guards (Company-based)

## File Structure

```
app/
├── Http/Controllers/
│   ├── CompanyAuthController.php
│   ├── DashboardController.php
│   ├── BookingController.php
│   ├── InvoiceController.php
│   └── LabelController.php
├── Models/
│   ├── Company.php
│   ├── Booking.php
│   ├── Shipment.php
│   ├── Invoice.php
│   └── Label.php
└── Policies/
    ├── BookingPolicy.php
    ├── InvoicePolicy.php
    └── LabelPolicy.php

resources/views/
├── layouts/
├── auth/
├── bookings/
├── invoices/
├── labels/
└── dashboard.blade.php

database/migrations/
├── create_companies_table.php
├── create_bookings_table.php
├── create_shipments_table.php
├── create_invoices_table.php
└── create_labels_table.php
```

## API Endpoints

### Authentication
- `POST /login` - Company login
- `POST /register` - Company registration
- `POST /logout` - Company logout

### Bookings
- `GET /bookings` - List bookings
- `POST /bookings` - Create booking
- `GET /bookings/{id}` - Show booking
- `PUT /bookings/{id}` - Update booking
- `POST /bookings/{id}/confirm` - Confirm booking

### Invoices
- `GET /invoices` - List invoices
- `GET /invoices/{id}` - Show invoice
- `GET /invoices/{id}/pdf` - Download invoice PDF
- `POST /invoices/{id}/paid` - Mark as paid

### Labels
- `GET /labels` - List labels
- `POST /labels/generate/{shipment}` - Generate label
- `GET /labels/{id}/download` - Download label PDF
- `POST /labels/{id}/print` - Mark as printed

## Security Features

- Company-based data isolation
- CSRF protection
- Input validation
- Authorization policies
- Secure authentication

## Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## License

This project is licensed under the MIT License.

## Support

For support and questions, please contact the development team.
