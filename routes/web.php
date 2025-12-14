<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PatientAuthController;
use App\Http\Controllers\DoctorAuthController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\PatientAppointmentController;
use App\Http\Controllers\DoctorProfileController;
use App\Models\Doctor;

// ----------------------
// صفحه اصلی
// ----------------------
Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

// ----------------------
// انتخاب نقش (Role)
// ----------------------
Route::get('/role', function () {
    return view('role');
})->name('role');

// ----------------------
// Auth عمومی (بدون middleware guest)
// ----------------------
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// ----------------------
// Auth بیمار
// ----------------------
Route::prefix('patient')->group(function () {
    Route::get('/register', [PatientAuthController::class, 'showRegisterForm'])->name('patient.register');
    Route::post('/register', [PatientAuthController::class, 'register']);
});

// ----------------------
// Auth پزشک
// ----------------------
Route::prefix('doctor')->group(function () {
    Route::get('/register', [DoctorAuthController::class, 'showRegisterForm'])->name('doctor.register');
    Route::post('/register', [DoctorAuthController::class, 'register']);
});

// ----------------------
// خروج از سیستم
// ----------------------
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ----------------------
// گروه روت‌های محافظت‌شده با auth
// ----------------------
Route::middleware(['auth'])->group(function () {

    // داشبورد پزشک
    Route::get('/doctor/dashboard', function () {
        $user = auth()->user();

        if (!$user || !session()->has('last_login_time')) {
            return redirect()->route('login')->with('info', 'لطفاً دوباره وارد شوید.');
        }

        if (!$user->is_logged_in) {
            auth()->logout();
            session()->flush();
            return redirect()->route('login')->with('info', 'لطفاً دوباره وارد شوید.');
        }

        return app(DoctorDashboardController::class)->index();
    })->name('doctor.dashboard');

    // داشبورد بیمار
    Route::get('/patient/dashboard', function () {
        $user = auth()->user();

        if (!$user || !session()->has('last_login_time')) {
            return redirect()->route('login')->with('info', 'لطفاً دوباره وارد شوید.');
        }

        if (!$user->is_logged_in) {
            auth()->logout();
            session()->flush();
            return redirect()->route('login')->with('info', 'لطفاً دوباره وارد شوید.');
        }

        return app(PatientDashboardController::class)->index();
    })->name('patient.dashboard');

    // پروفایل پزشک
    Route::get('/doctor/profile', [DoctorProfileController::class, 'edit'])
        ->name('doctor.profile.edit');

    Route::post('/doctor/profile', [DoctorProfileController::class, 'update'])
        ->name('doctor.profile.update');

    // جستجوی پزشکان (AJAX) برای بیمار
    Route::get('/patient/search-doctors', [PatientDashboardController::class, 'searchDoctors'])
        ->name('patient.search.doctors');

    // مشاهده و مدیریت زمان‌بندی پزشک
    Route::get('/doctor/schedule', [DoctorDashboardController::class, 'showSchedule'])
        ->name('doctor.schedule');

    Route::post('/doctor/schedule/add', [DoctorDashboardController::class, 'addAvailableSlot'])
        ->name('doctor.schedule.add');

    // ----------------------
    // روت‌های مربوط به رزرو نوبت بیمار
    // ----------------------
    Route::prefix('patient')->group(function () {

        Route::get('/appointments/create/{doctor}', [PatientAppointmentController::class, 'create'])
            ->name('patient.appointments.create');

        Route::post('/appointments/book/{schedule}', [PatientAppointmentController::class, 'store'])
            ->name('patient.appointments.store');
    });

    // ----------------------
    // API ساده برای دریافت زمان‌های آزاد پزشک (برای AJAX یا مستقیم)
    // ----------------------
    Route::get('/patient/doctor/{doctor}/schedules', function (Doctor $doctor) {
        return $doctor->schedules()
            ->where('status', 'available')
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();
    })->name('patient.doctor.schedules');

    // تأیید نوبت توسط پزشک
    Route::post('/doctor/appointments/{appointment}/confirm', [DoctorDashboardController::class, 'confirmAppointment'])
        ->name('doctor.appointments.confirm');

    // لغو نوبت توسط پزشک
    Route::post('/doctor/appointments/{appointment}/cancel', [DoctorDashboardController::class, 'cancelAppointment'])
        ->name('doctor.appointments.cancel');
});
