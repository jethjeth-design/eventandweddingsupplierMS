<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'supplier_id',
        'name',
        'role',
        'phone',
        'email',
        'is_active'
    ];

    public function supplier()
    {
        return $this->belongsTo(SupplierProfile::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'package_team');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
