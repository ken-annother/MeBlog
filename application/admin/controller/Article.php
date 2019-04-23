<?php
/**
 * User: nicekun
 * Date: 2019/4/1
 * Time: 15:31
 */

namespace app\admin\controller;

use app\common\model\Post;
use app\common\util\ResponsUtil;
use think\Request;

class Article extends Base
{
    protected $beforeActionList = [
        'checkAuth',
    ];


    public function create()
    {
        $request = Request::instance();
        $status = $request->param("status");
        $title = $request->param("title");
        $content = $request->param("content");
        $cate = $request->param("cate");

        $isTop = 0;
        if ($request->param("isTop") && $request->param("isTop") == 'true') {
            $isTop = 1;
        }

        $tags = $request->param("tags");
        $postTime = $request->param("postTime");
        if (empty($postTime)) {
            $postTime = time() * 1000;
        }

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
            "post_post_time" => floatval($postTime) / 1000,
            "post_update_time" => time(),
            "post_meta" => $content,
            "post_istop" => $isTop,
            "post_tags" => $tags,
        ];

        $post->insert($data);

        return ResponsUtil::success("修改完成");
    }


    public function manage()
    {
        $request = Request::instance();
        $action = $request->param("action");
        $items = explode(",", $request->param("items"));
        switch ($action) {
            case "del":   //删除文章，丢到回收站
                $this->deletePosts($items);
                break;

            case "publish":   //发布
                $this->publishPosts($items);
                break;

            case "draft":   //移动到草稿箱
                $this->draftPosts($items);
                break;

            case "top":  //置顶
                $this->topPosts($items);
                break;

            case "untop":  //取消置顶
                $this->untopPosts($items);
                break;

            case "cate":    //移动到某个分类
                $cateId = $request->param("cateId");
                if(empty($cateId)){
                    return ResponsUtil::error("参数错误");
                }else{
                    $this->moveCate($items,intval($cateId));
                }

                break;

            default:        //未定义

                break;
        }

        return ResponsUtil::success("修改完成");
    }


    /**
     * 将文章删除到回收站
     * @param array $items
     */
    private function deletePosts(array $items)
    {
        $post = new Post();
        $post->whereIn("post_id", $items)->update(['post_status' => 2]);
    }

    private function publishPosts(array $items)
    {
        $post = new Post();
        $post->whereIn("post_id", $items)->update(['post_status' => 0]);
    }

    private function draftPosts(array $items)
    {
        $post = new Post();
        $post->whereIn("post_id", $items)->update(['post_status' => 1]);
    }

    private function topPosts(array $items)
    {
        $post = new Post();
        $post->whereIn("post_id", $items)->update(['post_istop' => 1]);
    }

    private function untopPosts(array $items)
    {
        $post = new Post();
        $post->whereIn("post_id", $items)->update(['post_istop' => 0]);
    }

    /**
     * 移动到某个分类
     * @param array $items
     * @param $cateId
     */
    private function moveCate(array $items, $cateId)
    {
        $post = new Post();
        $post->whereIn("post_id", $items)->update(['post_cate_id' => $cateId]);
    }
}