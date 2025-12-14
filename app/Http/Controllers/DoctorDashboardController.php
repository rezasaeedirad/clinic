<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Schedule;
use Carbon\Carbon;

class DoctorDashboardController extends Controller
{
    // داشبورد اصلی
    public function index()
    {
        $doctor = auth()->user()->doctor;

        // نوبت‌ها همراه اطلاعات بیمار و زمان‌بندی
        $appointments = $doctor->appointments()
            ->with(['patient.user', 'schedule'])
            ->get()
            ->sortBy(fn($a) => strtotime($a->schedule->date . ' ' . $a->schedule->start_time));

        // زمان‌بندی آزاد
        $schedules = $doctor->schedules()->orderBy('date')->orderBy('start_time')->get();

        return view('doctor.dashboard', compact('doctor', 'appointments', 'schedules'));
    }

    /**
     * افزودن زمان آزاد
     */
    public function addAvailableSlot(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'end_time' => 'nullable',
        ]);

        $doctor = auth()->user()->doctor;

        // بررسی تداخل با زمان‌های موجود
        $exists = $doctor->schedules()
            ->where('date', $request->date)
            ->where('start_time', $request->start_time)
            ->exists();

        if ($exists) {
            return back()->with('error', 'این زمان قبلا ثبت شده است.');
        }

        // ایجاد زمان آزاد جدید
        $doctor->schedules()->create([
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => 'available',
        ]);

        return back()->with('success', 'زمان آزاد با موفقیت اضافه شد.');
    }

    /**
     * تأیید نوبت توسط پزشک
     */
    public function confirmAppointment(Appointment $appointment)
    {
        $doctor = auth()->user()->doctor;

        // بررسی اینکه نوبت متعلق به این پزشک است
        if ($appointment->doctor_id !== $doctor->id) {
            abort(403, 'این نوبت متعلق به شما نیست.');
        }

        // تغییر وضعیت نوبت به confirmed
        $appointment->update([
            'status' => 'confirmed',
        ]);

        // تغییر وضعیت زمان مربوطه به booked
        $appointment->schedule->markAsBooked();

        return back()->with('success', 'نوبت با موفقیت تأیید شد.');
    }

    /**
     * لغو نوبت توسط پزشک
     */
    public function cancelAppointment(Appointment $appointment)
    {
        $doctor = auth()->user()->doctor;

        // بررسی اینکه نوبت متعلق به این پزشک است
        if ($appointment->doctor_id !== $doctor->id) {
            abort(403, 'این نوبت متعلق به شما نیست.');
        }

        // تغییر وضعیت نوبت به cancelled
        $appointment->update([
            'status' => 'cancelled',
        ]);

        // تغییر وضعیت زمان مربوطه به available
        $appointment->schedule->markAsAvailable();

        return back()->with('success', 'نوبت با موفقیت لغو شد.');
    }
}
