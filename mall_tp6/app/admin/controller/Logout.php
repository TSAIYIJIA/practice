<?php

namespace app\admin\controller;
class Logout extends AdminBase{
    public function index(){
        //清除session
        session(config("admin.session_admin"),null);
        //跳轉
        return redirect(url("login/index"));
    }
}