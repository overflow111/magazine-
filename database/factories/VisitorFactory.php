<?php

namespace Database\Factories;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Visitor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now');
        $userAgent = \App\Models\UserAgent::inRandomOrder()->first();
        return [
            'ip_address_id' => \App\Models\IpAddress::inRandomOrder()->first()->id,
            'user_agent_id' => $userAgent->id,
            'hits' => rand(10, 40),
            'suspect_hits' => rand(1, 25),
            'robot' => $userAgent->robot == null ? 0 : 1,
            'created_at' => $date,
            'updated_at' => \Carbon\Carbon::parse($date)->addMinutes(rand(5, 300))->toDateTimeString(),
        ];
    }
}
