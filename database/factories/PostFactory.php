<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;
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
            'title'=>fake()->sentence(),
            'author_id'=>User::factory(),
            'category_id'=>Category::factory(),
            'slug'=>Str::slug(fake()->sentence()),
            //'body'=>'<p>' . implode('<p><\p>', $this->fake()->paragraphs(mt_rand(5,10)))
            'body'=>collect($this->faker->paragraphs(mt_rand(5,10)))
                    ->map(fn($p) => "<p>$p</p>")
                    ->implode('')
        ];
    }
}
