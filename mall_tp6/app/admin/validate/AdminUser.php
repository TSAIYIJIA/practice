<?php

namespace app\admin\validate;
use think\Validate;

class AdminUser extends Validate{
    protected $rule=[
        'username'=>'require',
        'password'=>'require',
        'captcha'=>'require|checkCaptcha',
    ];

    protected $message=[
        'username'=>'用戶名必須',
        'password'=>'密碼必須',
        'captcha'=>'驗證碼必須'
    ];
    //驗證碼判定
    protected function checkCaptcha($value,$rule,$data=[]){
        if(!captcha_check($value)){
            return "驗證碼錯誤" ;
        }
        return true;
    }
}