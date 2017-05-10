<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Node as NodeModel;

class Node extends Controller
{
    public function index()
    {
        $node = NodeModel::all();
        $node = node_merge(collection($node)->toArray());
        $this->assign('node', $node);
        return $this->fetch();
    }

    public function add()
    {
        $request = Request::instance();
        $pid = $request->param('pid', 0, 'intval');
        $level = $request->param('level', 1, 'intval');
        switch($level) {
            case 1:
                $type = '应用';
                break;
            case 2:
                $type = '控制器';
                break;
            case 3:
                $type = '方法';
                break;
        }
        if($request->isPost()) {
            $post = $request->post();
            $post['pid'] = $request->param('pid', 0, 'intval');
            $post['level'] = $request->param('level', 1, 'intval');
            
            $node = new NodeModel();
            if($result = $node->allowField(true)->save($post)) {
                echo '添加成功!';
            } else {
                echo '添加失败!';
            }
        } else {
            $this->assign('pid', $pid);
            $this->assign('level', $level);
            $this->assign('type', $type);
            return $this->fetch();
        }
    }
}