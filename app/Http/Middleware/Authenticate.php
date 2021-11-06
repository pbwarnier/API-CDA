<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\TokenMismatchException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;

class Authenticate extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if(!$request->cookie('token')) throw new TokenMismatchException();
            $rawToken = $request->cookie('token');
            $token = new Token($rawToken);
            $payload = JWTAuth::decode($token, env('JWT_SECRET'),['HS256']);
            if($token != $rawToken) throw new TokenMismatchException();
            $request->headers->set('Authorization', 'Bearer ' . $request->cookie('token'));
            return $next($request);
        } catch (\Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) { // Token invalide
                $status = 403;
                $message = 'This token is invalid. Please Login';
                return response()->json(compact('status', 'message'), 403);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) { // Token expiré
                $message = 'This token is expired. Please login.';
                $status = 401;
                return response()->json(compact('status', 'message'), 401);
            } else { // Pas de token
                $rawToken = $request->cookie('token');
                $message = 'Authorization Token not found';
                return response()->json(array("error"=>$e->getMessage()), 401);
            }
        }
    }
}
