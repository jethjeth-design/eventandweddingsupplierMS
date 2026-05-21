<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversationParticipant extends Model
{
    protected $fillable = [

        'conversation_id',
        'user_id',
        'role',
        'joined_at',
        'is_active',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function conversation()
    {
        return $this->belongsTo(
            Conversation::class
        );
    }

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    /*
    |--------------------------------------------------------------------------
    | AUTO TIMESTAMP WHEN JOINING
    |--------------------------------------------------------------------------
    */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->joined_at = now();
        });
    }
}
