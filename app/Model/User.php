<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //关联表
    public $table='user';

    //2.主键
    public $primaryKey='user_id';
    //3.允许批量操作的字段
    public $fillable=['user_name','user_pass','email','phone'];
    // public $guarded=[];   所有都允许
    public  $timestamps=false;



}
