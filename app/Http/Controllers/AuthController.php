<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    // ----------------------
    // نمایش فرم ورود عمومی
    // ----------------------
    public function showLoginForm()
    {
        // اگر کاربر وارد سیستم باشد، هدایت خودکار به داشبورد
        if (Auth::check()) {
            $user = Auth::user();

            // جلوگیری از نمایش صفحه Login وقتی داخل داشبورد است
            if ($user->is_logged_in) {
                return redirect()->route(
                    strtolower($user->role) === 'doctor' ? 'doctor.dashboard' : 'patient.dashboard'
                )->with('info', 'شما هم‌اکنون وارد سیستم هستید. برای ورود دوباره ابتدا خروج کنید.');
            }
        }

        // نمایش فرم Login
        return view('login');
    }

    // ----------------------
    // ورود کاربر
    // ----------------------
    public function login(Request $request)
    {
        // اعتبارسنجی داده‌ها
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // بررسی Single Login واقعی با دیتابیس
            if ($user->is_logged_in) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'این کاربر هم‌اکنون در جای دیگری وارد شده است.'
                ])->withInput();
            }

            // علامت‌گذاری کاربر به عنوان وارد شده
            $user->update(['is_logged_in' => true]);

            // ثبت زمان ورود و نقش برای جلوگیری از Back مرورگر و هدایت خودکار
            Session::put('last_login_time', now());
            Session::put('user_role', strtolower($user->role));

            // هدایت به داشبورد بر اساس نقش
            if (strtolower($user->role) === 'doctor') {
                return redirect()->route('doctor.dashboard')->with('success', 'ورود موفقیت‌آمیز بود!');
            }

            if (strtolower($user->role) === 'patient') {
                return redirect()->route('patient.dashboard')->with('success', 'ورود موفقیت‌آمیز بود!');
            }

            // اگر نقش غیرمجاز داشت، به صفحه اصلی هدایت شود
            return redirect('/home');
        }

        return back()
            ->withErrors(['email' => 'ایمیل یا رمز عبور اشتباه است'])
            ->withInput();
    }

    // ----------------------
    // خروج از سیستم
    // ----------------------
    public function logout(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            // حذف Flag ورود برای Single Login
            $user->update(['is_logged_in' => false]);
        }

        Auth::logout();

        // پاک کردن کامل سشن و توکن CSRF برای جلوگیری از برگشت به صفحات داخلی
        $request->session()->flush();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'شما با موفقیت خارج شدید.');
    }
}
