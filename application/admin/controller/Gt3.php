<?php
/**
 * User: nicekun
 * Date: 2019/3/14
 * Time: 14:42
 */

namespace app\admin\controller;


use app\common\model\User;
use app\common\util\ResponsUtil;
use think\Config;
use think\Controller;
use think\Request;
use think\Session;
use \Firebase\JWT\JWT;

class Gt3 extends Controller
{

    public function api1(){
        $request = Request::instance();

        $GtSdk = new \gt3\GeetestLib(Config::get('GT3_CAPTCHA_ID'), Config::get('GT3_PRIVATE_KEY'));
        $userId = Session::get('user_id');
        if(!$userId){
            $userId = "anonym";
        }
        $data = array(
            "user_id" =>  $userId, # 网站用户id
            "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
            "ip_address" => $request->ip() # 请在此处传输用户请求验证时所携带的IP
        );

        $status = $GtSdk->pre_process($data, 1);

        Session::set('gtserver',$status);
        Session::set('user_id',$data['user_id']);
        echo $GtSdk->get_response_str();
    }


    public function api2(){
        $request = Request::instance();

        $GtSdk = new  \gt3\GeetestLib(Config::get('GT3_CAPTCHA_ID'), Config::get('GT3_PRIVATE_KEY'));
        $data = array(
            "user_id" => Session::get('user_id'), # 网站用户id
            "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
            "ip_address" => $request->ip() # 请在此处传输用户请求验证时所携带的IP
        );

        if (Session::get('gtserver')== 1) {   //服务器正常
            $result = $GtSdk->success_validate($request->param('geetest_challenge'), $request->param('geetest_validate'), $request->param('geetest_seccode'), $data);
            if ($result) {
                return $this->validateLogin($request);
            } else {
                return ResponsUtil::error("fail");
            }
        } else {  //服务器宕机,走failback模式
            if ($GtSdk->fail_validate($request->param('geetest_challenge'),$request->param('geetest_validate'),$request->param('geetest_seccode'))) {
                return $this->validateLogin($request);
            } else {
                return ResponsUtil::error("fail");
            }
        }
    }

    private function validateLogin($request){
        $email = $request->param('email');
        $password = $request->param('password');
        $rememberme = $request->cookie('rememberme');

        if(empty($rememberme)){
            $rememberme = 0;
        }

        if(empty($username) || empty($password)){
            return ResponsUtil::error("用户名和密码不能为空");
        }

        $user = new User();
        $cursor = $user->where('email',$email)->find();
        if(empty($cursor) || $password != $cursor['password']){
            return ResponsUtil::error("用户名或密码错误");
        }


    }
}