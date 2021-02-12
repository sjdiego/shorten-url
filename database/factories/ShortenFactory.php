<?php

namespace Database\Factories;

use App\Models\Shorten;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShortenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Shorten::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => $this->faker->url,
            'slug' => Shorten::generateUniqueSlug(),
            'max_hits' => $this->faker->numberBetween(10, 1025),
            'expires_at' => $this->faker->dateTimeInInterval('+1 hour', '+1 year')
        ];
    }
}
