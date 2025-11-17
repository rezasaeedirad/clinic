<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function logout(Request $request)
    {
        // اگر بیمار وارد شده باشد
        if (Auth::guard('patient')->check()) {
            Auth::guard('patient')->logout();
        }

        // اگر پزشک وارد شده باشد
        if (Auth::guard('doctor')->check()) {
            Auth::guard('doctor')->logout();
        }

        // پاک کردن سشن
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
