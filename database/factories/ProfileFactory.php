<?php

namespace Database\Factories;

use App\Models\User;
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
            'user_id' => User::factory(),
            'display_name' => function (array $attributes) {
                return User::find($attributes['user_id'])->name;
            },
            'current_city' => $this->faker->city(),
            'hometown' => $this->faker->city(),
            'work' => $this->faker->jobTitle()
        ];
    }
}
