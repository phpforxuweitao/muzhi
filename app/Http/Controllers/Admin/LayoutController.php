<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Config;
class LayoutController extends Controller
{
    // 排版的设定列表页
    public function index(Request $request)
    {
         //获取搜索关键词
        $k = $request->input('keywords');

        $data = DB::table('cates')
                ->where('status','0')
                ->where('pid','0')
                ->where('name','like',"%".$k."%")
                ->get();
        return view('admin.layout.index',[
            'menu_layout'    => 'active',
            'menu_layout_index'=>'active',
            'data' => $data]);
    }

    // 排版调整页
    public function edit($id)
    {
        $data = DB::table('cates')->where('id',$id)->first();

        return view('admin.layout.edit',['data' => $data]);
    }

    // 排版调整方法
    public function update(Request $req)
    {
        $data = $req->except(['_token']);
        // 将数据修改入数据
        // dd($data);
        $row = DB::table('cates')
                ->where('id',$data['id'])
                ->update(['position'=>$data['position']]);
        // 判断位置是否调整成功
        if ($row) {
            return redirect('/bk_layout')->with('success','位置调整成功');
        } else {
            return back()->with('error','位置调整失败');
        }
    }

    // 排版详情显示页
    public function show(Request $request,$id)
    {
        //获取搜索关键词
        $k = $request->input('keywords');
        // 获取该位置的顶级位置
        $cid = DB::table('cates')
                    ->select('id','name')
                    ->where('id',$id)
                    ->where('status','!=','1')
                    ->where('status','!=','2')
                    ->first();
        // 获取该位置顶级类的子类信息
        $list = DB::table('cates')
                    ->select('id','name')
                    ->where('pid',$cid->id)
                    ->where('status','!=','1')
                    ->where('status','!=','2')
                    ->orderBy('id')
                    ->get();
        // 将子类的信息存储在数组，找到该子类的所有内容
        $con_id = [];
        foreach($list as $v){
            $con_id[] = $v->id;
        }
        $con = DB::table('content')
                    ->where('title','like',"%".$k."%")
                    ->where('status','0')
                    ->whereIn('cid',$con_id)
                    ->orderBy('id','desc')
                    ->paginate(6);
        // dd($cid);
        return view('admin.layout.show',[
                'menu_layout'    => 'active',
                'menu_layout_index'=>'active',
                'data'=>$con,
                'cates'=>$cid,
                'request'=>$request->all()
            ]);
    }

    // 图片位设定页
    public function img($id)
    {
        $data = DB::table('content')
                ->where('id',$id)
                ->select('title','id')
                ->first();
        return view('admin.layout.img',[
                'menu_layout'    => 'active',
                'menu_layout_index'=>'active',
                'data' => $data
            ]);
    }

    //图片设定提交方法
    public function doimg(Request $request)
    {
        $data = $request->except('_token','id');
        $id = $request->input('id');

        if ($request->hasFile('img')) {
            $name = time()+rand(1,10000);
            //获取上传文件的后缀
            $ext = $request->file('img')->getClientOriginalExtension();
            //存放到指定位置
            $request->file('img')->move(Config::get('app.app_content'),$name.'.'.$ext);
            //获取图片位置
            $data['img']=Config::get('app.app_content')."/".$name.".".$ext;
            $data['img'] = ltrim($data['img'],'.');
        }

        $row = DB::table('content')
                ->where('id',$id)
                ->update($data);
        if ($row) {
            return redirect('/bk_layout')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }
    }
}
