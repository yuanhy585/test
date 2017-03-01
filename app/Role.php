<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //角色和用户一对多
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
