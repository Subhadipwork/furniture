<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'blog_title' => $this->faker->sentence(),
            'blog_description' => $this->faker->paragraph(),
            'blog_image' => $this->faker->imageUrl(),
            'blog_author' => $this->faker->name(),
        ];
    }
}
