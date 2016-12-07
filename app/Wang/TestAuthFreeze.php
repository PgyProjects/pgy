<?php


include('ZmopClient.php');
include('request/ZhimaAuthInfoAuthorizeRequest.php');
class TestAuthFreeze {
    //芝麻信用网关地址
    public $gatewayUrl = "https://zmopenapi.zmxy.com.cn/openapi.do";
    //商户私钥文件
    public $privateKeyFile = "C:\\rsa_private_key_1000825.pem";
    //芝麻公钥文件
    public $zmPublicKeyFile = "C:\\rsa_public_key_1000825.pem";
    //数据编码格式
    public $charset = "UTF-8";
    //芝麻分配给商户的appId
    public $appId = "1000825";

    public $certNo="";
    public $name="";
    public $mobileNo="";
    //生成H5端页面授权的URL，身份证姓名授权
    public function generatePcPageAuthUrl(){
        $client = new ZmopClient($this->gatewayUrl, $this->appId, $this->charset, $this->privateKeyFile, $this->zmPublicKeyFile);
        $request = new ZhimaAuthInfoAuthorizeRequest();
        //$request->setScene("");
        // H5授权来源渠道设置为app
        $request->setChannel("app");
        // 授权类型设置为2标识为证件号授权见“章节4中的业务入参说明identity_type”
        $request->setIdentityType("2");
        // 构造授权业务入参证件号，姓名，证件类型;“章节4中的业务入参说明identity_param”
        $request->setIdentityParam("{\"certNo\":\"".$this->certNo."\",\"certType\":\"IDENTITY_CARD\", \"name\":\"".$this->name."\"}");
        // 构造业务入参扩展参数“章节4中的业务入参说明biz_params”
        $request->setBizParams("{\"auth_code\":\"M_H5\",\"state\":\"".$this->mobileNo."|".$this->certNo."|".$this->name."\"}");
 
        return $client->generatePageRedirectInvokeUrl($request);
}

}
//$certNo=$_GET['certNo'];
//$name=$_GET['name'];
//$s=new TestAuthFreeze();
//$s->certNo=$certNo;
//$s->name=$name;
//echo $s->generatePcPageAuthUrl();