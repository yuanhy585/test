<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //用户和语言一对一
    public function language()
    {
        return $this->belongsTo('App\Language');
    }

    //用户和角色一对一
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    //用户和状态一对一
    public function status()
    {
        return $this->belongsTo('App\Status');
    }

    //用户和文档信息一对一
    public function profile()
    {
        return $this->hasOne('App\Profile');
    }

    //用户和部门一对一
    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }

    //用户和导入文件一对多
    public function importLog()
    {
        return $this->hasMany('App\ImportLog');
    }

    //用户和文章一对多
    public function post()
    {
        return $this->hasMany('App\Post');
    }

}
