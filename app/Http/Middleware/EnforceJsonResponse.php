<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\Middleware\TransformsRequest;
use Illuminate\Http\Request;

class EnforceJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if (
        //     $request->expectsJson() ||
        //     ($request->route() && in_array('api', $request->route()->middleware()))
        // ) {
        //     $request->headers->set('Accept', 'application/vnd.api+json');
        // }

        if ($request->route() != null && in_array('api', $request->route()->middleware())) {
            $request->headers->set('Accept',  'application/vnd.api+json');
        }

        
        return $next($request);
    }
}
