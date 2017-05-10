<?php
/*
	吉信通发送短信接口
*/
namespace app\Common\ORG;

class Jxtmsg
{	
	const BASE_URL = "http://service.winic.org/sys_port/gateway/?";
	private $url='';
	
	public function __construct($id,$pwd,$to,$content,$time='')
	{
		if($id !='' && $pwd !='' && $to !='' && $content !='')
		{
			$data = array('id'=>$id,'pwd'=>$pwd,'to'=>$to,'content'=>iconv("UTF-8","GB2312//IGNORE",$content)/*对本参数进行转码UTF-8=>GB2312*/,'time'=>$time);
			
			$this->url = self::BASE_URL.http_build_query($data);
		}
		else
		{
			die('参数不能为空');
		}		
	}
	
	public function send()
	{
		$this->https_request($this->url);
	}
	
	private function https_request($url,$post_data=null)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		//curl_setopt($ch, CURLOPT_USERAGENT,'User-Agent:Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Maxthon/4.4.8.1000 Chrome/30.0.1599.101 Safari/537.36');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,0);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		if(!empty($post_data))
		{
			curl_setopt($ch,CURLOPT_POST,1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);	
		}
		$output = curl_exec($ch);
		curl_close($ch);
		return $output;
	}
}

