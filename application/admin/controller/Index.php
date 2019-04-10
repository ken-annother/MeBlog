<?php
/**
 * User: nicekun
 * Date: 2019/3/13
 * Time: 15:40
 */

namespace app\admin\controller;

use app\common\model\Category;


class Index extends Base
{
    protected $beforeActionList = [
        'checkAuth',
//        'checkAuth' => ['only' => 'checkAuth'],
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
            }else{
                array_push($cat_map, $cat);
            }
        }

        array_unshift($cat_map, $tmp);
        $this->assign("cates", $cat_map);
        return $this->fetch();
    }
}