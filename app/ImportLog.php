<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImportLog extends Model
{
    //导入文件和用户多对一
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
