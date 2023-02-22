<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objects = [
            ["Syýahatçylyk syýasyýeti", "Политика туризма", "Tourism policy", 1, 1, 1],
            ["Medeni we taryhy ýadygärlikler", "Культурно-исторические памятники", "Cultural and historical monuments", 1, 1, 1],
            ["Syýahatçylyk desgalary", "Туристические объекты", "Tourism facilities", 1, 1, 1],
            ["Täsinlikler", "Чудеса", "Wonders", 1, 1, 1],
            ["Syýahatçlyk kärhanalary", "Туристические компании", "Travel companies", 1, 1, 1],
            ["Şahsyýetler", "Выдающиеся личности", "Prominent figures", 1, 1, 1],
            ["Tebigat", "Природа", "Nature", 1, 1, 1],
        ];

        for ($i = 0; $i < count($objects); $i++) {
            $obj = new \App\Models\Category();
            $obj->name_tm = $objects[$i][0];
            $obj->name_ru = $objects[$i][1];
            $obj->name_en = $objects[$i][2];
            $obj->slug = Str::slug($objects[$i][0]);
            $obj->menu = $objects[$i][3];
            $obj->main = $objects[$i][4];
            $obj->advice = $objects[$i][5];
            $obj->sort_order = $i + 1;
            $obj->active = 1;
            $obj->save();
        }
    }
}
