<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Invoice;
use App\Models\Label;
use App\Models\Shipment;
use App\Policies\BookingPolicy;
use App\Policies\InvoicePolicy;
use App\Policies\LabelPolicy;
use App\Policies\ShipmentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Booking::class => BookingPolicy::class,
        Invoice::class => InvoicePolicy::class,
        Label::class => LabelPolicy::class,
        Shipment::class => ShipmentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //
    }
}
