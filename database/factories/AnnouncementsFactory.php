<?php

namespace Database\Factories;

use App\Models\Announcements;
use App\Models\Classes;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AnnouncementsFactory extends Factory
{
    protected $model = Announcements::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'text' => $this->faker->text(),
            'type' => 0,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'author_id' => User::factory(),
            'class_id' => Classes::factory(),
        ];
    }
}
