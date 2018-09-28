<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
// 引入校验类
use App\Http\Requests\AdminUser\AdminInsert;
use App\Http\Requests\AdminUser\AdminUpdate;
use PHPExcel;

class AdminUserController extends Controller
{
    /**
     * 显示管理员列表页
     * @return [type] [description]
     */
     public function index(Request $request)
    {
        //获取搜索关键词
        $k = $request->input('keywords');
        //获取列表数据
        $data = DB::table('admin_users')->where('name','like',"%".$k."%")->paginate(5);
        return view('admin.AdminUser.user.index',[
            'menu_admin'    => 'active',
            'menu_adminuser_index'=>'active',
            'data'          =>$data,'request'=>$request->all()
        ]);
    }

    /**
     * 显示管理员添加页面
     * @return [type] [description]
     */
    public function create()
    {
        // 获取角色信息
        $data = DB::table('role')->where('status',0)->select('id','name')->get();
        // 返回给视图
        return view('admin.AdminUser.user.add',[
            'menu_admin'        => 'active',
            'menu_adminuser_create' => 'active',
            'role'             =>  $data
        ]);
    }

    /**
     * 管理员添加操作
     * @return [type] [description]
     */
    public function add(AdminInsert $request)
    {
        // 获取提交的数据
        $data = $request->except(['_token','role']);
        $role = $request->input('role');
        // 数据处理
        $data['pass'] = Hash::make($data['pass']);
        $data['created_at'] = time();
        //开启一个事务 角色添加成功后 返回该角色的id 然后与rid 拼接
        DB::beginTransaction();
        try {
            $id = DB::table('admin_users')->insertGetId($data);
            if ( !empty($role) ) {
                $datas = [];
                foreach ($role as $k=>$v) {
                    $datas[$k]['rid'] = $v;
                    $datas[$k]['uid'] = $id;
                }
                DB::table('user_role')->insert($datas);
            }
            // 添加成功提交事务
            DB::commit();
            return redirect('/bk_adminuser')->with('success','添加管理员成功');
        } catch (\Exception $e){
            // 失败回滚事务
            DB::rollBack();
            return back()->with('error','添加管理员失败');
        }
    }

    /**
     * 删除管理员的方法
     * @return [type]
     */
    public function del($id)
    {
       //开启一个事务
        DB::beginTransaction();
        try {
            // 删除管理员表数据
            DB::table('admin_users')->where('id','=',$id)->delete();
            // 删除管理员表分配角色
            DB::table('user_role')->where('uid',$id)->delete();
            DB::commit();
            return redirect('/bk_adminuser')->with('success','删除成功');
        } catch (\Exception $e){
            DB::rollBack();
            return back()->with('error','删除失败');
        }
    }

    /**
     * 管理员解锁方法
     * @return [type]     [description]
     */
    public function open($id)
    {
        $row = DB::table('admin_users')->where('id',$id)->update(['status'=> '0']);
        // 判断是否启用成功
        if ($row) {
             return back()->with('success','成功启用');
        } else {
            return back()->with('error','启用失败');
        }
    }

    /**
     * 管理员禁用方法
     * @return [type]     [description]
     */
    public function close($id)
    {
        $row = DB::table('admin_users')->where('id','=',$id)->update(['status'=> '1']);
        // 判断是否启用成功
        if ($row) {
             return back()->with('success','成功锁定');
        } else {
            return back()->with('error','锁定失败');
        }
    }

     /**
     * 显示管理员修改页
     * @return [type]     [description]
     */
    public function edit($id)
    {
        //获取需要修改的数据
        $data = DB::table('admin_users')->where('id','=',$id)->first();
        return view('admin.AdminUser.user.edit',['data'=>$data,'menu_admin'=> 'active']);
    }

    /**
     * 管理员修改的方法
     * @return [type]              [description]
     */
    public function update(AdminUpdate $request)
    {
        // 获取修改数据拼
        $data = $request->except(['id','_token']);
        $id = $request->input('id');
        $data['pass'] = Hash::make($data['pass']);
        $row = DB::table('admin_users')->where('id','=',$id)->update($data);
        // 判断是否修改成功
        if ($row) {
             return redirect('/bk_adminuser')->with('success','修改成功');
        } else {
            return back()->with('error','修改失败');
        }
    }

