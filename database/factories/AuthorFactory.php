<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AuthorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Author::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->name;
        $job = $this->faker->jobTitle;
        return [
            'name_tm' => $name,
            'name_ru' => rand(0, 1) ? $name . ' (ru)' : null,
            'name_en' => rand(0, 1) ? $name . ' (en)' : null,
            'slug' => Str::slug($name),
            'job_tm' => $job,
            'job_ru' => rand(0, 1) ? $job . ' (ru)' : null,
            'job_en' => rand(0, 1) ? $job . ' (en)' : null,
            'active' => $this->faker->boolean($chanceOfGettingTrue = 95),
        ];
    }
}
