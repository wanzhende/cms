<?php

namespace app\admin\model;

use think\Model;

class StaffDepart extends Model
{
    protected $name = 'staff_depart';

    public function depart()
    {
        return $this->belongsTo('Depart', 'did');
    }
}