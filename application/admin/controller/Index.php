<?php
/**
 * User: nicekun
 * Date: 2019/3/13
 * Time: 15:40
 */

namespace app\admin\controller;

use app\common\model\Category;
use app\common\model\Post;
use think\Request;


class Index extends Base
{
    protected $beforeActionList = [
        'checkAuth',
    ];

    public function phpinfo()
    {
        return phpinfo();
    }

    public function index()
    {
        return $this->fetch();
    }

    public function notepad()
    {
        $cats = Category::all();
        $cat_map = array();
        $tmp = null;
        foreach ($cats as $cat) {
            if ($cat['cate_id'] == 1) {
                $tmp = $cat;
            } else {
                array_push($cat_map, $cat);
            }
        }

        array_unshift($cat_map, $tmp);
        $this->assign("cates", $cat_map);
        return $this->fetch();
    }


    public function article()
    {
        //加入文章分类
        $cats = Category::all();
        $cate_map = array();
        foreach ($cats as $cat) {
            $cate_map[$cat['cate_id']] = $cat['cate_name'];
        }

        $this->assign("cate_map", $cate_map);
        $this->assign("cate", $cats);

        $post = new Post();
        $post->where("post_type", "0");  //普通类型，非留言板

        $request = Request::instance();
        $manage_type = $request->get("c");
        if (!empty($manage_type) && $manage_type == "dm") {  //草稿管理
            $post->where("post_status", "1");
        } else {  //文章管理
            $post->where("post_status", "0");
        }

        $cate = $request->get("t");
        if (!empty($cate)) {
            $post->where("post_cate_id", $cate);
        }

        $post->order("post_post_time", "DESC");

        $post_list = $post->select();
        $this->assign("post_list", $post_list);

        return $this->fetch();
    }
}