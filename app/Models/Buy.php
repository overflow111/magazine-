<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    const UPDATED_AT = null;


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }


    public function magazine()
    {
        return $this->belongsTo(Magazine::class);
    }
}
