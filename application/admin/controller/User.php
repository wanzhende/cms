<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\User as UserModel;
use app\admin\model\Role as RoleModel;
class User extends Controller
{
    public function index()
    {
        $request = Request::instance();
        if($request->isGet()) {
            $user = UserModel::all();
            $this->assign('user', $user);           
            return $this->fetch();
        } else {

        }
    }

    public function add()
    {
        if($this->request->isGet()) {
            $roles = RoleModel::all(['status'=>1]);
            $this->assign('roles', $roles);
            return $this->fetch();
        }
    }

    public function edit()
    {
        if($this->request->isGet()) {
            $id = $this->request->param('id', 0, 'intval');
            $user = UserModel::get($id);
            $roles = RoleModel::all(['status'=>1]);
            $this->assign('user', $user);
            $this->assign('roles', $roles);
            return $this->fetch();
        } else {
            $data = $this->request->post();
            dump($data);
        }
    }

    /**返回角色数量 */
    public function getRolesNum()
    {
        $num = RoleModel::where('status','=',1)->count();
        return $num;
    }
}