<?php

namespace Utils\Components;

/**
 * Array Component
 * @package Utils\Components
 */
trait Arr
{
    /**
     * Converting an array to a character-partitioned string
     * @static
     * @param  array  $array  Array to be converted
     * @param  string  $glue  character
     * @param  bool  $isBeforeAfter  Whether to add characters before and after
     * @return string
     */
    public static function intervalArrToStr(
        array $array,
        string $glue = ',',
        bool $isBeforeAfter = false
    ) {
        return $isBeforeAfter ? ($array ? $glue.implode($glue, $array).
            $glue : $glue) : implode($glue, $array);
    }

    /**
     * Two-dimensional arrays sorted by a field
     * @param  array  $array  Array to sort
     * @param  string  $key  Key fields to sort
     * @param  int  $sort  Sort type : SORT_ASC or SORT_DESC
     * @return array Sorted arrays
     */
    public static function arrayMultipleSort(
        array $array,
        string $key,
        int $sort = SORT_DESC
    ): array {
        $keysValue = [];
        foreach ($array as $k => $v) {
            $keysValue[$k] = $v[$key];
        }
        array_multisort($keysValue, $sort, $array);

        return $array;
    }

    /**
     * Null in the filter array
     * @static
     * @param  array  $array  Array to be filtered
     * @return array Filtered array
     */
    public static function filterNullByArr(array $array): array
    {
        return array_filter($array, function ($item) {
            if ($item === null) {
                return false;
            }
            return true;
        });
    }

    /**
     * Filtering Null's Health of the Median Value of Multidimensional Array
     * @static
     * @param  array  $array  Array to be filtered
     * @return array Filtered array
     */
    public static function filterNullByMultipleArr(array $array): array
    {
        foreach ($array as $key => &$val) {
            if (is_array($val)) {
                $val = self::filterNullByMultipleArr($val);
            } elseif ($val === null) {
                unset($array[$key]);
            }
        }

        return $array;
    }
}