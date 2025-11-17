<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;

// صفحه اصلی
Route::get('/', fn() => view('v1front'))->name('home');

// ---------------------------
// ثبت‌نام
// ---------------------------

// فرم ثبت‌نام بیمار
Route::get('/signup/patient', [RegisterController::class, 'showPatientRegisterForm'])
    ->name('patient.register.form');

Route::post('/register/patient', [RegisterController::class, 'registerPatient'])
    ->name('register.patient');

// فرم ثبت‌نام پزشک
Route::get('/signup/doctor', [RegisterController::class, 'showDoctorRegisterForm'])
    ->name('doctor.register.form');

Route::post('/register/doctor', [RegisterController::class, 'registerDoctor'])
    ->name('register.doctor');


// ---------------------------
// ورود
// ---------------------------

// فرم ورود بیمار
Route::get('/login/patient', [LoginController::class, 'showPatientLoginForm'])
    ->name('patient.login.form');

Route::post('/login/patient', [LoginController::class, 'loginPatient'])
    ->name('login.patient');

// فرم ورود پزشک
Route::get('/login/doctor', [LoginController::class, 'showDoctorLoginForm'])
    ->name('doctor.login.form');

Route::post('/login/doctor', [LoginController::class, 'loginDoctor'])
    ->name('login.doctor');


// ---------------------------
// خروج (عمومی برای هر دو گارد)
// ---------------------------
Route::post('/logout', [LogoutController::class, 'logout'])
    ->name('logout')
    ->middleware('auth'); // LogoutController خودش گارد رو تشخیص می‌دهد


// ---------------------------
// داشبورد بیمار
// ---------------------------
Route::middleware('auth:patient')->group(function () {
    Route::get('/patient/welcome', function () {
        return view('welcomepatient'); // بدون . و -
    })->name('patient.welcome');
});


// ---------------------------
// داشبورد پزشک
// ---------------------------
Route::middleware('auth:doctor')->group(function () {
    Route::get('/doctor/welcome', function () {
        return view('welcomedoctor'); // بدون . و -
    })->name('doctor.welcome');
});