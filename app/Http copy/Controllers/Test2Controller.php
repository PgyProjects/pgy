<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\weixin;
use DB;

require __DIR__ . '/weixin.php';
class Test2Controller extends Controller
{
    public function wang(){
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

		}
	}
}
