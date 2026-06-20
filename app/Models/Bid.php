<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [
        'event_id',
        'package_id',
        'client_id',
        'supplier_id',
        'final_price',
        'status',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }

    public function messages()
    {
        return $this->hasMany(BidMessage::class);
    }

    public function latestMessage()
    {
        return $this->hasOne(BidMessage::class)->latestOfMany();
    }
}