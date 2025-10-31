<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Company extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'city',
        'state',
        'zip_code',
        'country',
        'tax_id',
        'is_active',
        'contact_first_name',
        'contact_last_name',
        'contact_person',
        'cnic_no',
        'ntn_no',
        'account_activity',
        'accounts_email',
        'accounts_mobile',
        'website',
        'gst_no',
        'logo',
        'cnic_front',
        'cnic_back',
        'ntn_image',
        'company_name',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function users()
    {
        return $this->hasMany(\App\Models\User::class);
    }

    public function shipments()
    {
        return $this->hasMany(\App\Models\Shipment::class);
    }

    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class);
    }

    public function invoices()
    {
        return $this->hasMany(\App\Models\Invoice::class);
    }

    public function labels()
    {
        return $this->hasMany(\App\Models\Label::class);
    }
}
