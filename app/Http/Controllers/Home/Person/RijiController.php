<?php

namespace App\Http\Controllers\Home\Person;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\Home\Content;

class RijiController extends Controller
{
    //日记投稿页面
    public function index() {
        $data = DB::table('cates')
            ->select('id','name')
            ->where('pid','!=',0)
            ->where('pid','!=',44)
            ->orderBy('id','asc')
            ->get();

    	return view('home.Person.riji',['data'=>$data]);
    } 

    //日记添加处理
    public function doadd(Content $req) {
        $all = $req->session()->all();
        $id = $all['home_user']['id'];
        $name = $all['home_user']['name'];
    	$data = $req->only('cid','week','weather','title','content');
    	$data['size'] = mb_strlen($data['content']);
        $data['uid'] = $id;
        $data['uname'] = $name;
    	$data['created_at'] = time();
    	$data['updated_at'] = time();
        // dd($data);
    	$res = DB::table('content')->insert($data);
    	if($res){
    		return redirect('/ps_riji')->with('success','添加成功');
    	}else{
    		return redirect('/ps_riji')->with('error','添加失败');
    	}
    }
}
