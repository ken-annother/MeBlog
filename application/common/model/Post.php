<?php
/**
 * User: nicekun
 * Date: 2019/3/8
 * Time: 15:51
 */

namespace app\common\model;
use \think\Model;

class Post extends Model
{
    public function getPostPostTimeAttr($value)
    {
        return date("Y-m-d",$value);
    }
}