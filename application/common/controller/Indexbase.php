<?php
namespace app\common\controller;
use think\Controller;
use think\Db;
class Indexbase extends Controller
{
	public function _initialize()
	{
		if(session('user') == null && cookie('user') == null)
		{			
			$this->redirect("common/login");
		}
		elseif(session('user') == null && cookie('user') != null) //检测到cookie时验证用户名和密码是否相符，避免伪造身份登录
		{
			$cookie_user = cookie('user');
			$this->validateUser($cookie_user['id'] , $cookie_user['password']) && session('user',$cookie_user); //验证通过重新建立会话
		}
	}
	private function validateUser($userid='' , $password='')
	{
		$user = Db::name('user');
		$userinfo = $user->where(['id' => $userid])->find();
		return $userinfo['password']===$password;
	}
}
