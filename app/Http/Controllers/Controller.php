<?php

namespace App\Http\Controllers;

use class_weixin;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Library\Dao;
use Library\Input;

require_once __DIR__ . '/../../autoload.php';

/**
 * Class Controller
 *
 * @property Input $input
 * @property Dao $db
 *
 * @package App\Http\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected function checkWx()
    {
        $weixin = new class_weixin();
        $openid = "";
        if (isset($_GET["openid"]) && !empty($_GET["openid"])) {
            $openid = $_GET["openid"];
        } else {
            if (!isset($_GET["code"])) {
                $redirect_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                $jumpurl = $weixin->oauth2_authorize($redirect_url, "snsapi_userinfo", "123");
                header("Location: $jumpurl");
            } else {
                $access_token = $weixin->oauth2_access_token($_GET["code"]);
                @$openid = $access_token['openid'];
                @$userinfo = $weixin->oauth2_get_user_info($access_token['access_token'], $access_token['openid']);
                //echo $openid.$userinfo['nickname'];
                session([
                    'access_token' => $access_token['access_token'],
                    'openid' => $openid, 'weixin_name' => $userinfo['nickname'], 'weixin_touxiang' => $userinfo['headimgurl'], 'weixin_sex' => $userinfo['sex'], 'weixin_shenfen' => $userinfo["province"]]);
            }
        }
    }

    /**
     * 显示错误提示框
     * @param $message
     */
    protected function showAlert($message)
    {
        ob_get_level() and ob_end_clean();//清空之前的输出
        die("<script>alert(\"{$message}\");</script>");
    }

    public function __get($name)
    {
        static $instances = [];
        if (!isset($instances[$name])) {
            switch ($name) {
                case 'db':
                    $instances[$name] = Dao::getInstance();
                    break;
                case 'input':
                    $instances[$name] = new Input();
                    break;
            }
        }
        return $instances[$name];
    }
}
