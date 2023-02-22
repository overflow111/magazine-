<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $obj = new \App\Models\User();
        $obj->username = "admin";
        $obj->password = bcrypt("admin123");
        $obj->save();
    }
}
