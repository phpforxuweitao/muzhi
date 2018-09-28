<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Requests\Notice\Notice;

class NoticeController extends Controller
{
    //公告列表页
    public function index(Request $req) {
    	$tot = DB::table('notice')->count(); //获取总条数	
    	$num = 5; //每页显示条数
    	$count = ceil($tot/$num); //获取总页数
    	$page = $req->input('page'); //获取附加参数值
    	if(empty($page)){
    		$page = 1;
    	}
    	$offset = ($page-1) * $num; //偏移量
    	$sql = "select * from la_notice limit $offset,$num"; 
    	$data = DB::select($sql);
    	if($req->ajax()){ //判断是否为ajax请求
    		return view('admin.notice.page',['data'=>$data]);
    	}
    	for($i=1;$i<=$count;$i++){
    		$pages[$i] = $i;
    	}
    	// dd($pages);  
    
    	return view('admin.notice.index',[
    		'menu_notice' => 'active',
    		'menu_notice_index' => 'active',
    		'data' => $data,
    		'pages'=>$pages
    		
    	]);
    }

    //公告添加页
    public function add() {
    	return view('admin.notice.add',[
    		'menu_notice' => 'active',
    		'menu_notice_add' => 'active'
    	]);
    }

    //添加处理
    public function doadd(Notice $req) {
    	$data = $req->only('title','content');
    	$data['created_at'] = time();
    	
    	$res = DB::table('notice')->insert($data);
    	if($res){
    		return redirect('/bk_notice')->with('success','添加成功');
    	}else{
    		return redirect('/bk_notice/add')->with('error','添加失败');
    	}
    }

    //删除处理
    public function delete($id) {
    	$res = DB::table('notice')->where('id','=',$id)->delete();
    	if($res){
    		return back()->with('success','删除成功');
    	}else{
    		return back()->with('error','删除失败');
    	}
    }

    //修改页面
    public function edit($id) {
    	$data = DB::table('notice')->where('id','=',$id)->first();
    	return view('admin.notice.edit',[
            'menu_notice' => 'active',
    	    'data'=>$data
        ]);
    }

    //处理修改
    public function doedit(Notice $req) {
    	$data = $req->only('id','title','content');
    	$res = DB::table('notice')->where('id','=',$data['id'])->update($data);
    	if($res){
    		return redirect('/bk_notice')->with('success','修改成功');
    	}else{
    		return redirect('/bk_notice/edit/{$data["id"]}')->with('error','修改失败');
    	}
    }

    //内容页
    public function content($id) {
    	$data = DB::table('notice')->where('id','=',$id)->first();
    	return view('admin.notice.content',['data'=>$data]);
    }

    //分页
    public function page(Request $req) {

    }
}
