<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->input('token') !== 'my-secret-token') {
            return new Response('Middleware not pass', 403);
        }

        return $next($request);
    }

    public function terminate($request, $response)
    {
        // // This method is called after the response has been sent to the client.
        // // You can perform actions like logging here.
        // \Log::info('Request Path: ' . $request->path());
        // \Log::info('Response Status Code: ' . $response->getStatusCode());
    }
}
