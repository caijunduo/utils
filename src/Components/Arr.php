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

    /**
     * Getting the values of multi-level arrays through points
     * @static
     * @param  array  $array
     * @param  string  $names
     * @return array|mixed|null
     * @example key1.key2.key3 => $array[$key1][$key2][$key3]
     */
    public static function getMultiLayerArr(array $array, string $names = '')
    {
        $names = array_filter(explode('.', $names));
        $tmp = $array;
        foreach ($names as $name) {
            $tmp = &$tmp[$name] ?? null;
        }

        return $tmp;
    }

    /**
     * Statistics the number of occurrences of array values
     * to support multiple arrays
     * @static
     * @return array
     * @example statisticsNum($array1, $array2, $array3), 仅限一维数组
     */
    public static function statisticsNum()
    {
        $array = func_get_args();
        $num = func_num_args();
        $result = [];

        for ($i = 0; $i < $num; $i++) {
            foreach ($array[$i] as $item) {
                if (isset($result[$item])) {
                    $result[$item]++;
                } else {
                    $result[$item] = 1;
                }
            }
        }

        return $result;
    }

    /**
     * Multidimensional array sorting, the first parameter needs to
     * sort the array, the second parameter needs to sort the field,
     * the third parameter. It's sort.
     * @static
     * @return mixed
     * @example arrayMultipleOrderBy($list, 'age', SORT_DESC)
     * @example arrayMultipleOrderBy($list, 'age', SORT_DESC, 'name', SORT_DESC)
     */
    public static function arrayMultipleOrderBy()
    {
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $idx => $field) {
            if (is_string($field)) {
                $tmp = [];
                foreach ($data as $key => $row) {
                    $tmp[$key] = $row[$field];
                }
                $args[$idx] = $tmp;
            }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);

        return array_pop($args);
    }
}