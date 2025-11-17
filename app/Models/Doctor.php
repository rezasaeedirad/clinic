<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    protected $table = 'doctors';

    protected $primaryKey = 'did';

    protected $fillable = [
    'uname', 'email', 'phone', 'password', 'gender', 'skill', 'bio', 'address'
    ];

    protected $hidden = ['password'];
}
