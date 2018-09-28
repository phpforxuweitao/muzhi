<?php

namespace App\Http\Controllers\Home\Person;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class IndexController extends Controller
{
	//我的个人中心
    public function index(Request $req) {
        $all = $req->session()->all();
        $id = $all['home_user']['id'];
        //用户详情与用户表关联
    	$data = DB::table('users as u')
    		->join('users_detail as ud','u.id','=','ud.uid')
    		->select('u.name','u.qq','u.email','u.score','ud.uface','ud.nickname','ud.fame')
    		->where('u.id','=',$id)
    		->get();
        //获取总积分
        $score = $data[0]->score;

        //获取粉丝总人数    
        $to_uid = DB::table('guanzhu')->where('from_uid','=',$id)->count();
        $qd = DB::table('qiandao')->where('uid','=',$id)->get();

        //获取评论表内容
        $comment = DB::table('comment as c')
            ->join('users_detail as ud','c.from_uid','=','ud.uid')
            ->join('content as con','c.con_id','=','con.id')
            ->select('c.created_at','ud.nickname','con.title','ud.uid','con.id')
            ->orderBy('created_at','desc')
            ->limit(10)
            ->get();

        //获取我所有的文章con_id
        // $con_id = DB::table('comment as c')
        //     ->join('content as con','c.con_id','=','con.id')
        //     ->select('con.id')
        //     ->where('con.uid','=',$id)
            // ->first();
        // dd($con_id);
        //获取别人评论我的
        $comment_me = DB::table('comment as c')
            ->join('users_detail as ud','c.from_uid','=','ud.uid')
            ->join('content as con','c.con_id','=','con.id')
            ->select('c.created_at','ud.nickname','con.title','ud.uid','con.id')
            ->where('con.uid','=',$id)
            ->orderBy('created_at','desc')
            ->limit(6)
            ->get();
            // dd($comment_me);

    	return view('home.Person.index',[
            'data'       => $data[0],
            'to_uid'     => $to_uid,
            'qd'         => $qd,
            'score'      => $score,
            'comment'    => $comment,
            'comment_me' => $comment_me
            ]);
    }

    //签到记录
     public function qiandao(Request $req) {
        $all = $req->session()->all();
        $id = $all['home_user']['id'];
        $data = DB::table('qiandao')->where('uid','=',$id)->get();
        if($data[0]->status == 0){
            $num = rand(5,10); //获取随机签到积分
            $users = DB::table('users')->where('id','=',$id)->get();
            $score = $users[0]->score;
            $score += $num; //总积分

            $continue_num = $data[0]->continue_num;
            $continue_num++; //连续签到日数加1
            // 用户表与签到表关联
            DB::table('qiandao as qd')
                ->join('users as u','qd.uid','=','u.id')
                ->where('qd.uid','=',$id)
                ->update([
                        'qd.status'       => '1',
                        'u.score'         => $score,
                        'qd.continue_num' => $continue_num    
                    ]);
            //签到详情表数据的插入
            DB::table('qiandao_detail')
                ->insert(['uid'=>$id,'score'=>$num,'created_at'=>time()]);
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
            return response()->json([ 
                'code'  => 1,
                'msg'   => '签到成功',
                'num'   => $num,
                'score' => $score
            ]); 
        }else{
            return 0;
        }
        
    }


}
