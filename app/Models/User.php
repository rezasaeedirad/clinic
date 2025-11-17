<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users'; // نام جدول در دیتابیس
    protected $primaryKey = 'id'; // کلید اصلی جدول
    public $timestamps = false; // چون جدول created_at و updated_at ندارد

    protected $fillable = [
        'uname', 'email', 'phone', 'password', 'role'
    ];

    protected $hidden = [
        'password'
    ];
}
