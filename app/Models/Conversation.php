<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
         
        'title',
        'type',
        'created_by',
        'collaboration_id',
        'package_id',
        'popular_package_id',
        'is_bidding_chat',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function participants()
    {
        return $this->hasMany(
            ConversationParticipant::class
        );
    }

    public function messages()
    {
        return $this->hasMany(
            Message::class
        );
    }

     public function latestMessage()
    {
        return $this->hasOne(Message::class)->latestOfMany();
    }

    public function collaboration()
    {
        return $this->belongsTo(
            Collaboration::class
        );
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function popularPackage()
    {
        return $this->belongsTo(PopularPackage::class);
    }
}
