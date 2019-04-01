<?php
/**
 * User: nicekun
 * Date: 2019/4/1
 * Time: 16:24
 */

namespace app\common\util;


class TextUtil
{
     public static function  closeTags($html) {
        // 直接过滤错误的标签 <[^>]的含义是 匹配只有<而没有>的标签
        // 而preg_replace会把匹配到的用''进行替换
        $html = preg_replace('/<[^>]*$/','',$html);

        // 匹配开始标签，这里添加了1-6，是为了匹配h1~h6标签
        preg_match_all('#<([a-z1-6]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $opentags = $result[1];
        // 匹配结束标签
        preg_match_all('#</([a-z1-6]+)>#iU', $html, $result);
        $closetags = $result[1];
        $len_opened = count($opentags);
        // 如何两种标签数目一致 说明截取正好
        if (count($closetags) == $len_opened) { return $html; }

        $opentags = array_reverse($opentags);
        // 过滤自闭和标签，也可以在正则中过滤 <(?!meta|img|br|hr|input)>
        $sc = array('br','input','img','hr','meta','link');

        for ($i=0; $i < $len_opened; $i++) {
            $ot = strtolower($opentags[$i]);
            if (!in_array($opentags[$i], $closetags) && !in_array($ot,$sc)) {
                $html .= '</'.$opentags[$i].'>';
            } else {
                unset($closetags[array_search($opentags[$i], $closetags)]);
            }
        }
        return $html;
    }
}