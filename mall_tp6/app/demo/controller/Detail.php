<?php

namespace app\demo\controller;

use\app\BaseController;

class Detail extends BaeController{
    public function index(){
      dump($this->request->type);
    }

   
}