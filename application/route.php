<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use \think\Route;

Route::rule("l", "admin/index/phpinfo");
Route::rule("login$", "admin/login/index");
Route::rule("admin$", "admin/index/index");
Route::rule("notepad$", "admin/index/notepad");
Route::rule("notepad/new", "admin/article/create","POST");

Route::get("gt/register-slide", "admin/gt3/api1");
Route::post("gt/register-slide", "admin/gt3/api2");

Route::pattern([
    'post_id'  =>  '\d+',
]);

return [
		'/' => 'index/index',
		'index' => 'index/index',
		'page/:post_id$' => 'post_page/index',
		'cate/:cate_id$' => 'index/cate',
         'leave' => 'leave/index',
];
