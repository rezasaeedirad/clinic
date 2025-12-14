<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class PreventBackHistory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            // اگر کاربر Logout شده یا Flag ورودش False است، فوراً هدایت به صفحه Login
            if (!$user->is_logged_in) {
                Auth::logout();
                Session::flush(); // پاک کردن کامل سشن
                return redirect()->route('login')->withErrors([
                    'email' => 'شما باید دوباره لاگین کنید.'
                ]);
            }

            // ثبت زمان ورود و نقش فقط اگر قبلاً ثبت نشده
            if (!Session::has('last_login_time')) {
                Session::put('last_login_time', now());
            }
            if (!Session::has('user_role')) {
                Session::put('user_role', strtolower($user->role));
            }

            // جلوگیری از بازگشت به صفحه Login وقتی داخل داشبورد است
            if ($request->route() && $request->route()->getName() === 'login') {
                return redirect()->route(
                    strtolower($user->role) === 'doctor' ? 'doctor.dashboard' : 'patient.dashboard'
                )->with('info', 'شما هم‌اکنون وارد سیستم هستید. برای ورود دوباره ابتدا خروج کنید.');
            }
        }

        $response = $next($request);

        // جلوگیری از ذخیره صفحه در Cache مرورگر
        return $response->header('Cache-Control', 'no-cache, no-store, max-age=0, must-revalidate')
                        ->header('Pragma', 'no-cache')
                        ->header('Expires', 'Sat, 01 Jan 1990 00:00:00 GMT');
    }
}
