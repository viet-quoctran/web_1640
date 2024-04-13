<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Kiểm tra nếu người dùng đã đăng nhập và có role_id trong số các role được chấp nhận
        if (!Auth::check() || !in_array(Auth::user()->role_id, $roles)) {
            // Nếu không đủ điều kiện, trả về response 403
            return abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
