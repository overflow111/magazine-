<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objects = [
            1, 3, 6, 12
        ];

        for ($i = 0; $i < count($objects); $i++) {
            $obj = new \App\Models\Plan();
            $obj->name_tm = 'Meýilnama ' . $objects[$i] . ' Aý / ' . $objects[$i] * (10 - $i) . ' TMT';
            $obj->name_ru = 'План ' . $objects[$i] . ' Месяц / ' . $objects[$i] * (10 - $i) . ' TMT';
            $obj->name_en = 'Plan ' . $objects[$i] . ' Month / ' . $objects[$i] * (10 - $i) . ' TMT';
            $obj->month = $objects[$i];
            $obj->download = $objects[$i] * (1 + $i * 2);
            $obj->price = $objects[$i] * (10 - $i);
            $obj->active = 1;
            $obj->save();
        }
    }
}
