<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\JsonResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('token')) {
            $api_key = $request->header('token');

            if ($api_key !== env('API_KEY')) {
                return response()->json([
                    'results' => 'API key is not valid',
                ], 403);
            }

            return $next($request);
        }

        return response()->json([
            'results' => 'Unauthorized',
        ], 401);

    }
}
