<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable=[
        'teaching_type_id', 'course_id', 'teacher_id',
        'name', 'classroom','starting_date', 'ending_date'
    ];

    protected $dates =[
        'formed_at','starting_date', 'ending_date'
    ];

}
