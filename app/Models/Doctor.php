<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    /**
     * فیلدهای قابل مقداردهی گروهی
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'phone',
        'specialty',
        'bio',
        'address',
        // 'clinic_address', // حذف شد چون در جدول شما فیلد جداگانه ندارد
    ];

    /**
     * رابطه هر دکتر به یک کاربر
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * رابطه دکتر با نوبت‌ها (appointments)
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * دسترسی به نام کامل دکتر از طریق User
     */
    public function getFullNameAttribute()
    {
        return $this->user->name ?? 'دکتر';
    }

    /**
     * دسترسی به شماره تماس دکتر
     * اگر در Doctor موجود نبود، شماره User استفاده می‌شود
     */
    public function getPhoneNumberAttribute()
    {
        return $this->phone ?? $this->user->phone ?? '—';
    }

    /**
     * دسترسی به تخصص با برچسب ساده
     */
    public function getSpecialtyLabelAttribute()
    {
        return $this->specialty ?? '—';
    }

    /**
     * نمونه‌ی دسترسی به بیو
     */
    public function getBioLabelAttribute()
    {
        return $this->bio ?? '—';
    }

    /**
     * نمونه‌ی دسترسی به آدرس کلینیک
     */
    public function getAddressLabelAttribute()
    {
        return $this->address ?? '—';
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
