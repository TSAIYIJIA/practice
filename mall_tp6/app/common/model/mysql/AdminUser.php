<?php
namespace app\common\model\mysql;

use think\Model;
class AdminUser extends Model{
    /**
     * 根據用戶名取得後端表的數據
     */
    public function getAdminUserByUsername($username){
        if(empty($username)){
            return false;
        }

        $where=[
         "username"=> trim($username),
         ];

         $result=$this->where($where)->find();
         return $result;
    }
/**
 * 根據主鍵id更新數據表數據
 */
    public function updateById($id,$data){
        $id=intval($id);
        if(empty($id) || empty($data) || !is_array($data)){
            return false;
        }

        $where=[
            "id"=>$id,
        ];
        return $this->where($where)->save($data);
    }
}