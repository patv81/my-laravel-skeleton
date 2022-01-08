<?php

namespace App\Http\Middleware;

use Closure;

class PermissionAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($request->session()->has('userInfo')){
            $userInfo = $request->session()->get('userInfo');
            if($userInfo['level']=='member'){
                return redirect()->route('notify/no-permission');
            }
        }else{
            return redirect()->route('home');
        }
        return $next($request);
    }
}
