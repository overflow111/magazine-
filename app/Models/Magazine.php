<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }


    public function getFile()
    {
        if ($this->file)
            return response()->download(storage_path('app/private/' . $this->file));
        else
            return back();
    }


    public function getTitle()
    {
        $locale = app()->getLocale();
        switch ($locale) {
            case 'tm':
                return $this->title_tm;
                break;
            case 'ru':
                return $this->title_ru ?: $this->title_tm;
                break;
            case 'en':
                return $this->title_en ?: $this->title_tm;
                break;
            default:
                return $this->title_tm;
        }
    }


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
