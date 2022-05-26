<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->word(),
            'title' => $this->faker->words(3, true),
            'detail_text' => $this->faker->paragraph(2, true),
            'published' => $this->faker->numberBetween(0,1),
        ];
    }
}
