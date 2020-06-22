<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;


class AdminLogin extends Controller
{
    //后台登录页
        public function login(){

            return view('admin/login');

        }
}
