<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = ['name', 'description'];

    public function category()
{
    return $this->belongsTo(Category::class);
}
}
