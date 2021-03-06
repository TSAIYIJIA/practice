<?php

namespace app\controller;

use app\BaseController;
use think\facade\Db;
use app\model\Demo;
class Data extends BaseController{
    public function index(){
        //容器的方式來處理
        $result=app("db")->table("mall_demo")->where("category_id",0)->find();
        //倒序
        // $result=Db::table("mall_demo")->order("category_id",desc)->find();
        //倒序、(倒數一位數據,取兩數據) 
        //$result=Db::table("mall_demo")->order("category_id","desc")->limit(0,2)->select();
        //分頁邏輯 (page第幾頁,listRows幾條數據)
        //$result=Db::table("mall_demo")->order("category_id","desc")->page(0,2)->select();
        dump($result);

    }

    public function abc(){
        //第一種輸出sql方式
        $result=Db::table("mll_demo")->where("category_id",1)->fetchSql()->find();
        //第二種輸出sql方式
        $result=Db::table("mall_demo")->where("category_id",1)->find();
        echo Db::getLastSql();exit;
        dump($result);
    }

    public function demo(){
        $data=[
            
            "category_id"=>3,
            "category_name"=>"水",
            
        ];
        //新增
        // $result=Db::table("mall_demo")->insert($data);
        // echo Db::getLastSql();

        //刪除
        // $result=Db::table("demo_mall")-where("category_id",1)->delete();
        // echo Db::getLastSql();

        //更新
        // $result=Db::table("demo_mall")->where("category_id",2)->update(["name"=>"汽水"]);
        // echo Db::getLastSql();
        dump($result);
    }
   
    /**
     * 模型方法來查找
     */
    public function model1(){
        $result=Demo::find(1);

        //dump(&result);
        dump($result->toArray());
    }

    public function model2(){
        $modelObj=new Demo();
        $result =$modelObj-where("category_id",2)
        ->limit(2)
        ->order("category_id","desc")
        ->select();
        
        foreach($result as $result){
            //dump($result['category_name']);
            //dump($result->category_name);
            //print_r($result->category_name);
            
            dump($result->status_text);//狀態文字轉換
        }
    }
}