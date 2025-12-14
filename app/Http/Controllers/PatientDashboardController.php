<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;

class PatientDashboardController extends Controller
{
    /**
     * نمایش داشبورد بیمار
     */
    public function index()
    {
        // گرفتن اطلاعات کاربر لاگین شده
        $user = auth()->user(); 

        // گرفتن نوبت‌های بیمار و ارسال آن به ویو
        $appointments = $user->patient->appointments;  // نوبت‌های بیمار

        return view('patient.dashboard', compact('user', 'appointments'));  // ارسال اطلاعات به ویو
    }

    /**
     * جستجوی پزشکان (AJAX)
     */
    public function searchDoctors(Request $request)
    {
        // شروع جستجوی پزشکان
        $query = Doctor::query();

        // جستجو بر اساس نام پزشک
        if ($request->filled('name')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->name . '%');
            });
        }

        // جستجو بر اساس تخصص پزشک
        if ($request->filled('specialty')) {
            $query->where('specialty', 'like', '%' . $request->specialty . '%');
        }

        // جستجو بر اساس آدرس پزشک
        if ($request->filled('address')) {
            $query->where('address', 'like', '%' . $request->address . '%');
        }

        // دریافت نتایج جستجو
        $doctors = $query->with('user')->get();  // بارگذاری اطلاعات کاربر برای دسترسی به نام پزشک

        // اگر درخواست AJAX باشد، جواب را به صورت JSON بر می‌گرداند
        if ($request->ajax()) {
            return response()->json($doctors);
        }

        // در حالت معمولی به ویو برای نمایش نتایج می‌رود
        return view('patient.search_results', compact('doctors'));
    }
}
