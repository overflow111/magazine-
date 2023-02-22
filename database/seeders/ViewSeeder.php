<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $objects = \App\Models\Post::get(['id', 'published_at']);
        foreach ($objects as $object) {
            $d = \Carbon\Carbon::today()->diffInDays($object->published_at);
            for ($i = 1; $i <= $d; $i++) {
                $v = new \App\Models\View();
                $v->post_id = $object->id;
                $v->date = \Carbon\Carbon::today()->subDays($i)->toDateString();
                $v->viewed = rand(1, 111);
                $v->save();
                $i = $i + rand(1, 5);
            }
            $object->viewed = $object->views->sum('viewed');
            $object->update();
        }
    }
}
