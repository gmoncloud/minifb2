<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
            'user_id' => User::factory(),
            'display_name' => $this->faker->firstName(),
            'current_city' => $this->faker->city(),
            'hometown' => $this->faker->city(),
            'work' => $this->faker->jobTitle()
        ];
    }
}
