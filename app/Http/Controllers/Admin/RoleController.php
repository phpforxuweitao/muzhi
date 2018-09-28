<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
// 引入校验类
use App\Http\Requests\AdminUser\RoleInsert;
use App\Http\Requests\AdminUser\RoleUpdate;
class RoleController extends Controller
{
    /**
     * 角色列表页方法
     * @return [type] [description]
     */
    public function index(Request $request)
    {
        //获取搜索关键词
        $k = $request->input('keywords');
        //获取列表数据
        $data = DB::table('role')->where('name','like',"%".$k."%")->paginate(10);

        return view('admin.AdminUser.role.index',[
            'menu_admin'    => 'active',
            'menu_role_index'=>'active',
            'data'          =>$data,'request'=>$request->all()
        ]);
    }

    /**
     * 角色添加页方法
     * @return [type] [description]
     */
    public function create()
    {
        // 获取权限列表
        $data = DB::table('node')->where('status',0)->select('id','name')->get();
        // 返回给视图
        return view("admin.AdminUser.role.add",[
            'node'             => $data,
            'menu_admin'        => 'active',
            'menu_role_create' => 'active'
        ]);
    }

    /**
     * 角色添加操作
     * @return [type] [description]
     */
    public function add(RoleInsert $request)
    {
        // 获取提交的数据
        $data = $request->except(['_token','role']);
        $role = $request->input('role');
        //开启一个事务 角色添加成功后 返回该角色的id 然后与nid 拼接
        DB::beginTransaction();
        try {
            $rid = DB::table('role')->insertGetId($data);
            if (!empty($role)) {
                $datas = [];
                foreach ($role as $k=>$v) {
                    $datas[$k]['nid'] = $v;
                    $datas[$k]['rid'] = $rid;
                }
                DB::table('role_node')->insert($datas);
            }
            DB::commit();
            return redirect('/bk_role')->with('success','添加角色成功');
        } catch (\Exception $e){
            DB::rollBack();
            return back()->with('error','添加角色失败');
        }
    }

     /**
     * 删除角色的方法
     * @return [type]
     */
    public function del($id)
    {
       //开启一个事务
        DB::beginTransaction();
        try {
            // 删除角色表的角色
            DB::table('role')->where('id','=',$id)->delete();
            // 删除角色的权限
            DB::table('role_node')->where('rid',$id)->delete();
            DB::commit();
            return redirect('/bk_role')->with('success','删除成功');
        } catch (\Exception $e){
            DB::rollBack();
            return back()->with('error','删除失败');
        }
    }

     /**
     * 角色解锁方法
     * @return [type]     [description]
     */
    public function open($id)
    {
        $row = DB::table('role')->where('id',$id)->update(['status'=> '0']);
        // 判断是否启用成功
        if ($row) {
             return redirect('/bk_role')->with('success','成功启用');
        } else {
            return redirect('/bk_role')->with('error','启用失败');
        }
    }

    /**
     * 角色禁用方法
     * @return [type]     [description]
     */
    public function close($id)
    {
        $row = DB::table('role')->where('id','=',$id)->update(['status'=> '1']);
        // 判断是否启用成功
        if ($row) {
             return redirect('/bk_role')->with('success','成功锁定');
        } else {
            return redirect("/bk_role")->with('error','锁定失败');
        }
    }

     /**
     * 显示角色修改页
     * @return [type]     [description]
     */
    public function edit($id)
    {
        //获取需要修改的数据
        $data = DB::table('role')->where('id','=',$id)->first();
        return view('admin.AdminUser.role.edit',['data'=>$data,'menu_admin'=> 'active']);
    }

     /**
     * 角色修改的方法
     * @return [type]              [description]
     */
    public function update(RoleUpdate $request)
    {
        // 获取修改数据拼修改数据库
        $data = $request->except(['id','_token']);
        $id = $request->input('id');
        $row = DB::table('role')->where('id','=',$id)->update($data);
        // 判断是否修改成功
        if ($row) {
             return redirect('/bk_role')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }
    }

    /**
     * 分配权限页
     * @return [type]     [description]
     */
    public function node($id)
    {
        // 获取该角色信息
        $role = DB::table('role')->where('id','=',$id)->first();
        // 获取所有权限
        $node = DB::table('node')->where('status',0)->select('id','name')->get();
        // 获取该角色的权限
        $data = DB::table('role_node')->where('rid','=',$id)->select('nid')->get();
        // 判断是否之前分配过权限
        $datas = [];
        if ($data) {
            foreach ($data as $v) {
                $datas[] = $v->nid;
            }
        }
        return view('admin.AdminUser.role.node',[
            'data'=>$datas,
            'node'=>$node,
            'role'=>$role,
            'menu_admin'=>'active'
        ]);

    }

    /**
     * 分配权限操作的方法
     * @return [type]           [description]
     */
    public function donode(Request $request)
    {
         // 获取提交的数据
        $rid = $request->input('rid');
        $role = $request->input('role');
        $row = DB::table('role_node')->where('rid',$rid)->first();
        //开启一个事务  用该角色的id 然后与nid 拼接
        DB::beginTransaction();
        try {
            // 判断之前是否有权限
            if ( $row) {
                DB::table('role_node')->where('rid',$rid)->delete();
            }
            // 判断是否分配了权限
            if (!empty($role)) {
                $datas = [];
                foreach ($role as $k=>$v) {
                    $datas[$k]['nid'] = $v;
                    $datas[$k]['rid'] = $rid;
                }
                DB::table('role_node')->insert($datas);
            }
            // 修改成功则提交事务返回视图
            DB::commit();
            return redirect('/bk_role')->with('success','角色权限分配成功');
        } catch (\Exception $e){
            DB::rollBack();
            return back()->with('error','角色权限分配失败');
        }
    }
}
