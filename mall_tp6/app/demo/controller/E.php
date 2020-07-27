<?php

namespace app\demo\controller;

use\app\BaseController;

class E extends BaeController{
    public function index(){
        throw new \think\exception\HttpException(404,"找不到數據");
    }

    public function abc(){
        //dump(2);
        dump($this->request->type);
    }
}