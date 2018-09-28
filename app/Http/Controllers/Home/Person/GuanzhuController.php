<?php

namespace App\Http\Controllers\Home\Person;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class GuanzhuController extends Controller
{
    //粉丝关注列表页
	public function index(Request $req) {
		$all = $req->session()->all();
        $from_id = $all['home_user']['id'];
		$data = DB::table('users_detail as ud')
			->join('guanzhu as gz','ud.uid','=','gz.to_uid')
			->select('ud.nickname','ud.sex','ud.fame','ud.uface','ud.uid','gz.from_uid','gz.to_uid')
			->where('gz.from_uid','=',$from_id)
			->paginate(10);
		// dd($data);
		return view('home.Person.gz_index',['data'=>$data]);
	}

	//我的粉丝列表页
	public function fensi(Request $req) {
		$all = $req->session()->all();
        $from_id = $all['home_user']['id'];
		$data = DB::table('users_detail as ud')
			->join('guanzhu as gz','ud.uid','=','gz.from_uid')
			->select('ud.nickname','ud.sex','ud.fame','ud.uface','ud.uid','gz.to_uid','gz.from_uid')
			->where('gz.to_uid','=',$from_id)
			->paginate(10);
			
		return view('home.Person.gz_fensi',['data'=>$data]);
	}

	//取消关注
	public function quxiao(Request $req,$id) {
		$all = $req->session()->all();
        $from_id = $all['home_user']['id'];
		$res = DB::table('guanzhu')
			->where('from_uid','=',$from_id)
			->where('to_uid','=',$id)
			->delete();
		if($res){
			return back()->with('success','取消关注成功');
		}else{
			return back()->with('error','取消关注失败');
		}
	}
}
