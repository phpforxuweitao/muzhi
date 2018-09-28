<?php
/*  User: tao    Date: 2018/9/9   Time: 15:08  */


/**
 * 聚合api接口调用类
 * Class JuheApi
 * @package app\common\controller
 */
class JuheApi
{
    private static $appKey = 'c47eea70bec91635f6ab7f119185a46b';
    /**
     * @param $appKey   string 申请的该接口key
     * @param $page integer 当前页数
     * @param $pagesize integer 每页显示多少条数据 默认为1  最大20
     */
    public static function joke( $page , $pagesize ) {
        $url        = 'http://japi.juhe.cn/joke/content/text.from';//接口连接
        $params     = [
            'page'          => $page,
            'pagesize'      => $pagesize,
            'key'           => self::$appKey
        ];
        $paramstring    = http_build_query( $params );
        $content        = self::juhecurl( $url , $paramstring );
        $result         = json_decode( $content , true);
        if ( $result ) {
            if ( $result['error_code'] == '0' ) {
                return $result;
            } else {
                return $result['error_code'] . ' : ' . $result['reason'];
            }
        } else {
            return '请求失败';
        }
    }

    /**
     * 请求接口返回内容
     * @param string $url [请求的url地址]
     * @param string $params [请求的参数]
     * @param int $ispost [是否采用post形式]
     */
    protected static function juhecurl( $url , $params = false , $ispost = 0 ) {
        $httpInfo   = [];
        $ch = curl_init();
        curl_setopt( $ch , CURLOPT_HTTP_VERSION ,CURL_HTTP_VERSION_1_1 );//设置http协议版本
        curl_setopt( $ch , CURLOPT_USERAGENT , 'JuheData' );//设置代理服务商名称
        curl_setopt( $ch , CURLOPT_CONNECTTIMEOUT , 60 );//连接超时时间
        curl_setopt( $ch , CURLOPT_TIMEOUT , 60 );//请求超时时间
        curl_setopt( $ch , CURLOPT_RETURNTRANSFER , true );//不直接输出内容
        curl_setopt( $ch , CURLOPT_FOLLOWLOCATION , true );//跟踪爬取重定向页面
        if ( $ispost ) {
            curl_setopt( $ch , CURLOPT_POST , true );
            curl_setopt( $ch , CURLOPT_POSTFIELDS , $params );
            curl_setopt( $ch , CURLOPT_URL , $url );
        } else {
            if ( $params ) {
                curl_setopt( $ch , CURLOPT_URL , $url.'?'.$params);
            } else {
                curl_setopt( $ch , CURLOPT_URL , $url );
            }
        }
        $response = curl_exec( $ch );
        if ( $response === FALSE ) {
            //echo 'cUrl Error: ' , curl_error( $ch );
            return false;
        }
        $httpCode   = curl_getinfo( $ch , CURLINFO_HTTP_CODE );
        $httpInfo   = array_merge( $httpInfo , curl_getinfo( $ch ) );
        curl_close( $ch );
        return $response;
    }

}