<?php

namespace app\demo\middleware;

class Check {
    public function handle($request,\Closure $next){

        //dump(1);
        $request->type="demo";
        return $next($request);
    }
}