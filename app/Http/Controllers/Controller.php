<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
        public function  test1(){
            $admin="wo";
            $data=DB::select('select * from member where id=?',[2]);
                foreach ($data as $user){
                    echo $user->phone;
                }
               return view('test1',['users'=>$user->phone],['admin'=>$admin]);
        }

}
