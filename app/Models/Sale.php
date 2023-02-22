<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }


    public function buys()
    {
        return $this->hasMany(Buy::class)
            ->orderBy('id', 'desc');
    }


    public function getName()
    {
        return '#' . $this->id;
    }


    public function status()
    {
        switch ($this->status) {
            case 0:
                return trans('transAdmin.pending');
            case 1:
                return trans('transAdmin.completed');
            case 2:
                return trans('transAdmin.canceled');
            default:
                return trans('transAdmin.not-found');
        }
    }


    public function icon()
    {
        switch ($this->status) {
            case 0:
                return '<i class="fas fa-circle text-warning"></i>';
                break;
            case 1:
                return '<i class="fas fa-check-circle text-success"></i>';
                break;
            case 2:
                return '<i class="fas fa-times-circle text-dark"></i>';
                break;
            default:
                return '<i class="fas fa-dot-circle text-secondary"></i>';
        }
    }


    public function month($id)
    {
        switch ($id) {
            case 1:
                return trans('transAdmin.jan');
            case 2:
                return trans('transAdmin.feb');
            case 3:
                return trans('transAdmin.mar');
            case 4:
                return trans('transAdmin.apr');
            case 5:
                return trans('transAdmin.may');
            case 6:
                return trans('transAdmin.jun');
            case 7:
                return trans('transAdmin.jul');
            case 8:
                return trans('transAdmin.aug');
            case 9:
                return trans('transAdmin.sep');
            case 10:
                return trans('transAdmin.oct');
            case 11:
                return trans('transAdmin.nov');
            case 12:
                return trans('transAdmin.dec');
            default:
                return trans('transAdmin.not-found');
        }
    }
}
