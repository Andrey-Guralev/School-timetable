<?php

namespace App\Contracts\TimetableParser;

interface TimetableXmlParser
{
    /**
     * @param $xml
     * @param $parametrs
     */
    public function parseXml($file, $parametrs);
}
