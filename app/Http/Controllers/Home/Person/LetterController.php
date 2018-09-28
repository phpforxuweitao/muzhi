<?php

namespace App\Http\Controllers\Home\Person;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LetterController extends Controller
{
	public function index() {

	}

    //收件箱页面
	public function in(Request $req) {
		$all = $req->session()->all();
        $id = $all['home_user']['id'];
        //用户详情表和站内信表关联
		$data = DB::table('letter as l')
			->join('users_detail as ud','l.from_uid','=','ud.uid') //发送人uid
			->select('ud.uface','ud.nickname','l.from_uid','l.to_uid','l.content','l.created_at','l.id')
			->where('to_uid','=',$id)
			->orderBy('created_at','desc')
			->paginate(10);
		
		return view('home.Person.letter_in',['data'=>$data]);
	}

	//发件箱页面
	public function out(Request $req) {
		$all = $req->session()->all();
        $id = $all['home_user']['id'];
        //用户详情表和站内信表关联
		$data = DB::table('letter as l')
			->join('users_detail as ud','l.to_uid','=','ud.uid') //收件人uid
			->select('ud.uface','ud.nickname','l.from_uid','l.to_uid','l.content','l.created_at','l.id')
			->where('from_uid','=',$id)
			->orderBy('created_at','desc')
			->paginate(10);
		return view('home.Person.letter_out',['data'=>$data]);
	}

	//发送信件页面
	public function send($id) {
		return view('home.Person.send',['to_uid'=>$id]);
	}

	//处理发送的信件
	public function dosend(Request $req) {
		$all = $req->session()->all();
        $from_id = $all['home_user']['id'];
		$data = $req->only('to_uid','content');
		$data['from_uid'] = $from_id;
		$data['created_at'] = time();
		$res = DB::table('letter')->insert($data);
		if($res){
			return redirect('/ps_letter/out')->with('success','信件发送成功');
		}else{
			return redirect('/ps_letter/send/{$data["to_uid"]}')->with('error','信件发送失败');
		}
	}

	//删除信件处理
	public function delete($id) {
		// dd($id);
		$res = DB::table('letter')->where('id','=',$id)->delete();
		if($res){
			return back()->with('success','删除成功');
		}else{
			return back()->with('error','删除失败');
		}
	}
}
