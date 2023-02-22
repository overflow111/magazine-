<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PlanSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(PageSeeder::class);

        $ratio = 10;
        if (true) {
            \App\Models\Author::factory()->count($ratio)->create();
            \App\Models\Post::factory()->count($ratio * 3)->create();
            $this->call(ViewSeeder::class);
            \App\Models\Magazine::factory()->count($ratio)->create();
            \App\Models\Verification::factory()->count($ratio)->create();
            \App\Models\Customer::factory()->count($ratio)->create();
            \App\Models\Sale::factory()->count($ratio * 2)->create();
            $this->call(BuySeeder::class);
            \App\Models\Contact::factory()->count($ratio)->create();
            for ($i = 1; $i <= $ratio; $i++) {
                $this->call(IpAddressSeeder::class);
                $this->call(UserAgentSeeder::class);
            }
            \App\Models\Visitor::factory()->count($ratio * 5)->create();
            \App\Models\Attempt::factory()->count($ratio)->create();
        }
    }
}
