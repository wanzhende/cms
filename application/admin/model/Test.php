<?php

namespace app\admin\model;

use think\Model;

class Test extends Model
{
    protected $name = 'test';
    protected $resultSetType = 'collection';
    protected $type = [
        'start' => 'datetime:Y-m-d',
        'end'  =>  'timestamp:Y-m-d',
    ];


    /*protected function getEndAttr($value)
    {
        return $value ? date('Y-m-d', $value): '';
    }*/
}