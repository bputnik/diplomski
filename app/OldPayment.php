<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OldPayment extends Model
{

    protected $fillable = [
        'student_id', 'course_id', 'amount', 'payment_method', 'note'
    ];

    protected $dates = [
        'crated_at', 'updated_at'
    ];

}
