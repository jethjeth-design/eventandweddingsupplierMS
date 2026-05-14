<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'event_id',
        'package_id',
        'supplier_id', 
        'popular_package_id',
        'event_date',
        'total_price',
        'status',
        'booking_type',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function popularPackage()
{
    return $this->belongsTo(PopularPackage::class);
}
    
}