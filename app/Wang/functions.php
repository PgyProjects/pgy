<?php
require __DIR__ . '/weixin.php';
function wang_tishi($neirong)
{
    echo "<script>alert('" . $neirong . "');</script>";
}

function wang_tiaozhuan($neirong)
{
    echo "<script>self.location='" . $neirong . "'; </script>";
}

function wang_json($arr)
{
    echo json_encode($arr);
}

/**
 * @Author:      Wang
 * @DateTime:    2016-11-15 16:30:02
 * @Description:
 */
function http_post_json($url, $jsonStr)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonStr);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSLVERSION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
        )
    );
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    return $response;
}

/**
 * @Author:      Wang
 * @DateTime:    2016-11-16 13:26:11
 * @Description:
 */
function curl($url, $params = false, $ispost = 0)
{
    $httpInfo = array();
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'JuheData');
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSLVERSION, 1);

    if ($ispost) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_URL, $url);
    } else {
        if ($params) {
            curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
        } else {
            curl_setopt($ch, CURLOPT_URL, $url);
        }
    }
    $response = curl_exec($ch);
    if ($response === FALSE) {
        echo "cURL Error: " . curl_error($ch);
        return false;
    }
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
    curl_close($ch);
    return $response;
}

function wang_aq_ajax()
{
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        //echo 'yes';
        return true;
    } else {
        //echo 'no ajax!';
        return false;
    }

}

/**
 * @Author:      Wang
 * @DateTime:    2016-11-17 11:29:13
 * @Description:
 */
function juhecurl($url, $params = false, $ispost = 0)
{
    $httpInfo = array();
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_USERAGENT, 'JuheData');
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    if ($ispost) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_URL, $url);
    } else {
        if ($params) {
            curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
        } else {
            curl_setopt($ch, CURLOPT_URL, $url);
        }
    }
    $response = curl_exec($ch);
    if ($response === FALSE) {
        //echo "cURL Error: " . curl_error($ch);
        return false;
    }
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
    curl_close($ch);
    return $response;
}

/**
 * @Author:      Wang
 * @DateTime:    2016-11-17 11:30:00
 * @Description:
 */
