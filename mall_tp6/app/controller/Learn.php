<?php

namespace app\controller;

use app\Request;
use think\facade\Request as A;
class Learn{
    public function index(Request $app){
        //第二種方式
        dump($request->param("Jay"));
        //第三種方式
        dump(input("Jay"));
        //第四種方式
        dump(request()->param("abc"));
        //第五種方式
        dump(A::param("abc"));

    }
}