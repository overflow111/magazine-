<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BuySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objects = \App\Models\Sale::get();
        foreach ($objects as $object) {
            $status = rand(0, 5);
            if (in_array($status, [1, 3, 4, 5])) {
                $downloaded = rand(0, $object->plan_download);
                for ($i = 0; $i < $downloaded; $i++) {
                    \App\Models\Buy::updateOrCreate([
                        'customer_id' => $object->customer_id,
                        'sale_id' => $object->id,
                        'magazine_id' => \App\Models\Magazine::inRandomOrder()->first()->id,
                    ], [
                        'created_at' => \Carbon\Carbon::parse($object->date_start)->addDays($i * 10 + rand(0, 9))->toDateTimeString(),
                    ]);
                }
                $object->downloaded = $downloaded;
                $object->status = 1;
            } else {
                $object->status = $status;
            }
            $object->update();
        }
    }
}
