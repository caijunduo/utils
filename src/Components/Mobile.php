<?php

namespace Utils\Components;

/**
 * Mobile Component
 * @package Utils\Components
 */
trait Mobile
{
    /**
     * Access to mobile phone ownership
     * @static
     * @param $mobile
     * @return array
     */
    public static function getMobileArea($mobile): array
    {
        $url = "http://tcc.taobao.com/cc/json/mobile_tel_segment.htm?tel=".$mobile;
        $content = file_get_contents($url);
        $content = iconv("GB2312", "UTF-8", $content);
        $start = strpos($content, "carrier:'") + 9;
        $end = strpos($content, "}");
        $isp = substr($content, $start, $end - $start - 3);
        $data = [
            "isp" => $isp,
        ];

        return $data;
    }
}