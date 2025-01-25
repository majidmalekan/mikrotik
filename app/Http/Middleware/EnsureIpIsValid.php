<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIpIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!ipInRange($request->ip(), "172.3.0.0.0/16"))
            return back()->withErrors([
                'ip' => 'آیپی شما در رنج مورد نظر وجود ندارد.',
            ]);
        return $next($request);
    }
}
