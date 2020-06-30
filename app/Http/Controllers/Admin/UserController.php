<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //用户列表界面
        return view('admin.user.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //用户添加界面
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //用户添加功能实现
        //1.接收前台表单提交的数据
        $input=$request->all();

//        2.表单验证
       // 3.添加数据库

        $username=$input['email'];
        $pass=Crypt::encrypt($input['pass']);
        $res=User::create(['user_name'=>'$username'],['user_pass'=>'$pass'],['email'=>$input['email']]);
//
//    4.根据添加是否成功，给客户返回json格式
        if ($res){
            $data=[
              'status'=>0,
                'message'=>'添加成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'message'=>'添加失败'
            ];
        }
        return $data;
//
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //显示一条数据
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //返回修改页面
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //用户更新操作
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //用户删除
    }
}
