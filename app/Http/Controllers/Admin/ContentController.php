<?php
/*  User: tao    Date: 2018/8/29   Time: 9:41  */


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\ContentRijiEdit;
use App\Http\Requests\Content\ContentRijiSave;
use function Couchbase\defaultDecoder;
use DB;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * 进入已通过审核日记列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function riji(Request $req) {
        $keywords = $req->input('keywords');
        //通过审核的日记内容列表
        $data = DB::table('content as a')
            ->join('cates as b','a.cid','=','b.id')
            ->select('a.*','b.name as cname')
            ->where('a.status','0')
            ->where('a.uname','like','%'.$keywords.'%')
            ->orderBy('a.id','desc')
            ->paginate(8);

        return view('admin.content.riji',[
            'menu_content'      => 'active',
            'menu_content_riji' => 'active',
            'data'              => $data,
            'req'               => $req->all()
        ]);
    }

    /**
     * 进入添加日记页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function riji_add() {
        $cates = DB::table('cates')->orderBy('id','asc')->orderByRaw('concat(path,id)')->select('id','name','pid','path')->get();
        return view('admin.content.riji_add',[
            'menu_content'          => 'active',
            'menu_content_riji_add' => 'active',
            'cate_data'             => $cates
        ]);
    }

    /**
     * 保存添加日记数据
     * @param ContentRijiSave $req
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save_riji(ContentRijiSave $req) {
        $data = $req->only(['cid','title','content','week','weather']);
        $data['size'] = mb_strlen(strip_tags($data['content']));
        $data['uname'] = '匿名';
        $data['created_at'] = time();
        $data['updated_at'] = time();
        $data['status']     = '0';
        $data['is_admin']   = '1';
        $data['uid']        = session('admin_info')['uid'];
        if ( DB::table('content')->insert($data) ) {
            return redirect('/bk_content/riji')->with('success','添加日记成功');
        } else {
            return back()->with('error','添加日记失败');
        }
    }

    /**
     * 根据id  显示 日记内容详情
     * @param $id
     */
    public function riji_show($id) {

        $info = DB::table('content as a')
            ->join('cates as b','a.cid','=','b.id')
            ->where('a.id',$id)
            ->first();
        return view('admin.content.riji_show',[
            'menu_content'     => 'active',
            'info'             => $info,
            'backUrl'          => back()->getTargetUrl()
        ]);
    }

    /*
     * 进入日记修改页面
     */
    public function riji_edit($id) {
        $info = DB::table('content')->where('id',$id)->first();
        if ( $info->uid != session('admin_info')['uid'] ) {
            return redirect('/bk_content/riji')->with('error','不允许修改他人发表内容');
        }

        $cates = DB::table('cates')->orderBy('id','asc')->orderByRaw('concat(path,id)')->select('id','name','pid','path')->get();
        foreach ($cates as $k=>$v){
            if ($v->pid != 0) {
                $data[] = $v;
            }
        }
        $info = DB::table('content')->where('id','=',$id)->first();
        return view('admin.content.riji_edit',[
            'menu_content'          => 'active',
            'info'                  => $info,
            'cate_data'             => $cates
        ]);
    }

    //保存日记修改
    public function riji_editsave(ContentRijiEdit $req) {
        $data = $req->except(['_token','con_id']);
        $content_id = $req->input('con_id');
        $data['uname']  = session('admin_info')['adminName'];
        $data['size']   = mb_strlen($data['content']);
        if ( DB::table('content')->where('id',$content_id)->update($data) ) {
            return redirect('/bk_content/riji')->with('success','日记修改成功');
        } else {
            return back()->with('error','日记修改失败');
        }
    }

    /**
     * 删除通过审核的日记
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function riji_del($id) {

        if (DB::table('content')->where('id',$id)->delete()){
            return back()->with('success','删除日记成功!');
        } else {
            return back()->with('error','删除日记失败');
        }
    }

    /**
     * 进入未审核日记列表
     */
    public function riji_vali(Request $req){
        $keywords  = $req->input('keywords');
        //未通过审核的日记内容列表
        $data = DB::table('content as a')
            ->join('cates as b','a.cid','=','b.id')
            ->select('a.*','b.name as cname')
            ->where('a.status','1')
            ->where('a.uname','like','%'.$keywords.'%')
            ->orderBy('a.id')
            ->paginate(8);
        return view('admin.content.riji_vali',[
            'menu_content'          => 'active',
            'menu_content_riji_vali'=> 'active',
            'data'                  => $data,
            'req'                   => $req->all()
        ]);
    }

    /*
     * 日记审核通过
     */
    public function riji_pass($id) {
        if ( DB::table('content')->where('id',$id)->update(['status'=>'0']) ) {
            return redirect('/bk_content/riji/vali')->with('success','日记审核通过成功');
        } else {
            return back()->with('error','日记审核通过失败');
        }
    }

    /**
     * 日记审核不通过
     */
    public function riji_unpass($id) {
        if ( DB::table('content')->where('id',$id)->update(['status'=>'2']) ) {
            return redirect('/bk_content/riji/vali')->with('success','日记审核不通过成功');
        } else {
            return back()->with('error','日记审核不通过失败');
        }
    }

    //进入日记审核不通过列表
    public function unpass_list(Request $req) {
        $keywords = $req->input('keywords');
        //未通过审核的日记内容列表
        $data = DB::table('content as a')
            ->join('cates as b','a.cid','=','b.id')
            ->select('a.*','b.name as cname')
            ->where('a.uname','like','%'.$keywords.'%')
            ->where('a.status','2')
            ->orderBy('a.id')
            ->paginate(8);
        return view('admin.content.riji_unpasslist',[
            'menu_content'          => 'active',
            'menu_content_riji_unpasslist'=> 'active',
            'data'                  => $data,
            'req'                   => $req->all()
        ]);
    }

    //标记内容为推荐
    public function recommand($id) {
        if ( DB::table('content')->where('id','=',$id)->update(['recommand'=>'1']) ) {
            return back()->with('success','标记成功');
        }else {
            return back()->with('success','标记失败');
        }
    }

    //取消内容标记为推荐
    public function unrecommand($id) {
        if ( DB::table('content')->where('id','=',$id)->update(['recommand'=>'0']) ) {
            return back()->with('success','取消标记成功');
        }else {
            return back()->with('success','取消标记失败');
        }
    }

}
