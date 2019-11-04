<?php

namespace Utils;

use Utils\Components\{Arr,
    Date,
    Http,
    Ip,
    Json,
    Judge,
    Mobile,
    Num,
    Paging,
    Str
};
use Utils\Components\Oauth\{
    WeChat
};

/**
 * Util Class
 * @package Utils
 */
class Util
{
    // 基础
    use Arr, Date, Http, Ip, Json, Judge, Mobile, Num, Str,
        // 辅助
        Paging,
        // 第三方
        WeChat;
}