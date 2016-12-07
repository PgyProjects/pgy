
<?php
/**
 * create by Timer
 * will execute in 2016-12-06 12:14:56
 */

    require_once __DIR__.'/../../../Wang/Muban.php';
    $Muban = new Muban();
    $access_token = $Muban->fucktheaccess_token();
    $template_id = 'CLx3ExPL-LkY-ew76DXAFn8HhxqKgTtCtUGkIi9RjUI';
    $urls = 'http://test.pgyxwd.com/home';//跳转地址
// 响应url
    $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token;
    $data = array(
        'first' => array('value' => '你的申请未通过！'),
        'keyword1' => array('value' => '未通过', 'color' => '#FF0000'),
        'keyword2' => array('value' => '请点击查看原因', 'color' => '#173177'),
        'keyword3' => array('value' => date("Y-m-d H:i:s"), 'color' => '#173177'),
    );
    $Muban->fucktheWeChatmuban('ohyMUwv66uy1Mi25NzkiridGtAhE', $template_id, $data, $url, $urls);
