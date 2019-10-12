<?php

namespace Utils\Components;

/**
 * Ip Component
 * @package Utils\Components
 */
trait Ip
{
    /**
     * Getting IP Home
     * @static
     * @param  string  $ip
     * @return array
     */
    public static function getIPArea(string $ip): array
    {
        $url = "http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
        $content = file_get_contents($url);
        $resp = json_decode($content, true);
        $d = [];
        if (0 == $resp["code"]) {
            $d = [
                "isp" => $resp["data"]["isp"],
                "province" => $resp["data"]["region"],
                "city" => $resp["data"]["city"]
            ];
        } elseif (1 == $resp["code"]) {
            $d = [
                "isp" => "",
                "province" => "",
                "city" => ""
            ];
        };

        return $d;
    }

    /**
     * Get the Client IP
     * @static
     * @param  int  $type
     * @param  bool  $adv
     * @return mixed
     */
    public static function getClientIP(int $type = 0, bool $adv = true)
    {
        $type = $type ? 1 : 0;
        static $ip = null;
        if ($ip !== null) {
            return $ip[$type];
        }
        if ($adv) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                $pos = array_search('unknown', $arr);
                if (false !== $pos) {
                    unset($arr[$pos]);
                }
                $ip = trim($arr[0]);
            } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        } elseif (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $long = sprintf("%u", ip2long($ip));
        $ip = $long ? [
            $ip,
            $long
        ] : [
            '0.0.0.0',
            0
        ];

        return $ip[$type];
    }
}