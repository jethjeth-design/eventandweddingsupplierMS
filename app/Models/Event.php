<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'client_id',
        'event_type',
        'event_date',
        'location',
        'budget',
        'guest_count',
        'theme',
        'notes',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function suppliers()
{
    return $this->belongsToMany(SupplierProfile::class, 'event_supplier_profile');
}
}
