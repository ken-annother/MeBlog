<?php
/**
 * User: nicekun
 * Date: 2019/3/9
 * Time: 22:07
 */

namespace app\index\controller;


use app\common\model\Category;
use app\common\model\Post;

class PostPage extends Base
{
    public function Index($post_id){
        $cats = Category::all();
        $cat_map = array();

        foreach ($cats as $cat){
            $cat_map[$cat['cate_id']] = $cat['cate_name'];
        }

        $post = new Post();
        $data = $post->where('post_id','=',$post_id)
            ->alias('p')
            ->join('__CATEGORY__ c', 'p.post_cate_id = c.cate_id')
            ->find();
        if(!$data){
            $this->error("文章不存在");
        }

        $this->assign("post", $data);
        return $this->fetch("page");
    }
}