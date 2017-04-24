<?php

namespace app\admin\model;

use think\Model;
use think\Db;

class Staff extends Model
{
    //protected $name = 'staff';
    protected $resultSetType = 'collection';
    protected $type = [
        'hiredate' => 'timestamp:Y-m-d',
        'leavedate' => 'timestamp:Y-m-d',
    ];

    /**定义表间关联-开始**/
    public function depart()
    {
        return $this->belongsToMany('Depart', table('staff_depart'), 'did', 'sid');
    }

    /*public function staffDepart()
    {
        return $this->hasMany('StaffDepart', 'sid', 'id');
    }*/

    public function staffProfile()
    {
        return $this->hasOne('StaffProfile', 'sid', 'id');
    }
    /**定义表间关联-结束**/

    public function getDepartStaff($did = 0)
    {
        $depart = Depart::get($did);
        $staff = $depart->staff->append(['seniority', 'seniority_text']);
        return $staff;
    }

    public function getSeniorityAttr($value, $data)
    {
        return is_null($data['hiredate']) ? 0 : floor((time() - $data['hiredate'])/86400);
    }

    public function getSeniorityTextAttr($value, $data)
    {
        $day = is_null($data['hiredate']) ? 0 : floor((time() - $data['hiredate'])/86400);
        $str = $day >= 365 ? strval(floor($day / 365)) . '年' : $day . '天';
        return $str;
    }

    public function getDepartStaff1($did = 0)
    {
        $data = Db::name('staff')->alias('A')->join('staff_depart B', 'A.id = B.sid')->field(['A.id', 'A.name', 'A.alias', 'A.sex', 'A.telphone', 'A.level', 'A.hiredate', 'A.leavedate', 'A.status'])->where('B.did', 'eq', $did)->select();
        foreach($data as $key => &$value) {
            //工龄暂时未考虑离职情况，后期再修改
            $value['seniority'] = $value['hiredate'] ? $this->convertSeniority(floor((time()-$value['hiredate'])/86400)) : 0;
            $value['hiredate'] = $value['hiredate'] ? date('Y-m-d', $value['hiredate']) : '';
            $value['leavedate'] = $value['leavedate'] ? date('Y-m-d', $value['leavedate']) : '';
        }
        return $data;
    }

}