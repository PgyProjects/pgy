<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\File;
use App\weixin;
use DB;
use CustomerModel;
use CustomerInfoModel;
use CustomContectersModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class HomeController extends Controller
{
    public function index(){
    	/*
		echo 'wang1';
		//$users = DB::table('jxl_data1')->first();
		//$users=DB::table('jxl_data1')->where('xingming', '张晓成')->first();
		//var_dump($users);
		$weixin = new \class_weixin();
		var_dump($weixin);

		$openid = "";
			if (isset($_GET["openid"]) && !empty($_GET["openid"])){
				$openid = $_GET["openid"];
			}else{
				if (!isset($_GET["code"])){
					$redirect_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
					$jumpurl = $weixin->oauth2_authorize($redirect_url, "snsapi_userinfo", "123");
					Header("Location: $jumpurl");
				}else{
					$access_token = $weixin->oauth2_access_token($_GET["code"]);
					@$openid = $access_token['openid'];
			        @$userinfo = $weixin->oauth2_get_user_info($access_token['access_token'], $access_token['openid']);
			        echo $openid.$userinfo['nickname'];
			    }

		}*/
		wang_jiance_weixin();
		return view('home/index_1');
	}
	public function index_2(){
		wang_jiance_weixin();
		return view('home/index_2');
	}
	public function index_3(){
		//wang_jiance_weixin();
		return view('home/index_3');
	}
	public function index_4(){
		wang_jiance_weixin();
		return view('home/index_4');
	}
	public function index_3_jk(){
		return view('home/jk2');
	}
	public function index_4_tj_info(){
		return view('home/tj_info');
	}
	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-17 10:06:26
	 * @Description: 
	 */
	public function bd1(){
		//echo 'bd1';
		//wang_tishi('dasdsd');
		// @$jxl_user_data=$this->db->get_where('jxl_data1',array('weixin_openid'=>$_SESSION['openid']))->row_array();
		/*
		 if(!empty($jxl_user_data['shoujihao'])){//通过判断用户在第三页是否填写手机号判断
		 	//echo 'you shuju la!';
		 }else{
		 	//echo 'mei shuju';
		 }*/
			@$p_xingming=$_POST['xingming'];
			@$p_shoujihao=$_POST['shoujihao'];
			@$p_shenfenzheng=$_POST['shenfenzheng'];
			@$p_email=$_POST['email'];
			@$p_xueli=$_POST['xueli'];
			@$p_gongzuodanwei=$_POST['gongzuodanwei'];
			@$p_dangqianweizhi=$_POST['dangqianweizhi'];
			@$p_shouru=$_POST['shouru'];
			@$p_zhimafen = $_POST['zhimafen'];
			@$p_dizhi_1=$_POST['dizhi_1'];
			@$p_dizhi_2=$_POST['dizhi_2'];
			@$p_dizhi_3=$_POST['dizhi_3'];
			@$p_dizhi_4=$_POST['dizhi_4'];
			@$p_dizhi_5=$_POST['dizhi_5'];
			@$p_dizhi_6=$_POST['dizhi_6'];
			@$p_dizhi_7=$_POST['dizhi_7'];
			@$p_dizhi_8=$_POST['dizhi_8'];
			//var_dump($p_xingming);
		if(empty($p_xingming)){
			return view('home/bd/bd1');
			//$this->load->view('home/bd1');
			//echo $_SERVER['HTTP_USER_AGENT'];
			//if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"iphone")){
			  // $browser = "iphone";
			 // }elseif(strpos($_SERVER['HTTP_USER_AGENT'],"Linux")){
			  //	$browser = "Android";
			  //}
			//$shebei_data=explode(';', $_SERVER['HTTP_USER_AGENT']);
			//var_dump($shebei_data);
			//  echo $browser;
			//echo getIP();
			//$aa=DB::table('customers')->where('shenfenzheng', '330227199112212496')->first();
			//var_dump($aa);
				
	/*
			$model = new CustomerModel();
			$bd1_data=$model->where([
				'idCard'=>'330227199112212496'])->find();
			var_dump($bd1_data);*/
			//echo session('weixin_shenfen');

		}
		else{
			
			//$this->session->set_userdata('shenfenzheng', $p_shenfenzheng);
			session(['idCard' => $p_shenfenzheng]);
			//echo $_SESSION['idCard'];
			//$bd1_data=$this->db->get_where('jxl_data1',array('shenfenzheng'=>$p_shenfenzheng))->row_array();
			$model = new CustomerModel();
			$bd1_data=$model->where([
				'idCard'=>$p_shenfenzheng])->find();

			if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']),"iphone")){
			   $browser = "iphone";
			  }elseif(strpos($_SERVER['HTTP_USER_AGENT'],"Linux")){
			  	$browser = "Android";
			  }else{
			  	$browser = "未知";
			  }
			  $s=substr($p_shenfenzheng, -2,1);
			  if($s%2==0){
					//echo '偶数';
					//$sex='女';
			  		$sex='2';
					
				}else{
					//echo '基数';
					//$sex='男';
					$sex='1';
				}

			$url = "http://apis.juhe.cn/idcard/index";
			$params = array(
			      "cardno" => $p_shenfenzheng,//身份证号码
			      "dtype" => "",//返回数据格式：json或xml,默认json
			      "key" => "599b0c28c1abb0845974dd3494690770",//你申请的key
			);
			$paramstring = http_build_query($params);
			$content = juhecurl($url,$paramstring);
			$result = json_decode($content,true);
			if($result){
			    if($result['error_code']=='0'){
			       // print_r($result);
			    	//var_dump($result['result']['area']);
			    }else{
			        echo $result['error_code'].":".$result['reason'];
			    }
			}else{
			    echo "请求失败";
			}
			/*
				上传1
			*/
			//Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.jpg');
			$file1 = $_FILES['userfile1'];//得到传输的数据

			//var_dump($file1);
			//得到文件名称
			//var_dump($file1);
			$name1 = $file1['name'];


			$type1 = strtolower(substr($name1,strrpos($name1,'.')+1)); //得到文件类型，并且都转化成小写
			$allow_type = array('jpg','jpeg','png'); //定义允许上传的类型
			//判断文件类型是否被允许上传
			if(!in_array($type1, $allow_type)){
			  //如果不被允许，则直接停止程序运行
			  //return ;
				die('错误');
			}
			//判断是否是通过HTTP POST上传的
			if(!is_uploaded_file($file1['tmp_name'])){
			  //如果不是通过HTTP POST上传的
			  //return ;
			  die('错误');
			}
			$upload_path = '../uploads/shenfenzheng/'; //上传文件的存放路径
			//开始移动文件到相应的文件夹
			if(move_uploaded_file($file1['tmp_name'],$upload_path.'w_'.session('idCard').'_1.jpg')){
			 // echo "Successfully!";
			}else{
			 // echo "Failed!";
			}

			/*
				上传2
			*/
			$file2 = $_FILES['userfile2'];//得到传输的数据
			//得到文件名称
			//var_dump($file2);
			$name2 = $file2['name'];
			
			$type2 = strtolower(substr($name2,strrpos($name2,'.')+1)); //得到文件类型，并且都转化成小写
			$allow_type = array('jpg','jpeg','png'); //定义允许上传的类型
			//判断文件类型是否被允许上传
			if(!in_array($type2, $allow_type)){
			  //如果不被允许，则直接停止程序运行
			 // return ;
				die('错误');
			}
			//判断是否是通过HTTP POST上传的
			if(!is_uploaded_file($file2['tmp_name'])){
			  //如果不是通过HTTP POST上传的
			  //return ;
				die('错误');
			}
			$upload_path = '../uploads/shenfenzheng/'; //上传文件的存放路径
			//开始移动文件到相应的文件夹
			if(move_uploaded_file($file2['tmp_name'],$upload_path.'w_'.session('idCard').'_2.jpg')){
			 // echo "Successfully!";
			}else{
			 // echo "Failed!";
			}
			/*
				上传3
			*/
			$file3 = $_FILES['userfile3'];//得到传输的数据
			//得到文件名称
			//var_dump($file3);
			$name3 = $file3['name'];
			
			$type3 = strtolower(substr($name3,strrpos($name3,'.')+1)); //得到文件类型，并且都转化成小写
			$allow_type = array('jpg','jpeg','png'); //定义允许上传的类型
			//判断文件类型是否被允许上传
			if(!in_array($type3, $allow_type)){
			  //如果不被允许，则直接停止程序运行
			//  return ;
				die('错误');
			}
			//判断是否是通过HTTP POST上传的
			if(!is_uploaded_file($file3['tmp_name'])){
			  //如果不是通过HTTP POST上传的
			  //return ;
			  die('错误');
			}
			$upload_path = '../uploads/shenfenzheng/'; //上传文件的存放路径
			//开始移动文件到相应的文件夹
			if(move_uploaded_file($file3['tmp_name'],$upload_path.'w_'.session('idCard').'_3.jpg')){
			 // echo "Successfully!";
			}else{
			//  echo "Failed!";
			}
			

			if(empty($bd1_data['idCard'])){
				$in_data=array(
				'name'=>$p_xingming,
				'phone'=>$p_shoujihao,
				'idCard'=>$p_shenfenzheng,
				'email'=>$p_email,
				'education'=>$p_xueli,
				'company'=>$p_gongzuodanwei,
				'address'=>$p_dangqianweizhi,
				'shenfenzheng_img'=>serialize(array(1=>'w_'.session('idCard').'_1.jpg',2=>'w_'.session('idCard').'_2.jpg',3=>'w_'.session('idCard').'_3.jpg')),
				//'shouru'=>$p_shouru,
				//'shebei'=>$browser,
				'ip'=>getIP(),
				'sex'=>$sex,
				'age'=>getAgeByID($p_shenfenzheng),//年龄
				'hujidizhi'=>$result['result']['area'],
				//'time'=>date("Y-m-d H:i:s"),
				'wx_openid'=>session('openid'),
				//'weixin_name'=>$_SESSION['weixin_name'],
				//'weixin_touxiang'=>$_SESSION['weixin_touxiang'],
				//'weixin_sex'=>$_SESSION['weixin_sex'],
				//'weixin_shenfen'=>$_SESSION['weixin_shenfen'],
				'input_zhima'=>$p_zhimafen,//手动输入芝麻分
				'manager'=>'0'
				);

				if($model->insert($in_data)){
					//echo 'ok';
					//执行微信信息存入

					$in_weixin=array(
						'wxid'=>session('openid'),
						'wx_name'=>session('weixin_name'),
						'wx_img'=>session('weixin_touxiang'),
						'wx_sex'=>session('weixin_sex'),
						'wx_addr'=>session('weixin_shenfen')
						);
					$wx_model=new CustomerInfoModel;
					if($wx_model->insert($in_weixin)){
						wang_tiaozhuan(asset('home/bd2'));
					}else{
						echo $wx_model->error();

					}
					
				}else{
					echo $model->error();
				}

				//$this->db->insert('jxl_data1',$in_data);
				// echo 'ok';
				//wang_tiaozhuan(site_url('home/bd2').'?shenfenzheng='.$p_shenfenzheng);
			}else{
				//
                //die('dsadsada');
				//wang_tiaozhuan(site_url('home/bd2').'?shenfenzheng='.$p_shenfenzheng);
				wang_tishi('用户信息已存在');
			}
			//echo $p_xingming.$p_shenfenzheng.$p_email.$p_xueli.$p_gongzuodanwei.$p_shouru;
			

			}






	}
	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-17 10:06:31
	 * @Description: 
	 */
	public function bd2(){
		@$p_fuqin_xingming=$_POST['fuqin_xingming'];
		@$p_fuqin_shoujihao=$_POST['fuqin_shoujihao'];
		@$p_muqin_xingming=$_POST['muqin_xingming'];
		@$p_muqin_shoujihao=$_POST['muqin_shoujihao'];
		@$p_peiou_xingming=$_POST['peiou_xingming'];
		@$p_peiou_shoujihao=$_POST['peiou_shoujihao'];
		@$p_lingdao_xingming=$_POST['lingdao_xingming'];
		@$p_lingdao_shoujihao=$_POST['lingdao_shoujihao'];
		@$p_pengyou_xingming=$_POST['pengyou_xingming'];
		@$p_pengyou_shoujihao=$_POST['pengyou_shoujihao'];
		@$g_openid=$_GET['openid'];
		//echo $g_shenfenzheng;
		if(empty($p_fuqin_xingming)){
			return view('home/bd/bd2');
		}else{
			$jxl_user_data=DB::table('custom_contecters')->where('uid', session('openid'))->first();
			$jxl_user_data=(array)$jxl_user_data;
			if(empty($jxl_user_data)){
				//echo $_SESSION['shenfenzheng'];
				$CustomerContecters=new CustomContectersModel;

				$in_data=array(
					'fname'=>$p_fuqin_xingming,
					'fphone'=>$p_fuqin_shoujihao,
					'mname'=>$p_muqin_xingming,
					'mphone'=>$p_muqin_shoujihao,
					'pname'=>$p_peiou_xingming,
					'pphone'=>$p_peiou_shoujihao,
					'lname'=>$p_lingdao_xingming,
					'lphone'=>$p_lingdao_shoujihao,
					'yname'=>$p_pengyou_xingming,
					'yphone'=>$p_pengyou_shoujihao,
					'uid'=>session('openid')
					);
				//$this->db->where('shenfenzheng',$_POST['shenfenzheng']);
				//$this->db->update('jxl_data1',$in_data);
				if($CustomerContecters->insert($in_data)){
						//echo 'ok';
					DB::table('custom_forms')->insert(['uid'=>session('openid')]);
					wang_tishi('OK,提交成功！');
					wang_tiaozhuan(asset('home'));
					}else{
						echo $model->error();
					}
				//echo $p_fuqin_xingming.$p_fuqin_shoujihao;
				//echo 'ok';
				//wang_tiaozhuan(site_url('home/bd3').'?shenfenzheng='.$_POST['shenfenzheng']);



			}
			
			
		}



	}
	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-17 16:53:53
	 * @Description: 验证身份证合法性
	 */

	public function shenfenzheng_ajax(){
			@$p_shenfenzheng=$_POST['shenfenzheng'];
			$url = "http://apis.juhe.cn/idcard/index";
			$params = array(
			      "cardno" => $p_shenfenzheng,//身份证号码
			      "dtype" => "",//返回数据格式：json或xml,默认json
			      "key" => "599b0c28c1abb0845974dd3494690770",
			);
			$paramstring = http_build_query($params);
			$content = juhecurl($url,$paramstring);
			$result = json_decode($content,true);

			//echo $result['error_code'];
			$arr=array('code'=>$result['error_code']);
			echo json_encode($arr,true);
			//var_dump($result);
			//echo $p_shenfenzheng;
			/*
			if($result){
			    if($result['error_code']=='0'){
			       // print_r($result);
			    	//var_dump($result['result']['area']);
			    }else{
			        echo $result['error_code'].":".$result['reason'];
			    }
			}else{
			    echo "请求失败";
			}*/

	}
	/**
	 * @Author:      Wang
	 * @DateTime:    2016-11-17 14:06:25
	 * @Description: 控制图标 禁止点击接口
	 */
	public function kongzhi_ajax(){
		$kongzhi_data=DB::table('custom_forms')->where('uid', session('openid'))->first();
		$kongzhi_data=(array)$kongzhi_data;
		$user_data=DB::table('customers')->where('wx_openid', session('openid'))->first();
		$user_data=(array)$user_data;
		if($kongzhi_data['auth_jd']==0){
			$kongzhi_jd=0;
			$img_jd='jingdong.png';
		}else{
			$kongzhi_jd=1;
			$img_jd='jingdong2.png';
		}

		if($kongzhi_data['auth_tb']==0){
			$kongzhi_tb=0;
			$img_tb='taobao.png';
		}else{
			$kongzhi_tb=1;
			$img_tb='taobao2.png';
		}

		if($kongzhi_data['auth_yys']==0){
			$kongzhi_yys=0;
			$img_yys='yys.png';
		}else{
			$kongzhi_yys=1;
			$img_yys='yys2.png';
		}

		if($kongzhi_data['auth_zfb']==0){
			$kongzhi_zmf=0;
			$img_zmf='zmf.png';
			$dizhi_zmf='http://xinxi.pgyxwd.com/zmxy/index?mobileNo='.$user_data['phone'].'&certNo='.$user_data['idCard'].'&xingming='.$user_data['name'];
		}else{
			$kongzhi_zmf=1;
			$img_zmf='zmf2.png';
		}

		$arr=array(
			'kongzhi_zmf'=>$kongzhi_zmf,
			'dizhi_zmf'=>$dizhi_zmf,
			'img_zmf'=>$img_zmf,
			'kongzhi_yys'=>$kongzhi_yys,
			'dizhi_yys'=>asset('jxl/yys1'),
			'img_yys'=>$img_yys,
			'kongzhi_jd'=>$kongzhi_jd,
			'dizhi_jd'=>asset('jxl/jdqutoken'),
			'img_jd'=>$img_jd,
			'kongzhi_tb'=>$kongzhi_tb,
			'dizhi_tb'=>asset('jxl/tbqutoken'),
			'img_tb'=>$img_tb
			);
		wang_json($arr);

	}

}
