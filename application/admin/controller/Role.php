<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Role as RoleModel;

class Role extends Controller
{
    public function index()
    {
        $roleList = RoleModel::all();
        $this->assign('role', $roleList);
        return $this->fetch();
    }

    public function add()
    {
        $request = Request::instance();
        if($request->isGet()) {
            return $this->fetch();
        } else {
            dump($request->post());
            if(RoleModel::create($request->post())) {
                echo '添加成功';
            } else {
                echo '添加失败';
            }
        }        
    }

    public function edit()
    {
        $request = Request::instance();
        $id = $request->param('id', 0, 'intval');
        $role = RoleModel::get($id);
        if($request->isGet()) {            
            $this->assign('role', $role);
            return $this->fetch();
        } else {
            dump($request->post());
            if($role->save($request->post())) {
                echo '修改成功';
            } else {
                echo '修改失败';
            }
        }        
    }
}