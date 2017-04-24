<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Depart as DepartModel;

class Depart extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function departAdd()
    {
        $request = Request::instance();
        $pid = $request->param('pid', 0, 'intval');
        if($request->isGet()) {
            $this->assign('pid', $pid);
            return $this->fetch();
        } else {

            $depart = new DepartModel();
            
            $result = $depart->validate(true)->save(input('post.'));

            if(false === $result) {
                $this->error('添加失败！'.$depart->getError());                
            }
            else {
                $this->success('添加成功！');
            }
        }        
    }

    public function departEdit($id = 0)
    {
        $request = Request::instance();
        $id = $request->param('id', 0, 'intval');
        
        if($request->isGet()) {
            if($id ==0) {
                $this->error('id错误，非法操作！');
            } else {
                $dpInfo = DepartModel::get($id);
                $this->assign('dpInfo', $dpInfo);
                return $this->fetch();
            }
        } else {
            $depart = new DepartModel();            
            $result = $depart->isUpdate(true)->validate(true)->save(input('post.'));
            if(false === $result) {
                $this->error('修改失败！'.$depart->getError());                
            }
            else {
                $this->success('修改成功！');
            }            
        }        
    }

    public function departDelete()
    {
        $request = Request::instance();
        $id = $request->param('id', 0, 'intval');        
        if($request->isGet()) {
            //应增加判断是否有子部门，若有禁止删除
            if(DepartModel::destroy($id)) {
                $this->success('删除成功!');
            } else {
                $this->error('删除失败!');
            }
            
        } else {
            $this->error('非法操作');
        }
    }

    public function departSelect()
    {
        return $this->fetch();
    }

    public function getDepart()
    {
        $depart = new DepartModel();        
        return  json($depart->getDepart());
    }

    public function departInfoSync($id = 0)
    {
        $depart = new DepartModel();
        $value['breadCrumb'] = $depart->getBreadCrumb($id);
        $value['children'] = $depart->getChildDepart($id);
        return json($value);
    }

}