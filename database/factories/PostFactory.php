<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

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
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
            'author_id' => \App\Models\Author::inRandomOrder()->first()->id,
            'title_tm' => $title,
            'title_ru' => rand(0, 1) ? $title . ' (ru)' : null,
            'title_en' => rand(0, 1) ? $title . ' (en)' : null,
            'slug' => Str::slug($title) . '-' . \Carbon\Carbon::parse($date)->format('Y-m-d'),
            'body_tm' => $body,
            'body_ru' => rand(0, 1) ? $body . ' (ru)' : null,
            'body_en' => rand(0, 1) ? $body . ' (en)' : null,
            'main' => $this->faker->boolean($chanceOfGettingTrue = 25),
            'recommended' => $this->faker->boolean($chanceOfGettingTrue = 25),
            'active' => $this->faker->boolean($chanceOfGettingTrue = 95),
            'published_at' => $date,
            'created_at' => $date,
            'updated_at' => $date,
        ];
    }
}
