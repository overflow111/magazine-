<?php

namespace Database\Factories;

use App\Models\Verification;
use Illuminate\Database\Eloquent\Factories\Factory;

class VerificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Verification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now');
        return [
            'username' => $this->faker->unique()->numberBetween(60000000, 65999999),
            'code' => rand(10000, 99999),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
