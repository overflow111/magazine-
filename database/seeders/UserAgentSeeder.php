<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Jenssegers\Agent\Agent;

class UserAgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $ua = $faker->userAgent;
        $agent = new Agent();
        $agent->setUserAgent($ua);

        \App\Models\UserAgent::firstOrCreate([
            'user_agent' => substr($ua, 0, 255),
            'device' => $agent->device() ? substr($agent->device(), 0, 255) : null,
            'platform' => $agent->platform() ? substr($agent->platform(), 0, 255) : null,
            'browser' => $agent->browser() ? substr($agent->browser(), 0, 255) : null,
            'robot' => $agent->robot() ? substr($agent->robot(), 0, 255) : null,
        ]);
    }
}
