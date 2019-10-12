<?php

namespace Utils\Components;

/**
 * Date Component
 * @package Utils\Components
 */
trait Date
{
    /**
     * Get the millisecond timestamp
     * @static
     * @return string
     */
    public static function millisecond(): string
    {
        $time = explode(' ', microtime());

        return $time[1].substr($time[0], 2, 3);
    }

    /**
     * Age based on birth time
     * @static
     * @param  string  $birth  Format birth time
     * @return int
     */
    public static function getAgeByBirthDate($birth): int
    {
        $age = strtotime($birth);
        if ($age === false) {
            return 18;
        }
        list($y1, $m1, $d1) = explode("-", date("Y-m-d", $age));
        $now = strtotime("now");
        list($y2, $m2, $d2) = explode("-", date("Y-m-d", $now));
        $age = $y2 - $y1;
        if ((int) ($m2.$d2) < (int) ($m1.$d1)) {
            $age -= 1;
        }

        return $age;
    }

    /**
     * Get the Humanized Time
     * @static
     * @param  int|string  $time  Format time or timestamp
     * @return string
     */
    public static function humanizeTime($time): string
    {
        $time = is_numeric($time) ? $time : strtotime($time);
        $t = time() - $time;
        $f = [
            '31536000' => '年',
            '2592000' => '个月',
            '604800' => '星期',
            '86400' => '天',
            '3600' => '小时',
            '60' => '分钟',
            '1' => '秒'
        ];
        foreach ($f as $k => $v) {
            if (0 != $c = floor($t / (int) $k)) {
                return $c.$v.'前';
            }
        }

        return '刚刚';
    }

    /**
     * Computation time
     * @static
     * @param $seconds
     * @return string
     */
    public static function calculationTime($seconds)
    {
        if ($seconds <= 3600) {
            return gmstrftime('%H:%M:%S', $seconds);
        }

        return intval($seconds / 3600).":".gmstrftime('%M:%S',
                ($seconds % 3600));
    }
}