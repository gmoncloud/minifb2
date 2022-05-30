<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->unique()->numberBetween($min = 1, $max = 100),
            'display_name' => $this->faker->unique()->firstName(),
            'current_city' => $this->faker->city(),
            'hometown' => $this->faker->city(),
            'work' => $this->faker->jobTitle()
        ];
    }
}
