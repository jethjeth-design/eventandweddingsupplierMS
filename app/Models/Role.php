<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'supplier_id',
        'name',
        'description'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
