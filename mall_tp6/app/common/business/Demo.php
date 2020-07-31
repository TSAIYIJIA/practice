<?php

namespace app\common\business;
use app\common\model\mysql\Demo as DemoModel;
class Demo{
    /**
     * business層通過getDemoDataByCategoryId來獲取數據
     */
    public function getDemoDataByCategoryId($category_id,$limit=4){
        $model=new DemoModel();
        $result=$model->getDemoDataByCategoryId($category_id,$limit);
        if(empty($result)){
            return [];
        }
        
        //halt($result); 等同於 dump();exit;
        //利用配置文件來做數字狀態轉換
        $categorys=config("category");
        foreach($result as $key=>$r){
            $result[$key]['category_name']=$categorys[$r["category_id"]]??"其他";
        }
        return $result;
    }
}