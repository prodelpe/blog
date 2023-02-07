<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
            'title' => [
                'ca' => 'ca - ' . fake()->text(20),
                'es' => 'es - ' . fake()->text(20),
                'en' => 'en - ' . fake()->text(20),
            ],

            'body' => [
                'ca' => 'ca - ' . fake()->paragraphs(rand(3,6), true),
                'es' => 'es - ' . fake()->paragraphs(rand(3,6), true),
                'en' => 'en - ' . fake()->paragraphs(rand(3,6), true),
            ],

            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id,
        ];
    }
}
