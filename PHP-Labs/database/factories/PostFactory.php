<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
    public function definition(): array
    {
        $title = $this->faker->title();
        return [
            'title' => fake()->title(),
            // 'slug' => Str::slug($title),
            'description' => fake()->paragraph(2,true),
            'user_id' => rand(1,3)
        ];
    }
}