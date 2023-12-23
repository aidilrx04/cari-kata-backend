<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\Response as AccessResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsUserData
{
    /**
     * Handle if user request their own data or not
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) return response()->json(null, 401);

        $auth_user_id = Auth::id();
        $user_data = $request->route()->parameter('user');

        if ($user_data->id !== $auth_user_id)
            return AccessResponse::denyAsNotFound();

        return $next($request);
    }
}
