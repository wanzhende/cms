<?php

namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Request;
use think\Cache;

class Dingtalk extends Controller
{
    private $params = array();
    private $corpID = '';
    private $corpSecret = '';
    private $access_token = '';
    private $jsapi_ticket = '';
    public function __construct($corpID = '', $corpSecret = '')
    {
        $this->corpID = empty($corpID) ? 'dingf07faf331bd604a8' : $corpID;        
        $this->corpSecret = empty($corpSecret) ? '2XRo-BuBX9xvQ2JKV-kvB04ca_jyD0_WXIjk0UKZcpu2GbvqAIfiGdSCbjyf44ug' : $corpSecret;
        //dump($_SERVER['HTTP_USER_AGENT']);
    }

    public function getAccesstoken()
    {
        $access_token = Cache::get('dd_access_token') ?: $this->updateAccesstoken($this->corpID, $this->corpSecret);
        $this->access_token = $access_token;
        return $access_token;
    }

    //从服务器刷新access_token
    private function updateAccesstoken($corpID = '', $corpSecret= '')
    {
        $plain = $this->https_request("https://oapi.dingtalk.com/gettoken?corpid={$corpID}&corpsecret={$corpSecret}");
        $data = json_decode($plain, true);
        if($data['errcode'] == 0) {
            Cache::set('dd_access_token', $data['access_token'], 7200);
            return $data['access_token'];
        } else {
            return false;
        }
    }

    public function getJSAPIticket()
    {
        $jsapi_ticket = Cache::get('dd_jsapi_ticket') ?: $this->updateJSAPIticket($this->access_token);
        $this->jsapi_ticket = $jsapi_ticket;
        return $jsapi_ticket;
    }

    private function updateJSAPIticket($access_token = '')
    {
        $plain = $this->https_request("https://oapi.dingtalk.com/get_jsapi_ticket?access_token={$this->access_token}");
        $data = json_decode($plain, true);
        if($data['errcode'] == 0) {            
            Cache::set('dd_jsapi_ticket', $data['ticket'], 7200);
            return $data['ticket'];
        } else {
            return false;
        }
    }

    public function getUserinfo($code = '')
    {
        $access_token = $this->getAccesstoken();
        $plain = $this->https_request("https://oapi.dingtalk.com/user/getuserinfo?access_token={$access_token}&code={$code}");
        $data = json_decode($plain, true);
        if($data['errcode'] == 0) {
            return $data;
        } else {
            return false;
        }
    }    

    public function setParams($key, $value)
    {
        $this->params[$key] = $value;
    }

    private function getSignature()
    {
        $this->getAccesstoken();       
        if($this->access_token) {
            $this->getJSAPIticket();
            $this->setParams('jsapi_ticket', $this->jsapi_ticket);
        } else {
            return false;
        }
        $this->setParams('noncestr', $this->createNonceStr());
        ksort($this->params, SORT_STRING);
        $plain = urldecode(http_build_query($this->params));
        return sha1($plain);
    }

    public function getParams()
    {
        $this->params['signature'] = $this->getSignature();
        if($this->params['signature']) {
            return $this->params;
        } else {
            return false;
        }        
    }

    private function createNonceStr($length = 32) 
	{
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
		$str ="";
		for ( $i = 0; $i < $length; $i++ )  {  
			$str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
		} 
		return $str;
	}

    public function https_request($url,$post_data=null)
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