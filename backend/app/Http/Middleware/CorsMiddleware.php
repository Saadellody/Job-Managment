<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->getMethod()==="OPTION"){
            return response(204)
                ->header('Access-Control-Allow-origin','http://localhost:5173')
                ->header('Access-Control-Allow-Methods','GET,POST ,PUT ,PATCH,DELETE,OPTION')
                ->header('Access-Control-allow-Headers','Content-Type,Authorization,X-Requested-With')
                ->header('Access-Control-Allow-Credentials', 'true');
        }
        $response = $next($request);
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:5173'); // Vite URL
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');

        return $response;
    }
}
