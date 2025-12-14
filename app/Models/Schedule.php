<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'date',
        'start_time',
        'end_time',
        'status',  // وضعیت زمان (available, booked)
    ];

    /**
     * رابطه هر زمان‌بندی به یک دکتر
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    /**
     * رابطه هر زمان‌بندی به چندین نوبت
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * تغییر وضعیت زمان به رزرو شده
     */
    public function markAsBooked()
    {
        $this->status = 'booked'; // تغییر وضعیت به رزرو شده
        $this->save(); // ذخیره تغییرات
    }

    /**
     * تغییر وضعیت زمان به آزاد
     */
    public function markAsAvailable()
    {
        $this->status = 'available'; // تغییر وضعیت به آزاد
        $this->save(); // ذخیره تغییرات
    }
}
