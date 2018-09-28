<?php
/*  User: tao    Date: 2018/9/2   Time: 15:01  */


namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use \Exception;
use Cookie;
use JuheApi;
use Illuminate\Support\Facades\Cache;

class ListController extends Controller
{
    /**
     * 列表页面, 根据$id(分类id) 将这个分类的所有数据 列出来
     * @param $id
     */
    public function index($id) {
        $redis = $this->getRedis(1);
        $key = 'key_nav_cates_lists';
        if ( $redis->exists( $key ) ) {
            $cate = $redis->get( $key );
        } else {
            //导航栏分类列表
            $cate = json_encode($this->getCatesBypid(0));
            $redis->set( $key , $cate );
        }
        //根据$id获取该分类的列表数据和类名称和类id
        $cate_info = DB::table('cates')->where('id',$id)->select(['id','name','pid'])->first();
        //获取阅读排行中前10条
        $readTop10 = DB::table('content')->select('id','title','num')->orderBy('num','desc')->limit(10)->get();
        //获取年级分类
        $classCates = DB::table('cates')->select('id','pid','name')->whereIn('pid',['29','36','40'])->where('status','!=','1')->orderBy('id','asc')->get();

        if ( $cate_info->pid != 0 ) {   //进入子级分对应的内容列表页面
            $list = DB::table('cates as c')
                ->join('content as con','c.id','=','con.cid')
                ->where('c.id',$id)
                ->paginate(10);

            //列表页广告
            $ads_data = DB::table('advertising')->select('pic','name','url')->get();

            return view('home.index.list',[
                'cates'     => json_decode( $cate ),
                'list'      => $list,
                'cate_info' => $cate_info,
                'readTop10' => $readTop10,
                'ads_data'  => $ads_data
            ]);
        } else {    //进入顶级分类对应的子类列表
            //根据顶级类的id获取子类列表(一级分类) 和  子类的列表(内容)
            $res_cids = DB::table('cates')->where('pid',$cate_info->id)->orderBy('id')->select('id','name')->get();
            foreach ($res_cids as $k=>$v) {
                $v->child = DB::table('content')->orderBy('id','desc')->where('cid',$v->id)->select(['id','title'])->get();
                $lists[] = $v;
            }

            //列表页广告
            $ads_data = DB::table('advertising')->select('pic','name','url')->get();
            

            return view('home.index.list_p',[
                'cates'     => json_decode( $cate ),
                'cate_info' => $cate_info,
                'lists'     => $lists,
                'readTop10' => $readTop10,
                'classCates'=> $classCates,
                'ads_data'      => $ads_data
            ]);
        }

    }


