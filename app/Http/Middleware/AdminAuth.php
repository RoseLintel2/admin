<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use App\Model\Permissions;
use Illuminate\Support\Facades\DB;
use App\tools\ToolsAdmin;
use Illuminate\Http\Request;

class AdminAuth
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
        //判断用户是否登录
        $session = $request->session('user.id');
        // dd($session);
        if(!$session->has('user')){
            //如果用户未登录，调到登录页
            return redirect('/admin/login')->send();
        }

         //获取当前登录的用户
        $user_name = $session->get('user.username');
        
        //获取当前访问的路由地址
        $uri = $request->path();

        // 转换路由格式  admin/home  admin.home
        $url=strtr($uri,"/",".");
        
        //原生SQL查询是否有权限
        $sql = DB::select(" select count(*) cnt  from admin_users a LEFT JOIN user_role b on a.id = b.user_id LEFT JOIN role c on b.role_id = c.id LEFT JOIN role_permissions d on c.id = d.role_id LEFT JOIN permissions e on d.p_id = e.id WHERE a.username = ? and e.url = ?",[$user_name , $url]);

        //查找是否为超管
        $user = DB::select("select is_super FROM admin_users WHERE username = ? and is_super = 2",[$user_name]);
        
        // 1，判断是否为超级管理员或者是不是主页
        if(!empty($user) || $url == "admin.home"){

            
        // 2, 如果非超管，不能访问没有权限的页面
        }else if($sql[0]->cnt == 0){
                
             return redirect('403'); 
        }

        //获取当前登录的用户id
        $user = DB::select("select * FROM admin_users WHERE username = ?",[$user_name]);
        
        //获取用户所有权限的主键id
        $pids = ToolsAdmin::getUserPermissionIds($user[0]->id);
        
        
        $data = [
            'pids' => $pids,
            'user' => $user
        ];

        //完成视图共享
        View::share('username',$session->get('user.username'));
        View::share('user_pic',$session->get('user.image_url'));
        
        //左侧菜单视图共享
        View::share('menus',Permissions::getMeuns($data));

        return $next($request);
    }
}
