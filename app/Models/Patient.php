<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    /**
     * فیلدهای قابل مقداردهی گروهی
     */
    protected $fillable = [
        'user_id',
        'phone',
        'birth_date',
        'gender',
        'has_medical_history',
        'medical_history',
    ];

    /**
     * رابطه هر بیمار به یک کاربر
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * دسترسی به نام کامل بیمار از طریق User
     */
    public function getFullNameAttribute()
    {
        return $this->user->name ?? 'بیمار';
    }

    /**
     * دسترسی به ایمیل بیمار از طریق User
     */
    public function getEmailAttribute()
    {
        return $this->user->email ?? '—';
    }

    /**
     * دسترسی به شماره تماس بیمار
     */
    public function getPhoneNumberAttribute()
    {
        return $this->phone ?? $this->user->phone ?? '—';
    }

    /**
     * دسترسی به جنسیت بیمار
     */
    public function getGenderLabelAttribute()
    {
        return $this->gender ?? '—';
    }

    /**
     * دسترسی به تاریخ تولد بیمار
     */
    public function getBirthDateLabelAttribute()
    {
        return $this->birth_date ?? '—';
    }

    /**
     * دسترسی به وضعیت سابقه پزشکی
     */
    public function getMedicalHistoryStatusAttribute()
    {
        return $this->has_medical_history ? 'دارد' : 'ندارد';
    }

    /**
     * دسترسی به متن سابقه پزشکی
     */
    public function getMedicalHistoryTextAttribute()
    {
        return $this->medical_history ?? '—';
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
