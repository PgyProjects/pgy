<?php
    include_once('ZmopClient.php');
    include('request/ZhimaCreditScoreGetRequest.php');
    //error_reporting(0);

    header("Content-type: text/html; charset=utf-8");




class TestZhimaCreditScoreGet {
    //芝麻信用网关地址
    public $gatewayUrl = "https://zmopenapi.zmxy.com.cn/openapi.do";
    //商户私钥文件
    public $privateKeyFile = "C:\\rsa_private_key_1000825.pem";
    //芝麻公钥文件
    public $zmPublicKeyFile = "C:\\rsa_public_key_1000825.pem";
    //数据编码格式
    public $charset = "UTF-8";
    //芝麻分配给商户的 appId
    public $appId = "1000825";
    public $openid= "";
    public $TransactionId="";
    public function testZhimaCreditScoreGets(){
         $client = new ZmopClient($this->gatewayUrl,$this->appId,$this->charset,$this->privateKeyFile,$this->zmPublicKeyFile);
         $request = new ZhimaCreditScoreGetRequest();
         $request->setChannel("apppc");
         $request->setPlatform("zmop");
                 $request->setTransactionId($this->TransactionId);// 必要参数         
                $request->setProductCode("w1010100100000000001");// 必要参数         
                $request->setOpenId($this->openid);// 必要参数         
                  $response = $client->execute($request);
          return json_encode($response);
    }
}
//$s=new TestZhimaCreditScoreGet();
//echo $s->testZhimaCreditScoreGet();