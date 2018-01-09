<?php

namespace app\admin\model;

use think\Model;

class StaffProfile extends Model
{
    protected $name = 'staff_profile';
    protected $type = [
        'birthday' => 'timestamp:Y-m-d',
    ];
    protected $field = true;
}