<?php

namespace Database\Factories;

use App\Actions\Translit;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ClassesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $number = rand(5, 11);
        $letter = Str::random(1);
        $alias = Translit::translitInEn($number . $letter);

        return [
            'number' => $number,
            'letter' => $letter,
            'alias' => $alias,
            'shift' => 0,
        ];
    }
}
