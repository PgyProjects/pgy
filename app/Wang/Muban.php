<?php

/**
* 模板发送类
*2016年9月30日15:20:00
*@name:wang
*/
class Muban{
	public $appid = 'wx29530c2c3cf68e00';
	public $secrect ='9f9963690d22924e6682a79e081e93d4';
	// 获取access_token
	public function fucktheaccess_token(){
			$token_access_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appid."&secret=".$this->secrect;
			$res = file_get_contents($token_access_url); //获取文件内容或获取网络请求的内容
			//echo $res;
			$result = json_decode($res, true); //接受一个 JSON 格式的字符串并且把它转换为 PHP 变量
			$access_token = $result['access_token'];
			return $access_token;
	}
	// 发送模板消息
	/* @ $openid 接收者的openid
	*@ $template_id 模板的id
	*@ $data 要发送的内容
 	*@ $url 提交响应
	*
	*/
	public function fucktheWeChatmuban($openid,$template_id,$data,$url,$urls){

		$this->fucktheaccess_token();
		$template_msg=array('touser'=>$openid,'template_id'=>$template_id,'topcolor'=>'#FF0000','data'=>$data,'url'=>$urls); 
		$curl = curl_init($url);
		$header = array();
		$header[] = 'Content-Type: application/x-www-form-urlencoded';
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		// 不输出header头信息
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		// 伪装浏览器
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
		// 保存到字符串而不是输出
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		// post数据
		curl_setopt($curl, CURLOPT_POST, 1);
		// 请求数据
		curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($template_msg));
		$response = curl_exec($curl);
		curl_close($curl);
		$arr = json_decode($response,true);
		return $arr['errmsg'];
	}
}

?>
