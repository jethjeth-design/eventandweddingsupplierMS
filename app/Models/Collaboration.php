<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaboration extends Model
{
    protected $fillable = [
        'owner_supplier_profile_id',
        'conversation_id',  
        'title',
        'description',
        'event_date',
        'location',
        'budget',
        'status'
    ];

    public function owner()
    {
        return $this->belongsTo(
            SupplierProfile::class,
            'owner_supplier_profile_id'
        );
    }

    public function members()
    {
        return $this->hasMany(CollaborationMember::class);
    }

    public function getAutoStatusAttribute()
{
    if (!$this->event_date) {
        return $this->status;
    }

    $eventDate = Carbon::parse($this->event_date);
    $today = Carbon::today();

    if ($eventDate->isFuture()) {
        return 'upcoming';
    }

    if ($eventDate->isToday()) {
        return 'ongoing';
    }

    return 'completed';
}
}
