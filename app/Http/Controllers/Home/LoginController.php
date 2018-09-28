<?php
/*  User: tao    Date: 2018/8/30   Time: 8:58  */

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use DB;
use Hash;
use Cache;
use Validator;
use Mail;
use Illuminate\Http\Request;
use Cookie;

class LoginController extends Controller
{
    //进入登录页面
    public function login() {
        return view('home.login.login');
    }

    //登录检测
    public function login_check() {
        // 判断用户账号密码是否正确

        // 判断账号是否为空
        if (empty($_POST['name'])) {
            return json_encode(['code'=>1,'msg'=>'账号不能为空']);
        }
        // 判断密码是否为空
        if (empty($_POST['pass'])) {
            return json_encode(['code'=>2,'msg'=>'密码不能为空']);
        }
        // 判断该用户是否存在
        $row = DB::table('users')->where('name',$_POST['name'])->where('status','!=','2')->first();
        if (!$row) {
            return json_encode(['code'=>3,'msg'=>'该用户不存在或用户输入有误']);
        }
        // 判断该用户是否被禁用
        if ($row->status == '1') {
            return json_encode(['code'=>4,'msg'=>'用户未激活,请前往邮箱激活后再登录!']);
        }
        // 判断密码跟用户是否存在
        if ( $row && Hash::check($_POST['pass'],$row->pass)) {
            $user = DB::table('users_detail')
                    ->where('uid',$row->id)
                    ->first();
            session([
                'home_user' =>[
                    'name'      =>  $row->name,
                    'id'        =>  $row->id,
                    'nickname'  =>  $user->nickname,
                    'uface'     =>  $user->uface,
                    'score'     =>  $row->score
                ]
            ]);
            // 判断该用户是否记住密码
            if ( $_POST['rem'] == 1 ) {
                Cookie::queue('username',$row->name, 1008);
                Cookie::queue('pass',  $_POST['pass'], 1008);
            } else {
               Cookie::queue(Cookie::forget('home_info'));
            }
            // 将用户登录信息写入数据库
            DB::table('users_detail')
                ->where('id',$row->id)
                ->update([
                    'last_login_ip' => $_SERVER['REMOTE_ADDR'],
                    'last_login_time'=>time()
                ]);
            return json_encode(['code'=>0,'msg'=>'登录成功!']);
        } else {
            return json_encode(['code'=>4,'msg'=>'用户名或密码错误']);
        }

    }

    //退出登录
    public function logout() {
        session()->pull('home_user');
        return redirect('/');
    }

    //进入注册页面
    public function register() {
        return view('home.login.reg');
    }