    /**
     * 管理员分配页
     * @return [type]     [description]
     */
    public function role($id)
    {
        // 获取该管理员
        $user = DB::table('admin_users')->where('id','=',$id)->first();
        // 获取所有角色
        $role = DB::table('role')->where('status',0)->select('id','name')->get();
        // 获取该管理员已有的权限
        $data = DB::table('user_role')->where('uid','=',$id)->select('rid')->get();
        // 判断是否之前分配过权限
        if ($data) {
            // 将该管理员已有权限组合成数组
            $datas = [];
            foreach ($data as $v) {
                $datas[] = $v->rid;
            }
            // 返回给视图
            return view('admin.AdminUser.user.role',['data'=>$datas,'user'=>$user,'role'=>$role,'menu_admin'=>'active']);
        } else {
            return view('admin.AdminUser.user.role',['data'=>array(),'node'=>$node,'role'=>$role,'menu_admin'=>'active']);
        }
    }

    /**
     *管理员角色分配操作的方法
     * @return [type]           [description]
     */
    public function dorole(Request $request)
    {
         // 获取提交的数据
        $uid = $request->input('uid');
        $role = $request->input('role');
        $row = DB::table('user_role')->where('uid',$uid)->first();
        //开启一个事务  用该角色的id 然后与rid 拼接
        DB::beginTransaction();
        try {
            // 判断之前是否有角色
            if ( $row) {
                DB::table('user_role')->where('uid',$uid)->delete();
            }
            // 判断是否分配了角色
            if (!empty($role)) {
                $datas = [];
                foreach ($role as $k=>$v) {
                    $datas[$k]['rid'] = $v;
                    $datas[$k]['uid'] = $uid;
                }
                DB::table('user_role')->insert($datas);
            }
            // 修改成功则提交事务返回视图
            DB::commit();
            return redirect('/bk_adminuser')->with('success','管理员角色分配成功');
        } catch (\Exception $e){
            DB::rollBack();
            return back()->with('error','管理员角色分配失败');
        }
    }

    /**
     * 登录日志显示页
     * @return [type] [description]
     */
    public function log(Request $request)
    {
        //获取搜索关键词
        $k = $request->input('keywords');
        // 获取登录后台的数据
        $data = DB::table('admin_log as log')
            ->join('admin_users as u','log.uid','=','u.id')
            ->where('u.name','like',"%".$k."%")
            ->where('log.status',0)
            ->orderBy('log.id','desc')
            ->select('log.*','u.name')
            ->paginate(20);
        // 将数据返回视图
        return view('admin.AdminUser.user.log',[
            'menu_admin'        => 'active',
            'menu_adminuser_log'=>'active',
            'data'              =>$data,
            'request'           =>$request->all()
        ]);
    }

    /**
     * 删除日志的方法
     * @return [type]
     */
    public function logdel($id)
    {
        $row = DB::table('admin_log')->where('id','=',$id)->update(['status'=> '2']);
        // 判断是否删除成功
        if ($row) {
             return back()->with('success','删除成功');
        } else {
            return back()->with('error','删除失败');
        }
    }

    //将登陆日记以excel格式导出
    public function getLogFile() {
        //excel表中数据
        $data = DB::table('admin_users as au')
            ->join('admin_log as al','au.id','=','al.uid')
            ->select('al.id','au.name','al.ip','al.login_time','al.desc')
            ->get();
        //excel中表字段名称(需要与select查询时的字段位置一致)
        $cellName = ['编号','用户名','登录IP','登录时间','描述'];

        //记录执行当前操作用户的信息
        $this->saveLog('导出登录日志文件');

        $this->exportLog('后台登录日志记录表','登录日志',$cellName,$data,2,3);
    }

