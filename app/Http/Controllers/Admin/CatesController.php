<?php
/*  User: tao    Date: 2018/8/26   Time: 15:02  */


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cates;
use DB;
use Illuminate\Http\Request;

class CatesController extends Controller
{
    /**
     * 分类首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        $cates = DB::table('cates')->orderByRaw('concat(path,id)')->select('id','name','pid','path','status','created_at','updated_at')->paginate(10);
        return view('admin.cates.index',[
            'menu_cates'   => 'active',
            'menu_cates_index'=>'active',
            'cates'         =>$cates
        ]);
    }

    /**
     * 进入分类添加页面
     * @param string $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add($id='') {
        $cates = DB::table('cates')->orderByRaw('concat(path,id)')->select('id','name','pid','path','created_at')->get();
        return view('admin.cates.add',[
            'menu_cates'    => 'active',
            'menu_cates_add'=> 'active',
            'cates'         =>$cates,
            'cate_id'       => $id
        ]);
    }

    /**
     * @param Cates $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doadd(Cates $req) {
        $data = $req->only(['name','pid']);
        $data['created_at'] = time();
        $data['updated_at'] = time();
        if ( $data['pid'] == '0') {
            $data['path'] = '0,';
        } else {
            $res = DB::table('cates')->where('id','=',$data['pid'])->first();
            $data['path'] = $res->path.$data['pid'].',';
        }
        //执行数据库插入
        if ( DB::table('cates')->insert($data) ) {
            $this->clearRedisCache();//调用清除缓存类
            return  back()->with('success','添加分类成功');
        } else {
            return  back()->with('error','添加分类失败');
        }
    }

    /**
     * 根据分类id进入修改页面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $info = DB::table('cates')->where('id',$id)->select('id','name')->first();
        return view('admin.cates.edit',[
            'menu_cates'   => 'active',
            'info'=> $info
        ]);
    }

    public function doedit(Request $req){
        $data = $req->except('_token');
        //检测修改的名字是否已经存在
        $check = DB::table('cates')->where('name',$data['name'])->exists();
        if ($check) {
            return back()->with('error','该类名已存在');
        }
        //执行修改操作
        if ( DB::table('cates')->where('id',$data['cates_id'])->update(['name'=>$data['name']]) ) {
            $this->clearRedisCache();//调用清除缓存类
            return redirect('/bk_cates')->with('success','修改分类名称成功!');
        } else {
            return redirect("/bk_cates/edit-{$data['cates_id']}")->with('error','修改分类名称失败!');
        }
    }

    /**
     * 根据id 删除不带有子类的分类
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($id) {
        $check = DB::table('cates')->where('pid','=',$id)->count();
        if ( $check > 0 ) {
            return back()->with('error','不能删除带有子类的分类节点');
        }
        //直接删除当前没有子类的分类
        if ( DB::table('cates')->where('id','=',$id)->delete() ) {
            $this->clearRedisCache();//调用清除缓存类
            return back()->with('success','删除成功');
        } else {
            return back()->with('error','删除失败');
        }
    }

    /**
     * 标记分类为热门分类
     * @param $id
     */
    public function signHot($id) {
        if ( DB::table('cates')->where('id','=',$id)->update(['status'=>'3']) ) {
            return back()->with('success',"标记成功");
        } else {
            return back()->with('error',"标记失败");
        }
    }

    /**
     * 取消标记为热门分类
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelHot($id) {
        if ( DB::table('cates')->where('id','=',$id)->update(['status'=>'0']) ) {
            return back()->with('success',"标记成功");
        } else {
            return back()->with('error',"标记失败");
        }
    }

    /**
     * 执行分类的增删改时  调用清除 首页和列表页等关于分类导航数据的缓存
     */
    private function clearRedisCache() {
        $redis = $this->getRedis(1);
        $redis->del(['key_nav_cates_lists','key_nav_cates_index','key_nav_cate_show']);
    }

}