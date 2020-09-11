<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $guard = 'student';

    protected $fillable = [
        'trustee_id', 'name', 'surname', 'email', 'password',
        'address', 'phone', 'dob'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'dob', 'created_at'
    ];

    public function trustee(){
        return $this->belongsTo('App\Trustee');
    }

    public function groups(){
        return $this->belongsToMany('App\Group')
            ->withPivot('contract_number', 'discount')
            ->withTimestamps();
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }


}
