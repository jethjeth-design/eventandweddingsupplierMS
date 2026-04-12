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
        'description',
        'address',
        'price',
        'rating',
        'is_available',
    ];
    
    public function portfolios()
    {
        return $this->hasMany(SupplierPortfolio::class, 'supplier_id');
    }
    
    public function packages()
    {
       return $this->hasMany(Package::class, 'supplier_id');
    }

    // 🔗 Many-to-Many with categories
    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'supplier_category',
            'supplier_id',   // pivot column
            'category_id'    // pivot column
        );
    }

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

    public function venues() {
        return $this->belongsToMany(Venue::class, 'supplier_venue');
    }

    
}
