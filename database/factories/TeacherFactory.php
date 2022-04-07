<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TeacherFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 49),
            'lessons' => '{"1": {"id": 1}}',
            'class_id' => rand(1, 49),
            'type' => 'undefined',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
