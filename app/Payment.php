<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

//     protected $table = ['payments'];

    protected $fillable =[
        'student_id', 'course_id', 'amount', 'payment_method', 'note'
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function course(){
        return $this->belongsTo('App\Course');
    }



}
