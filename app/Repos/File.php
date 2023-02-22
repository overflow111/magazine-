<?php

namespace App\Repos;

class File
{
    public static function exists($file) 
    {
        return file_exists($file);
    }

    public static function get($file) 
    {
        return static::exists($file) ? file_get_contents($file) : false;
    }

    public static function put($file, $data, $append = null) 
    {
        return ($append)
            ? file_put_contents($file, $data, FILE_APPEND | LOCK_EX)
            : file_put_contents($file, $data, LOCK_EX);
    }
}
