<?php

namespace Database\Factories;

use App\Models\Magazine;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MagazineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Magazine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = ucfirst(implode(" ", $this->faker->words(rand(4, 7))));
        $body = $this->faker->text(rand(50, 500));
        $date = $this->faker->dateTimeBetween($startDate = '-6 months', $endDate = 'now');
        return [
            'title_tm' => $title,
            'title_ru' => rand(0, 1) ? $title . ' (ru)' : null,
            'title_en' => rand(0, 1) ? $title . ' (en)' : null,
            'slug' => Str::slug($title) . '-' . \Carbon\Carbon::parse($date)->format('Y-m-d'),
            'body_tm' => $body,
            'body_ru' => rand(0, 1) ? $body . ' (ru)' : null,
            'body_en' => rand(0, 1) ? $body . ' (en)' : null,
            'active' => $this->faker->boolean($chanceOfGettingTrue = 95),
            'published_at' => $date,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
