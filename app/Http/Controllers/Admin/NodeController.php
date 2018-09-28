<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 导入校验类
use App\Http\Requests\AdminUser\NodeInsert;
use App\Http\Requests\AdminUser\NodeUpdate;
class NodeController extends Controller
{
    /**
     * 权限列表页方法
     * @return [type] [description]
     */
    public function index(Request $request)
    {
        //获取搜索关键词
        $k = $request->input('keywords');
        //获取列表数据
        $data = DB::table('node')->orderBy('id','desc')->where('name','like','%'.$k.'%')->paginate(20);

        return view('admin.AdminUser.node.index',[
            'menu_admin'    => 'active',
            'menu_node_index'=>'active',
            'data'          =>$data,'request'=>$request->all()
        ]);
    }

    /**
     * 显示权限添加页面
     * @return [type] [description]
     */
    public function create()
    {
        return view('admin.AdminUser.node.add',[
            'menu_admin'        => 'active',
            'menu_node_create' => 'active'
        ]);

    }

     /**
     * 权限添加操作
     * @return [type] [description]
     */
    public function add(NodeInsert $request)
    {
        $data = $request->except(['_token']);
        $data['mname']  = $data['mname'].'Controller';

        $row = DB::table('node')->insert($data);
        // 判断是否加入成功
        if ($row) {
            return redirect('/bk_node')->with('success','权限添加成功');
        }else{
            return redirect('/bk_node/create')->with('error','权限添加失败');
        }
    }

    /**
     * 权限删除的方法
     * @return [type]
     */
    public function del($id)
    {
        $row = DB::table('node')->where('id',$id)->delete();
        // 判断是否删除成功
        if ($row) {
             return redirect('/bk_node')->with('success','删除成功');
        } else {
            return redirect('/bk_node')->with('error','删除失败');
        }
    }

     /**
     * 权限开启方法
     * @return [type]     [description]
     */
    public function open($id)
    {
        $row = DB::table('node')->where('id','=',$id)->update(['status'=> '0']);
        // 判断是否启用成功
        if ($row) {
             return redirect('/bk_node')->with('success','成功启用');
        } else {
            return redirect('/bk_node')->with('error','启用失败');
        }
    }

    /**
     * 权限禁用方法
     * @return [type]     [description]
     */
    public function close($id)
    {
        $row = DB::table('node')->where('id','=',$id)->update(['status'=> '1']);
        // 判断是否启用成功
        if ($row) {
             return redirect('/bk_node')->with('success','成功禁用');
        } else {
            return redirect('/bk_node')->with('error','禁用失败');
        }
    }

     /**
     * 显示权限修改页
     * @return [type]     [description]
     */
    public function edit($id)
    {
        //获取需要修改的数据
        $data = DB::table('node')->where('id','=',$id)->first();
        return view('admin.AdminUser.node.edit',['data'=>$data,'menu_admin'=> 'active']);
    }

    /**
     * 用户修改的方法
     * @return [type]              [description]
     */
    public function update(NodeUpdate $request)
    {
        // 获取修改数据拼修改数据库
        $data = $request->except(['id','_token']);

        $id = $request->input('id');
        $row = DB::table('node')->where('id','=',$id)->update($data);
        // 判断是否修改成功
        if ($row) {
             return redirect("/bk_node")->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }
    }
}
