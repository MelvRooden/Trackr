<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make($this->faker->password),
            'address' => $this->faker->streetAddress,
            'postcode' => $this->faker->postcode,
            'city' => $this->faker->city,
            'role_id' => rand(2, 4),
            'remember_token' => Str::random(10)
        ];
    }
}
