<?php
/**
 * User: nicekun
 * Date: 2019/4/1
 * Time: 15:41
 */

namespace app\common\util;


class ResponsUtil
{

    public static function error($string)
    {
        return ["msg" => $string, "code" => -1];
    }

    public static function success($string)
    {
        return ["msg" => $string, "code" => 200];
    }
}