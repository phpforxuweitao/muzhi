<?php
/*  User: tao    Date: 2018/8/23   Time: 22:33  */


namespace App\Http\Controllers\Admin;
use Hash;
use App\Http\Requests\AdminUser\PassUpdate;
use DB;
class IndexController
{

    public function index() {
        $users_count    = DB::table('users')->orderBy('id')->count();//统计注册会员数量
        $cates_count    = DB::table('cates')->where('pid','!=',0)->orderBy('id')->count();//分类总数
        $content_count  = DB::table('content')->orderBy('id')->count();//日记条数
        $links_count    = DB::table('links')->orderBy('id')->count();//友情链接数
        $qiandao_count    = DB::table('qiandao')->where('status','1')->count();//签到数
        $data_count    = DB::table('content')->where('status','1')->count();//投稿数

        return view('admin.index.index',[
            'menu_index'    => 'active',
            'users_count'   => $users_count,
            'cates_count'   => $cates_count,
            'content_count' => $content_count,
            'links_count'   => $links_count,
            'qiandao_count' => $qiandao_count,
            'data_count'    => $data_count
        ]);
    }

    /**
     * 修改用户密码页面
     * @return [type] [description]
     */
    public function edit()
    {
        return view('admin.index.edit');
    }

    public function update(PassUpdate $request)
    {
        $pass = $request->input('pass');
        $data['pass'] = Hash::make($request->input('newpass'));
        $data['update_time'] = time();
        // 获取该用户原密码判断密码是否正确
        $user = DB::table('admin_users')
            ->where('id',session('admin_info')['uid'])
            ->first();
        if (Hash::check($pass,$user->pass)) {
            try {
                DB::table('admin_users')
                    ->where('id',session('admin_info')['uid'])
                    ->update($data);
                return redirect('/bk_index')->with('success','密码修改成功');
            } catch (Exception $e) {
                return back()->with('error','密码修改失败');
            }
        } else {
            return back()->with('error','原密码不正确');
        }
    }
}
