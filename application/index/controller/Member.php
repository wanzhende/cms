<?php
namespace app\index\controller;

use think\Request;
use app\common\controller\Indexbase;
use think\Db;

class Member extends Indexbase
{
	public function findPassword()
	{
		$request = Request::instance();
		$view = new \think\View(\think\Config::get());
		if($request->isPost())
		{
			$cardno = input('cardno','','trim');
			if(preg_match('/^\d{1,12}$/',$cardno,$match))
			{
				$get_pwd_url = "http://ailin.xicp.cn:8888/index/Index/getpwd/card_no/".$cardno;
				$result_str = file_get_contents($get_pwd_url);
				$member_info = json_decode($result_str,true);
				if($member_info['status']==1)
				{
					if($member_info['set_pwd']==1)
					{
						if($member_info['tel']=='')
						{
							$this->error('该会员未登记手机号，请先核实资料并登记手机号再试！');
							//$this->error('该会员未登记手机号，请先核实资料并登记手机号再试！'.$member_info['password']);
						}
						else
						{
							$last_msg = Db::name('smslog')->Where(['telphone'=>$member_info['tel']])->order('id desc')->find();
							if( time() - intval($last_msg['send_time']) < 3 )
							{
								$this->error('您点击也太快了吧，刚才明明已经向手机号'.$member_info['tel'].'发送过密码了！','',5);
							}
							else
							{
								$kf_phone = session('user')['phone'];
								$this->build_content($member_info['tel'],$member_info['password'],$kf_phone,$cardno);							
								$this->success('密码为：'.$member_info['password'].'，已经向手机号'. substr($member_info['tel'],0,3).'****'.substr($member_info['tel'],-4) .'同步发送密码！','',5);
							}							
						}
					}
					else
					{
						$this->error('该会员未设置密码！');
					}
				}
				else
				{
					$this->error('未找到对应会员信息，请检查卡号是否输入正确！');
				}
			}
			else
			{
				$this->error('输入会员卡号不对，请重新输入！');
			}			
		}
		else
		{
			$view->assign('username',session('user')['truename']);
			return $view->fetch();
		}
	}	
	
	public function ticketList()
	{
		$request = Request::instance();
		$data_1 = array();
		$data_2 = array();
		$data_3 = array();
		$cardno = '';
		if($request->isPost()) {
			$cardno = $request->param('cardno', '', 'trim');
			$type = 1;
			$url = 'http://ailin.xicp.cn:8888/index/Index/getElectronTicket/cardno/' .$cardno. '/type/' .$type;
			$plain = file_get_contents($url);
			$data_1 = json_decode($plain, true);
			$type = 2;
			$url = 'http://ailin.xicp.cn:8888/index/Index/getElectronTicket/cardno/' .$cardno. '/type/' .$type;
			$plain = file_get_contents($url);
			$data_2 = json_decode($plain, true);
			$type = 3;
			$url = 'http://ailin.xicp.cn:8888/index/Index/getElectronTicket/cardno/' .$cardno. '/type/' .$type;
			$plain = file_get_contents($url);
			$data_3 = json_decode($plain, true);
		}
		$this->assign('cardno', $cardno);
		$this->assign('brand_new', $data_1);
		$this->assign('used', $data_2);
		$this->assign('expired', $data_3);
		return $this->fetch();
	}

	public function replace()
	{
		return $this->fetch();
	}

	public function getcardinfo($cardno = '')
	{
		if(empty($cardno)) {
			$this->error('卡号不能为空！');
		} else {
			$data = \think\Db::name('vip_replace')->where('cardno', $cardno)->find();
			//dump($data);
			if(is_array($data)) {
			
				//对时间戳进行转换	
				if($data['status'] ==0 && $data['r_time'] == NULL) {
					
				} else {
					$data['r_time'] = date('Y-m-d H:i:s', $data['r_time']);
				}						
				$this->success('查询成功!',null,$data);
			} else {
				$this->error('对不起，卡号不存在！');
			}
		}
	}

	public function replaceCard($cardno = '', $new_cardno = '')
	{
		if(empty($cardno) || empty($new_cardno)) {
			$this->error('卡号不能为空！');
		} else {
			$result = \think\Db::name('vip_replace')->where('cardno', $cardno)->where('status', 0)->update(['new_cardno'=>$new_cardno, 'status'=>1, 'r_time'=>time()]);
			if($result) {
				$this->success('查询成功!');
			} else {
				$this->error('兑换失败!');
			}
		}
	}

	public function newcard()
	{
		return $this->fetch();
	}

	private function build_content($tel, $pwd, $kf, $cardno)
	{
		$content_str="尊敬的会员，您的密码为：".$pwd."，查询时间：".date('n月d日G时i分',time())."，如非您本人申请请立即致电".$kf."。";
		//记录短信发送日志
		$data = array(
					'uid'=>session('user')['id'],
					'cardno'=>$cardno,
					'send_time'=>time(),
					'content'=>$content_str,
					'char'=>mb_strlen($content_str,'UTF8'),
					'telphone'=>$tel
				);
		Db::name('smslog')->insert($data);
		$dx = new \app\common\ORG\Jxtmsg('ailin','ma19340091',$tel,$content_str);		
		$dx->send();
	}
}
