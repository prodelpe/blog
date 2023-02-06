<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => [
                'ca' => 'ca - ' . fake()->word(),
                'es' => 'es - ' . fake()->word(),
                'en' => 'en - ' . fake()->word(),
            ],

            'description' => [
                'ca' => 'ca - ' . fake()->paragraph(),
                'es' => 'es - ' . fake()->paragraph(),
                'en' => 'en - ' . fake()->paragraph(),
            ],
        ];
    }
}
