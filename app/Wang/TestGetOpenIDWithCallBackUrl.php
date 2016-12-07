<?php

    include('ZmopClient.php');

header("Content-type: text/html; charset=utf-8");
    /**
     * step2
     * PHP版本的回调地址过滤直接取得open_id
     * Class GetOpenIDWithCallBackUrl
     */
    class TestGetOpenIDWithCallBackUrl{
        public $x;
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
        public $encryptedParam = 'N%2Fetn9BIKl%2F1EPuDY7mhA2SZE6jPKuJlq4%2BCueyWpJ11mOjnui0eBWg89hn1rUEl9s4ZBHQhs1VPqJ5NhoPCdnrh1xqWwYMsteD12bm8dBvlWPuZaTiaeNEfE31vSxwLGnON0U5drrI3C0VYqAeFdDfrtf5PHpTI9Qp3lexiYjwsE01rMVAsbaMbkzrScB0zcCdhiiYKQF7QiyeGP1DaphL4jwKodAdBuLFFpofE4W3EXAHqMkcCwzIvyBNTbVf0HxL5Z2sS3BtfE0DYNRrprflZMowysprGFDpe%2BHE54uIVnR8e4eyYXD%2FXE9J%2FSlW03uK4se%2BNSntWVAqYFnTpmA%3D%3D';
        public $sign = "QT7zjAyOWiGRCzqZqL7FlR3uKROfB4zYGGWvVRug9CwWiIO%2FnleaVwh%2B87dVGa8Pa25k6YhxElaUpaZbIj1ygndhQ657Zby4idF1GU40s8zTL%2BACYKimREukKbkylkz9viBGthjTa4w3RSMpN7uMzVNt1ZcLTkPZqJOgjAv98ec%3D";

        public function testCreditWatchListiiGet(){
            $client = new ZmopClient($this->gatewayUrl,$this->appId,$this->charset,$this->privateKeyFile,$this->zmPublicKeyFile);
           
            //$bb = $rsa::rsaDecrypt(urldecode($this->encryptedParam),$this->privateKeyFile);

            $a = $client->decryptAndVerifySign(urldecode($this->encryptedParam),urldecode($this->sign));
            return $a;
        }

    }


    //用户授权后callback后的网址
    //$url='';

    //进行过滤解密从来获得open_id
   // $params=urlencode($_GET['params']);
    //$sign=urlencode($_GET['sign']);

   // $obj = new TestGetOpenIDWithCallBackUrl();
   // $obj->encryptedParam=$params;
   // $obj->sign=$sign;

    //echo $obj->testCreditWatchListiiGet();