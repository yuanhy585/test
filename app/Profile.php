<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //文档信息和用户一对一
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