    /**
     * 详情页面
     * @param $id  int 内容id
     * @return string
     */
    public function show($id) {
        $redis = $this->getRedis(1);//实例化redis并选中1号库
        //$id对应的内容点击数量+1
        DB::table('content')->where('id',$id)->increment('num');
        //获取上一篇
        $lastPage = DB::table('content')->orderBy('id','desc')->where('id','<',$id)->limit(1)->first();
        //获取下一篇
        $nextPage = DB::table('content')->orderBy('id','asc')->where('id','>',$id)->limit(1)->first();
        $key_show = 'key_nav_cate_show';
        if ( $redis->exists( $key_show ) ) {
            $cate = $redis->get( $key_show );
        } else {
            //导航栏分类列表
            $cate = DB::table('cates')->select('id','name')->where('pid','=',0)->orderBy('id','asc')->get();
            $cate = json_encode( $cate );
            $redis->set( $key_show , $cate );
        }
        //将每一条详情内容缓存到redis中(有效时间为一周)
        $key_show_detail = 'key_show_detail_'.$id;
        if ( $redis->exists( $key_show_detail ) ) {
            $info = $redis->get( $key_show_detail );
        } else {
            //根据内容参数$id 获取内容数据 以及根据内容数据中的cid 获取 内容页面子导航链接
            $info = DB::table('content')
                ->where('id','=',$id)
                ->first();
            $info = json_encode($info);
            $redis->setex( $key_show_detail , 604800 , $info );
        }
        $info = json_decode($info);

        //获取本条内容用户所被关注的用户(array)
        $gz_fromuid = DB::table('guanzhu')->select('from_uid')->where('to_uid','=',$info->uid)->get()->toArray();
        if ( !empty($gz_fromuid) ) {
            foreach ($gz_fromuid as $k=>$v) {
                $gz_from_ids[] = $v->from_uid;
            }
        } else {
            $gz_from_ids = [];
        }

        $child_cate = DB::table('cates')->select('id','name','pid')->where('id','=',$info->cid)->first();
        $parent_cate = DB::table('cates')->select('id','name')->where('id','=',$child_cate->pid)->first();
        if ( DB::table('content')->select('is_admin')->where('is_admin','=','0')->where('id',$id)->first() ) {
            $contents = DB::table('content as c')
                ->join('users as u','c.uid','=','u.id')
                ->join('users_detail as ud','c.uid','=','ud.uid')
                ->select('c.*','ud.uface')
                ->where('c.id',$id)
                ->first();
        } else {//管理员用户发表内容
            $contents = DB::table('content')
                ->where('id',$id)
                ->first();
        }
        //获取相关日记
        $relateds = DB::table('content')->select('id','title')->where('cid','=',$info->cid)->limit(8)->get();
        //获取阅读排行中前10条
        $readTop10 = DB::table('content')->select('id','title','num')->orderBy('num','desc')->limit(10)->get();
        //获取年级分类
        $classCates = DB::table('cates')->select('id','pid','name')->whereIn('pid',['29','36','40'])->where('status','!=','1')->orderBy('id','asc')->get();
        // 获取评论数据
        $comment = DB::table('comment as c')
                    ->join('users_detail as u','c.from_uid','=','u.uid')
                    ->where('c.con_id',$id)
                    ->select('c.id','c.from_uid','c.content','c.created_at','u.nickname','u.uface','u.uid')
                    ->orderBy('created_at','asc')
                    ->get();
                    // dd($comment);
        //获取回复内容
        $recomment = DB::table('comment_reply as cr')
                    ->join('users_detail as ud','cr.from_uid','=','ud.uid')
                    ->where('cr.con_id',$id)
                    ->select('cr.id','cr.reply_id','cr.reply_content','cr.created_at','cr.from_uid','cr.c_id','ud.nickname','ud.uface','ud.uid')
                    ->orderBy('created_at','asc')
                    ->get();
            // dd($recomment);
        //列表页广告
        $data = DB::table('advertising')->select('pic','name','url')->get();

        return view('home.index.show',[
            'cates'         => json_decode($cate),
            'parent_cate'   => $parent_cate,
            'childrent_cate'=> $child_cate,
            'contents'      => $contents,
            'lastPage'      => $lastPage,
            'nextPage'      => $nextPage,
            'relateds'      => $relateds,
            'readTop10'     => $readTop10,
            'classCates'    => $classCates,
            'comment'       => $comment,
            'recomment'     => $recomment,
            'gz_from_ids'   => $gz_from_ids,
            'data'          => $data
        ]);
    }

    //点赞/点踩
    public function digg(Request $req) {
        if ( empty( session('home_user') ) ) {
            return response()->json([
                'code'      => '222',
                'msg'       => '请登录后再点击',
                'time'      => time()
            ]);
        }

        if ( $req->ajax() ) {
            $type   = $req->input('digg');
            $uid    = $req->input('uid');
            $id     = $req->input('id');//日记内容id
            $info   = DB::table('content')->where('id',$id)->first();
            //记录点赞时的用户id和日记内容id 防止重复点赞（先验证用户记录是否已存在 feeling表中）
            $check = DB::table('feeling')->where([
                'uid'   => $uid,
                'cid'   => $id
            ])->exists();
            if ( $check ) {
                return response()->json([
                    'code'      => '111',
                    'msg'       => '已评价过,不能重复评价',
                    'time'      => time()
                ]);
            }
            //如果$type 为good 则表示 点赞  为bad则为点踩
            if ( $type == 'good' ) {

                DB::beginTransaction();
                try {
                    if ( $info->is_admin == '0' ) {//会员用户
                        //被点赞 随机增加积分
                        $score = mt_rand(1,10);
                        DB::table('users')->where('id',$info->uid)->increment('score',$score);
                    }
                    DB::table('content')->where('id',$id)->increment('laud',1);//赞数+1
                    //点赞记录保存
                    DB::table('feeling')->insert([
                        'uid'   => $uid,
                        'cid'   => $id,
                        'status'=> '0'
                    ]);
                    DB::commit();
                    return response()->json([
                        'code'      => '000',
                        'msg'       => '成功点赞',
                        'type'      => 'good',
                        'time'      => time()
                    ]);
                } catch (Exception $e) {
                    DB::rollBack();
                    return response()->json([
                        'code'      => '111',
                        'msg'       => '点赞操作失败',
                        'time'      => time()
                    ]);
                }

            } else if( $type == 'bad' ) {   //点踩

                DB::beginTransaction();
                try {
                    DB::table('content')->where('id',$id)->increment('belittle',1);//踩数+1
                    //点踩记录保存
                    DB::table('feeling')->insert([
                        'uid'   => $uid,
                        'cid'   => $id,
                        'status'=> '1'
                    ]);
                    DB::commit();
                    return response()->json([
                        'code'      => '000',
                        'msg'       => '成功点踩',
                        'type'      => 'bad',
                        'time'      => time()
                    ]);
                } catch (Exception $e) {
                    DB::rollBack();
                    return response()->json([
                        'code'      => '111',
                        'msg'       => '点踩操作失败',
                        'time'      => time()
                    ]);
                }
            }
        } else {
            return response()->json([
                'code'      => '111',
                'msg'       => '请求方式非法',
                'time'      => time()
            ]);
        }
    }

