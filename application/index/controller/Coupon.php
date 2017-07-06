<?php
namespace app\index\controller;

use think\Request;
use think\Db;

class Coupon extends \app\common\controller\Indexbase
{
	public function buildCode($money = 0)
	{
		if(session('user')['id'] ==4 ) {
			$coupon = new \app\common\ORG\Couponcode();
			$data = $coupon->mkCoupon($money);
			if(is_array($data)) {
				$str = "券号：{$data['code']}，<br/>金额：{$data['money']}元，<br/>有效期：". date('Y-m-d H:i:s', $data['start_time']).'至'.date('Y-m-d H:i:s', $data['end_time']).'。<br />'.'限商丘地区门店使用，每桌限用1张，券号交收银员核销即可，本券不退现不找零、不能单独点酒水、不能与其它优惠活动一同使用(团购、充值卡、打折等)';
				echo $str;
			} else {
				$this->error('生成代金券错误!');
			}
		} else {
			$this->error('非法请求，您并没有生成代金券的权限!');
		}		
	}

	public function batchCode() {
		$coupon = new \app\common\ORG\Couponcode();
		$coupon->batchCoupon(100);
	}

	public function createCoupon()
	{
		$request = Request::instance();
		if($request->isGet()) {
			return $this->fetch();
		} else {
			$coupon = new \app\common\ORG\Couponcode();
			//获取提交的变量
			$min_money = $request->param('min_money', 50, 'floatval');
			$max_money = $request->param('max_money', 50, 'floatval');
			$delay = $request->param('delay', 0 , 'intval');
			$start_time = $request->param('start_time', '', 'trim');
			$end_time = $request->param('end_time', '', 'trim');

			if($start_time == date('Y-m-d', time())) {
				$start_time = time();
			} else {
				$delay = 0;
			}

			$end_time = strtotime($end_time) + 86399;
			$data = $coupon->buildCoupon($min_money, $max_money, $delay, $start_time, $end_time);
			if($data) {
				$data['rule'] = '限商丘地区门店使用，每桌限用1张，券号交收银员核销即可，本券不退现不找零、不能单独点酒水、不能与其它优惠活动一同使用(团购、充值卡、打折等)';
				$this->assign('coupon',$data);				
				return $this->fetch('newcoupon');
			} else {
				$this->error('生成代金券失败,请重试！');
			}
			//dump($_POST);
		}
	}

	public function newcoupon()
	{
		$data = array('code'=>'', 'money'=>'', 'start_time'=>0, 'end_time'=>0, 'rule'=>'');
		$this->assign('coupon', $data);
		return $this->fetch();
	}
	
	public function coupon()
	{
		return $this->fetch();
	}

	public function getCouponInfo($code='')
	{		
		if(empty($code)) {
			$this->error('券号不能为空！');
		} else {
			$coupon = new \app\common\ORG\Couponcode();
			$data = $coupon->getCouponInfo($code);
			if(is_array($data)) {
				
				//判断是否在有效期范围内
				$current_time = time();
				if($current_time > $data['start_time'] && $current_time < $data['end_time']) {
					$data['expired'] = 0;
				} else {
					$data['expired'] = 1;
				}				
				
				//对时间戳进行转换	
				$data['start_time'] = date('Y-m-d H:i:s', $data['start_time']);
				$data['end_time'] = date('Y-m-d H:i:s', $data['end_time']);
				$data['use_time'] = $data['use_time']==0 ? $data['use_time'] : date('Y-m-d H:i:s', $data['use_time']);
				
				//转换名称
				$data['uid'] != 0 && $data['name'] = \think\Db::name('user')->where('id','eq',$data['uid'])->value('truename');
								
				$this->success('查询成功!',null,$data);
			} else {
				$this->error('对不起，券号不存在！');
			}
		}
	}
	
	public function validCoupon($code='')
	{
		$uid = session('user')['id'];
		if(empty($code)) {
			$this->error('券号不能为空！');
		} else {
			$coupon = new \app\common\ORG\Couponcode();
			$result = $coupon->validCoupon($code, $uid);
			if($result) {
				$this->success('券号['.$code.']核销成功！');
			} else {
				$this->error('对不起，验证失败，券号不存在或已被使用！');
			}
		}		
	}
	
	public function couponList($start_time = '', $end_time = '')
	{
		//时间参数初始化
		$start_time = empty($start_time) ? strtotime(date('Y-m-d',time())) : strtotime($start_time);
		$end_time = empty($end_time) ? strtotime(date('Y-m-d',time())) + 86399 : strtotime($end_time) + 86399;
		$end_time < $start_time && $end_time = $start_time + 86399;
		
		if(!empty($start_time) && !empty($end_time)) {
			$list = Db::name('randcoupon')->where(array('uid'=>session('user')['id'], 'status'=>1, 'use_time'=>array('between', [$start_time, $end_time])))->order('use_time desc')->select();
			$sum = Db::name('randcoupon')->where(array('uid'=>session('user')['id'], 'status'=>1, 'use_time'=>array('between', [$start_time, $end_time])))->sum('money');
		}
		
		$request_method = Request::instance();
		
		if($request_method->isAjax()) {
			foreach($list as $key=>$value) {
				$list[$key]['use_time'] = date('Y-m-d H:i:s',$list[$key]['use_time']);
			}
			return json($list);
		} elseif ($request_method->isGet()) {
			$this->assign('sum',$sum);
			$this->assign('list',$list);
			return $this->fetch();
		} else {
			$this->error('非法'.$request_method->method().'请求!');
		}			
	}

	public  function test()
	{
		$couponCodeList = \think\Db::name('randcoupon')->column('code');
		echo '<pre>';
		var_export(array_values($couponCodeList));
	}
}
