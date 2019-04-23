<?php

namespace nktaglib;

use think\template\TagLib;

/**
 * User: nicekun
 * Date: 2019/4/23
 * Time: 12:21
 */
class NKTag extends TagLib
{
    protected $tags = [
        'ftime' => ['attr' => 'name,format', 'close' => 0]
    ];

    public function ftime($tags)
    {
        $time = $tags['name'];
        $fomat = $tags['format'];

        // 逻辑代码
        return date($fomat, $time);
    }
}