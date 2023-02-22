<?php

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $customer = \App\Models\Customer::inRandomOrder()->first();
        $plan = \App\Models\Plan::inRandomOrder()->first();
        $date = $this->faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now');
        return [
            'customer_id' => $customer->id,
            'plan_id' => $plan->id,
            'customer_name' => $customer->name,
            'customer_surname' => $customer->surname,
            'customer_email' => $customer->email,
            'customer_username' => $customer->username,
            'plan_month' => $plan->month,
            'plan_download' => $plan->download,
            'date_start' => \Carbon\Carbon::parse($date)->toDateString(),
            'date_end' => \Carbon\Carbon::parse($date)->addMonths($plan->month)->toDateString(),
            'price' => $plan->price,
            'status' => rand(0, 10) ? 1 : (rand(0, 1) ? 0 : 2),
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
