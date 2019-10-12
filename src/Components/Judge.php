<?php

namespace Utils\Components;

/**
 * Judge Component
 * @package Utils\Components
 */
trait Judge
{
    /**
     * Judging the Type of Mobile Equipment
     * @static
     * @return int 0: not found, 1: android, 2: ios
     */
    public static function mobileDeviceType(): int
    {
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        $type = 0;
        if (strpos($agent, 'android')) {
            $type = 1;
        }
        if (preg_match('/iphone|ipad|ipod/i', $agent)) {
            $type = 2;
        }

        return $type;
    }

    /**
     * Is it IOS?
     * @static
     * @return false|int
     */
    public static function isIos()
    {
        return preg_match('/iphone|ipad|ipod/i',
            strtolower($_SERVER['HTTP_USER_AGENT']));
    }

    /**
     * Is it Android?
     * @static
     * @return bool
     */
    public static function isAndroid(): bool
    {
        return strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'android') !==
            false;
    }

    /**
     * Is it WeChat Client Access?
     * @static
     * @return bool
     */
    public static function isWeChat(): bool
    {
        return strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false;
    }

    /**
     * Is it IPad?
     * @static
     * @return bool
     */
    public static function isIPad(): bool
    {
        return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),
                'ipad') !== false;
    }

    /**
     * Is it IPhone?
     * @static
     * @return bool
     */
    public static function isIPhone(): bool
    {
        return strpos(strtolower($_SERVER['HTTP_USER_AGENT']),
                'iphone') !== false;
    }

    /**
     * Is it mobile?
     * @static
     * @return false|int
     */
    public static function isMobile()
    {
        return preg_match('/NetFront|iPhone|MIDP-2.0|Opera Min|UCWEB|Android|Windows CE|SymbianOS/i',
            $_SERVER['HTTP_USER_AGENT']);
    }

    /**
     * Is it JSON?
     * @static
     * @param  string  $string
     * @return bool
     */
    public static function isJson(string $string): bool
    {
        json_decode($string);

        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * Is it Email?
     * @static
     * @param  string  $email
     * @return mixed
     */
    public static function isEmail(string $email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Is it URL? The URL must be followed by /
     * @static
     * @param  string  $url
     * @return mixed
     */
    public static function isUrl(string $url)
    {
        return filter_var($url, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);
    }

    /**
     * Is it IP?
     * @static
     * @param  string  $ip
     * @return mixed
     */
    public static function isIp(string $ip)
    {
        return filter_var($ip, FILTER_VALIDATE_IP);
    }

    /**
     * Is it Mac Code?
     * @static
     * @param  string  $macCode
     * @return mixed
     */
    public static function isMacCode(string $macCode)
    {
        return filter_var($macCode, FILTER_VALIDATE_MAC);
    }

    /**
     * Is it telephone?
     * @static
     * @param  string  $telephone
     * @return bool
     */
    public static function isTelephone(string $telephone): bool
    {
        if (preg_match('/^([0-9]{3,4}-)?[0-9]{7,8}$/', $telephone)) {
            return true;
        }

        return false;
    }

    /**
     * Does a character exist in a string?
     * @static
     * @param  string  $haystack
     * @param  string  $needle
     * @return bool
     */
    public static function isStrExists(string $haystack, string $needle): bool
    {
        return !(strpos($haystack, $needle) === false);
    }

    /**
     * Is it IE browser?
     * @static
     * @return bool
     */
    public static function isIe(): bool
    {
        $useragent = strtolower($_SERVER['HTTP_USER_AGENT']);

        if ((strpos($useragent, 'opera') !== false) ||
            (strpos($useragent, 'konqueror') !== false)) {
            return false;
        }

        if (strpos($useragent, 'msie ') !== false) {
            return true;
        }

        return false;
    }

    /**
     * Is it Ajax?
     * @static
     * @return bool
     */
    public static function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    /**
     * Is it utf-8 strings?
     * @static
     * @param  string  $string
     * @return bool
     */
    public static function isUTF8(string $string): bool
    {
        $c = 0;
        $b = 0;
        $bits = 0;
        $len = strlen($string);
        for ($i = 0; $i < $len; $i++) {
            $c = ord($string[$i]);
            if ($c > 128) {
                if (($c >= 254)) {
                    return false;
                } elseif ($c >= 252) {
                    $bits = 6;
                } elseif ($c >= 248) {
                    $bits = 5;
                } elseif ($c >= 240) {
                    $bits = 4;
                } elseif ($c >= 224) {
                    $bits = 3;
                } elseif ($c >= 192) {
                    $bits = 2;
                } else {
                    return false;
                }
                if (($i + $bits) > $len) {
                    return false;
                }
                while ($bits > 1) {
                    $i++;
                    $b = ord($string[$i]);
                    if ($b < 128 || $b > 191) {
                        return false;
                    }
                    $bits--;
                }
            }
        }

        return true;
    }

    /**
     * Is it Linux OS?
     * @static
     * @return bool
     */
    public static function isLinux(): bool
    {
        return PATH_SEPARATOR == ':';
    }

    /**
     * Is it Windows OS?
     * @static
     * @return bool
     */
    public static function isWindows(): bool
    {
        return PATH_SEPARATOR != ':';
    }
}