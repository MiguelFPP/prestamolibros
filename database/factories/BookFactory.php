<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'edition' => $this->faker->word,
            'published_at' => $this->faker->date,
            'stock' => $this->faker->numberBetween(1, 50),
            'author_id' => $this->faker->numberBetween(1, 15),
        ];
    }
}
