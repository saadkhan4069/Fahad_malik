<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'booking_id',
        'tracking_number',
        'status',
        'origin_address',
        'destination_address',
        'origin_city',
        'destination_city',
        'origin_country',
        'destination_country',
        'weight',
        'dimensions',
        'shipping_date',
        'estimated_delivery',
        'actual_delivery',
        'shipping_cost',
        'notes',
        'tracking_notes'
    ];

    protected $casts = [
        'shipping_date' => 'datetime',
        'estimated_delivery' => 'datetime',
        'actual_delivery' => 'datetime',
        'weight' => 'decimal:2',
        'dimensions' => 'array',
        'shipping_cost' => 'decimal:2',
    ];

    // Relationships
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function labels()
    {
        return $this->hasMany(Label::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', '!=', 'delivered');
    }

    public function scopeDelivered($query)
    {
        return $query->where('status', 'delivered');
    }
}
