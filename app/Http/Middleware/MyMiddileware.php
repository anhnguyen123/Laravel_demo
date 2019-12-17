<?php

namespace App\Http\Middleware;

use Closure;

class MyMiddileware
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
        if($request->has('diem') && $request['diem']>=5)
            return $next($request);
        else
            return redirect()->route('loi');
    }
}
