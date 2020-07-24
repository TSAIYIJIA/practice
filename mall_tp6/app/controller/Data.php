<?php

namespace app\controller;

use app\BaseController;
use think\facade\Db;
class Data extends BaseController{
    public function index(){
        //容器的方式來處理
        $result=app("db")->table("mall_demo")->where("id",0)->find();
        //倒序
        // $result=Db::table("mall_demo")->order("id",desc)->find();
        //倒序、(倒數一位數據,取兩數據) 
        //$result=Db::table("mall_demo")->order("id","desc")->limit(0,2)->select();
        //分頁邏輯 (page第幾頁,listRows幾條數據)
        //$result=Db::table("mall_demo")->order("id","desc")->page(0,2)->select();
        dump($result);

    }
  
}