<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         //检测用户是否具有登录的session
        if(session('admin_info')['islogin']){
            // 4.获取当前访问的控制跟方法跟当前用户权限做对比
            //获取访问模块方法名
            $action = $request->route()->getActionMethod();
            //获取访问模块控制器的名字
            $actions = explode('\\', \Route::current()->getActionName());
            //或$actions=explode('\\', \Route::currentRouteAction());
            $modelName = $actions[count($actions)-2] == 'Controllers'?null:$actions[count($actions)-2];
            $func = explode('@', $actions[count($actions)-1]);
            //控制器名字
            $controller = $func[0];
            // 获取权限信息
            $node_list = session('admin_node')['node_list'];
            // 和当前访问权限对比
            if ( empty($node_list[$controller]) || !in_array($action, $node_list[$controller])) {
                return redirect('/bk_index')->with('error','对不起!您没有访问权限，请联系后台管理员');
            }
            return $next($request);
        }else{
            //跳转到登录界面
            return redirect("/bk_login");
        }
    }
}
