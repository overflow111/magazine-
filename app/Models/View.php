<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public $timestamps = false;


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
