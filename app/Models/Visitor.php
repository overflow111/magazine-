<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function scopeRobot($query)
    {
        return $query->where('robot', 1);
    }


    public function scopeHuman($query)
    {
        return $query->where('robot', 0);
    }


    public function ipAddress()
    {
        return $this->belongsTo(IpAddress::class);
    }


    public function userAgent()
    {
        return $this->belongsTo(UserAgent::class);
    }
}
