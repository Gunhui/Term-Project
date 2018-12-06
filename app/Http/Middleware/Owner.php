<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class Owner
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
        // if(Auth::user()['name'] == )
         
        //     return $next($request);
    
        // return redirect()->route('board.board')->with('error', '로그인 이후 사용 가능합니다.');
    }
}