<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopularPackageItem extends Model
{
    protected $fillable = [
        'popular_package_id',
        'supplier_id',
        'package_id',
    ];

    public function popularPackage()
    {
        return $this->belongsTo(PopularPackage::class);
    }

    public function supplier()
    {
        return $this->belongsTo(SupplierProfile::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}