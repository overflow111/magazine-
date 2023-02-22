<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function sales()
    {
        return $this->hasMany(Sale::class)
            ->orderBy('id', 'desc');
    }


    public function buys()
    {
        return $this->hasMany(Buy::class)
            ->orderBy('id', 'desc');
    }


    public function getName()
    {
        return $this->username;
    }
}
