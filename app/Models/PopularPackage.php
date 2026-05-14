<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopularPackage extends Model
{
    protected $fillable = [
        'name',
        'event_type',
        'price',
        'guest_capacity',
        'duration_hours',
        'is_active'
    ];

    public function inclusions()
    {
        return $this->hasMany(PopularPackageInclusion::class, 'popular_package_id');
    }

    public function supplier()
    {
        return $this->belongsTo(SupplierProfile::class, 'supplier_id');
    }

    public function bookings()
    {
        return $this->hasMany(\App\Models\Booking::class, 'popular_package_id');
    }

    public function items()
    {
        return $this->hasMany(\App\Models\PopularPackageItem::class);
    }
}
