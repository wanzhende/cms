<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;
use think\Request;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function test()
    {
        $data = \app\admin\model\Test::all();
        dump($data);
        $this->assign('data', $data);
        return $this->fetch();
    }

    public function upload()
    {
        $file = request()->file('pic_upload');
        // 移动到框架应用根目录/html/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'html' . DS . 'uploads');
        if($info) {
            $data = array(
                        'code' => 1,
                        'url' => '/uploads/' . $info->getSaveName(),
                    );            
        } else {
            // 上传失败获取错误信息
            $data = array(
                        'code' => 0,
                        'url' => '',
                        'msg' => $file->getError(),
                    );
        }
        return json($data);
    }
}