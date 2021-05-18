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
        $data = [
            'ip' => $request->ip(),
            'route' => $request->path()
        ];

        if(auth()->check())
        {
            $data['user_id'] = auth()->user()->id;
        }

        AppVisit::create($data);

        return $next($request);
    }
}
