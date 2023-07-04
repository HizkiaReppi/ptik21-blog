<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'title' => fake()->sentence(mt_rand(4, 8)),
            'user_id' => mt_rand(1, 10),
            'category_id' => mt_rand(1, 5),
            'slug' => fake()->slug(),
            'published_at' => Carbon::now('Asia/Jakarta'),
            'content' => collect(fake()->paragraphs(mt_rand(20, 30)))
                ->map(fn ($p) => "<p>$p</p>")
                ->implode('')
        ];
    }
}
