<?php

namespace App\Http\Controllers\Admin;

use App\Model\Permission;
use App\Model\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{


    //获取授权图
    public function auth($id){


        //获取当前角色
        $role=Role::find($id);
        //通过id获取所有的权限列表
        $perms=Permission::get();
        //获取当前角色拥有的权限
        $own_perms=$role->permission;
        //遍历出当前角色身上的权限
        $own_pers=[];
        foreach ($own_perms as $v) {
            $own_pers[]=$v->id;
        }

        return view('admin.role.auth',compact('role','perms','own_pers'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */

    //角色处理授权
    public function doAuth(Request $request){
        $input=$request->except('_token');
        //dd($input);
        //先删除当前角色已有权限
        \DB::table('role_permission')->where('role_id',$input['role_id'])->delete();
        //添加新授权权限
        if (!empty($input['permission_id'])){

        foreach ($input['permission_id'] as $v){
            \DB::table('role_permission')->insert(['role_id'=>$input['role_id'],'permission_id'=>$v]);
        }
        }

        return redirect('admin/role');
    }


    public function index()
    {
        //1.获取所有的角色列表
        $role=Role::get();
        //2.返回视图
        return view('admin.role.list',compact('role'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //1.获取表单提交数据
        $input=$request->except('_token');
//        dd($input);
//        2.进行表单验证
//            3.将数据提交到表单中

    $res=Role::create($input);
        if ($res){
            return redirect('admin/role');
        }else{
            return back()->with('msg','添加失败');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
