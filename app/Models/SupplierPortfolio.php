<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierPortfolio extends Model
{
     protected $fillable = [
        'supplier_id',
        'title',
        'description',
        'images',
        'video'
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function supplier()
    {
        return $this->belongsTo(SupplierProfile::class, 'supplier_id');
    }
}
