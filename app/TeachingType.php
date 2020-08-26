<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeachingType extends Model
{
    protected $fillable =[
        'name'
    ];

    protected $table = 'teaching_types';
}
