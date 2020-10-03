<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{

    protected $fillable = [
        'group_id', 'lesson_id', 'student_id', 'attendance'
    ];

    protected $dates = [
        'created_at'
    ];


    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function groups(){
        return $this->hasMany(Group::class);
    }

    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }

    public function getAttendanceAttribute($value){
        if($value == 1 )
            return $value = 'P';
        elseif($value == 0)
            return $value = 'O';

    }


}
