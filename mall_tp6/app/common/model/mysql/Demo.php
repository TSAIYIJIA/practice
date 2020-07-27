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
    public function getDemoDataByCategoryId($id,$limit=4){
        if(empty($id)){
            return [];
        }
        $result=$this->where("id",$id)
        ->limit($limit)
        ->order("id","desc")
        ->select()
        ->toArray();

        return $result;
    }
}