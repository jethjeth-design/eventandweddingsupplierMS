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
        'cover_photo', 
        'phone',
        'bio',
        'business_name',
        'tagline',
        'city',
        'province',
        'description',
        'address',
        'starting_price',
        'rating',
        'is_available',
        'is_featured',
        
    ];
    
    public function portfolios()
    {
        return $this->hasMany(SupplierPortfolio::class, 'supplier_id');
    }

    public function popularPackageItems()
    {
        return $this->hasMany(PopularPackageItem::class, 'supplier_id');
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
        return $this->hasMany(Rating::class, 'supplier_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function venues() {
        return $this->belongsToMany(Venue::class, 'supplier_venue');
    }

    // Suppliers I invited
    public function collaborators()
    {
        return $this->hasMany(
            SupplierCollaborator::class,
            'supplier_id'
        );
    }

    // Suppliers inviting me
    public function collaborationInvites()
    {
        return $this->hasMany(
            SupplierCollaborator::class,
            'collaborator_id'
        );
    }

    public function teamMembers()
    {
        return $this->hasMany(
            SupplierTeamMember::class,
            'supplier_profile_id'
        );
    }
}
