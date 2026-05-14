<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        // 👤 RELATIONSHIP FIELDS
        'sender_id',
        'receiver_id',
        'supplier_id',
        'package_id',
        'event_id',

        // 💬 MESSAGE CONTENT
        'message',

        // 💰 BIDDING SYSTEM
        'offer_price',
        'type', // message | offer | counter | accept | reject
        'is_final_offer',

        // 📩 STATUS
        'is_read',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function supplier()
{
    return $this->belongsTo(SupplierProfile::class, 'supplier_id');
}
}
