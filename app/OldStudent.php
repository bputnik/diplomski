<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldStudent extends Model
{
    protected $fillable = [
        'student_id', 'name', 'surname', 'avatar', 'email', 'address',
        'phone', 'dob', 'course', 'group', 'contract_number', 'trustee_name',
        'trustee_surname', 'trustee_email', 'trustee_address', 'trustee_phone',
        'deleted', 'created_at', 'updated_at'
    ];

    protected $dates = [
        'created_at', 'updated_at'
    ];

}
