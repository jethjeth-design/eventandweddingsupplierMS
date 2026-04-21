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
     
    protected $casts = [
        'inclusion' => 'array',
    ];

    public function supplier()
    {
        return $this->belongsTo(SupplierProfile::class, 'supplier_id');
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
}