    //获取聚合提供的笑话大全api数据
    public function jokeList() {
        $cate = $this->getCatesBypid(0);
        //获取阅读排行中前10条
        $readTop10 = DB::table('content')->select('id','title','num')->orderBy('num','desc')->limit(10)->get();

        return view('home.index.joke',[
            'cates'     => $cate,
            'readTop10'     => $readTop10,
        ]);
    }

     //获取聚合提供的星座运势api数据
    public function xingzuo($name) {
        $cate = $this->getCatesBypid(0);
        //获取阅读排行中前10条
        $readTop10 = DB::table('content')->select('id','title','num')->orderBy('num','desc')->limit(10)->get();
        // 获取星座列表
        $xingzuo = DB::table('xingzuo')->select('name','url','mon')->get();
        // dd($xingzuo);
        $redis = Redis::connection('default');
        $redis->select(2);
        $data = [];
        // 查看今日运势的信息有没在缓存 没则调用接口
        if ( $redis->exists($name.'today') ) {
            $data[] = json_decode( $redis->get($name.'today'),true);
        } else {
            $data[] = $this->getXingzuo($name,'today');
        }
        // 查看明日运势的信息有没在缓存 没则调用接口
        if ( $redis->exists($name.'tomorrow') ) {
            $data[] = json_decode( $redis->get($name.'tomorrow'),true);
        } else {
            $data[] = $this->getXingzuo($name,'tomorrow');
        }
        // 获取下周运势是否有在Redis ,没则调用接口
        if ( $redis->exists($name.'week') ) {
            $data[] = json_decode( $redis->get($name.'week'),true);
        } else {
            $data[] = $this->getXingzuo($name,'week');
        }
         // 获取下周运势是否有在Redis ,没则调用接口
        if ( $redis->exists($name.'nextweek') ) {
            $data[] = json_decode( $redis->get($name.'nextweek'),true);
        } else {
            $data[] = $this->getXingzuo($name,'nextweek');
        }
         // 获取本月运势是否有在Redis ,没则调用接口
        if ( $redis->exists($name.'month') ) {
            $data[] = json_decode( $redis->get($name.'month'),true);
        } else {
            $data[] = $this->getXingzuo($name,'month');
        }
         // 获取今年运势是否有在Redis ,没则调用接口
        if ( $redis->exists($name.'year') ) {
            $data[] = json_decode( $redis->get($name.'year'),true);
        } else {
            $data[] = $this->getXingzuo($name,'year');
        }
        // dd($data);
        return view('home.index.xingzuo',[
            'cates'     => $cate,
            'readTop10'     => $readTop10,
            'data'          => $data,
            'xingzuo'       => $xingzuo
        ]);
    }


