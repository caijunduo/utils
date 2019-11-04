<?php

namespace Utils\Components;


use GuzzleHttp\Client;

/**
 * Http Components
 * @package Utils\Components
 */
trait Http
{
    private static $http = null;

    /**
     * Convert the array to an HTTP request parameter,
     * without encoding, corresponding to http_build_query
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

    /**
     * Http Client
     * @return Client
     */
    public static function http()
    {
        if (empty(self::$http)) {
            self::$http = new Client();
        }
        return self::$http;
    }

    /**
     * @param  string  $uri
     * @param  array  $options
     * @return string
     */
    public static function Get(string $uri, array $options = [])
    {
        $default = ['timeout' => 3];
        $options = array_merge($default, $options);
        return self::http()
            ->request("GET", $uri, $options)
            ->getBody()
            ->getContents();
    }

    /**
     * @param  string  $uri
     * @param  array  $options
     * @return string
     */
    public static function Post(string $uri, array $options = [])
    {
        $default = ['timeout' => 3];
        $options = array_merge($default, $options);
        return self::http()
            ->request("POST", $uri, $options)
            ->getBody()
            ->getContents();
    }
}