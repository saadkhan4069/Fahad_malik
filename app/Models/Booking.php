<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'booking_number',
        'cn_number',
        'status',
        'shipper_name',
        'shipper_email',
        'shipper_phone',
        'shipper_address',
        'shipper_city',
        'shipper_country',
        'shipper_state',
        'shipper_zip',
        'shipper_cnic',
        'shipper_ntn',
        'consignee_name',
        'consignee_email',
        'consignee_phone',
        'consignee_address',
        'consignee_city',
        'consignee_country',
        'consignee_state',
        'consignee_zip',
        'consignee_attention',
        'package_description',
        'package_value',
        'weight',
        'dimensions',
        'service_type',
        'pickup_date',
        'delivery_date',
        'special_instructions',
        'total_cost',
        'booking_date',
        'goods_value_currency',
        'payment_status',
        'paid_at',
        'hs_code',
        'quantity',
        'unit',
        'rate',
        'dox_type',
        'form_e_number',
        'inco_terms',
        'export_reason',
        'invoice_items',
        'financial_instrument',
        'shipment_charges',
        'estimated_date',
        'shipment_reference'
    ];

    protected $casts = [
        'booking_date' => 'datetime',
        'pickup_date' => 'datetime',
        'delivery_date' => 'datetime',
        'package_value' => 'decimal:2',
        'weight' => 'decimal:2',
        'dimensions' => 'array',
        'total_cost' => 'decimal:2',
        'rate' => 'decimal:2',
        'quantity' => 'decimal:2',
        'invoice_items' => 'array',
        'paid_at' => 'datetime',
        'shipment_charges' => 'decimal:2',
        'estimated_date' => 'date',
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

    public function shipment()
    {
        return $this->hasOne(Shipment::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }
}
