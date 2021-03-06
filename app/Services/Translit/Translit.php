<?php

namespace App\Services\Translit;

class Translit
{
    static public function translitInRus($input): string
    {
        $ar = array(
            "a"=>"а", "b"=>"б", "v"=>"в", "g"=>"г", "d"=>"д", "e"=>"е", "yo"=>"ё", "j"=>"ж", "z"=>"з",
            "i"=>"и", "k"=>"к", "l"=>"л", "m"=>"м", "n"=>"н", "o"=>"о", "p"=>"п", "r"=>"р", "s"=>"с",
            "t"=>"т", "y"=>"у", "f"=>"ф", "h"=>"х", "c"=>"ц", "ch"=>"ч", "sh"=>"ш", "u"=>"у", "ya"=>"я",
            "A"=>"А", "B"=>"Б", "V"=>"В", "G"=>"Г", "D"=>"Д", "E"=>"Е", "Yo"=>"Ё", "J"=>"Ж", "Z"=>"З",
            "I"=>"И", "K"=>"К", "L"=>"Л", "M"=>"М", "N"=>"Н", "O"=>"О", "P"=>"П", "R"=>"Р", "S"=>"С",
            "T"=>"Т", "Y"=>"Ю", "F"=>"Ф", "H"=>"Х", "C"=>"Ц", "Ch"=>"Ч", "Sh"=>"Ш", "U"=>"У", "Ya"=>"Я",
        );
        return strtr($input, $ar);
    }

    static public function translitInEn($input): string
    {
        $ar = array(
            'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
            'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
            'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
            'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
            'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
            'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
            'э' => 'e',    'ю' => 'yu',   'я' => 'ya',

            'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
            'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
            'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
            'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
            'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
            'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
            'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
        );
        return strtr($input, $ar);
    }
}
