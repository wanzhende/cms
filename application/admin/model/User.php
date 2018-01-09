<?php

namespace app\admin\model;

use think\Model;

class User extends Model
{
    protected $resultSetType = 'collection';
    public function roles()
    {
        return $this->belongsToMany('Role', 'role_user', 'role_id', 'user_id');
    }
}
