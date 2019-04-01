<?php
/**
 * User: nicekun
 * Date: 2019/4/1
 * Time: 15:31
 */

namespace app\admin\controller;

use app\common\model\Post;

use app\common\util\ResponsUtil;
use app\common\util\TextUtil;
use think\Request;

class Article extends Base
{
    public function create()
    {
        $request = Request::instance();
        $status = $request->param("status");
        $title = $request->param("title");
        $content = $request->param("content");
        $cate = $request->param("cate");

        if (empty($cate)) {
            $cate = 1;
        }

        if (empty($status)) {
            $status = 0;
        }

        if (empty($title) || empty($content)) {
            return ResponsUtil::error("格式错误");
        }

        $post = new Post();

        $desc = strip_tags($content);

        $data = [
            "post_cate_id" => $cate,
            "post_status" => $status,
            "post_title" => $title,
            "post_content" => $content,
            "post_intro" => mb_substr($desc, 0, 300),
            "post_post_time" => time(),
            "post_update_time" => time(),
            "post_meta" => $content,
        ];

        $post->insert($data);

        return ResponsUtil::success("修改完成");
    }
}