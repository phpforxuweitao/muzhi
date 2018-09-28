<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Cookie;
class CommentContorller extends Controller
{
    public function index ()
    {
        // 判断该用户是否有登录
        if ( session('home_user') ) {
            $data['con_id']   = $_GET['id'];
            $data['from_uid'] = session('home_user')['id'];
            $data['content']  = $_GET['content'];
            $data['created_at'] = time();
            // return json_encode($data);
            $id = DB::table('comment')->insertGetId($data);
            // 将评论插入数据库
            if ( $id ) {
                // 评论成功返回数据
                return json_encode(['code'=>00000,'msg'=>'评论成功','ctime'=>date('m-d H:i'),'id'=>$id]);
            } else {
                return json_encode(['code'=>10002,'msg'=>'评论失败']);
            }
        } else {
            // 未登录提醒登录
            return json_encode(['code'=>10000,'msg'=>'请先登录后在评论']);
        }
    }

    //回复处理
    public function recomment() {
        if (session('home_user')) {
            $data['con_id'] = $_GET['cont_id'];
            $data['reply_id'] = $_GET['reply_id'];
            $data['reply_content'] = $_GET['recontent'];
            $data['from_uid'] = session('home_user')['id'];
            $data['to_uid'] = $_GET['reply_id'];
            $data['created_at'] = time();
            $data['c_id'] = $_GET['id'];
            $id = DB::table('comment_reply')->insertGetId($data); //将回复插入数据库
            if ($id) {
                return json_encode(['code'=>10001,'msg'=>'回复成功','time'=>date('m-d H:i'),'id'=>$id]);
            } else {
                return json_encode(['code'=>10002,'msg'=>'评论失败']);
            }

        } else {
            //未登录处理
            return json_encode(['code'=>10000,'msg'=>'请先登录后在评论']);
        }
    }

    //评论删除处理
    public function del(){
        $id = $_GET['id'];
        $res = DB::table('comment')->where('id','=',$id)->delete();
        if ($res) {
            return json_encode(['code'=>10001,'msg'=>'删除成功']);
        } else {
            return json_encode(['code'=>10002,'msg'=>'删除失败']);
        }
    }

    //回复删除处理
    public function dels(){
        $id = $_GET['id'];
        $res = DB::table('comment_reply')->where('id','=',$id)->delete();
        if ($res) {
            return json_encode(['code'=>10001,'msg'=>'删除成功']);
        } else {
            return json_encode(['code'=>10002,'msg'=>'删除失败']);
        }
    }
}
