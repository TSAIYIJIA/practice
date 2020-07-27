<?php

use think\facade\Route;

//訪問路徑/demo/test
Route::rule("test","demo/index/hello","GET");
Route::rule("detail","detail/index","GET")->middleware(app\demo\middleware\Detail::class);
