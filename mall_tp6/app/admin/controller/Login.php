<?php

namespace app\admin\controller;

use app\BaseController;
use think\facade\View;
use app\common\model\mysql\AdminUser;

class Login extends BaseController{
    public function index(){
        return View::fetch();
    }
    public function md5(){
        echo md5("admin_singwa_abc");
    }

    public function check(){
        if(!$this->request->isPost()){
            return show(config("status.error"),"請求方式錯誤");
        }

        //參數檢驗
        $username=$this->request->param("username"," ","trim");
        $password=$this->request->param("password"," ","trim");
        $captcha=$this->request->param("captcha"," ","trim");
        if(empty($username)||empty($password)||empty($captcha)){
            return show(config("status.error"),"參數不能為空");
        }
        //驗證碼是否正確
        if(!captcha_check($captcha)){
            //失敗
            return show(config("status.error"),"驗證碼錯誤");
        }

        try{ 
            //判斷用戶名是否正確
            $adminUserObj =new AdminUser();
            $adminUser=$adminUserObj->getAdminUserByUsername($username);
            
            if(empty($adminUser)||$adminUser->status !=config("status.mysql.table_normal")){
                return show(config("status.error"),"不存在該用戶");
            }

            $adminUser=$adminUser->toArray();

            //判斷密碼是否正確
            if($adminUser['password'] !=md5($password."_singwa_abc")){
                return show(config("status.error"),"密碼錯誤");
            }

            //紀錄信息到sql
            $updateData=[
                "last_login_time"=>time(),
                "last_login_ip"=>request()->ip(),
                "update_time"=>time(),
            ];
            $res=$adminUserObj->updateById($adminUserObj['id'],$updateData);
            if(empty($res)){
                return show(config("status.error"),"登錄失敗");
            }
        }catch(\Exception $e){
            //todo 紀錄日誌 $e->getMessage();
            return show(config("status.error"),"內部異常,登錄失敗");
        }
        //紀錄session
        session(config("admin.session_admin"),$adminUser);
        return show(config("status.success"),"登錄成功");
    }
}