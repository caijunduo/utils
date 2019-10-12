<?php

namespace Utils\Components;

/**
 * Paging Component
 * @package Utils\Components
 */
trait Paging
{
    /**
     * Generate and obtain interface paging information
     * @static
     * @param  int  $page
     * @param  int  $count
     * @param  int  $pageNum
     * @return array
     */
    public static function getPageInfo(
        int $page = 1,
        int $count = 0,
        $pageNum = 10
    ) {
        if ($page <= 0) {
            $page = 1;
        }
        $pageTotal = intval(ceil($count / $pageNum));
        $prev = $page - 1;
        if ($prev <= 0) {
            $prev = 1;
        }
        $next = $page + 1;
        if ($next > $pageTotal) {
            $next = $pageTotal;
        }

        return [
            'prev' => $prev,
            'curr' => $page,
            'next' => $next,
            'page_num' => $pageNum,
            'page_total' => $pageTotal,
            'total' => $count
        ];
    }
}