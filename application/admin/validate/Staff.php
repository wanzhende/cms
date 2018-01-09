<?php

namespace app\admin\validate;

use think\Validate;

class Staff extends Validate
{
    protected $rule = [
        'name'  =>  'require|min:2|max:25|unique:staff,name^telphone',
        'telphone' => 'require|unique:staff',
    ];
}