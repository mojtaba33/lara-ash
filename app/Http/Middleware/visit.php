<?php

namespace App\Http\Middleware;

use App\Visit as AppVisit;
use Closure;
use Illuminate\Http\Request;

class visit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check())
        {
            $data = [
                'ip' => $request->ip(),
                'user_id' => auth()->user()->id
            ];
        }else{
            $data = [
                'ip' => $request->ip(),
            ];
        }

        AppVisit::create($data);

        return $next($request);
    }
}
