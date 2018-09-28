<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Links\Links;
use App\Http\Requests\Links\LinksEdit;
use DB;

class LinksController extends Controller
{
	//友情链接列表页
    public function index(Request $req) {
        $k = $req->input('keywords');
    	$links = DB::table('links')
            ->where('name','like','%'.$k.'%')
            ->where('status','!=','2')
            ->paginate(5);
    	return view('admin.links.index',[
    		'menu_links' => 'active',
    		'menu_links_index' => 'active',
    		'links' => $links,
            'request' => $req->all()
    		]);
    }

    //友情链接审核列表
    public function checkList(Request $req) {
        $check = DB::table('links')
            ->where('status','=','2')
            ->get();
        return view('admin.links.check',[
                'menu_links' => 'active',
                'menu_links_checkList' => 'active',
                'check'=> $check
            ]);
    }

    //友情链接添加页
    public function add() {
    	return view('admin.links.add',[
    		'menu_links' => 'active',
    		'menu_links_add' => 'active',
    		]);
    }

    //友情链接添加处理
    public function doadd(Links $req) {
    	$data = $req->only('name','url','status');
    	$data['created_at'] = time();
    	$data['updated_at'] = time();

    	if(DB::table('links')->insert($data)){
    		return redirect('/bk_links')->with('success','添加成功');
    	}else{
    		return redirect('/bk_links/add')->with('error','添加失败');
    	}
    }

    
    // //友情链接删除处理
    // public function delete($id) {
    // 	$del = DB::table('links')->where('id','=',$id)->delete();
    // 	if($del){
    // 		return back()->with('success','删除成功');
    // 	}else{
    // 		return back()->with('error','删除失败');
    // 	}
    // }

    //友情链接修改页面
    public function edit($id) {
    	$edit = DB::table('links')->where('id','=',$id)->first();
    	return view('admin.links.edit',['edit'=>$edit]);
    }

    //修改处理
    public function doedit(LinksEdit $req) {
    	$data = $req->only('id','name','url');
    	$data['updated_at'] = time();
    	// dd($data);
    	$res = DB::table('links')->where('id','=',$data['id'])->update($data);
    	if($res){
    		return redirect('/bk_links')->with('success','修改成功');
    	}else{
    		return redirect('/bk_links/edit/$data["id"]')->with('error','修改失败');
    	}
    }

    //启用和禁用轮播图
    public function change($id) {
        $arr = DB::table('links')->where('id','=',$id)->get();
        //判断数据库状态值是否为0
        if($arr[0]->status == 0){
            $res = DB::table('links')->where('id','=',$id)->update(['status'=>'1']);
            return redirect('/bk_links')->with('success','修改成功');
        }else if($arr[0]->status == 1){
            $res = DB::table('links')->where('id','=',$id)->update(['status'=>'0']);
            return redirect('/bk_links')->with('success','修改成功');
        }else if($arr[0]->status == 2){
            $res = DB::table('links')->where('id','=',$id)->update(['status'=>'0']);
            return redirect('/bk_links/checkList')->with('success','审核通过');
        } 
    }

    //ajax删除处理
    public function del(Request $req){
        $id = $req->input('id');
        $res = DB::table('links')->where('id','=',$id)->delete();
        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }

}
