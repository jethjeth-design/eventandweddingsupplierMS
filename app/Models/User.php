<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    const ROLE_ADMIN = 'admin';
    const ROLE_SUPPLIER = 'supplier';
    const ROLE_CLIENT = 'client';

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isSupplier()
    {
        return $this->role === self::ROLE_SUPPLIER;
    }

    public function isClient()
    {
        return $this->role === self::ROLE_CLIENT;
    }

    public function hasRole($role): bool
    {
        return $this->role === $role;
    }

     
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function supplier()
    {
        return $this->hasOne(supplierProfile::class);
    }

    public function events()
    {
        return $this->hasMany(Event::class, 'client_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'supplier_id');
    }

    public function packages()
    {
        return $this->hasMany(Package::class, 'user_id'); 
    }
}
