<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Auth::check(), Auth::user()->role);
        if (!Auth::check()) {
            return redirect()->route('login'); // nếu chưa đăng nhập thì chuyển hướng đến trang đăng nhập
        } elseif (Auth::user()->role !== 'admin') {
            abort(403, 'Bạn không có quyền truy cập.'); // nếu không phải admin thì trả về lỗi 403
        }
        return $next($request); // cho phép đi tiếp
    }
}