    /**
     * 调用星座数据的方法
     * @param  [string] $consName [星座名称，如:白羊座]
     * @param  [string] $type     [运势类型：today,tomorrow,week,nextweek,month,year]
     * @return [type]           [description]
     */
    public function getXingzuo($consName,$type){
        //配置您申请的appkey
        $appkey = "7a4622e755403eca8b955f483cbe1f2f";
        //************1.运势查询************
        $url = "http://web.juhe.cn:8080/constellation/getAll";
        $params = array(
              "key" => $appkey,//应用APPKEY(应用详细页查询)
              "consName" => $consName,//星座名称，如:白羊座
              "type" => $type,//运势类型：today,tomorrow,week,nextweek,month,year
        );
        $paramstring = http_build_query($params);
        $content = $this->juhecurl($url,$paramstring);
        $result = json_decode($content,true);
        if($result){
            if($result['error_code']=='0'){
                // 判断如果是今日或者明日的做数据处理
                if ($type == 'today' || $type == 'tomorrow') {
                    // 数据处理
                    $result['health'] = ceil((int)$result['health']/100*5);
                    $result['love'] = ceil((int)$result['love']/100*5);
                    $result['all'] = ceil((int)$result['all']/100*5);
                    $result['money'] = ceil((int)$result['money']/100*5);
                    $result['work'] = ceil((int)$result['work']/100*5);
                }
                // 将星座图片加入数据
                $pic = DB::table('xingzuo')->select('img','mon')->where('name',$consName)->first();
                $result['pic'] = $pic->img;
                $result['mon'] = $pic->mon;
                // 将数据存入Redis
                $key = $consName.$type;
                $redis = Redis::connection('default');
                $redis->select(2);
                $data = json_encode($result, JSON_UNESCAPED_UNICODE );
                // 获取到当前到凌晨00点的秒数
                $time = date('H-i-s');
                $rtiem = explode('-', $time);
                $s = $rtiem[0]*60*60+$rtiem[1]*60+$rtiem[2];
                $redis->setex( $key, $s ,$data);//一天一更新
                return $result;
            }else{

                return false;
            }
        }else{
            return false;
        }
    }

    /**
     * 关注用户按钮接口
     * @param Request $req
     * @param $uid
     */
    public function guanzhu( Request $req ) {
        $from_uid   = session('home_user')['id'];  //点击关注的用户id
        $to_uid     = $req->input('to_uid'); //被关注的用户id
        $check = DB::table('guanzhu')
            ->where('from_uid','=',$from_uid)
            ->where('to_uid','=',$to_uid)
            ->exists();
        if ( $check ) {
            return $this->returnJson('您已关注该用户','10001');
        }
        $data['from_uid']   = $from_uid;
        $data['to_uid']     = $to_uid;
        $data['create_at']  = time();
        $res = DB::table('guanzhu')->insert($data);
        if ( $res ) {
            return $this->returnJson('关注成功','00000');
        } else {
            return $this->returnJson('关注失败','10002');
        }
    }

    /**
     * 请求接口返回内容
     * @param  string $url [调用星座接口的地址]
     * @param  string $params [星座]
     * @param  int $ipost [是否采用POST形式]
     * @return  string
     */
    public function juhecurl($url,$params=false,$ispost=0){
        $httpInfo = array();
        $ch = curl_init();

        curl_setopt( $ch, CURLOPT_HTTP_VERSION , CURL_HTTP_VERSION_1_1 );
        curl_setopt( $ch, CURLOPT_USERAGENT , 'JuheData' );
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT , 60 );
        curl_setopt( $ch, CURLOPT_TIMEOUT , 60);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER , true );
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        if( $ispost )
        {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        }
        else
        {
            if($params){
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params );
            }else{
                curl_setopt( $ch , CURLOPT_URL , $url);
            }
        }
        $response = curl_exec( $ch );
        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        // var_dump($response);
        return $response;
    }

    // 获取聚合提供的笑话大全api数据的 ajax
    public function getJokeData(Request $req) {
        $page = $req->input('page');
        $jokelistKey = 'jokelist_'.$page;
        $redis = Redis::connection('default');
        $redis->select(1);
        if ( $redis->exists( $jokelistKey ) ) {
            return $redis->get( $jokelistKey );
        } else {
            $res = JuheApi::joke( $page ,20 );
            $data = json_encode( $res , JSON_UNESCAPED_UNICODE );
            $redis->setex( $jokelistKey , 7200 , $data);//2小时更新一次API数据
            return $data;
        }
    }

    //无限级递归方法
    public function getCatesBypid($pid){

        $s = DB::table('cates')->where('pid','=',$pid)->orderBy('id','asc')->get();
        //遍历
        $data=[];
        foreach($s as $key=>$value){
            $value->child=$this->getCatesBypid($value->id);
            $data[]=$value;
        }
        return $data;
    }
}
