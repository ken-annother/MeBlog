<?php
namespace app\index\controller;

use app\common\model\Category;
use think\Controller;
use think\Request;

class Base extends Controller 
{
    protected $beforeActionList = [
        'listCate'
    ];

    protected function listCate(){
        $request = Request::instance();

        $cats = Category::all(function ($query){
            $query->order('cate_order', 'asc');
        });
        $cate_map = array();

        foreach ($cats as $cat){
            $cate_map[$cat['cate_id']] = $cat['cate_name'];
        }

        $request->cate_map = $cate_map;
        $request->cate = $cats;
        Request::hook('cate_map','getCateMap');
        Request::hook('cate','getCate');

        $this->assign("cate_map", $cats);
    }
}
