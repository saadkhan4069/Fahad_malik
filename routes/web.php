<?php

use App\Http\Controllers\CompanyAuthController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserBookingController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LabelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Public tracking routes (no authentication required)
Route::get('/track', [App\Http\Controllers\TrackingController::class, 'index'])->name('tracking.index');
Route::post('/track', [App\Http\Controllers\TrackingController::class, 'track'])->name('tracking.track');

// Company Authentication routes
Route::middleware('guest:company')->group(function () {
    Route::get('/login', [CompanyAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [CompanyAuthController::class, 'login']);
    Route::get('/register', [CompanyAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [CompanyAuthController::class, 'register']);
    Route::get('/company/login', [CompanyAuthController::class, 'showLoginForm'])->name('company.login');
    Route::post('/company/login', [CompanyAuthController::class, 'login']);
    Route::get('/company/register', [CompanyAuthController::class, 'showRegisterForm'])->name('company.register');
    Route::post('/company/register', [CompanyAuthController::class, 'register']);
});

// User Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/user/login', [UserAuthController::class, 'showLoginForm'])->name('user.login');
    Route::post('/user/login', [UserAuthController::class, 'login']);
    Route::get('/user/register', [UserAuthController::class, 'showRegisterForm'])->name('user.register');
    Route::post('/user/register', [UserAuthController::class, 'register']);
});

Route::post('/logout', [CompanyAuthController::class, 'logout'])->name('logout');
Route::post('/user/logout', [UserAuthController::class, 'logout'])->name('user.logout');
Route::post('/company/logout', [CompanyAuthController::class, 'logout'])->name('company.logout');

// Generate Invoice routes (Public)
Route::get('/invoices/generate', [InvoiceController::class, 'generateInvoice'])->name('invoices.generate');
Route::post('/invoices/generate', [InvoiceController::class, 'storeInvoice'])->name('invoices.store');
Route::get('/invoices/{invoice}/generated', [InvoiceController::class, 'showGenerated'])->name('invoices.generated');

