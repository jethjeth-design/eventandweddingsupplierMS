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
        'notes'
    ];
}
