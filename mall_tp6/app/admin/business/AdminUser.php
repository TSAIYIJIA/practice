<?php

namespace app\admin\business;

use app\common\model\mysql\AdminUser as AdminUserModel;
use think\Exception;
class AdminUser{

    public static function login($data){
        try{ 
            //判斷用戶名是否正確
            $adminUserObj =new AdminUserModel();
            $adminUser=self:: getAdminUserByUsername($data['username']);
            if(empty($adminUser)){
                throw new Exception("用戶不存在");
            }
           
            //判斷密碼是否正確
            if($adminUser['password'] !=md5($data['password']."_singwa_abc")){
                throw new Exception("密碼錯誤");
                //return show(config("status.error"),"密碼錯誤");
            }

            //紀錄信息到sql
            $updateData=[
                "last_login_time"=>time(),
                "last_login_ip"=>request()->ip(),
                "update_time"=>time(),
            ];
            $res=$adminUserObj->updateById($adminUser['id'],$updateData);
            if(empty($res)){
                throw new Exception("登錄失敗");
                //return show(config("status.error"),"登錄失敗");
            }
        }catch(\Exception $e){
            //todo 紀錄日誌 $e->getMessage();
            //return show(config("status.error"),"內部異常,登錄失敗");
            throw new Exception("內部異常,登錄失敗");
        }
        //紀錄session
        session(config("admin.session_admin"),$adminUser);
        return true;
    }
    /**
     * 通過用戶名獲取數據
     */
    public static function getAdminUserByUsername($username){
        $adminUserObj =new AdminUserModel();
        $adminUser=$adminUserObj->getAdminUserByUsername($username );
        
        if(empty($adminUser)||$adminUser->status !=config("status.mysql.table_normal")){
            return false;
        }

        $adminUser=$adminUser->toArray();
        return $adminUser;
    }
}