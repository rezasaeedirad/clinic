<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * تعیین مسیر ریدایرکت برای کاربران لاگین‌نشده
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            // اگر در مسیر patient باشه
            if ($request->is('patient/*')) {
                return route('patient.login.form');
            }

            // اگر در مسیر doctor باشه
            if ($request->is('doctor/*')) {
                return route('doctor.login.form');
            }

            // در غیر این صورت به صفحه اصلی
            return route('home');
        }

        return null;
    }
}