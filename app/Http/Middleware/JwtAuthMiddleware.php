<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (UnauthorizedHttpException $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()],  401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()],  401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()],  401);
        }
        return $next($request);
    }
}
