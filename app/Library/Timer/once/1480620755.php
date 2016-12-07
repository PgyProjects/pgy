
<?php
/**
 * create by Timer
 * will execute in 2016-12-02 03:32:35
 */

    require_once __DIR__.'/../../../Wang/Muban.php';
    $Muban = new Muban();
    $access_token = $Muban->fucktheaccess_token();
    $template_id = 'j9Z7dMMVY_4A05rad7UabG6gaHCqia5DmAOac5LTIpA';
    $urls = 'http://test.pgyxwd.com/home';//跳转地址
// 响应url
    $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=" . $access_token;
    $data = array(
        'first' => array('value' => '初审通过，请点击完善相关信息！'),
        'keyword1' => array('value' => '初审通过', 'color' => '#FF0000'),
        'keyword2' => array('value' => date("Y-m-d H:i:s"), 'color' => '#173177'),
    );
    $Muban->fucktheWeChatmuban('ohyMUwlwGFjQfMl8A9VD79EwzCAk', $template_id, $data, $url, $urls);
