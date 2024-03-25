<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voiteur>
 */
class VoiteurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1, 100),
            'marque' => $this->faker->company,
            'modele' => $this->faker->word,
            'annee' => $this->faker->year,
            'kilometrage' => $this->faker->numberBetween(0, 200000),
            'prix' => $this->faker->randomFloat(2, 1000, 100000),
            'puissance' => $this->faker->numberBetween(50, 500),
            'motorisation' => $this->faker->randomElement(['Electric', 'Hybrid', 'Petrol', 'Diesel']),
            'carburant' => $this->faker->randomElement(['Petrol', 'Diesel', 'Electric', 'Hybrid']),
            'options' => $this->faker->sentence,
            'created_at' => $this->faker->dateTime,
            'updated_at' => $this->faker->dateTime,
        ];
    }
}