    //处理注册页面数据
    public function registerCheck(Request $req) {
        if ( $req->ajax() ) {
            $data   = $req->only(['name','pass','email','nickname']);
            if ( DB::table('users')->where('email','=',$data['email'])->exists() ) {
                return response()->json([
                    'code'      => '111',
                    'msg'       => '邮箱已存在',
                    'time'      => time()
                ]);
            }
            if ( DB::table('users')->where('name','=',$data['name'])->exists() ) {
                return response()->json([
                    'code'      => '111',
                    'msg'       => '用户名已存在',
                    'time'      => time()
                ]);
            }
            if ( DB::table('users_detail')->where('nickname','=',$data['nickname'])->exists() ) {
                return response()->json([
                    'code'      => '111',
                    'msg'       => '妮称已存在',
                    'time'      => time()
                ]);
            }

            $token  = str_random(50);
            DB::beginTransaction();
            try {
                $uid = DB::table('users')->insertGetId([
                    'name'  => $data['name'],
                    'pass'  => Hash::make($data['pass']),
                    'email' => $data['email'],
                    'status'=> '1',
                    'token' => $token
                ]);
                DB::table('qiandao')->insert(['uid'=>$uid]);
                DB::table('users_detail')->insert([
                    'nickname'  => $data['nickname'],
                    'uid'       => $uid,
                ]);
                $info = [
                    'links' => "http://www.riji.com/registerActive/{$uid}/{$token}",
                    'uname' => $data['name'],
                    'tip'   => '点击激活账号'
                ];
                //发送邮件给用户,成功返回true
                $res = SendEmail($data['email'],$info);
                if ( $res != true ) {
                    DB::rollBack();
                    return response()->json([
                        'code'      => '000',
                        'msg'       => '发送邮件失败',
                        'time'      => time()
                    ]);
                }


                DB::commit();

                return response()->json([
                    'code'      => '000',
                    'msg'       => '注册成功,请在邮箱中激活账号，再登录',
                    'time'      => time()
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([
                    'code'      => '111',
                    'msg'       => '注册失败',
                    'time'      => time()
                ]);
            }
        }
    }

    //用户帐号激活页面
    public function registerActive($id,$token) {
        $info = DB::table('users')->where('id','=',$id)->first();
        if ( $info && $info->token == $token && $info->status == '1' ) {
            $up = [
                'id'    => $info->id,
                'token' => str_random(50),
                'status'=> '0'
            ];
            if ( DB::table('users')->where('id',$id)->update($up) ) {
                return view('home.login.activeResultPage',[
                    'tip'   => '帐号已激活'
                ]);
            } else {
                return view('home.login.activeResultPage',[
                    'tip'   => '帐号激活失败',
                    'backUrl'          => back()->getTargetUrl()
                ]);
            }
        } else {
            return view('home.login.activeResultPage',[
                'tip'   => '帐号激活验证失败'
            ]);
        }
    }

    //ajax验证帐号
    public function checkName(Request $req) {
        if ( $req->ajax() ) {
            $data = $req->except('_token');
            if ( DB::table('users')->where('name','=',$data['name'])->exists() ) {
                return $this->returnJson('帐号已存在','111');
            } else {
                return $this->returnJson('帐号可用');
            }
        }
    }

    //ajax验证笔名/妮称
    public function checkNickname(Request $req) {
        if ( $req->ajax() ) {
            $data = $req->except('_token');
            if ( DB::table('users_detail')->where('nickname','=',$data['nickname'])->exists() ) {
                return $this->returnJson('笔名/妮称已存在','111');
            } else {
                return $this->returnJson('笔名/妮称可用');
            }
        }
    }

    //ajax验证邮箱
    public function checkEmail(Request $req) {
        if ( $req->ajax() ) {
            $email = $req->input('email');
            if ( DB::table('users')->where('email','=',$email)->exists() ) {
                return $this->returnJson('邮箱已存在','111');
            } else {
                return $this->returnJson('邮箱可用');
            }
        }
    }

    /**
     * 进入忘记密码页面
     */
    public function forget() {
        return view('home.login.forget');
    }

    //发送邮箱路径  进入修改密码页面
    public function doforget(Request $req) {
        $email = $req->input('email');
        $rules = ['email' => 'required|email', 'vcode' => 'required|captcha'];
        $validator = Validator::make($req->all(),$rules);
        if ( !empty( $validator->errors()->messages() ) ) {
            return response()->json([
                'code'      => '111',
                'msg'       => '验证码错误',
                'time'      => time()
            ]);
        }

        $info = DB::table('users')->where('email','=',$email)->first();
        if ( $info ) {
            $data = [
                'links' => "http://www.riji.com/changepwd/{$info->id}/{$info->token}",
                'uname' => $info->name,
                'tip'   => '点击前往修改密码',
            ];
            //发送邮件给用户,成功返回true
            $res = SendEmail($email,$data);
            if ( $res ) {
                $redis = $this->getRedis(3);//将修改密码的用户信息放入到
                $key_forget_pwd = 'key_forget_pwd_'.$email;
                if ( $redis->exists( $key_forget_pwd ) ) {
                    return response()->json([
                        'code'      => '000',
                        'msg'       => '修改密码链接已经发送至邮件中,请登录邮箱进入修改1!',
                        'time'      => time()
                    ]);
                }
                $redis->setex( $key_forget_pwd , 600, $email );
                return response()->json([
                    'code'      => '000',
                    'msg'       => '修改密码链接已经发送至邮件中,请登录邮箱进入修改!',
                    'time'      => time()
                ]);
            } else {
                return response()->json([
                    'code'      => '111',
                    'msg'       => '邮件发送失败',
                    'time'      => time()
                ]);
            }

        } else {
            return response()->json([
                'code'      => '111',
                'msg'       => '邮箱帐号不存在',
                'time'      => time()
            ]);
        }

    }

    /**
     * 邮箱中的修改密码链接
     */
    public function changePwd($id,$token) {
        $info = DB::table('users')->where('id','=',$id)->first();
        $email = $info->email;
        $redis = $this->getRedis(3);//将修改密码的用户信息放入到
        $key_forget_pwd = 'key_forget_pwd_'.$email;
        if ( !$redis->exists( $key_forget_pwd ) ) {
            return view('home.login.activeResultPage',[
                'tip'   => '链接已失效'
            ]);
        }

        //如果邮箱中的验证码和id通过验证后  就进入修改密码页面
        if ($info && $info->token == $token) {
            return view('home.login.changepwd',[
                'id'    => $id,
                'token' => $token
            ]);
        } else {
            return view('home.login.activeResultPage',[
                'tip'   => '邮箱验证失败'
            ]);
        }
    }

    /**
     * 执行修改密码
     * @param Request $req
     * @return \Illuminate\Http\JsonResponse
     */
    public function doChangePwd(Request $req) {
        $id     = $req->input('id');
        $token  = $req->input('token');
        $pass   = $req->input('pass');
        $info = DB::table('users')->where('id',$id)->first();
        $email = $info->email;
        if ( $info && $info->token == $token ) {
            $pass = Hash::make($pass);
            if ( DB::table('users')->where('id',$id)->update(['pass'=>$pass]) ) {
                $redis = $this->getRedis(3);//将修改密码的用户信息放入到
                $key_forget_pwd = 'key_forget_pwd_'.$email;
                $redis->del([$key_forget_pwd]);

                return response()->json([
                    'code'      => '000',
                    'msg'       => '修改密码成功',
                    'time'      => time()
                ]);
            } else {
                return response()->json([
                    'code'      => '111',
                    'msg'       => '修改密码失败',
                    'time'      => time()
                ]);
            }
        } else {
            return response()->json([
                'code'      => '111',
                'msg'       => '用户验证失败',
                'time'      => time()
            ]);
        }
    }

}
