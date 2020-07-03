<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

//        1.获取提交的参数
//        $input=$request->all();
//        dd($input);

      $user=  User::orderBy('user_id','asc')
            ->where(function ($qurey) use ($request) {
                $username=$request->input('username');
                $email=$request->input('email');
                if (!empty($username)){
                    $qurey->where('user_name','like','%'.$username.'%');
                }
                if (!empty($email)){
                    $qurey->where('email','like','%'.$email.'%');
                }
            })->paginate($request->input('num')?$request->input('num'):3);

//        $user=User::();
        //用户列表界面
        return view('admin.user.list',compact('user','request'));
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
        $user=User::find($id);
        return  view('admin.user.edit',compact('user'));
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
//        1根据id获取要修改的记录
    $user=User::find($id);
//        2.获取修改的用户名
    $username=$request->input('user_name');

    $user->user_name=$username;
        $res=$user->save();
        if ($res){
            $data=[
                'status'=>0,
                'message'=>'修改成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'message'=>'修改失败'
                ];
        }
        return $data;

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
        $user=User::find($id);
        $res=$user->delete();
        if ($res){
            $data=[
                'status'=>0,
                'message'=>'删除成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'message'=>'删除失败'
            ];
        }
        return $data;
    }
    //选中用户全部删除
    public function delAll(Request $request){
        $input=$request->input('ids');
        $res=User::destroy($input);

        if ($res){
            $data=[
                'status'=>0,
                'message'=>'全部删除成功'
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
