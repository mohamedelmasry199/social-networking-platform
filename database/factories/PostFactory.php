<?php

namespace Database\Factories;
use Faker\Generator as Faker;

use App\Models\Post;
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
    protected $model = Post::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
        'content' => $this->faker->paragraph,
        'image' => $this->faker->imageUrl(),
        'user_id' => $this->faker->randomElement([1, 2, 3]),
        ];
    }
}
