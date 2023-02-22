<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'contact' =>rand(0, 1) ? ('+993' . $this->faker->numberBetween(60000000, 65999999)) : $this->faker->freeEmail,
            'message' => $this->faker->text(rand(50, 500)),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now'),
        ];
    }
}
