<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierProfile extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'photo',
        'business_name',
        'tagline',
        'phone',
        'city',
        'province',
        'bio',
        'experience',
        'category',
        'description',
        'address',
        'price',
        'rating',
        'is_available',
    ];

    protected $casts = [
        'is_available' => 'boolean',
        'rating' => 'float',
        'price' => 'float',
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function portfolios()
    {
        return $this->hasMany(SupplierPortfolio::class);
    }

    
}
