<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Role as RoleModel;
use app\admin\model\Node as NodeModel;
use app\admin\model\Access as AccessModel;

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

    public function grantConfig()
    {
        $request = Request::instance();
        if($request->isGet()) {
            $node = NodeModel::all();
            $grant = AccessModel::where('role_id', $request->param('id', 0, 'intval'))->column('node_id');
            $node = node_merge(collection($node)->toArray(), 0, $grant);
            $this->assign('node', $node);        
            return $this->fetch();
        } else {

            $data = $request->post();
            $access = array();
            //重组数据
            if(isset($data['access'])) {
                foreach($data['access'] as $key => $value) {
                    $temp = explode('_', $value);
                    $access[]  = array(
                        'node_id'=>$temp[0],
                        'level' => $temp[1],
                        'role_id' => $data['role_id'],
                        'module' => $request->module(),
                    );
                }
            }
            $acc = new AccessModel();
            $condition = ['role_id' => $data['role_id']];
            //清空原权限再添加新权限
            if($acc::destroy($condition) !== false) {
                $result = $acc->saveAll($access);
                if($result !== false) {
                    $this->success('保存成功！');
                }
            }
        }
    }
    
}