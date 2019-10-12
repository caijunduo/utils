<?php

namespace Utils\Components;

trait Num
{
    /**
     * Acquiring Humanized Price
     * @param  int|float  $price
     * @return string
     */
    public static function humanizePrice($price): string
    {
        if ($price > 100000000) {
            return $price / 100000000 .'亿';
        } elseif ($price > 10000) {
            return $price / 10000 .'万';
        } elseif ($price > 1000) {
            return $price / 1000 .'千';
        } else {
            return number_format($price, 2, '.', '').'元';
        }
    }
}