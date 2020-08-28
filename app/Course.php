<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'language_id', 'level_id', 'course_type_id', 'number_of_lessons', 'final_exam', 'price'
    ];

    public function language() {
        return $this->belongsTo('App\Language');
    }

    public function level(){
        return $this->belongsTo('App\Level');
    }

    public function courseType(){
        return $this->belongsTo('App\CourseType');
    }

    public function groups(){
        return $this->hasMany('App\Group');
    }


    public function getFinalExamAttribute($value){
        if($value == 1) {
            $value = 'Da';
        }
        else {
            $value = 'Ne';
        }
        return $value;
    }

}
