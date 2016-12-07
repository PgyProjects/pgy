<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use wang;
use DB;


class JxlapiController extends Controller
{
	/*******************taobao*******************/
	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-15 16:25:34
	 * @Description: 
	 */
	public function tbqutoken(){
		$jxl_user_data=DB::table('customers')->where('wx_openid', session('openid'))->first();
		$jxl_user_data=(array)$jxl_user_data;
		//$jxl_user_data=DB::table('jxl_data1')->where('shenfenzheng', '142701199002104216')->first();
			$url = "https://www.juxinli.com/orgApi/rest/v3/taobao/applications/pgyxxkj";
				$params = array(
					'apply_info'=>array(
							'basic_info'=>array(
								'name'=>$jxl_user_data['name'],
								'cell_phone_num'=>$jxl_user_data['phone'],
								'id_card_num'=>$jxl_user_data['idCard']
								)
						)
					
				      
				);
				$params=json_encode($params);
				$content = http_post_json($url,$params);
				$dd=json_decode($content,true);
				//echo $dd;
				//var_dump($dd);
				
				//echo $dd['data']['token'];
				$urls=asset('jxl/tb1').'?token='.$dd['data']['token'];
				wang_tiaozhuan($urls);

	}
	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-16 09:03:07
	 * @Description: 淘宝1页面
	 */
	public function tb1(){
		return view('home/taobao/tb1');

	}
	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-16 09:11:23
	 * @Description: 淘宝2页面
	 */
	public function tb2(){
		return view('home/taobao/tb2');
	}

	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-15 16:42:27
	 * @Description: 
	 */
	public function tb1_ajax(){
		//echo '123';
		
		$p_token=$_POST['token'];
		$p_tbname=$_POST['tbname'];
		$url = "https://www.juxinli.com/orgApi/rest/v3/taobao/message/collect/req/pgyxxkj";
				$params = array(
					'token'=>$p_token,
					'account'=>$p_tbname,
					'password'=>''//可以不填
					
				      
				);
				$params=json_encode($params);
				//echo $params;
				//echo '</br>';

				$content = http_post_json($url,$params);
				$dd=json_decode($content,true);
				//echo $content;
				$ddd=explode('_', $dd['data']['content']);
				$erweima=$ddd[1];
				$arr=array('erweima'=>$erweima,'tbname'=>$p_tbname,'token'=>$p_token,'code'=>1);
				echo json_encode($arr);

	}

	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-16 09:47:59
	 * @Description: 扫完二维码提交接口
	 */
	public function tb1_ajax_ok(){
		$jxl_user_data=DB::table('customers')->where('idCard', session('openid'))->first();
		$jxl_user_data=(array)$jxl_user_data;
		$p_token=$_POST['token'];
			$url = "https://www.juxinli.com/orgApi/rest/v3/taobao/messages/qrcodeCollect/resp/";
				$params = array(
					'token'=>$p_token
				);
				$params=json_encode($params);
				//echo $params;
				//echo '</br>';

				$content = http_post_json($url,$params);
				$dd=json_decode($content,true);
				echo $content;
				if($dd['data']['process_code']==10008){//查看淘宝授权成功
					//$this->db->where('shenfenzheng',$jxl_user_data['shenfenzheng']);
					//$this->db->update('jxl_data1',array('kongzhi_tb'=>1));
					//$jxl_tb=$this->db->get_where('jxl_tb',array('shenfenzheng'=>$jxl_user_data['shenfenzheng']))->row_array();
					$jxl_tb=DB::table('data_tb')->where('shenfenzheng', $jxl_user_data['idCard'])->first();
					$jxl_tb=(array)$jxl_tb;
					
					if(empty($jxl_tb)){
						$in_data=array(
						'token'=>$p_token,
						'shoujihao'=>$jxl_user_data['phone'],
						'shenfenzheng'=>$jxl_user_data['idCard']
						);
						//$this->db->insert('jxl_tb',$in_data);
						DB::table('data_tb')->insert($in_data);
						DB::table('custom_forms')->where('uid',session('openid'))->update(['auth_tb'=>1]);
					}else{
						//$this->db->where('shenfenzheng',$jxl_user_data['shenfenzheng']);
						//$this->db->update('jxl_tb',array('token'=>$p_token,'shoujihao'=>$jxl_user_data['shoujihao']));
						DB::table('data_tb')
							->where('shenfenzheng',$jxl_user_data['idCard'])
							->update(array('token'=>$p_token));
						DB::table('custom_forms')->where('uid',session('openid'))->update(['auth_tb'=>1]);
					}
					
				}

	}
	/*******************jd*******************/
	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-16 10:01:30
	 * @Description: 
	 */
	public function jdqutoken(){
		//$jxl_user_data=$this->db->get_where('jxl_data1',array('weixin_openid'=>$_SESSION['openid']))->row_array();
		//$jxl_user_data=DB::table('jxl_data1')->where('shenfenzheng', '142701199002104216')->first();
			$url = "https://www.juxinli.com/orgApi/rest/v3/applications/pgyxxkj";
				$params = array(
					'selected_website'=>array(array(
						"category"=>"e_business",
						"website"=>"jingdong"
						)),
					'skip_mobile'=>true,
					'basic_info'=>array(
						"name"=>'王聪',
					     "id_card_num"=>'330227199112212496',
					     "cell_phone_num"=>'18815277833'
						),
				);
				$params=json_encode($params);
				//echo $params;
				//echo '</br>';

				$content = http_post_json($url,$params);
				$dd=json_decode($content,true);
				//var_dump($content);

				
				if($dd['code']==65557){
					$urls=asset('jxl/jd1').'?token='.$dd['data']['token'].'&shoujihao=18815277833&website='.$dd['data']['datasource']['website'];
					echo '<script language="JavaScript">self.location="'.$urls.'"; </script>';
					
				}

				//$dd=json_encode($content,true);
				//var_dump($dd);
				//$dd=json_decode($content,true);
				//echo $content;

	}
	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-16 10:16:00
	 * @Description: 
	 */
	public function jd1(){
		@$p_token=$_POST['token'];
		@$p_shoujihao=$_POST['shoujihao'];
		@$p_password=$_POST['pwd'];
		if(empty($p_password)){
			return view('home/jd/jd1');
		}else{

			$token=$p_token;
			$account=$p_shoujihao;//手机号
			$password=$p_password;//手机密码
			$website='jingdong';

				$url = "https://www.juxinli.com/orgApi/rest/v2/messages/collect/req";
				$params = array(
				      "token"=>$token,
				      "account"=>$account,
				      "password"=>$password,
				      "website"=>$website
				);
				$params=json_encode($params);
				//echo $params;
				//$paramstring = http_build_query($params);
				//echo '</br>';
				//var_dump($paramstring);
				$content = http_post_json($url,$params);
				$dd=json_decode($content,true);
				//var_dump($dd);
				echo $content;

		}


	}
	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-16 10:45:18
	 * @Description: 
	 */
	public function jd2(){
		return view('home/jd/jd2');
	}
	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-16 10:46:34
	 * @Description: 
	 */
	public function jd3(){
		$g_token=$_GET['token'];
		$g_shoujihao=$_GET['shoujihao'];
		//$shouji=$this->db->get_where('jxl_jd',array('shoujihao'=>$g_shoujihao))->row_array();
		$shouji=DB::table('data_jd')->where('shoujihao', $g_shoujihao)->first();
		$shouji=(array)$shouji;
		if(empty($shouji)){
			//echo $g_token.$g_shoujihao;
			//$this->db->insert('jxl_jd',array('token'=>$g_token,'shoujihao'=>$g_shoujihao));
			DB::table('data_jd')->insert(array('token'=>$g_token,'shoujihao'=>$g_shoujihao));
			return view('home/jd/jd3');
		}else{
			//$this->db->where('shoujihao',$g_shoujihao);
			//$this->db->update('jxl_jd',array('token'=>$g_token));
			DB::table('data_jd')
					->where('shoujihao',$g_shoujihao)
					->update(array('token'=>$g_token));
			return view('home/jd/jd3');
		}
		
	}


	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-16 10:38:40
	 * @Description: 
	 */
	public function jd1_ajax(){
		@$p_token=$_POST['token'];
		@$p_shoujihao=$_POST['shoujihao'];
		@$p_password=$_POST['pwd'];

			$token=@$p_token;
			$account=@$p_shoujihao;//手机号
			$password=@$p_password;//手机密码
			$website='jingdong';
				$url = "https://www.juxinli.com/orgApi/rest/v2/messages/collect/req";
				$params = array(
				      "token"=>$token,
				      "account"=>$account,
				      "password"=>$password,
				      "website"=>$website
				);
				$params=json_encode($params);
				//echo $params;
				//$paramstring = http_build_query($params);
				//echo '</br>';
				//var_dump($paramstring);
				$content = http_post_json($url,$params);
				$dd=json_decode($content,true);
				//var_dump($dd);
				echo $content;

	}

	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-16 11:09:54
	 * @Description: 
	 */
	public function jd2_ajax(){
		@$p_token=$_POST['token'];
		@$p_shoujihao=$_POST['shoujihao'];
		@$p_password=$_POST['pwd'];
		@$p_yzm=$_POST['yzm'];
			$url = "https://www.juxinli.com/orgApi/rest/v2/messages/collect/req";
				$params = array(
				      "token"=>$p_token,
				      "account"=>$p_shoujihao,
				     "password"=>$p_password,
				      "captcha"=>$p_yzm,//验证码 页面用户填写获取过来
				      "type"=>"SUBMIT_CAPTCHA",//提交短信验证码
				      "website"=>'jingdong' //get 获取过来 

				);
			$params=json_encode($params);
			$content = http_post_json($url,$params);
			$dd=json_decode($content,true);
			//var_dump($dd);
			echo $content;
			
			if(@$dd['data']['process_code']==10008){//OK
				$kongzhi_data=DB::table('custom_forms')->where('uid', session('openid'))->first();
				$kongzhi_data=(array)$kongzhi_data;
				DB::table('custom_forms')
						->where('uid',session('openid'))
						->update(['auth_jd'=>1]);
				//$this->db->where('shoujihao',$p_shoujihao);
				//$this->db->update('jxl_data1',array('kongzhi_jd'=>1));
				
			}

	}
	/*******************yys*******************/
	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-16 13:27:20
	 * @Description: 立木运营商 第一步登录 获取短息验证码
	 */
	public function yys1(){
		return view('home/yys/yys1');
			

	}

	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-16 13:34:02
	 * @Description: 
	 */
	public function yys1_ajax(){

		@$p_username=$_POST['shoujihao'];
		@$p_password=base64_encode($_POST['password']);
		//配置您申请的appkey
			$appkey = "6392035567178527";
			//$password=base64_encode("172458");
			//echo $password;
			//$username="18815277833";
			 
			 //计算签名
			$s=array('method','apiKey','version','username','password');
			ksort($s);
			//var_dump($s);
			$d=array($s['1']=>$appkey,$s['0']=>'api.mobile.get',$s['4']=>$p_password,$s['3']=>$p_username,$s['2']=>'1.0.0xxU1AAtC7LnDhFRcHVD4NmZFjhT8CyJJ');
			//echo http_build_query($d);//拼接得到字符串
			//echo '</br></br>';
			//var_dump($d);
			$sign=sha1(http_build_query($d));//对该字符串进行 SHA-1 计算，得到签名，并转换成 16 进制小写编码
			//echo $sign;
			//$str='method=api.mobile.get&apiKey=123456&version=1.0.0xxU1AAtC7LnDhFRcHVD4NmZFjhT8CyJJ';
			//echo sha1($str);

			$url = "https://api.limuzhengxin.com/api/gateway";
			$params = array(
			      "method" => "api.mobile.get",//
			      "apiKey" => $appkey,//
			      "version" => "1.0.0",
			      "sign"=>$sign,
			      "username"=>$p_username,
			      "password"=>$p_password
			);
			$paramstring = http_build_query($params);
			//var_dump($paramstring);
			$content = curl($url,$paramstring);
			$result = json_decode($content,true);
			//var_dump($content);
			if($result){
			    if($result['code']=='0'){
			      // print_r($result);

			    }else{
			        //echo $result['code'].":".$result['msg'];
			    }
			}else{
			    echo "请求失败";
			  // var_dump($result);
			}
			if($result['code']=='0010' and $result['msg']=='受理成功'){
				//echo '第一步OK，输入短信验证码';
				//echo $result;
				wang_json(['msg'=>'ok','token'=>$result['token'],'shoujihao'=>$p_username]);

				//$url=asset('yys/yys2').'?token='.$result['token'].'&username='.$p_username;
				//Header("Location: $url");
			}elseif($result['code']=='1002' and $result['msg']=='验证签名失败'){
				//echo "<script>alert('账号密码错误，请重试！');</script>";
				//$this->load->view('yys/yys1',array('tishi'=>'账号密码错误，请重试！'));
				//return view('home/yys/yys1',array('tishi'=>'账号密码错误，请重试！'));
				wang_json(['msg'=>0]);
				//$url=site_url('yys/yys1');
				//Header("Location: $url");
			}

	}

	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-16 13:31:15
	 * @Description: 立木运营商 第二步登录 填写手机验证码
	 */
	public function yys2(){
			return view('home/yys/yys2');

	}

	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-16 14:13:31
	 * @Description: 
	 */
	public function yys2_ajax(){
		$p_smsCode=$_POST['smsCode'];
		$p_token=$_POST['token'];
		$p_username=$_POST['shoujihao'];
	
		$appkey = "6392035567178527";
		$token=$p_token;
		 //计算签名
		$s=array('method','apiKey','version','token','smsCode');
		asort($s);
		//var_dump($s);
		$d=array($s['1']=>$appkey,$s['0']=>'api.mobile.sendSms',$s['4']=>$p_smsCode,$s['3']=>$p_token,$s['2']=>'1.0.0xxU1AAtC7LnDhFRcHVD4NmZFjhT8CyJJ');
	
		$sign=sha1(http_build_query($d));
		$url = "https://api.limuzhengxin.com/api/gateway";
		$params = array(
		      "method" => "api.mobile.sendSms",//
		      "apiKey" => $appkey,//
		      "version" => "1.0.0",
		      "sign"=>$sign,
		      "token"=>$p_token,
		      "smsCode"=>$p_smsCode
		);
		$paramstring = http_build_query($params);
		//echo '</br>';
		//var_dump($paramstring);
		$content = curl($url,$paramstring);
		$result = json_decode($content,true);
		//var_dump($content);
		if($result){
		    if($result['code']=='0'){
		        //print_r($result);
		    }else{
		       // echo $result['code'].":".$result['msg'];
		    }
		}else{
		    echo "请求失败";
		  // var_dump($result);
		}
		if($result['code']=='0009' and $result['msg']=='写入成功'){
						//echo 'ok，用户授权成功！';//写入数据库
			/*
						$token_name=$this->db->get_where('yys_token',array('login_name'=>$g_username))->row_array();
						if(empty($token_name)){
							$this->db->insert('yys_token',array('login_name'=>$g_username,'yys_token'=>$g_token));
						}else{
							$this->db->where('login_name',$g_username);
							$this->db->update('yys_token',array('yys_token'=>$g_token,'chakan'=>'0'));
						}*/
						//echo "<script>alert('ok，用户授权成功！');</script>";
						//$kongzhi_data=DB::table('custom_forms')->where('uid', session('openid'))->first();
						$token_name=DB::table('data_yys')->where('token', $p_token)->first();
						if(empty($token_name)){
							DB::table('data_yys')->insert(array('shoujihao'=>$p_username,'token'=>$p_token));
						}else{
							DB::table('data_yys')
								->where('shoujihao',$p_username)
								->update(array('shoujihao'=>$p_username,'token'=>$p_token));
						}
						DB::table('custom_forms')
								->where('uid',session('openid'))
								->update(['auth_yys'=>1]);

						wang_json(['msg'=>'ok']);
		}elseif($result['code']=='1002' and $result['msg']=='验证签名失败'){
						//echo '错误，请重试！';
						//$this->load->view('yys/yys2',array('tishi'=>'错误，请重试！'));
						wang_json(['msg'=>0]);
		}


	}
	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-21 09:47:24
	 * @Description: dingding
	 */
	public function dd_hd(){
		header('Location:https://oapi.dingtalk.com/connect/qrconnect?appid=dingoaumbd18es6ytun76o&response_type=code&scope=snsapi_login&state=STATE&redirect_uri=http://test.pgyxwd.com/admin/hd2');
	}
	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-21 09:50:30
	 * @Description: dingding
	 */
	public function dd_hd2(){
		@$g_code=$_GET['code'];
			$url = "https://oapi.dingtalk.com/sns/get_sns_token?access_token=c55d9fd4ad4a363390f9cfcfb73f1b87";
				$params = array(
				    
				      "openid"=>'3ChjyXUVLCLkii2wm8Ag6sQiEiE',
				      "persistent_code"=>'qGqBa3uLD1RU9L5nSnoLWeFWj4Tftc-dagrfKRy1quaGalYkLRKwkF2MK0G3oWnD' //get 获取过来 

				);
			$params=json_encode($params);
			$content = http_post_json($url,$params);
			//var_dump($content);
			$dd=json_decode($content,true);
 	 	 //echo '回调';
 	 	 if(!empty($g_code)){
 	 	 	wang_tiaozhuan(asset('admin/hd3').'?code='.$g_code);
 	 	 }
	}
	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-21 09:50:51
	 * @Description: dingding
	 */
	public function dd_hd3(){
		@$g_code=$_GET['code'];

		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://oapi.dingtalk.com/sns/gettoken?appid=dingoaumbd18es6ytun76o&appsecret=frYur1nvutr5guAujsB9wZyiDTO1XhpIbWleq2Gh795guBo8j1uwloEM4xehL-DF",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    	CURLOPT_SSL_VERIFYPEER=>false,
    	CURLOPT_SSL_VERIFYHOST=>false,
    	CURLOPT_SSLVERSION=>1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_HTTPHEADER => array(
		   
		    "content-type: application/json; charset=utf-8"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);
			
			//var_dump($response);
			$dd=json_decode($response,true);
			if($dd['errmsg']=='ok'){
					$url = "https://oapi.dingtalk.com/sns/get_persistent_code?access_token=".$dd['access_token'];
						$params = array(
						    
						      "tmp_auth_code"=>$g_code

						);
					$params=json_encode($params);
					$content = http_post_json($url,$params);
					$ddd=json_decode($content,true);
					//var_dump($content);
						if($ddd['errmsg']=='ok'){
							$url2 = "https://oapi.dingtalk.com/sns/get_sns_token?access_token=".$dd['access_token'];
								$params2 = array(
								    
								      "openid"=>$ddd['openid'],
								      "persistent_code"=>$ddd['persistent_code']

								);
							$params2=json_encode($params2);
							$content2 = http_post_json($url2,$params2);
							//var_dump($content2);
							$dddd=json_decode($content2,true);
							if($dddd['errmsg']=='ok'){
									$curl = curl_init();
									curl_setopt_array($curl, array(
									  CURLOPT_URL => "https://oapi.dingtalk.com/sns/getuserinfo?sns_token=".$dddd['sns_token'],
									  CURLOPT_RETURNTRANSFER => true,
									  CURLOPT_ENCODING => "",
									  CURLOPT_MAXREDIRS => 10,
									  CURLOPT_TIMEOUT => 30,
									  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
							    	CURLOPT_SSL_VERIFYPEER=>false,
							    	CURLOPT_SSL_VERIFYHOST=>false,
							    	CURLOPT_SSLVERSION=>1,
									  CURLOPT_CUSTOMREQUEST => "GET",
									  CURLOPT_HTTPHEADER => array(
									   
									    "content-type: application/json; charset=utf-8"
									  ),
									));

									$response2 = curl_exec($curl);
									$err = curl_error($curl);

									curl_close($curl);
			
									//var_dump($response);
									$dd_ok=json_decode($response2,true);
									//var_dump($dd_ok);
									if($dd_ok['errmsg']=='ok'){
										//$admin_user=$this->db->get_where('admin_user',array('dd_openid'=>$dd_ok['user_info']['openid']))->row_array();
										//if(!empty($admin_user)){
											//$this->session->set_userdata(array('admin_user'=>$admin_user['username']));
											//wang_tishi('登陆成功！');
											//wang_tiaozhuan(site_url('admin'));
										//}
										

									}

								}
					}



			}
 	 	
	}
/************芝麻信用************/
	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-21 10:22:28
	 * @Description: 获取回调params的信息解密拿open_id
	 */
	public function zmxyopenid(){
		@$g_params=urlencode($_GET['params']);
		@$g_sign=urlencode($_GET['sign']);
		//$this->load->library('TestGetOpenIDWithCallBackUrl');
		
		$obj = new \TestGetOpenIDWithCallBackUrl();
		$obj->encryptedParam=$g_params;
		$obj->sign=$g_sign;

		   // echo $g_params.'</br>'.$g_sign;
		    $dd=$obj->testCreditWatchListiiGet();
		    //echo $dd;
		   // $d1=json_decode($dd, true);

			$d1=explode('&', $dd);

			$d2=explode('=', $d1['0']);//用于取openid
			$d3=explode('=', $d1['2']);//用于取个人信息
			$d4=urldecode($d3[1]);
			$d5=explode('|', $d4);

			$openid=$d2[1];//获得openid

			//var_dump($d5);
			//$d5[0]//手机号
			//$d5[1]//身份证
			//$d5[2]//姓名

			//$shouji=explode('=', $d1);
			//var_dump($shouji);
			
			//$shoujihao=$shouji[1];//获得手机号
			//echo $shoujihao;
			//echo $openid;
			
			if(strlen($openid)==27){
					//$data=$this->db->get_where('zmxy',array('zmxy_openid'=>$openid))->row_array();
					//var_dump($data);
					/*
					if(empty($data)){
						$s=substr($d5[1], -2,1);
						if($s%2==0){
							//echo '偶数';
							$sex='女';
						}else{
							//echo '基数';
							$sex='男';
						}*/
						//$this->db->insert('zmxy',array('zmxy_openid'=>$openid,'shoujihao'=>$d5[0],'xingming'=>$d5[2],'shenfenzheng'=>$d5[1],'sex'=>$sex));
						//$this->db->order_by('id', 'DESC');
						//$data2=$this->db->get('zmxy')->row_array();
						//$this->load->library('TestZhimaCreditScoreGet');
						$g=new \TestZhimaCreditScoreGet();
						$g->openid=$openid;
						$g->TransactionId=date('YmdHis').rand();
						$d1=$g->testZhimaCreditScoreGets();
						$arr=json_decode($d1,true);
						echo $arr['zm_score'];//获得芝麻分
						
	
						
						
							//$this->db->where('zmxy_openid',$openid);
							//$this->db->update('zmxy',array('zmxy_zmfen'=>$d3[3],'TransactionId'=>date('YmdHis').$data2['TransactionId']+1,'time'=>date('Y-m-d H:i:s')));
							//$this->db->where('shenfenzheng',$d5[1]);
							//$this->db->update('jxl_data1',array('zhen_zhimafen'=>$d3[3]));
						
						//echo 'ok!';
						//echo '<script language="JavaScript">self.location="http://test.pgyxwd.com/home"; </script>';
						//echo 'ok!';
					}else{
						//$this->db->order_by('id', 'DESC');
						//$data2=$this->db->get_where('zmxy',array('zmxy_openid'=>$openid))->row_array();
						//$this->load->library('TestZhimaCreditScoreGet');
						$g=new \TestZhimaCreditScoreGet();
						$g->openid=$openid;
						$g->TransactionId=$data2['TransactionId'];
						$d1=$g->testZhimaCreditScoreGets();
						//echo $d1['zm_score'];
						
						$d2=explode(',', $d1);
						//var_dump($d2[3]);
						$d3=explode('"', $d2[2]);
						//var_dump($d3);
						//echo $d3[3];//获得芝麻分
						
						
							//$this->db->where('zmxy_openid',$openid);
							//$this->db->update('zmxy',array('zmxy_zmfen'=>$d3[3],'TransactionId'=>$data2['TransactionId'],'time'=>date('Y-m-d H:i:s')));
							//$this->db->where('shenfenzheng',$d5[1]);
							//$this->db->update('jxl_data1',array('zhen_zhimafen'=>$d3[3]));
						
						//echo 'ok!';
						//echo '<script language="JavaScript">self.location="http://test.pgyxwd.com/home"; </script>';
					}
					
			}
			
			
		   // echo '<script language="JavaScript">self.location="'.site_url('neibu/login').'"; </script>';


	
	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-21 10:24:35
	 * @Description: 让用户进行芝麻信用授权
	 */
	public function zmxyindex(){
		@$g_mobileNo=$_GET['mobileNo'];//手机号
		@$g_certNo=$_GET['certNo'];//身份证
		@$g_xingming=$_GET['xingming'];//姓名
		if(empty($g_mobileNo) or empty($g_certNo) or empty($g_xingming)){
			//$this->load->view('zmxy/index');
		}else{
			//$this->load->library('TestAuthFreeze');
			$s=new \TestAuthFreeze();
			$s->certNo=$g_certNo;
			$s->name=$g_xingming;
			$s->mobileNo=$g_mobileNo;
			$url=$s->generatePcPageAuthUrl();
			echo '<script language="JavaScript">self.location="'.$url.'"; </script>';
			//echo $url;
		}
		
	}

/************短信接口************/
/**
 * @Author:      Wang
 * @DateTime:    2016-11-21 11:11:45
 * @Description: 阿里短信接口
 * 参数一：姓名
 * 参数二：手机号
 */
	public function sms(){
		wang_sms_chushentongguo('王聪','18815277833');
	}

/************微信模板消息************/
/**
 * @Author:      Wang
 * @DateTime:    2016-11-21 11:21:14
 * @Description: 微信模板消息
 * 参数一：微信openid
 */
	public function wang_weixin_msg1(){
		wang_weixin_msg_yuqi('ohyMUwpUSz6BxFkbpFXTQdVpEJg8');
	}

	







}