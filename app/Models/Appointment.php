<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * فیلدهای قابل مقداردهی گروهی
     */
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'schedule_id',
        'appointment_at', // تاریخ و زمان نوبت
        'status',         // وضعیت نوبت (pending, confirmed, cancelled)
        'feedback',       // فیدبک بیمار
    ];

    /**
     * رابطه هر نوبت به یک دکتر
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * رابطه هر نوبت به یک بیمار
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * رابطه هر نوبت به یک زمان‌بندی (schedule)
     */
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * دسترسی سریع به نام بیمار
     */
    public function getPatientNameAttribute()
    {
        return $this->patient->user->name ?? '—'; // اگر نام بیمار موجود نباشد، از خط فاصله استفاده می‌کند
    }

    /**
     * دسترسی سریع به شماره تماس بیمار
     */
    public function getPatientPhoneAttribute()
    {
        return $this->patient->phone ?? $this->patient->user->phone ?? '—'; // اگر شماره تماس موجود نباشد، از خط فاصله استفاده می‌کند
    }

    /**
     * برچسب وضعیت نوبت
     */
    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status); // وضعیت نوبت را به صورت اول حرف بزرگ باز می‌گرداند
    }

    /**
     * زمان شروع نوبت از جدول Schedule
     */
    public function getStartTimeAttribute()
    {
        return $this->schedule->start_time ?? null; // اگر زمان شروع نوبت در جدول Schedule موجود نباشد، null برمی‌گرداند
    }

    /**
     * زمان پایان نوبت از جدول Schedule
     */
    public function getEndTimeAttribute()
    {
        return $this->schedule->end_time ?? null; // اگر زمان پایان نوبت در جدول Schedule موجود نباشد، null برمی‌گرداند
    }

    /**
     * تاریخ نوبت از جدول Schedule
     */
    public function getAppointmentDateAttribute()
    {
        return $this->schedule->date ?? null; // اگر تاریخ نوبت در جدول Schedule موجود نباشد، null برمی‌گرداند
    }

    /**
     * تایید نوبت
     */
    public function confirm()
    {
        // تغییر وضعیت نوبت به تایید شده
        $this->status = 'confirmed';
        $this->save();

        // تغییر وضعیت زمان به رزرو شده
        $this->schedule->markAsBooked();
    }

    /**
     * لغو نوبت
     */
    public function cancel()
    {
        // تغییر وضعیت نوبت به لغو شده
        $this->status = 'cancelled';
        $this->save();

        // تغییر وضعیت زمان به آزاد
        $this->schedule->markAsAvailable();
    }
}
