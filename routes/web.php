<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Route::get('/test1','Controller@test1');
//Route::get('/login','Auth\LoginController@login');
////用户添加页面路由
//Route::get('user/add','UserController@add');
////用户数据库添加
//Route::post('user/store','UserController@store');
////用户列表页
//Route::get('user/index','UserController@index');
////用户修改路由
//Route::get('user/edit/{id}','UserController@edit');
////用户列表页
////Route::get('user/list','UserController@list');
////用户修改页面
//Route::post('user/update','UserController@update');
////用户删除路由
//Route::get('user/del/{id}','UserController@destroy');
//============================================================
//正式博客路由================================================================

//需要验证的界面     后台登录之前的页面
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
    //后台登录界面路由
    Route::get('login','AdminLogin@login');
    //登录数据提交路由
    Route::post('dologin','AdminLogin@dologin');
    //加密路由
    Route::get('jiami','AdminLogin@jiami');
    //验证码路由
    Route::get('code','AdminLogin@code');
});


//需要验证的界面     后台登录之后的页面
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>'IsLogin'],function (){
    //后台主页
    Route::get('index','AdminLogin@index');
    //后台欢迎页
    Route::get('welcome','AdminLogin@welcome');
    //后台登出路由
    Route::get('logout','AdminLogin@logout');

    //用户删除路由
    Route::get('user/del','UserController@delAll');
    //后台用户界面相关路由
  Route::resource('user','UserController');


  //角色模块
    Route::resource('role','RoleController');
    //角色授权路由
    Route::get('role/auth/{id}','RoleController@auth');

});

Route::get('/code/captcha/{tmp}', 'Admin\AdminLogin@captcha');




