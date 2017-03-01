<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    //状态和用户一对多
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
