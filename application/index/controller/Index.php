<?php

namespace app\index\controller;

use app\common\model\Post;

class Index extends Base
{
    public function index()
    {
        $post = new Post();
        $top_posts = $post->where('post_status', '=', '0')
            ->where('post_type', '=', '0')
            ->where('post_istop', '=', '1')
            ->order("post_update_time", 'DESC')
            ->select();

        $posts = $post->where('post_status', '=', '0')
            ->where('post_type', '=', '0')
            ->where('post_istop', '=', '0')
            ->order('post_post_time', 'DESC')
            ->limit(0, 10)
            ->select();


        $hot_posts = $post->where('post_status', '=', '0')
            ->where('post_type', '=', 0)
            ->order('post_view_nums', 'DESC')
            ->order('post_post_time', 'DESC')
            ->limit(0, 8)
            ->select();

        $this->assign("top_posts", $top_posts);
        $this->assign("posts", array_merge($top_posts, $posts));
        $this->assign("hot_posts", $hot_posts);

        return $this->fetch("index");
    }

    public function cate($cate_id)
    {
        $post = new Post();
        $posts = $post->where('post_status', '=', '0')
            ->where('post_type', '=', '0')
            ->where('post_cate_id', '=', $cate_id)
            ->order('post_post_time', 'DESC')
            ->limit(0, 10)
            ->select();


        $hot_posts = $post->where('post_status', '=', '0')
            ->where('post_type', '=', 0)
            ->order('post_view_nums', 'DESC')
            ->order('post_post_time', 'DESC')
            ->limit(0, 8)
            ->select();
        $this->assign("hot_posts", $hot_posts);

        $this->assign("posts", $posts);
        $this->assign("cate_name", request()->cate_map[$cate_id]);
        return $this->fetch();
    }
}
