<?php

namespace App\Http\Controllers\Home\Person;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\Home\QianMing;

class QianmingController extends Controller
{
    //个性签名
    public function index() {
    	return view('home.Person.qianming');
    }

    //个性签名添加
    public function doadd(QianMing $req) {
        $all = $req->session()->all();
        $id = $all['home_user']['id'];
    	$sign = $req->input('sign');
    	$data['signatrue'] = $sign;
    	$res = DB::table('users_detail')->where('id','=',$id)->update($data);
    	if($res){
    		return back()->with('success','更新签名成功');
    	}else{
    		return back()->with('error','更新签名失败');
    	}
    }
}
