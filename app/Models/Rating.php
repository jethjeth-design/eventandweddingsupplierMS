<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = [
        'user_id',
        'supplier_id',
        'rating',
        'review'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
