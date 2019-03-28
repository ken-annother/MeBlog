<?php
/**
 * User: nicekun
 * Date: 2019/3/13
 * Time: 15:45
 */

namespace app\admin\controller;


class Login extends Base
{
    public function index(){
        return $this->fetch();
    }
}