<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BidMessage extends Model
{
    protected $fillable = [
        'bid_id',
        'sender_id',
        'offer_price',
        'message'
    ];

    public function bid()
    {
        return $this->belongsTo(Bid::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}