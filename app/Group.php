<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Subset;

class Group extends Model
{
    protected $fillable=[
        'teaching_type_id', 'course_id', 'teacher_id',
        'name', 'classroom','starting_date', 'ending_date'
    ];

    protected $dates =[
        'formed_at','starting_date', 'ending_date'
    ];

    public function course(){
        return $this->belongsTo('App\Course');
    }

    public function teacher(){
        return $this->belongsTo('App\Teacher');
    }

    public function students(){
        return $this->belongsToMany(Student::class);
//            ->withPivot('contract_number', 'discount');
    }

}
