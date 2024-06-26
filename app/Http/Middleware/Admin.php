<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function __construct() {
        $this->middleware('auth:admins');
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        if (!Auth::guard('admin')->check()){
            return redirect()->route('login-form')->with('error','لطفا وارد حساب کاربری خود شوید');
        }
        return $next($request);
    }
}
