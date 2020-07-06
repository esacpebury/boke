<?php

namespace App\Http\Middleware;

use App\Model\Role;
use App\Model\User;
use App\Model\Permission;
use Closure;
use Illuminate\Routing\Route;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //获取当前请求的路由  对应的控制器方法名
//        "App\Http\Controllers\Admin\AdminLogin@index"
        $route = \Route::current()->getActionName();
        //获取当前用户的权限组
        $user=User::find(session()->get('user')->user_id);

        //获取当前用户的角色组
        $roles=$user->role;
//       dd($roles);
        //根据用户拥有的角色，找对应的权限
        //存放权限对应的per_url字段的值（就是权限列表）
        $arr=[];
            foreach ($roles as  $v){
             $perms=$v->permission;
             foreach ($perms as $perm){
                 $arr[]=$perm->per_url;
             }
//             dd($arr);
            }
            //去掉重复的权限
        $arr=array_unique($arr);
            //判断当前请求的路由对应的控制器的方法是否在当前用户拥有的权限列表中 也就是$arr中
        if (in_array($route,$arr)){
            return $next($request);
        }else{
            return redirect('noaccess');
        }

    }
}
