<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAgent extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public $timestamps = false;


    public function ua()
    {
        $ua = [];
        if ($this->device) {
            $ua[] = $this->device;
        }
        if ($this->platform) {
            $ua[] = $this->platform;
        }
        if ($this->browser) {
            $ua[] = $this->browser;
        }
        $userAgent = implode(", ", $ua) . ($this->robot ? (' (' . $this->robot . ')') : '');
        if ($userAgent == '') {
            $userAgent = ucfirst(trans('transAdmin.not-found'));
        }

        return $userAgent;
    }
}
