<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    protected $fillable =[
        'teacher_id', 'group_id', 'lesson_number', 'lesson_content', 'lesson_note', 'lesson_date'
    ];

    protected $dates = [
        'lesson_date', 'created_at'
    ];

    public function attendances(){
        return $this->belongsToMany(Attendance::class);
    }


}
