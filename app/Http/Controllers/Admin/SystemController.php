<?php
/*  User: tao    Date: 2018/8/30   Time: 11:14  */


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Cache;

class SystemController extends Controller
{
    //进入前台维护界面
    public function maintain_home() {
        return view('admin.system.maintain_home',[
            'menu_system'               => 'active',
            'menu_system_maintain_home' => 'active'
        ]);
    }

    //维护开启或关闭
    public function homemaintainDownUp(Request $req) {
        $data = $req->except('_token');
        //如果type为false 也就是前台进入维护状态
        if ( $data['type'] == 'true' ) {
            Cache::forever('homemaintain','open');
            $datas = [
                'code'  => '000',
                'msg'   => '前台访问已开启',
                'time'  => time()
            ];
            return response()->json($datas);
        } else {
            if ( empty($data['time']) ) {
                Cache::forever('homemaintain','close');
            } else {
                Cache::put('homemaintain','close',Carbon::now()->addHour($data['time']));
            }

            $datas = [
                'code'  => '111',
                'msg'   => '前台访问已关闭',
                'time'  => time()
            ];
            return response()->json($datas);
        }

    }

}