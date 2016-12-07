<?php
/**
 * Created by linzhonghuang.
 * User: linzh
 * Date: 2016/11/30
 * Time: 9:12
 */
namespace {
    const SMS_APPKEY = '23514240';
    const SMS_SECRETKEY = 'c16e18df6b96348a27ed930c613a2196';
}
namespace Library {

    class Utils
    {
        public static function sendPassSMS($name, $phone, $delay = 0)
        {
            if ($delay) {
                Timer::once('
    require_once __DIR__.\'/../../../Wang/taobao-sdk-sms/TopSdk.php\';
    require_once __DIR__.\'/../../../Wang/taobao-sdk-sms/top/TopClient.php\';
    $c = new TopClient;
    $c->appkey = \'' . SMS_APPKEY . '\';
    $c->secretKey = \'' . SMS_SECRETKEY . '\';
    $req = new AlibabaAliqinFcSmsNumSendRequest;
    $req->setExtend("");
    $req->setSmsType("normal");
    $req->setSmsFreeSignName("蒲公英小微贷");
    $req->setSmsParam("{name:\'' . $name . '\'}");
    $req->setRecNum(\'' . $phone . '\');
    $req->setSmsTemplateCode("SMS_25290121");
    $resp = $c->execute($req);', $delay);
            } else {
                wang_sms_chushentongguo($name, $phone);
            }
        }


        /**
         * @param $jump_url
         * @param $openid
         * @param int $delay 延迟的时间，延迟3600*3伪装成审核过程为3小时
         */
        public static function setFailureTemplate($jump_url, $openid, $delay = 10800)
        {
            Timer::once('
    require_once __DIR__.\'/../../../Wang/Muban.php\';
    $Muban = new Muban();
    $access_token = $Muban->fucktheaccess_token();
    $template_id = \'CLx3ExPL-LkY-ew76DXAFn8HhxqKgTtCtUGkIi9RjUI\';
    $urls = \'' . $jump_url . '\';//跳转地址
// 响应url
    $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token;
    $data = array(
        \'first\' => array(\'value\' => \'你的申请未通过！\'),
        \'keyword1\' => array(\'value\' => \'未通过\', \'color\' => \'#FF0000\'),
        \'keyword2\' => array(\'value\' => \'请点击查看原因\', \'color\' => \'#173177\'),
        \'keyword3\' => array(\'value\' => date("Y-m-d H:i:s"), \'color\' => \'#173177\'),
    );
    $Muban->fucktheWeChatmuban(\'' . $openid . '\', $template_id, $data, $url, $urls);
', $delay);
        }

        public static function setSuccessTemplate($jump_url, $openid, $delay = 0)
        {
            Timer::once('
    require_once __DIR__.\'/../../../Wang/Muban.php\';
    $Muban = new Muban();
    $access_token = $Muban->fucktheaccess_token();
    $template_id = \'j9Z7dMMVY_4A05rad7UabG6gaHCqia5DmAOac5LTIpA\';
    $urls = \'' . $jump_url . '\';//跳转地址
// 响应url
    $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token;
    $data = array(
        \'first\' => array(\'value\' => \'初审通过，请点击完善相关信息！\'),
        \'keyword1\' => array(\'value\' => \'初审通过\', \'color\' => \'#FF0000\'),
        \'keyword2\' => array(\'value\' => date("Y-m-d H:i:s"), \'color\' => \'#173177\'),
    );
    $Muban->fucktheWeChatmuban(\'' . $openid . '\', $template_id, $data, $url, $urls);
', $delay);
        }

        /**
         * @param $jump_url
         * @param $openid
         * @param string $template templateid
         * @param $data
         * @param int $delay
         */
        public static function setTemplate($jump_url, $openid, $template, $data, $delay = 0)
        {
            if (!is_array($data)) {
                $data = [
                    'first' => ['value' => $data],
                ];
            }
            Timer::once('
    require_once __DIR__.\'/../../../Wang/Muban.php\';
    $Muban = new Muban();
    $access_token = $Muban->fucktheaccess_token();
    $template_id = \'' . $template . '\';
    $urls = \'' . $jump_url . '\';//跳转地址
// 响应url
    $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token;
    $data = ' . var_export($data, true) . ';
    $Muban->fucktheWeChatmuban(\'' . $openid . '\', $template_id, $data, $url, $urls);
', $delay);
        }

    }
}

