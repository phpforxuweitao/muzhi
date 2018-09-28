<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
//导入Hash类
use Hash;
//导入校验类
use App\Http\Requests\user\UserInsert;
use App\Http\Requests\user\UserUpdate;
class UsersController extends Controller
{
    /**
     * 显示会员列表页
     * @return [type] [description]
     */
    public function index(Request $request){
        //获取搜索关键词
        $k = $request->input('keywords');
        //获取列表数据
        $user = DB::table('users')->where('name','like','%'.$k.'%')->where('status','!=','2')->paginate(5);
        // dd($user);
        return view('admin.users.index',[
            'menu_users'    => 'active',
            'menu_users_index'=>'active',
            'user'          =>$user,'request'=>$request->all()
        ]);
    }

    /**
     * 显示会员添加页面
     * @return [type] [description]
     */
    public function create()
    {
        return view('admin.users.add',[
            'menu_users'        => 'active',
            'menu_users_create' => 'active'
        ]);

    }

    /**
     * 显示会员添加操作
     * @return [type] [description]
     */
    public function add(UserInsert $request)
    {
        $data = $request->except(['repass','_token']);
        //对密码做加密
        $data['pass'] = Hash::make($data['pass']);
        // 开启一个事务
        DB::beginTransaction();
        try {
            // 插入用户表获取新建用户ID
            $row = DB::table('users')->insertGetId($data);
            // 插入用户详情表
            DB::table('users_detail')->insert(['uid'=>$row,'created_at'=>time()]);
            DB::commit();
            return redirect('/bk_users')->with('success','数据添加成功');
        } catch (\Exception $e){
            DB::rollBack();
           return redirect('/bk_users/create')->with('error','数据添加失败');
        }
    }

    /**
     * 删除会员的方法
     * @return [type]
     */
    public function del($id)
    {
        $row = DB::table('users')->where('id','=',$id)->update(['status'=> '2']);
        // 判断是否删除成功
        if ($row) {
             return redirect('/bk_users')->with('success','删除成功');
        } else {
            return redirect('/bk_users')->with('error','删除失败');
        }
    }

    /**
     * 会员开启方法
     * @return [type]     [description]
     */
    public function open($id)
    {
        $row = DB::table('users')->where('id','=',$id)->update(['status'=> '0']);
        // 判断是否启用成功
        if ($row) {
             return redirect('/bk_users')->with('success','成功启用');
        } else {
            return redirect('/bk_users')->with('error','启用失败');
        }
    }

    /**
     * 会员禁用方法
     * @return [type]     [description]
     */
    public function close($id)
    {
        $row = DB::table('users')->where('id','=',$id)->update(['status'=> '1']);
        // 判断是否启用成功
        if ($row) {
             return redirect('/bk_users')->with('success','成功禁用');
        } else {
            return redirect("/bk_users")->with('error','禁用失败');
        }
    }

    /**
     * 显示用户修改页
     * @return [type]     [description]
     */
    public function edit($id)
    {
        //获取需要修改的数据
        $user = DB::table('users')->where('id','=',$id)->first();
        return view('admin.users.edit',[
                'user'          =>  $user,
                'menu_users'    =>  'active'
                ]);
    }

    /**
     * 用户修改的方法
     * @return [type]              [description]
     */
    public function update(UserUpdate $request)
    {
        // 获取修改数据拼修改数据库
        $data = $request->except(['id','_token']);
        $id = $request->input('id');
        $row = DB::table('users')->where('id','=',$id)->update($data);
        // 判断是否修改成功
        if ($row) {
             return redirect('/bk_users')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }
    }

    /**
     * 用户详情
     * @return [type]     [description]
     */
    public function show($id){
        //获取用户数据
        $data = DB::table('users as u')
            ->join('users_detail as ud','u.id','=','ud.uid')
            ->where('u.id',$id)
            ->first();
        // dd($data);
        return view('admin.users.show',['user'=>$data,'menu_users'=>'active']);
    }


}
