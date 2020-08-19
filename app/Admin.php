<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin  extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'surname', 'avatar', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function languages(){
        return $this->belongsToMany(Language::class);
    }

//    public function setPasswordAttribute($value){
//        $this->attributes['password'] = bcrypt($value);
//    }

    public function getAvatarAttribute($value){
        return asset('storage/' . $value);
    }

}

