<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Illuminate\Support\Facades\Redis;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getRedis( int $dbNum = 1 ) {
        $redis = Redis::connection('default');
        $redis->select($dbNum);
        return $redis;
    }

    public function saveLog($desc)
    {
        $insertData = [
            'uid' => session('admin_info')['uid'],
            'ip' => $_SERVER['REMOTE_ADDR'],
            'desc' => $desc,
            'login_time' => time()
        ];
        $res = DB::table('admin_log')->insert($insertData);
        return $res;
    }

    public function returnJson($msg,$code='000')
    {
        $data = [
            'code'  => $code,
            'msg'   => $msg,
            'time'  => time()
        ];
        return response()->json($data);
    }

}
