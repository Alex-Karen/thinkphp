<?php

namespace app\http\middleware;

class CheckLogin
{
    public function handle($request, \Closure $next)
    {
//        session(null);
        if (!session('?admin.user')) {
            return redirect('admin/login/index')->with('error', '非法请求后台操作，请登录');
        }
        return $next($request);
    }
}
