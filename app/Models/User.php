<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'postcode',
        'city',
        'role_id'
    ];

    protected $observables = [
        'id'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function labels()
    {
        return $this->hasMany(Label::class);
    }


    public function isSuperAdmin(): bool
    {
        return $this->role_id === 1;
    }

    public function isSender(): bool
    {
        return $this->role_id === 2;
    }

    public function isCarrier(): bool
    {
        return $this->role_id === 3;
    }

    public function isReceiver(): bool
    {
        return $this->role_id === 4;
    }

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'postcode' => $this->postcode,
            'city' => $this->city,
        ];
    }
}
