<?php

namespace app\admin\validate;

use think\Validate;

class Depart extends Validate
{
    protected $rule = [
        'name'  =>  'require|min:2|max:25|unique:depart,name^pid',
    ];
}