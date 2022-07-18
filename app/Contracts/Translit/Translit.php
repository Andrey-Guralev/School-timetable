<?php

namespace App\Contracts\Translit;

interface Translit
{
    static public function translitInRus($input): string;

    static public function translitInEn($input): string;
}
