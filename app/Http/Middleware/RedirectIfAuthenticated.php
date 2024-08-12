<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            $roleRedirects = [
                'Admin' => 'admin.index',
                'Teacher' => 'teacher.index',
                'Student' => 'student.index',
                'Employee' => 'employee.index',
            ];

            foreach ($roleRedirects as $role => $route) {
                if ($user->hasRole($role)) {
                    return redirect()->route($route);
                }
            }
        }

        return redirect('/home');
    }
}
