<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [

        'conversation_id',

        'client_id',

        'supplier_id',

        'type',

        'package_id',

        'popular_package_item_id',

        'base_price',

        'offer_price',

        'counter_price',

        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | CONVERSATION
    |--------------------------------------------------------------------------
    */

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    /*
    |--------------------------------------------------------------------------
    | CLIENT
    |--------------------------------------------------------------------------
    */

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SUPPLIER
    |--------------------------------------------------------------------------
    */

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }

    /*
    |--------------------------------------------------------------------------
    | PACKAGE
    |--------------------------------------------------------------------------
    */

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /*
    |--------------------------------------------------------------------------
    | POPULAR PACKAGE ITEM
    |--------------------------------------------------------------------------
    */

    public function popularPackageItem()
    {
        return $this->belongsTo(PopularPackageItem::class);
    }
}