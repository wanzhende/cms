<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use think\Db;

class Common extends Controller
{
	public function login(Request $request)
	{
		
		$dd = new Dingtalk();		
		$dd->setParams('timestamp', $request->time());
		$dd->setParams('url', $request->url(true));
		$data = $dd->getParams();
		$this->assign('ddjs',$data);

		if($request->isPost())
		{
			$username = input('username','','trim');
			$password = input('password','','md5');
			$auto_login = $request->has('auto_login','post');
			$user = Db::name('user');
			$userinfo = $user->field(['id','password','truename','phone'])->where(['username' => $username])->find();
			if($userinfo)
			{
				if($userinfo['password']===$password)
				{
					session('user',$userinfo);
					$auto_login && cookie('user',$userinfo,604800); //一周内免登录
					$user->Where(['username'=>$username])->update(['last_ip'=>$request->ip(),'last_time'=>time()]);
					$redirect_url = $request->root();
					$redirect_url = !empty($redirect_url)?$redirect_url:'/';
					$this->success('登录成功！',$redirect_url);
				}
				else
				{
					$this->error('用户名与密码不匹配！');
				}
			}
			else
			{
				$this->error('用户不存在！');
			}
			//echo '用户名：'.$username.',密码：'.$password;
		}
		else
		{
			if(session('user'))
			{
				$redirect_url = $request->root();
				$redirect_url = !empty($redirect_url)?$redirect_url:'/';
				$this->redirect($redirect_url);
			}
			else
			{
				return $this->fetch();
			}			
		}		
	}

	public function logout()
	{
		session('user',null);
		cookie('user',null);
		$this->success('登出成功！',url('index/index'));
	}
	
	public function getDDUserinfo()
	{
		$request = Request::instance();
		if($request->isGet()) {
			$dd = new Dingtalk();
			$code = $request->param('code', '', 'trim');
			$userinfo = $dd->getUserinfo($code);
			return json($userinfo);
		}
	}
}