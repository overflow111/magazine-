<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public $timestamps = false;


    public function getBody()
    {
        $locale = app()->getLocale();
        switch ($locale) {
            case 'tm':
                return $this->body_tm;
                break;
            case 'ru':
                return $this->body_ru ?: $this->body_tm;
                break;
            case 'en':
                return $this->body_en ?: $this->body_tm;
                break;
            default:
                return $this->body_tm;
        }
    }
}
