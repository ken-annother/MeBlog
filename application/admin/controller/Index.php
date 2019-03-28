<?php
/**
 * User: nicekun
 * Date: 2019/3/13
 * Time: 15:40
 */

namespace app\admin\controller;


class Index extends Base
{
    public function index(){
       return  $this->fetch();
    }

    public function notepad(){
        return $this->fetch();
    }
}