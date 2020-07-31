<?php

namespace app\admin\controller;


use think\facade\View;
use app\common\model\mysql\AdminUser;

class Login extends  AdminBase{

    public function initialize(){
        if($this->isLogin()){
            return $this->redirect(url("index/index"));
        }
    }
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

        $data=[
            'username'=> $username,
            'password'=>$password,
            'captcha'=>$captcha,
        ];

        $validate=new \app\admin\validate\AdminUser();
        if(!$validate->check($data)){
            return show(config("status.error"),$validate->getError());
        }
        // if(empty($username)||empty($password)||empty($captcha)){
        //     return show(config("status.error"),"參數不能為空");
        // }
        //驗證碼是否正確
        // if(!captcha_check($captcha)){
        //     //失敗
        //     return show(config("status.error"),"驗證碼錯誤");
        // }
        try{
            $result= \app\admin\business\AdminUser::login($data);
        }catch(\Exception $e){
            return show(config("status.error"),$e->getMessage());
        }
        
        if($result){
            return show(config("status.success"),"登錄成功");
        }else{
            return show(config("status.error"),"登錄失敗");
        }
        
    }
}