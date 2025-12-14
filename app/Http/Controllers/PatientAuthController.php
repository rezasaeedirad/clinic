<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PatientAuthController extends Controller
{
    // ----------------------
    // نمایش فرم ثبت‌نام بیمار
    // ----------------------
    public function showRegisterForm()
    {
        return view('patient.register');
    }

    // ----------------------
    // ثبت‌نام بیمار
    // ----------------------
    public function register(Request $request)
    {
        // اعتبارسنجی داده‌ها
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'gender' => 'required|in:male,female',
            'birth_date' => 'required|date',
            'has_history' => 'nullable|in:yes,no',
            'history_details' => 'nullable|string',
        ]);

        // ایجاد کاربر با نقش patient
        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'patient', // نقش بیمار
        ]);

        // ایجاد اطلاعات اختصاصی بیمار
        Patient::create([
            'user_id' => $user->id,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'has_medical_history' => $request->has_history === 'yes' ? 1 : 0,
            'medical_history' => $request->has_history === 'yes' ? $request->history_details : null,
        ]);

        // ورود خودکار بیمار پس از ثبت‌نام
        Auth::login($user);

        // هدایت به داشبورد بیمار
        return redirect()->route('patient.dashboard')->with('success', 'ثبت‌نام موفقیت‌آمیز بود!');
    }

    // ----------------------
    // نمایش فرم ورود بیمار
    // ----------------------
    public function showLoginForm()
    {
        return view('patient.login');
    }

    // ----------------------
    // ورود بیمار
    // ----------------------
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // فقط کاربران با نقش patient می‌توانند وارد شوند
            if ($user->role === 'patient') {
                return redirect()->route('patient.dashboard')->with('success', 'ورود موفقیت‌آمیز بود!');
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
