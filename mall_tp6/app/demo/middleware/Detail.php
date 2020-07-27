<?php

namespace app\demo\middleware;

class Detail {
    public function handle($request,\Closure $next){

        //dump(1);
        $request->type="detail";
        return $next($request);
    }
}