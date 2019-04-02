<?php
/**
 * User: nicekun
 * Date: 2019/3/13
 * Time: 15:41
 */

namespace app\admin\controller;


use think\Config;
use think\Controller;
use think\Cookie;
use think\Request;
use think\Session;
use \Firebase\JWT\JWT;

class Base extends Controller
{

    protected function checkAuth(){
        $request = Request::instance();
        $user = $request->user;

        $jwt = "";
        if(empty($user)){
            $jwt = Session::get("token");
            if(empty($jwt)){
                $jwt = Cookie::get("tk");
            }

            if(empty($jwt)){
                $this->redirect("/login");
            }
        }

        $request->user = (array)JWT::decode($jwt,  Config::get("JWT_PUB_KEY"), array('RS256'));
        Request::hook('user','getUserInfo');
    }
}