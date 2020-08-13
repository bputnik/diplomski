<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Language extends Model
{
    use Notifiable;

    protected $fillable = [
        'name'
    ];

    protected $table = 'languages';

    public function admins(){
        return $this->belongsToMany(Admin::class);
    }


}
