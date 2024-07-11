<?php

namespace Database\Factories;

use App\Models\blog;
use App\Models\comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{

    protected $model=comment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comment' => $this->faker->sentence,
            'user_id' => User::inRandomOrder()->first()->id,
            'blog_id'=>blog::inRandomOrder()->first()->id,
        ];
    }
}
