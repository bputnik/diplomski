<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{

    protected $fillable = [
        'group_id', 'lesson_id', 'student_id', 'attendance'
    ];


    public function students(){
        return $this->hasMany(Student::class);
    }

    public function groups(){
        return $this->hasMany(Group::class);
    }

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

}
