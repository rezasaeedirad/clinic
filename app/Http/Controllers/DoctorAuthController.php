<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DoctorAuthController extends Controller
{
    // ----------------------
    // نمایش فرم ثبت‌نام پزشک
    // ----------------------
    public function showRegisterForm()
    {
        return view('doctor.register');
    }

    // ----------------------
    // ثبت‌نام پزشک
    // ----------------------
    public function register(Request $request)
    {
        // اعتبارسنجی داده‌ها
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'gender' => 'required|in:male,female',
            'phone' => 'required|string|max:20',
            'specialty' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'clinic_address' => 'nullable|string|max:255',
            'password' => 'required|string|confirmed|min:6',
        ]);

        // ایجاد کاربر با نقش doctor
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'doctor', // نقش doctor
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
        ]);

        // ایجاد اطلاعات اختصاصی پزشک
        Doctor::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'specialty' => $request->specialty,
            'bio' => $request->bio,
            'address' => $request->clinic_address,
        ]);

        // ورود خودکار پس از ثبت‌نام
        Auth::login($user);

        // هدایت به داشبورد پزشک
        return redirect()->route('doctor.dashboard')->with('success', 'ثبت‌نام موفقیت‌آمیز بود!');
    }

    // ----------------------
    // نمایش فرم ورود پزشک
    // ----------------------
    public function showLoginForm()
    {
        return view('doctor.login');
    }

    // ----------------------
    // ورود پزشک
    // ----------------------
    public function login(Request $request)
    {
        // اعتبارسنجی داده‌ها
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // تلاش برای احراز هویت
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // فقط کاربران با نقش doctor می‌توانند وارد شوند
            if ($user->role === 'doctor') {
                return redirect()->route('doctor.dashboard')->with('success', 'ورود موفقیت‌آمیز بود!');
            }

            // اگر نقش دیگری داشت، خارج شود و فرم لاگین عمومی نمایش داده شود
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'email' => 'شما اجازه دسترسی به این بخش را ندارید.'
            ]);
        }

        // در صورت اشتباه بودن ایمیل یا رمز عبور
        return back()->withErrors(['email' => 'ایمیل یا رمز عبور اشتباه است'])->withInput();
    }
}
