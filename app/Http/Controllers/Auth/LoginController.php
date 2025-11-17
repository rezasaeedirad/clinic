<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // نمایش فرم ورود بیمار
    public function showPatientLoginForm()
    {
        return view('loginpatient'); // بدون . و -
    }

    // نمایش فرم ورود پزشک
    public function showDoctorLoginForm()
    {
        return view('logindoctor'); // بدون . و -
    }

    // ورود بیمار
    public function loginPatient(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::guard('patient')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->route('patient.welcome');
        }

        return back()->withErrors(['email' => 'ایمیل یا رمز عبور اشتباه است.'])->withInput();
    }

    // ورود پزشک
    public function loginDoctor(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::guard('doctor')->attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return redirect()->route('doctor.welcome');
        }

        return back()->withErrors(['email' => 'ایمیل یا رمز عبور اشتباه است.'])->withInput();
    }
}