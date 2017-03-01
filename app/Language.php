<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //语言和用户一对多
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
