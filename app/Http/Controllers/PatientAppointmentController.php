<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientAppointmentController extends Controller
{
    /**
     * نمایش زمان‌های آزاد پزشک
     */
    public function create(Doctor $doctor)
    {
        // گرفتن زمان‌های آزاد پزشک
        $schedules = $doctor->schedules()
            ->where('status', 'available')  // فیلتر زمان‌های آزاد
            ->orderBy('date')  // مرتب‌سازی بر اساس تاریخ
            ->orderBy('start_time')  // مرتب‌سازی بر اساس زمان شروع
            ->get();

        // بازگشت به ویو با لیست زمان‌ها
        return view('patient.appointments.create', compact('doctor', 'schedules'));
    }

    /**
     * رزرو نوبت (با چک همزمانی)
     */
    public function store(Request $request, Schedule $schedule)
    {
        $patient = auth()->user()->patient;  // گرفتن بیمار فعلی از طریق auth

        return DB::transaction(function () use ($schedule, $patient) {

            // قفل کردن ردیف برای جلوگیری از رزرو همزمان
            $schedule->lockForUpdate();

            // چک کردن وضعیت زمان: اگر در دسترس نباشد، رزرو انجام نمی‌شود
            if ($schedule->status !== 'available') {
                return back()->with('error', 'این زمان قبلاً رزرو شده است.');
            }

            // ذخیره نوبت جدید
            $appointment = Appointment::create([
                'patient_id'     => $patient->id,  // بیمار فعلی
                'doctor_id'      => $schedule->doctor_id,  // پزشک مرتبط
                'schedule_id'    => $schedule->id,  // زمان‌بندی نوبت
                'appointment_at' => $schedule->date . ' ' . $schedule->start_time,  // تاریخ و زمان نوبت
                'status'         => 'pending',  // وضعیت نوبت به "در انتظار" تنظیم می‌شود
            ]);

            // تغییر وضعیت زمان‌بندی به "رزرو شده"
            $schedule->update([
                'status' => 'booked'
            ]);

            // بازگشت به داشبورد بیمار با پیام موفقیت
            return redirect()
                ->route('patient.dashboard')
                ->with('success', 'نوبت با موفقیت رزرو شد');
        });
    }

    /**
     * تغییر وضعیت نوبت توسط پزشک (تایید یا لغو)
     */
    public function updateAppointmentStatus(Request $request, Appointment $appointment)
    {
        // بررسی مجوز دسترسی
        $this->authorize('update', $appointment);  // بررسی مجوز

        // چک کردن وضعیت ورودی برای تایید یا لغو
        if (!in_array($request->status, ['confirmed', 'cancelled'])) {
            return back()->with('error', 'وضعیت نامعتبر است.');
        }

        // تغییر وضعیت نوبت
        $appointment->update([
            'status' => $request->status,  // 'confirmed' یا 'cancelled'
        ]);

        // بازگشت به داشبورد پزشک با پیام موفقیت
        return back()->with('success', 'وضعیت نوبت با موفقیت تغییر یافت');
    }
}
