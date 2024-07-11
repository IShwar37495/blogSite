<?php

namespace Database\Factories;

use App\Models\blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{

    protected $model = blog::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>$this->faker->sentence,
            'short_description'=>$this->faker->paragraph,
            'long_description'=>$this->faker->paragraph(3,true),
            'user_id'=>User::inRandomOrder()->first()->id,
        ];
    }
}
