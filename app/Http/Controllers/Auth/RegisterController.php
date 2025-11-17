<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use App\Models\Doctor;

class RegisterController extends Controller
{
    // ثبت‌نام بیمار
    public function registerPatient(Request $request)
    {
        $request->validate([
            'uname' => 'required|string|max:100',
            'email' => 'required|email|unique:patients,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|in:مرد,زن',
        ]);

        $patient = Patient::create([
            'uname' => $request->uname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'medical_history' => $request->medical_history ?? null,
        ]);

        Auth::guard('patient')->login($patient);

        return redirect()->route('patient.welcome');
    }

    // ثبت‌نام پزشک
    public function registerDoctor(Request $request)
    {
        $request->validate([
            'uname' => 'required|string|max:100',
            'email' => 'required|email|unique:doctors,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|in:مرد,زن',
            'skill' => 'required|string|max:100',
        ]);

        $doctor = Doctor::create([
            'uname' => $request->uname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'skill' => $request->skill,
            'bio' => $request->bio ?? null,
            'address' => $request->address ?? null,
        ]);

        Auth::guard('doctor')->login($doctor);

        return redirect()->route('doctor.welcome');
    }

    // نمایش فرم ثبت‌نام بیمار
    public function showPatientRegisterForm()
    {
        return view('registerpatient'); // بدون . و -
    }

    // نمایش فرم ثبت‌نام پزشک
    public function showDoctorRegisterForm()
    {
        return view('registerdoctor'); // بدون . و -
    }
}