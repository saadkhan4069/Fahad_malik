<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'booking_id',
        'shipment_id',
        'invoice_number',
        'invoice_date',
        'due_date',
        'status',
        'subtotal',
        'tax_amount',
        'discount_amount',
        'total_amount',
        'payment_method',
        'payment_status',
        'payment_date',
        'notes',
        'billed_to',
        'from_company',
        'address',
        'contact',
        'services',
        'bank_title',
        'account_number',
        'iban',
        'bank_name'
    ];

    protected $casts = [
        'invoice_date' => 'datetime',
        'due_date' => 'datetime',
        'payment_date' => 'datetime',
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'services' => 'array',
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

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }

    // Scopes
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopeUnpaid($query)
    {
        return $query->where('payment_status', 'unpaid');
    }

    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now())->where('payment_status', 'unpaid');
    }
}
