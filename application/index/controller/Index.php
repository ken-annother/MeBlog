<?php
namespace app\index\controller;

use app\common\model\Category;
use app\common\model\Post;
use app\common\model\Tag;

class Index extends Base
{
    public function index()
    {
        $cats = Category::all();
        $cat_map = array();

        foreach ($cats as $cat){
            $cat_map[$cat['cate_id']] = $cat['cate_name'];
        }

        $tags = Tag::all();

        $post = new Post();
        $top_posts = $post->where('post_status','=', '0')
            ->where('post_type','=','0')
            ->where('post_istop','=','1')
            ->order("post_update_time",'DESC')
            ->select();

        $posts = $post->where('post_status','=', '0')
            ->where('post_type','=','0')
            ->where('post_istop','=','0')
            ->order('post_post_time','DESC')
            ->limit(0,10)
            ->select();

        $this->assign("cates", $cat_map);
        $this->assign("tags", $tags);
        $this->assign("top_posts", $top_posts);
        $this->assign("posts", array_merge($top_posts,$posts));

    	return $this->fetch("index");
    }
}
