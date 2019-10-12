<?php

namespace Utils\Components;

/**
 * Http Components
 * @package Utils\Components
 */
trait Http
{
    /**
     * Convert the array to an HTTP request parameter, without encoding, corresponding to http_build_query
     * @static
     * @param  array  $args  Parameter array
     * @return string
     */
    public static function httpBuildQueryNoEncode(array $args): string
    {
        $result = '';
        foreach ($args as $key => $arg) {
            $result .= $key.'='.$arg.'&';
        }
        return substr($result, 0, -1);
    }
}