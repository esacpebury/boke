<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    public $table='user';
    //2，表的主键
    public $primaryKey='id';


    //3.允许拓展字段
        protected $fillable=[
          'username','password',
        ];
        public $timestamps=false;
}
