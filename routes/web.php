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
Route::get('/test1','Controller@test1');
Route::get('/login','Auth\LoginController@login');
//用户添加页面路由
Route::get('user/add','UserController@add');
//用户数据库添加
Route::post('user/store','UserController@store');
//用户列表页
Route::get('user/index','UserController@index');
//用户修改路由
Route::get('user/edit/{id}','UserController@edit');
//用户列表页
//Route::get('user/list','UserController@list');
//用户修改页面
Route::post('user/update','UserController@update');
//用户删除路由
Route::get('user/del/{id}','UserController@destroy');
//============================================================
//正式博客路由
Route::get('admin/login','Admin\AdminLogin@login');



