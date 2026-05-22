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
        'is_listed',
        'min_price',
        'is_negotiable',
        'is_featured',
    ];
     
    protected $casts = [
        'inclusion' => 'array',
    ];

    public function popularPackageItems()
    {
        return $this->hasMany(PopularPackageItem::class);
    }

    public function featured()
    {
        return $this->hasOne(FeaturedPackage::class);
    }
    public function supplier()
    {
        return $this->belongsTo(SupplierProfile::class, 'supplier_id');
    }

    public function scopeListed($query)
    {
        return $query->where('is_listed', true);
    }
    
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    
    public function inclusions()
    {
        return $this->hasMany(PackageInclusion::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'package_team')
            ->withPivot('role_in_package')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }
    public function portfolios()
    {
        return $this->hasMany(SupplierPortfolio::class, 'supplier_id', 'supplier_id');
    }
}

