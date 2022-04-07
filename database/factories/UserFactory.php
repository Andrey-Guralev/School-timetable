<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->userName(),
            'first_name' => $this->faker->firstName(),
            'second_name' => $this->faker->firstName(),
            'middle_name' => $this->faker->firstName(),
            'type' => rand(0, 4),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => Carbon::now(),
            'password' => bcrypt($this->faker->password),
            'remember_token' => Str::random(10),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
