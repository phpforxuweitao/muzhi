<?php
/*  User: tao    Date: 2018/8/29   Time: 16:21  */
//全局函数
/**
 * @param $str  //要截取的字符串
 * @param $len  //要截取的长度
 * @param $tail //截取后结尾替换的字符
 * @return null|string  返回截取后的字符窜
 */
function changeStr(string $str, int $len, string$tail) :string {
    if ( mb_strlen($str)>$len ) {
        $tmp = mb_substr($str,0,$len,'utf8');
        return $tmp.$tail;
    } else {
        return $str;
    }
}

/**
 * 无限级递归获取子类整合
 * @param  [int] $pid [分类的pid]
 * @return [type]      [description]
 */
function getCatesBypid($pid){
    $s = DB::table('cates')->where('pid','=',$pid)->orderBy('id','asc')->get();
    //数组集合
    $data=[];
    foreach($s as $key=>$value){
        $value->dev = getCatesBypid($value->id);
        $data[] = $value;
    }
    return $data;
}

//发送邮箱验证码
function SendEmail($email,$data,$subject='印象日记注册验证码')  {
    try {
        Mail::send('home.login.linkActive',$data,function($message) use($email,$subject) {
            $message->subject($subject);
            $message->to($email);
        });
        return true;
    } catch (Exception $e) {
        return $e;
    }
}

