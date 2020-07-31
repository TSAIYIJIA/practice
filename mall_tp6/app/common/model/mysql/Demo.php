<?php
namespace app\common\model\mysql;

use think\Model;
class Demo extends Model{
    //依照status數字轉換文字狀態
    public function getStatus($value,$data){
        $status=[
            0=>"正常",
            1=>"刪除",
            2=>"待審核"

        ];

        return  $status[$data['status']];//database status欄位
    }
    public function getDemoDataByCategoryId($category_id,$limit=4){
        if(empty($category_id)){
            return [];
        }
        $result=$this->where("category_id",$category_id)
        ->limit($limit)
        ->order("category_id","desc")
        ->select()
        ->toArray();

        return $result;
    }
}