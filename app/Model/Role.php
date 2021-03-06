<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    //关联表
    public $table='role';

    //2.主键
    public $primaryKey='id';
    //3.允许批量操作的字段
    //public $fillable=['user_name','user_pass','email','phone'];
     public $guarded=[];
    public  $timestamps=false;
    //添加动态属性关联权限
    public function permission(){
        return $this->belongsToMany('App\Model\Permission','role_permission','role_id','permission_id');
    }
}
