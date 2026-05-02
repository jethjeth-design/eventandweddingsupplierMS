<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopularPackageInclusion extends Model
{
    protected $fillable = [
        'popular_package_id',
        'title',
        'type'
    ];

    public function package()
{
    return $this->belongsTo(PopularPackage::class, 'popular_package_id');
}
}
