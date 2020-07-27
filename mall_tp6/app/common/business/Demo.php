<?php

namespace app\common\business;
use app\common\model\mysql\Demo as DemoModel;
class Demo{
    /**
     * business層通過getDemoDataByCategoryId來獲取數據
     */
    public function getDemoDataByCategoryId($id,$limit=4){
        $model=new DemoModel();
        $result=$model->getDemoDataByCategoryId($id,$limit);
        if(empty($result)){
            return [];
        }
        
        //halt($result); 等同於 dump();exit;
        //利用配置文件來做數字狀態轉換
        $categorys=config("category");
        foreach($result as $key=>$r){
            $result[$key]['categoryName']=$categorys[$r["id"]]??"其他";
        }
        return $result;
    }
}