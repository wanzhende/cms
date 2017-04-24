<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Depart as DepartModel;
use app\admin\model\Staff as StaffModel;
use app\admin\model\StaffProfile;

class Staff extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function add()
    {
        $request = Request::instance();
        if($request->isGet()) {
            return $this->fetch();
        } else {
            $data = $request->param();
            $staff = new StaffModel();
            if($staff->allowField(true)->validate(true)->save($data)) {
                //删除原部门信息
                $staffDepart = new \app\admin\model\StaffDepart();
                $staffDepart->destroy(['sid'=>$staff->id]);
                //写入新部门信息
                $staffDepart_data = array();
                foreach($data['depart'] as $key => $value) {
                    $staffDepart_data[]  = array('sid'=>$staff->id, 'did'=>$value);
                }
                $staffDepart->saveAll($staffDepart_data);
            } else {
                $this->error('新增错误:'.$staff->getError());
            }
        }        
    }

    public function edit()
    {
        $request = Request::instance();
        if($request->isGet()) {
            $id = $request->param('id', 0, 'intval');
            $staff = StaffModel::get($id);
            $this->assign('staff', $staff);
            return $this->fetch();
        } else {
            $id = $request->post('id', 0, 'intval');
            $post = $request->post();
            unset($post['id']);
            dump($post);
            empty($post['hiredate']) && $post['hiredate'] = null;
            $post['sid'] = $id;
            $staff = StaffModel::get($id);
            $result = $staff->allowField(true)->save($post);
            if($result !== false) {
                echo '基础资料更新成功！<br>';
                //使用关联模型删除并更新部门
                $staff->depart()->detach();
                $staff->depart()->saveAll($post['depart']);
                //写入员工详细档案，判断是否已经存在，已在则更新，否则新增
                if($staff->staffProfile) {
                    $staff->staffProfile->save($post);
                } else {
                    $staff->staffProfile()->save($post);
                }
                
                dump($m_result);
                /*
                $staffProfile = StaffProfile::get(['sid'=>$id]);
                is_null($staffProfile) && $staffProfile = new StaffProfile();
                
                if($staffProfile->allowField(true)->save($post) !== false) {
                    echo '档案更新成功！';
                } else {
                    echo '档案更新失败！';
                }
                */
            } else {
                 echo '基础资料更新失败！<br>'.$staff->getError();
            }
        }
    }

    public function staffInfoSync($did = 0)
    {
        $depart = new DepartModel();
        $staff = new StaffModel();
        $value['breadCrumb'] = $depart->getBreadCrumb($did);
        $value['children'] = $staff->getDepartStaff($did)->toArray();
        return json($value);
    }

    public function test()
    {
        $staff = new StaffModel();
        $staff = $staff->find(1);
        $result = $staff->depart()->detach();
        dump($result);
    }
}