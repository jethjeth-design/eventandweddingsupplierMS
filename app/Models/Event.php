<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'user_id',
        'event_name',
        'event_type',
        'event_date',
        'budget',
        'description',
        'guest_count',
        'venue',

        // 🧠 recommendation tracking
        'is_recommended',
        'recommended_at',

        // 📌 event status (VERY IMPORTANT for system flow)
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
    
    
}
