<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public $timestamps = false;


    public function posts()
    {
        return $this->hasMany(Post::class)
            ->orderBy('published_at', 'desc');
    }


    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }


    public function getName()
    {
        $locale = app()->getLocale();
        switch ($locale) {
            case 'tm':
                return $this->name_tm;
                break;
            case 'ru':
                return $this->name_ru ?: $this->name_tm;
                break;
            case 'en':
                return $this->name_en ?: $this->name_tm;
                break;
            default:
                return $this->name_tm;
        }
    }


    public function getJob()
    {
        $locale = app()->getLocale();
        switch ($locale) {
            case 'tm':
                return $this->job_tm;
                break;
            case 'ru':
                return $this->job_ru ?: $this->job_tm;
                break;
            case 'en':
                return $this->job_en ?: $this->job_tm;
                break;
            default:
                return $this->job_tm;
        }
    }
}
