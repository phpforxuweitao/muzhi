<?php

namespace App\Http\Controllers\Home\Person;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Http\Requests\Msg\Msg;
use Config;

class MsgController extends Controller
{
    //信息修改页面
    public function index(Request $req) {
        $all = $req->session()->all();
        $id = $all['home_user']['id'];
    	$data = DB::table('users as u')
    		->join('users_detail as ud','u.id','=','ud.uid')
    		->select('u.name','u.pass','ud.sex','ud.nickname','ud.uface','ud.birthday','u.qq')
    		->where('u.id','=',$id)
    		->get();

    	return view('home.Person.msg',['data'=>$data[0]]);
    }

    //处理修改
    public function doedit(Msg $req) {
        $all = $req->session()->all();
        $id = $all['home_user']['id'];
    	$data = $req->only('nickname','sex','birthday');
        $qq = $req->only('qq');
        $y = substr($data['birthday'],0,4);
        $m = substr($data['birthday'],5,2);
        $d = substr($data['birthday'],8,2);
        $mktime = mktime(0,0,0,$m,$d,$y);
        //判断出生年月日不能比超过当前时间
        if(time()-$mktime<0){
            return back()->with('error','出生日期有误');
        }
        // dd($qq);
    	// 头像修改
    	if($req->hasFile('pic')){
    		$name = time()+rand(1,10000);
    		//获取上传文件的后缀
    		$ext = $req->file('pic')->getClientOriginalExtension();
            //存放到指定位置
            $req->file('pic')->move(Config::get('app.app_upload'),$name.'.'.$ext);
            //获取图片位置
            $pic = ltrim(Config::get('app.app_upload').'/'.$name.'.'.$ext,'.');
    		$data['uface'] = $pic;
    	}
        
    	$data['sex']=='男' ? $data['sex']='m' : $data['sex']='w'; //转换为m、w格式
        $sele = DB::table('users_detail')->where('id','=',$id)->first();
        $uface = '.'.$sele->uface;
        // dd($uface);
    	$res = DB::table('users_detail')->where('id','=',$id)->update($data);
        $res1 = DB::table('users')->where('id','=',$id)->update(['qq'=>$qq['qq']]);
    	if($res || $res1){
            //判断如果有图片上传才删除原来的图片
            if($req->hasFile('pic')){
                //判断原图片不是默认图片才删除
                if($uface != "./static/home/person/images/boy.jpg"){
                    unlink($uface);
                }
            }
            //用户表和用户详情表关联
            $sess = DB::table('users as u')
                ->join('users_detail as ud','u.id','=','ud.uid')
                ->select('u.name','u.id','u.score','ud.nickname','ud.uface')
                ->where('u.id','=',$id)
                ->first();
            //更新session数据
            session([
                'home_user' =>[
                    'name'      =>  $sess->name,
                    'id'        =>  $sess->id,
                    'nickname'  =>  $sess->nickname,
                    'uface'     =>  $sess->uface,
                    'score'     =>  $sess->score
                ]
            ]);
    		return back()->with('success','信息修改成功');
    	}else{
    		return back()->with('error','信息修改失败');
    	}
    }
}
