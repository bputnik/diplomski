<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $guard = 'student';

    protected $fillable = [
        'name', 'surname', 'email', 'password',
        'address', 'phone', 'dob'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


}
