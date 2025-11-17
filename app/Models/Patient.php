<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    protected $table = 'patients';

    protected $primaryKey = 'pid';

    protected $fillable = [
    'uname', 'email', 'phone', 'password', 'gender', 'medical_history'
    ];

    protected $hidden = ['password'];
}