function getIP()
{
    global $ip;
    if (getenv("HTTP_CLIENT_IP"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if (getenv("HTTP_X_FORWARDED_FOR"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if (getenv("REMOTE_ADDR"))
        $ip = getenv("REMOTE_ADDR");
    else $ip = "Unknow";
    return $ip;
}

/**
 * @Author:      Wang
 * @DateTime:    2016-11-17 11:30:41
 * @Description:
 */
function getAgeByID($id)
{

//过了这年的生日才算多了1周岁 
    if (empty($id)) return '';
    $date = strtotime(substr($id, 6, 8));
//获得出生年月日的时间戳 
    $today = strtotime('today');
//获得今日的时间戳 
    $diff = floor(($today - $date) / 86400 / 365);
//得到两个日期相差的大体年数 

//strtotime加上这个年数后得到那日的时间戳后与今日的时间戳相比 
    $age = strtotime(substr($id, 6, 8) . ' +' . $diff . 'years') > $today ? ($diff + 1) : $diff;

    return $age;
}

/**
 * @Author:      Wang
 * @DateTime:    2016-11-17 15:50:23
 * @Description: 检测weixin
 */
function wang_jiance_weixin()
{

    $weixin = new class_weixin();
    $openid = "";
    if (isset($_GET["openid"]) && !empty($_GET["openid"])) {
        $openid = $_GET["openid"];
        session('openid',$openid);
    } else {
        if(!session('openid')){
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
                    'openid' => $openid, 'weixin_name' => $userinfo['nickname'], 'weixin_touxiang' => $userinfo['headimgurl'], 'weixin_sex' => $userinfo['sex'], 'weixin_shenfen' => $userinfo["province"]]);
            }
        }
    }
}

/**
 * @Author:      Wang
 * @DateTime:    2016-11-21 11:15:46
 * @Description: 短信接口 初审通过
 */
function wang_sms_chushentongguo($xingming, $shoujihao)
{
    include('taobao-sdk-sms/TopSdk.php');
    include('taobao-sdk-sms/top/TopClient.php');
    $c = new \TopClient;
    $c->appkey = '23514240';
    $c->secretKey = 'c16e18df6b96348a27ed930c613a2196';
    $req = new \AlibabaAliqinFcSmsNumSendRequest;
    $req->setExtend("");
    $req->setSmsType("normal");
    $req->setSmsFreeSignName("蒲公英小微贷");
    $req->setSmsParam("{name:'" . $xingming . "'}");
    $req->setRecNum($shoujihao);
    $req->setSmsTemplateCode("SMS_25290121");
    $resp = $c->execute($req);
}

/**
 * @Author:      Wang
 * @DateTime:    2016-11-21 11:24:47
 * @Description: 微信审核通过提醒
 */
function wang_weixin_msg1($openid)
{
    include('Muban.php');
    $Muban = new \Muban();
    $access_token = $Muban->fucktheaccess_token();
    //$openid = 'ohyMUwpUSz6BxFkbpFXTQdVpEJg8';
    $template_id = 'j9Z7dMMVY_4A05rad7UabG6gaHCqia5DmAOac5LTIpA';
    $urls = asset('home');//跳转地址
    // 响应url
    $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token;
    $data = array(

        'first' => array('value' => '初审通过，请点击完善相关信息！'),
        'keyword1' => array('value' => '初审通过', 'color' => '#FF0000'),
        'keyword2' => array('value' => date("Y-m-d H:i:s"), 'color' => '#173177'),
        //'remark'=>array('value'=>'祝您工作顺利','color'=>'#173177')

    );
    $dd = $Muban->fucktheWeChatmuban($openid, $template_id, $data, $url, $urls);
    //var_dump($dd);
}

/**
 * @Author:      Wang
 * @DateTime:    2016-11-21 11:34:13
 * @Description: 微信审核未通过通知
 */
function wang_weixin_msg_wtg($openid)
{
    include('Muban.php');
    $Muban = new Muban();
    $access_token = $Muban->fucktheaccess_token();
    //$openid = 'ohyMUwpUSz6BxFkbpFXTQdVpEJg8';
    $template_id = 'CLx3ExPL-LkY-ew76DXAFn8HhxqKgTtCtUGkIi9RjUI';
    $urls = asset('home');//跳转地址
    // 响应url
    $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token;
    $data = array(

        'first' => array('value' => '你的申请未通过！'),
        'keyword1' => array('value' => '未通过', 'color' => '#FF0000'),
        'keyword2' => array('value' => '请点击查看原因', 'color' => '#173177'),
        'keyword3' => array('value' => date("Y-m-d H:i:s"), 'color' => '#173177'),
        //'remark'=>array('value'=>'祝您工作顺利','color'=>'#173177')

    );
    $dd = $Muban->fucktheWeChatmuban($openid, $template_id, $data, $url, $urls);

}

/**
 * @Author:      Wang
 * @DateTime:    2016-11-21 11:35:46
 * @Description: 微信还款提醒
 */
function wang_weixin_msg_huankuan($openid)
{
    include('Muban.php');
    $Muban = new Muban();
    $access_token = $Muban->fucktheaccess_token();
    //$openid = 'ohyMUwpUSz6BxFkbpFXTQdVpEJg8';
    $template_id = '3cM1pFAcq1aY0lP1h0z0eRXeKSlK3SFVbT6BjUmZ-Vc';
    $urls = asset('home');//跳转地址
    // 响应url
    $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token;
    $data = array(

        'first' => array('value' => ''),
        'keyword1' => array('value' => '您本期应还金额为：', 'color' => '#FF0000'),
        'keyword2' => array('value' => '还款时间调用系统', 'color' => '#173177'),
        'remark' => array('value' => '为避免逾期，请提前充值！', 'color' => '#173177')

    );
    $dd = $Muban->fucktheWeChatmuban($openid, $template_id, $data, $url, $urls);
}

/**
 * @Author:      Wang
 * @DateTime:    2016-11-21 11:37:57
 * @Description: 微信逾期提醒
 */
function wang_weixin_msg_yuqi($openid)
{
    include('Muban.php');
    $Muban = new Muban();
    $access_token = $Muban->fucktheaccess_token();
    //$openid = 'ohyMUwpUSz6BxFkbpFXTQdVpEJg8';
    $template_id = 'Acn1zc_QftPvN4FtbR0-wLmL2gyDXSYGyFM05SlyzmE';
    $urls = asset('home');//跳转地址
    // 响应url
    $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token;
    $data = array(

        'first' => array('value' => '客户的姓名，您的借款已逾期！'),
        'keyword1' => array('value' => '逾期时间调用系统', 'color' => '#FF0000'),
        'keyword2' => array('value' => '结欠金额调用系统', 'color' => '#FF0000'),
        'remark' => array('value' => '为不影响您的账号正常使用，请尽快还款，以免造成信用损失。', 'color' => '#173177')

    );
    $dd = $Muban->fucktheWeChatmuban($openid, $template_id, $data, $url, $urls);

}