    /**
     * @param $title string 表标题
     * @param $name  string 文件名称
     * @param $fieldName array 字段名称
     * @param $top  integer 字段标题显示行数    数据显示函数 +1
     * @param @left integer 数据距离左侧多少个单元 默认6个单元
     * @param $data object 表数据
     */
    protected function exportLog($title,$name,$fieldName,$data,$top=2,$left=6) {
        $phpexcel   = new PHPExcel();//实例化phpexcel类
        $objWriter  = new \PHPExcel_Writer_Excel2007($phpexcel);//定义excel版本 2007版 文件后缀名为 .xlsx
        //定义配置
        $name       = iconv('UTF-8','GB2312',$name);
        $filename   = $name.date('_YmdHis');//保存文件名
        $cellKey    = $this->getCellKey();
        $topNumber  = $top;//表标题为第一行 字段标题为第二行 数据为第三行及之后
        $leftNumber = $left;//距离左侧多少个空格

        $phpexcel->setActiveSheetIndex(0);//设置当前活动sheet
        $objSheet   = $phpexcel->getActiveSheet();//获取当前活动sheet
        $objSheet->setTitle($title);//设置当前sheet标题
        $objSheet->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//设置全部单元格内容为水平居中
        $objSheet->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);//设置全部单元格内容垂直居中
        $objSheet->getDefaultStyle()->getFont()->setName('微软雅黑')->setSize('14');

        //处理表头标题
        $objSheet->mergeCells($cellKey[$leftNumber].($topNumber-1).':'.$cellKey[count($fieldName)+$leftNumber-1].($topNumber-1));//合并单元格,如果是拆分单元格需要先合并再拆分，否则会报错
        $objSheet->setCellValue($cellKey[$leftNumber].($topNumber-1),$title);
        $tableTitleStyle = [
            'font'  => [
                'bold'      => true,
                'size'      => 20,
                'color'     => ['rgb'=>'cc4125']
            ],
            'borders'   => [
                'outline'   => [
                    'style'     => \PHPExcel_Style_Border::BORDER_THICK,
                    'color'     => ['rgb'=>'85e2ca']
                ]
            ]
        ];
        $objSheet->getStyle( $cellKey[$leftNumber].($topNumber-1).':'.$cellKey[count($fieldName)+$leftNumber-1].($topNumber-1) )->applyFromArray($tableTitleStyle);

        //处理表字段标题 从第二行开始
        foreach ( $fieldName as $k=>$v ) {
            if ( $k == 2|| $k == 3 ) {
                $objSheet->getColumnDimension($cellKey[$leftNumber+$k])->setWidth(mb_strlen($v)*5);
            } else if ( $k == 4 ){
                $objSheet->getColumnDimension($cellKey[$leftNumber+$k])->setWidth(mb_strlen($v)*10);
            }
            $objSheet->setCellValue($cellKey[$leftNumber+$k].$topNumber,$v);//设置字段标题
            $objSheet->getStyle($cellKey[$leftNumber+$k].$topNumber,$v)->getFont()->getColor()->setRGB('6aa84f');
        }

        //处理数据
        foreach ($data as $k=>$v) {
            $index = 0;
            foreach ($v as $k2=>$v2) {
                $objSheet->setCellValue($cellKey[$leftNumber+$index].($k+$topNumber+1),$v2);
                $index++;
            }
        }

        //浏览器输出 第一个参数如果为 excel2007则文件后缀为 .xlsx  如果为excel5 则文件后缀名为.xls
        $this->browser_export($filename);
        $objWriter->save('php://output');
        exit;
    }

    /**
     * 根据下标获取单元格所在列位置
     * @param $index
     * @return mixed
     */
    protected function getCellKey() {
        $cellKey    = [
            'A','B','C','D','E','F','G','H','I','J','K','L','M',
            'N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
            'AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM',
            'AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ'
        ];
        return $cellKey;
    }

    protected function browser_export($filename,$type='excel2007') {
        ob_end_clean();
        if ( $type == 'excel5' ) {//如果是excel03 也就是文件后缀名为 .xls
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename='.$filename.'.xls');
        } else if ( $type == 'excel2007' ) {//excel2007 文件后缀名为.xlsx
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename='.$filename.'.xlsx');
        }
        header('Cache-Control: max-age=0');//禁止浏览器缓存

    }

}
