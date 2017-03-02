<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    //部门和用户一对多
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
