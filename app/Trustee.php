<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trustee extends Model
{

    protected $fillable = [
        'name', 'surname', 'email', 'address', 'phone'
    ];


    public function students(){
        return $this->hasMany('App\Student');
    }


}
