<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'user_id',
        'shipment_id',
        'label_number',
        'label_type',
        'status',
        'file_path',
        'file_name',
        'file_size',
        'generated_at',
        'printed_at',
        'tracking_code',
        'barcode_data',
        'individual_tracking_number',
        'individual_status',
        'individual_tracking_notes',
        'individual_estimated_delivery'
    ];

    protected $casts = [
        'generated_at' => 'datetime',
        'printed_at' => 'datetime',
        'file_size' => 'integer',
        'individual_estimated_delivery' => 'datetime',
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
        return $this->belongsTo(Shipment::class);
    }

    // Scopes
    public function scopeGenerated($query)
    {
        return $query->where('status', 'generated');
    }

    public function scopePrinted($query)
    {
        return $query->where('status', 'printed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
