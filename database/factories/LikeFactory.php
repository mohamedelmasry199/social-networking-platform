<?php

namespace Database\Factories;

use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model =Like::class;
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomElement([1, 2, 3]),
            'post_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
