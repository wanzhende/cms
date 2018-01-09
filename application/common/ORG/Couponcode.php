<?php
namespace app\common\ORG;

class Couponcode
{
	private function mkCode($length = 4, $chars_option = 1)
	{
		switch($chars_option)
		{
			case 1:
				$chars = "0123456789";
				break;
			case 2:
				$chars = "abcdefghijklmnopqrstuvwxyz";
				break;
			case 3:
				$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
				break;
			default:
				return false;
		}
		//从数据库中取已经生成的代金券码，避免生成的券码重复		
		$couponCodeList = \think\Db::name('randcoupon')->column('code');
		do
		{
			$str ="";
			for ($j = 0; $j < $length; $j++ ) {
				$str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
			}
		} while(in_array($str, $couponCodeList));

		return $str;
	}

	private function batchCode($num = 1, $length = 6, $chars_option = 1)
	{
		switch($chars_option) {
			case 1:
				$chars = "0123456789";
				break;
			case 2:
				$chars = "abcdefghijklmnopqrstuvwxyz";
				break;
			case 3:
				$chars = "abcdefghijklmnopqrstuvwxyz0123456789";
				break;
			default:
				return false;
		}
		$code_arr = array();
		//从数据库中取已经生成的代金券码，避免生成的券码重复		
		$couponCodeList = \think\Db::name('randcoupon')->column('code');
		for($i = 0; $i < $num; $i++) {
			do {
				$str ="";
				for ($j = 0; $j < $length; $j++ ) {
					$str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
				}
			} while(in_array($str, $couponCodeList));
			$code_arr[] = $str;
		}
		return $code_arr;
	}

	public function batchCoupon($num = 0) {
		$code = $this->batchCode($num);
		$data = array();
		foreach($code as $key=>$value) {
			$data[$key]['code'] = $value;
			$data[$key]['money'] = 50;
		}
		\think\Db::name('randcoupon')->insertAll($data);
	}
	
	public function buildCoupon($min = 0, $max = 0 , $delay = 0, $start_time = 0, $end_time = 0)
	{
		//参数初始化
		if($min == 0 || $max == 0 )
		{
			return false;
		}
		$money =  mt_rand($min, $max);
		
		$start_time == 0 && $start_time = time();
		$start_time += $delay*60; //延迟生效
		$end_time ==0 && $end_time = strtotime(date('Y-m-d', $start_time + 86400*7)) + 86399;

		$code = $this->mkCode();
		$data = array('code'=>$code, 'money'=>$money, 'start_time'=>$start_time, 'end_time'=> $end_time);

		if(\think\Db::name('randcoupon')->where('code','eq',$code)->select()) {
			\think\Log::record('[错误]生成代金券号：'.$code.'在数据库中已存在','notice');
			return false;
		}

		if(\think\Db::name('randcoupon')->insert($data)) {
			return $data;
		} else {
			\think\Log::record('[错误]生成代金券号：'.$code.'写入数据库失败','notice');
			return false;
		}		
	}

	public function mkCoupon($money = 0, $start_time =0, $end_time =0)
	{
		//参数初始化
		$money == 0 && $money = mt_rand(48, 100);
		$start_time ==0 && $start_time = time();
		$end_time ==0 && $end_time = strtotime(date('Y-m-d', $start_time + 86400*3)) + 86399;
		
		$code = $this->mkCode();
		$data = array('code'=>$code, 'money'=>$money, 'start_time'=>$start_time, 'end_time'=> $end_time);
		if(\think\Db::name('randcoupon')->where('code','eq',$code)->select()) {
			\think\Log::record('[错误]生成代金券号：'.$code.'在数据库中已存在','notice');
			return false;
		}
		if(\think\Db::name('randcoupon')->insert($data)) {
			return $data;
		} else {
			\think\Log::record('[错误]生成代金券号：'.$code.'写入数据库失败','notice');
			return false;
		}
	}
	
	public function getCouponInfo($code)
	{
		$couponCode = \think\Db::name('randcoupon')->where('code','eq',$code)->find();
		if(is_array($couponCode)) {
			return $couponCode;
		} else {
			return false;
		}
	}
	
	public function validCoupon($code, $uid=0)
	{
		$couponCode = \think\Db::name('randcoupon')->where('status =0 and :nowtime between `start_time` and `end_time` and `code` = :code ', array('nowtime'=>array(time(),\PDO::PARAM_INT),'code'=>$code))->find();
		if(is_array($couponCode)) {
			$data = array('status'=>1, 'use_time'=>time() ,'uid'=>$uid);
			$result_num = \think\Db::name('randcoupon')->where('status =0 and :nowtime between `start_time` and `end_time` and `code` = :code ', array('nowtime'=>array(time(),\PDO::PARAM_INT),'code'=>$code))->update($data);
			if($result_num) {
				return true;
			} else { 
				return false;
			}
		} else {
			return false;
		}
	}
}