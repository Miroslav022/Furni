<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->session()->has('user') && $request->session()->get('user')->isAdmin){
            return $next($request);
        }
        if($request->ajax()) {
            return redirect()->json([], 401);
        }
        return redirect()->route('not-found');
    }
}
