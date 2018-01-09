<?php

namespace app\admin\model;

use think\Model;

class Depart extends Model
{
    //protected $pk = 'id';
    //protected $name = 'depart';
    protected $resultSetType = 'collection';

    public function staff()
    {
        return $this->belongsToMany('Staff', 'staff_depart', 'sid', 'did');
    }

    public function getDepart()
    {
        $depart = $this->field(['id', 'name', 'pid', 'level'])->select();
        return $this->buildTree($depart->toArray());
    }

    public function getBreadCrumb($id = 0)
    {
        $depart = self::all()->toArray();
        return $this->pushParent($id, $depart);
    }

    public function getChildDepart($pid = 0)
    {
        $depart = self::all(['pid'=>$pid]);
        return $depart->toArray();
    }

    private function buildTree($items)
    {
        $data = array();
        $tree = array();
        //同步数组key和id
        foreach($items as $key => $value) {
            $data[$value['id']] = $value;
        }
        
        foreach($data as $value) {
            if(isset($data[$value['pid']])) {
                $data[$value['pid']]['children'][] = &$data[$value['id']];
            } else {
                $tree[] = &$data[$value['id']];
            }
        }
        return $tree;
    }

    private function pushParent($id = 0, $queryData = [])
    {
        static $data = array();
        foreach($queryData as $key => $value) {
			if($value['id'] == $id) {
                $data[] = $value;
				unset($queryData[$key]);
				if($value['pid'] != 0) {
                    return $this->pushParent($value['pid'], $queryData);
				} else {
                    krsort($data);
                    return array_values($data);
				}
			}
		}
    }
}