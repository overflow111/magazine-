<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objects = [
//            'image' =>
            null,
//            'slogan_tm' =>
            '«Türkmenistan — parahatçylygyň we ynanyşmagyň Watany»',
//            'slogan_ru' =>
            null,
//            'slogan_en' =>
            null,
        ];

        for ($i = 0; $i < count($objects); $i++) {
            $obj = new \App\Models\Setting();
            $obj->setting = $objects[$i];
            $obj->save();
        }
    }
}
