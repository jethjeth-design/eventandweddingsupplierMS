<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollaborationMember extends Model
{
   protected $fillable = [
        'collaboration_id',
        'supplier_profile_id',
        'role',
        'responsibilities',
        'agreed_price',
        'status'
    ];

    public function collaboration()
    {
        return $this->belongsTo(Collaboration::class);
    }

    public function supplier()
{
    return $this->belongsTo(SupplierProfile::class, 'supplier_profile_id');
}
}
