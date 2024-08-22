<?php

namespace App\Http\Middleware;

use App\Models\Teacher;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MustVerifyTeacher
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user->userable->status != 1) {
            flash()
                ->options([
                    'timeout' => 3000,
                    'position' => 'top-center',
                ])
                ->warning('Tài khoản của bạn chưa được phê duyệt');
            return back();
        }
        return $next($request);
    }
}
