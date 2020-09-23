<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    protected $fillable =[
        'lesson_number', 'lesson_content', 'lesson_note', 'lesson_date'
    ];

    protected $dates = [
        'lesson_date', 'created_at'
    ];




}
