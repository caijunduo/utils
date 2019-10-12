<?php

namespace Utils\Components;

/**
 * Json Component
 * @package Utils\Components
 */
trait Json
{
    /**
     * Coded as JSON, Chinese is not included in the code
     * @param  mixed  $value  Data to be coded
     * @return string JSON
     */
    public static function jsonEncode($value): string
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Decode JSON strings
     * @param  string  $json  JSON String
     * @return mixed Decoded data
     */
    public static function jsonDecode(string $json)
    {
        return json_decode($json);
    }
}