<?php

namespace Utils\Components;

use Generator;

/**
 * String Component
 * @package Utils\Components
 */
trait Str
{
    /**
     * Interval strings are converted into arrays\n
     * Whether the content is converted to the specified format or not is
     * passed into the corresponding format, otherwise it is empty.\n
     * The value returned by this function is the generator\n
     * @static
     * @param  string  $string  String to be converted
     * @param  string  $formatType  Specified format or empty
     * @param  string  $divide  character
     * @return array
     */
    public static function intervalStrToArr(
        string $string,
        string $formatType = '',
        string $divide = ','
    ): array {
        $tmp = explode($divide, $string);
        $result = [];
        foreach ($tmp as $v) {
            if ($v) {
                if ($formatType) {
                    settype($v, $formatType);
                }
                $result[] = $v;
            }
        }
        return $result;
    }

    /**
     * Hide some characters of mobile phone number
     * @static
     * @param $phone
     * @return mixed
     */
    public static function hidePhoneNumber($phone)
    {
        return $phone ? substr_replace($phone, '****', 3, 4) : $phone;
    }

    /**
     * Underline to Hump
     * @param  string  $string  Underline strings
     * @return string
     */
    public static function underlineToHump(string $string): string
    {
        return lcfirst(str_replace('_', '', ucwords($string, '_')));
    }

    /**
     * Hump to Underline
     * @param  string  $string  Hump strings
     * @return string
     */
    public static function humpToUnderline(string $string): string
    {
        return strtolower(preg_replace('/[A-Z]/', '_$0', $string));
    }

    /**
     * Format byte size
     * @param  int  $size  Byte size
     * @param  int  $delimiter  A few decimal places
     * @return string
     */
    public static function byteFormat(int $size, int $delimiter = 0): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        $base = 1024;
        $idx = intval(floor(log($size, $base)));

        return round($size / pow($base, $idx), $delimiter).$units[$idx];
    }
}