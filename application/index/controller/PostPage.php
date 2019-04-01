<?php
/**
 * User: nicekun
 * Date: 2019/3/9
 * Time: 22:07
 */

namespace app\index\controller;


use app\common\model\Post;

class PostPage extends Base
{
    public function Index($post_id){
        $post = new Post();
        $data = $post->where('post_id','=',$post_id)->find();
        if(!$data){
            $this->error("文章不存在");
        }

        $this->assign("post", $data);
        return $this->fetch("page");
    }
}