// Company Protected routes
Route::middleware(['auth:company'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Booking routes
    Route::resource('bookings', BookingController::class);
    Route::get('/bookings-data', [BookingController::class, 'getBookingsData'])->name('bookings.data');
    Route::post('/bookings/{booking}/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
    Route::post('/bookings/{booking}/mark-paid', [BookingController::class, 'markPaid'])->name('bookings.mark-paid');
    Route::get('/bookings/new', function() {
        $services = \DB::table('services')->get();
        $countries = \DB::table('countries')->get();
        $currencies = \DB::table('currencies')->get();
        $units = \DB::table('units')->get();
        $branches = \DB::table('branches')->get();
        
        return view('bookings.new-booking', compact('services', 'countries', 'currencies', 'units', 'branches'));
    })->name('bookings.new');
    
    // Invoice routes
    Route::resource('invoices', InvoiceController::class)->only(['index', 'show']);
    Route::get('/invoices/{invoice}/pdf', [InvoiceController::class, 'generatePdf'])->name('invoices.pdf');
    Route::post('/invoices/{invoice}/paid', [InvoiceController::class, 'markAsPaid'])->name('invoices.paid');
    Route::post('/invoices/{invoice}/send', [InvoiceController::class, 'sendInvoice'])->name('invoices.send');
    Route::patch('/invoices/{invoice}/payment', [InvoiceController::class, 'updatePayment'])->name('invoices.payment');
    
    // Proforma Invoice routes
    Route::get('/bookings/{booking}/proforma', [InvoiceController::class, 'generateProformaInvoice'])->name('invoices.proforma');
    Route::get('/bookings/{booking}/proforma/pdf', [InvoiceController::class, 'generateProformaPdf'])->name('invoices.proforma.pdf');
    
    
    // Company Profile routes
    Route::get('/company/profile', [App\Http\Controllers\CompanyProfileController::class, 'show'])->name('company.profile');
    Route::put('/company/profile', [App\Http\Controllers\CompanyProfileController::class, 'update'])->name('company.profile.update');
    
    // Label routes
    Route::resource('labels', LabelController::class)->only(['index', 'show']);
    Route::post('/labels/generate/{shipment}', [LabelController::class, 'generate'])->name('labels.generate');
    Route::get('/labels/{label}/download', [LabelController::class, 'downloadPdf'])->name('labels.download');
    Route::post('/labels/{label}/print', [LabelController::class, 'print'])->name('labels.print');
    Route::put('/labels/{label}/update-tracking', [LabelController::class, 'updateLabelTracking'])->name('labels.update-tracking');
    Route::get('/labels-data', [LabelController::class, 'getLabelsData'])->name('labels.data');
    
    // Shipment routes
    Route::put('/shipments/{shipment}/update-tracking', [DashboardController::class, 'updateShipmentTracking'])->name('shipments.update-tracking');
});

// User Protected routes
Route::middleware(['auth'])->group(function () {
    // User Dashboard
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    
    // User Booking routes
    Route::resource('user/bookings', UserBookingController::class)->names([
        'index' => 'user.bookings.index',
        'create' => 'user.bookings.create',
        'store' => 'user.bookings.store',
        'show' => 'user.bookings.show',
        'edit' => 'user.bookings.edit',
        'update' => 'user.bookings.update',
        'destroy' => 'user.bookings.destroy'
    ]);
    Route::post('/user/bookings/{booking}/confirm', [UserBookingController::class, 'confirm'])->name('user.bookings.confirm');
    Route::post('/user/bookings/{booking}/mark-paid', [UserBookingController::class, 'markPaid'])->name('user.bookings.mark-paid');
    Route::get('/user/bookings-data', [UserBookingController::class, 'getBookingsData'])->name('user.bookings.data');
    
    // User Shipment routes
    Route::put('/user/shipments/{shipment}/update-tracking', [UserDashboardController::class, 'updateShipmentTracking'])->name('user.shipments.update-tracking');
    
    // User Invoice routes
    Route::get('/user/invoices', [UserDashboardController::class, 'invoices'])->name('user.invoices.index');
    Route::get('/user/invoices/{invoice}', [UserDashboardController::class, 'showInvoice'])->name('user.invoices.show');
    Route::get('/user/invoices/{invoice}/pdf', [UserDashboardController::class, 'invoicePdf'])->name('user.invoices.pdf');
    Route::get('/user/bookings/{booking}/proforma', [InvoiceController::class, 'generateProformaInvoice'])->name('user.invoices.proforma');
    Route::get('/user/bookings/{booking}/proforma/pdf', [InvoiceController::class, 'generateProformaPdf'])->name('user.invoices.proforma.pdf');
    
    // User Label routes
    Route::get('/user/labels', [UserDashboardController::class, 'labels'])->name('user.labels.index');
    Route::get('/user/labels/{label}', [UserDashboardController::class, 'showLabel'])->name('user.labels.show');
    Route::get('/user/labels/{label}/download', [UserDashboardController::class, 'downloadLabel'])->name('user.labels.download');
    Route::post('/user/labels/generate/{shipment}', [LabelController::class, 'generate'])->name('user.labels.generate');
    Route::put('/user/labels/{label}/update-tracking', [LabelController::class, 'updateLabelTracking'])->name('user.labels.update-tracking');
    
    // User Profile routes
    Route::get('/user/profile', [App\Http\Controllers\UserProfileController::class, 'show'])->name('user.profile');
    Route::put('/user/profile', [App\Http\Controllers\UserProfileController::class, 'update'])->name('user.profile.update');
    
    // Debug route
    Route::get('/debug-form', function () {
        return view('debug-form');
    });
    
    // Test performa invoice route
    Route::get('/test-proforma', function () {
        $booking = App\Models\Booking::first();
        if (!$booking) {
            return 'No bookings found. Please create a booking first.';
        }
        return redirect()->route('invoices.proforma', $booking);
    });
});
