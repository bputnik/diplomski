<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use Notifiable;


    protected $guard = 'teacher';

    protected $fillable = [
        'name', 'surname', 'jmbg', 'email', 'password',
        'bank_account_number', 'start_work',
        'address', 'phone', 'dob',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates=[
        'start_work', 'created_at', 'updated_at', 'dob'
    ];


    public function languages(){
        return $this->belongsToMany('App\Language');
    }


}
