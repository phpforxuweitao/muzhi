<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\AdminLogin;
use Hash;
use Cache;
use Carbon\Carbon;

class LoginController extends Controller
{
	private $limitNum = 5; //允许的错误次数
	private $limitTime  = 10; //禁用分钟数

	//登录
    public function index() {
        if ( session('admin_info')['islogin'] ) {
            return back()->with('error','用户已登录');
        }
    	return view('admin.login.login');
    }

    //处理登录方法
    public function dologin(AdminLogin $request) {
    	$name = $request -> input('name');
    	$pass = $request -> input('pass');
    	$user = DB::table('admin_users')
    	    ->where('name','=',$name)
    	    ->first(); //获取数据库中匹配的用户名

        if ($user && session('admin_info')['uid']){
            redirect('/bk_login')->with('error','用户已登录!');
        }

        $ip     = 'bk_login_'.$_SERVER['REMOTE_ADDR'];
        $err    = Cache::get($ip);
        if ( !empty($err) && $err >= $this->limitNum ) {
            return back()->with('admin_login_error',"已经登录错误{$err}次,{$this->limitTime}分钟后方可登录");
        } else {
            //如果用户名正确并且密码验证通过
            if ($user && Hash::check($pass,$user->pass)){
                //将当前用户登录信息插入到admin_log表中
                $admin_log = [
                    'uid'       => $user->id,
                    'ip'        => $_SERVER['REMOTE_ADDR'],
                    'desc'      => '登录',
                    'login_time'=> time()
                ];
                DB::table('admin_log')->insert($admin_log);
                //把用户信息写入到session
                session([
                    'admin_info'=>[
                        'islogin'   => true,
                        'uid'       => $user->id,
                        'adminName' => $user->name
                    ]
                ]);
                // 1.获取登录用户的所有访问权限
                $list = DB::table('user_role as ur')
                        ->join('role_node as rn','ur.rid','=','rn.rid')
                        ->join('node as n','rn.nid','=','n.id')
                        ->where('ur.uid',$user->id)
                        ->select('n.name','n.mname','n.aname')
                        ->get();
                // 2.初始化权限信息，将后台首页写入权限
                $node_list['IndexController'][] = 'index';
                // 遍历写入
                foreach ($list as $k => $v) {
                    $node_list[$v->mname][] = $v->aname;
                }
                // 3.将登录用户的所有权限存储在session
                session([
                    'admin_node'=>[
                        'node_list' => $node_list
                    ]
                ]);
                //登录成功，跳转到后台首页并清空记录登录错误的cache
                Cache::pull($ip);
    			return redirect('/bk_index')->with('success','登录成功');

            } else {
                $err = $this->login_errorNum($this->limitNum,$this->limitTime);
                if ($err < $this->limitNum) {
                    return back()->with('admin_login_error',"用户名或密码错误,错误次数{$err}");
                } else {
                    return back()->with('admin_login_error',"已经登录错误{$err}次,{$this->limitTime}分钟后方可登录");
                }
            }
        }
    }

    //退出登录
    public function logout(Request $request) {
        //将当前用户退出信息插入到admin_log表中
        $uid = session('admin_info')['uid'];
        if ($uid) {
            $admin_log = [
                'uid'       => $uid,
                'ip'        => $_SERVER['REMOTE_ADDR'],
                'desc'      => '退出',
                'login_time'=> time()
            ];
            DB::table('admin_log')->insert($admin_log);
        }

    	//销毁session值
    	$request -> session()->pull('admin_info');
        $request -> session()->pull('admin_node');
    	return redirect('/bk_login');
    }

    /**
     * @param int $limit    允许错误次数
     * @param int $time 限制分钟数
     * @return int|mixed
     */
    protected function login_errorNum(int $limit = 5,int $time=5):int {
        //获取当前登录用户的ip
        $ip = 'bk_login_'.$_SERVER['REMOTE_ADDR'];
        $err = Cache::get($ip);
        if ( empty($err) ) {
            $err = 1;
            Cache::put($ip,$err,$time);
        } elseif (!empty($err) && $err < $limit) {
            ++ $err;
            Cache::put($ip,$err,$time);
        } elseif ($err >= $limit) {
            Cache::put($ip,$err,$time);
        }
        return $err;    //返回错误次数
    }

}
