<?php

namespace Database\Factories;

use App\Models\Posteo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posteo>
 */
class PosteoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'   => 2,
            'titulo'     => $this->faker->sentence(150),
            'contenido'  => $this->faker->text(500),
        ];
    }
}
