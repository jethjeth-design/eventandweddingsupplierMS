<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{ 
    protected $fillable = ['name','slug','description'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }
    
    // 🤖 Recommendations
    public function recommendations()
    {
        return $this->hasMany(EventRecommendation::class);
    }
    public function suppliers()
    {
        return $this->belongsToMany(SupplierProfile::class, 'supplier_category');
    }

    public function venues()
    {
        return $this->hasMany(Subcategory::class);
    }
}

