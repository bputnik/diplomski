<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

//     protected $table = ['payments'];

    protected $fillable =[
        'student_id', 'course_id', 'amount', 'payment_method', 'note'
    ];

    public function students(){
        return $this->belongsToMany('App\Student');
    }

    public function courses(){
        return $this->belongsToMany('App\Course');
    }



}
