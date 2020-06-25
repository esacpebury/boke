<?php

namespace App\Http\Controllers\Admin;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use mysql_xdevapi\Session;


class AdminLogin extends Controller
{
    //后台登录页
    public function login()
    {

        return view('admin/login');

    }

    //验证码
    public function captcha($tmp)
    {

        $phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase->build(4);
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(220, 210, 230);
        $builder->setMaxAngle(10);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        \Session::flash('code', $phrase);

        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();

//
         $data = \Input::all();
//        //验证码验证
//        if ($data['captcha'] != \Session::get('code')) {
//            return redirect()
//                ->withErrors('验证码错误!');

    }

        //验证码判定
//    public function store(Request $request)
//    {
//
//        //

//
//
//    }
    //登录表单验证
    public function dologin(Request $request){
        //1.接收前台登录数据
    //  $input=$request->except('_token');


        //2.进行表单验证


        $rule=[
            'username'=>'required|between:4,18',
            'password'=>'required|between:4,18|alpha_dash',

              ];
        $msg=[
            'username.required'=>'用户名必须填写',
            'username.between'=>'用户名必须在4-18位' ,
            'password.required'=>'密码必须填写',
            'password.between'=>'密码必须在4-18位' ,
            'password.alpha_dash'=>'密码必须是数字字母下划线',

        ];
        //表单验证结果
       $validator= $this->validate($request,$rule,$msg);


//        3.验证用户是否存在
        $user=User::where('user_name',$request['username'])->first();
            if (!$user){
                return redirect('admin/login')->with('errors','用户名错误');
             }
            if ($request['password']!=Crypt::decrypt($user->user_pass)){
                return redirect('admin/login')->with('errors','密码错误');
            }
        if (strtolower($request['code'])!==strtolower(session()->get('code'))) {

            return redirect('admin/login')->with('errors','验证码错误');
        }
            //4.用户存到session中
            Session()->put('user',$user);

//            5.跳转到后台首页中去
                return redirect('admin/index');

   // public function jiami(){
        //md5加密
//        $str='salt'.'123456';
//        return md5($str);
        //哈希加密
//        $str='11234';
//       $hash=Hash::make($str);
//        //解密
//       if(Hash::check($str,$hash)){
//            return"正确";
//        }else{
//           return'密码错误';
//       }
        //crypt加密
//        $str='123456';
//        $crypt_str=Crypt::encrypt($str);
//        return $crypt_str;
//
//        if (Crypt::decrypt($crypt_str)==$str){
//            return "正确";
//        }else{
//            return "失败";
//        }
    }

    //后台首页
    public function index(){
        return  view('admin.index');
    }
    //后台欢迎页
    public function welcome(){
        return view('admin.welcome');
    }
}
