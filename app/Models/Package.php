<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'supplier_id',
        'name',
        'description',
        'price',
        'guest_capacity',
        'event_type',
    ];


    public function supplier()
    {
        return $this->belongsTo(SupplierProfile::class, 'supplier_id');
    }


    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    
}

