<?php

namespace Database\Factories;

use App\Models\Attempt;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttemptFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attempt::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $attempts = ['Registered', 'Login', 'Failed', 'Logout'];
        return [
            'ip_address_id' => \App\Models\IpAddress::inRandomOrder()->first()->id,
            'username' => $this->faker->userName,
            'event' => $attempts[array_rand($attempts, 1)],
            'created_at' => $this->faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        ];
    }
}
