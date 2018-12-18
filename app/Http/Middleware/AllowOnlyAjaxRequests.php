<?php

namespace App\Http\Middleware;

use Closure;

class AllowOnlyAjaxRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->ajax()) {
            $ref = strtolower('/'.$request->path());
            $home=substr($ref,0,5)=='/home'?'':'/home';
            return response()->redirectTo("/#!$home".$ref);
        }

        return $next($request);
    }
}