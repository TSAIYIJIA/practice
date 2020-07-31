<?php

declare (strict_types=1); //強制類型
namespace app\admin\middleware;

class Auth {
    public function handle($request,\Closure $next){

        if(empty(session(config("admin.session_admin")))&& !preg_match("/login/",$request->pathinfo())){
            return redirect((string) url('login/index'));//強制類型的話
        }
        //前置中間件
        $response=$next($request);
        // if(empty(session(config("admin.session_admin")))&&$request->controller()!="Login"){
        //     //return redirect(url('login/index'));
        //     return redirect((string) url('login/index'));//強制類型的話
        // }
        return $response;
        //後置中間件
    }
}