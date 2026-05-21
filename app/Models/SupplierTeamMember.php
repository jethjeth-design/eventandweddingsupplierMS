<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierTeamMember extends Model
{
    protected $fillable = [

        'supplier_profile_id',

        'name',

        'role',

        'email',

        'phone',

        'bio',

        'photo',

        'is_active'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function supplier()
    {
        return $this->belongsTo(
            SupplierProfile::class,
            'supplier_profile_id'
        );
    }
}
