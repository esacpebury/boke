<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    //
    //关联表
    public $table='permission';

    //2.主键
    public $primaryKey='id';
    //3.允许批量操作的字段
//    public $fillable=['user_name','user_pass','email','phone'];
     public $guarded=[];
    public  $timestamps=false;
}
