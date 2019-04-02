<?php
/**
 * User: nicekun
 * Date: 2019/4/2
 * Time: 14:17
 */

namespace app\index\controller;


class Leave extends Base
{

    public function index(){

        return $this->fetch();
    }
}