<?php
namespace app\controller;

use app\BaseController;
class Demo extends BaseController
{
    public function show(){

        $result =[
            "status"=>1,
            "message"=>"ok",
            "result"=>[
                'id'=>1,
                'name'=>2,
            ],
        ];
        return json($result);
    }
    public function request(){
        dump($this->request->param("Jay", "1","intval")); //第一種方式
    }

}