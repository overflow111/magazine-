<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 1; $i++) {
            $body = $faker->text(rand(50, 500));
            $obj = new \App\Models\Page();
            $obj->body_tm = $body;
            $obj->body_ru = rand(0, 1) ? $body . ' (ru)' : null;
            $obj->body_en = rand(0, 1) ? $body . ' (en)' : null;
            $obj->save();
        }
    }
}
