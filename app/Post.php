<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        //文章和用户一对一
        return $this->belongsTo('App\User');
    }
}
