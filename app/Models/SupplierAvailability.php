<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierAvailability extends Model
{
   protected $fillable = [
        'supplier_id',
        'date',
        'status'
    ];

    public function supplier()
    {
        return $this->belongsTo(SupplierProfile::class, 'supplier_id');
    }
}
