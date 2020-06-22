<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //获取一个添加页面
public function add(){
    return view('user/add');
}
    //获取一个添加操作
    public function store(Request $request ){

    //获取一个表单数据
        $input=$request->except('_token');
       // dd($input);
      $res=User::create(['username'=>$input['username'],'password'=>md5($input['password'])]);
        //表单验证

        //3.添加操作
        if ($res){
            return redirect('user/index');
        }else{
            return_back();
        }
    }
    //用户列表页
    public function index(){
    //获取用户列表
        $user=User::get();
        //返回用户列表页
        return view('user.list',compact('user'));
    }
    //修改页面
    public function edit($id){
    //根据id修改页面
        $user=User::find($id);
        return view('user.edit',compact('user'));
    }
    public function update(Request $request){
    //用户名
        //1.接收用户名和用户id
        $input=$request->all();
       // dd($input);

      $user=  User::find($input['id']);
      //将提交过来的用户名替换原来的用户名
        $res=$user->update(['username'=>$input['username']]);
        //根据返回结果跳转到不同页面
        if ($res){
            return redirect('user/index');
        }else{
            return back();
        }
    }
    //用户删除
    public function destroy($id){
   $user= User::find($id);
    $res=$user->delete();
    if ($res){
        $data=[
            'status'=>0,
            'message'=>'删除成功',
        ];

    }else{
        $data=[
            'status'=>1,
            'message'=>'删除失败'
        ];
    }
    return $data;

    }
}
