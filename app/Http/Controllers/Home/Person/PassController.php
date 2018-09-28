<?php

namespace App\Http\Controllers\Home\Person;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Http\Requests\Home\Pass;

class PassController extends Controller
{
    //密码修改首页
    public function index() {
    	return view('home.Person.pass');
    }

    //密码修改处理
    public function doedit(Pass $req) {
    	$all = $req->session()->all();
        $id = $all['home_user']['id'];
        $data = $req->only('pass');
        // dd($data);
    	// 数据库获取用户修改前的信息
    	$users = DB::table('users')->where('id','=',$id)->first();
    	if(!empty($data['pass'])){
    		if(Hash::check($data['pass'],$users->pass)){ //如果修改后的密码和原密码一样，不给修改
    			return back()->with('error','修改后的密码和原密码一样');
    		}else{
    			$hash = Hash::make($data['pass']);
    			$res = DB::table('users')->where('id','=',$id)->update(['pass'=>$hash]);
    			if($res){
    				return back()->with('success','密码修改成功');
    			}else{
    				return back()->with('error','密码修改失败');
    			}
    		}
    	}
    }
}
