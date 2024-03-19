<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       // Kiểm tra nếu người dùng đã đăng nhập và có vai trò là admin
        if (Auth::check() && Auth::user()->role_id == 1) {
            return $next($request);
        }

        // Nếu không phải admin, có thể chuyển hướng họ về một trang khác
        return redirect('/')->with('error', 'Bạn không có quyền truy cập trang này!');

    }
}
