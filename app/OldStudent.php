<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldStudent extends Model
{
    protected $fillable = [
        'student_id', 'name', 'surname', 'avatar', 'email', 'address',
        'phone', 'dob', 'course', 'group', 'contract_number', 'trustee_name',
        'trustee_surname', 'trustee_email', 'trustee_address', 'trustee_phone'
    ];

    protected $dates = [
        'deleted_at'
    ];

}
