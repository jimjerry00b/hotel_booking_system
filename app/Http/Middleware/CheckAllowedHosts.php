<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAllowedHosts
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    protected $allowedHosts = [
        'example.com',
        'localhost:8000',
    ];
    
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->header('Host') ?? $request->header('Origin');

        if (!in_array($host, $this->allowedHosts)) {
            return response()->json(['error' => 'Unauthorized host'], 403);
        }

        return $next($request);
    }
}
