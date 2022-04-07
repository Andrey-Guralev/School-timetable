<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class LoadFactory extends Factory
{
    public function definition(): array
    {
        return [
            'lesson_id' => rand(0, 49),
            'class_id' => rand(0, 49),
            'teacher_id' => rand(0, 49),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
