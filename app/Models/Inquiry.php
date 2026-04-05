<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $fillable = [
        'user_id',
        'supplier_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'subject',
        'message',
        'is_read',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function supplier()
    {
        return $this->belongsTo(SupplierProfile::class, 'supplier_id');
    }
}
