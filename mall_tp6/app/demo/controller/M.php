<?php

namespace app\demo\controller;

use app\BaseController;
use app\common\business\Demo;

class M extends BaseController{
    
    public function index(){
        $id=$this->requset->param("id",0,"intval");
        if(empty($id)){
            return show(config("status.error","參數錯誤"));
        }

        $demo=new Demo();
        $result=$demo->getDemoDataByCategoryId($id);

        return show(config("status.success"),"ok",$result);
    }
}