<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>运营商手机授权登录</title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <script type="text/javascript" src="<?php echo asset('assets/weixin/js/jquery-1.9.1.min.js') ?>"></script>
    <style>
        body {
            background-color: #f3f5f7;
        }

        .inputclass {
            background-color: white;
            width: 100%;
            border-bottom: 1px solid #d7d7d7;
        }

        .wang1 {
            width: 100%;
            height: 50px;
            line-height: 4.173333rem;
            border-bottom: 1px solid #DDD;
            background-color: #fff;
            padding-left: 10px;
        }

        .in1 {
            border-bottom: 1px solid #DDD;
            color: #6C6C6C;
            margin-left: 10px;
            background-color: transparent;
            text-align: left;
            padding: .373333rem .266667rem;
            border: 1px;
            width: 50%;

        }

        .button {
            width: 100%;
            height: 50px;
            line-height: 1.253333rem;
            border: 1px solid #eee;
            border-radius: 3px;
            color: #FFF;
            background-color: #1796dd;
            text-align: center;
            font-size: 17px;
            margin-left: -5%;
        }
    </style>
</head>
<body>
</br>
<form id="formyys2">
    <div class="wang1"><input type="text" name="smsCode" class="in1" placeholder="请输入短信验证码"></div>
    </br>

    <input type="hidden" name="token" value="<?php echo $_GET['token'] ?>">
    <input type="hidden" name="shoujihao" value="<?php echo $_GET['shoujihao'] ?>">
    <input type="hidden" name="shoujimima" value="<?php echo $_GET['shoujimima'] ?>">
    <input type="hidden" name="website" value="<?php echo $_GET['website'] ?>">

</form>
<div style="padding-left:10%;">
    <button id="load" class="button">登 录</button>
</div>
<div style="margin-left:30%"><span style="color:red"></span></div>
</body>
<script type="text/javascript">
    $('#load').click(function () {

        $.ajax({
            type: 'post',
            url: "<?php echo asset('jxl/yys2_ajax')?>", //发送后台的url
//            dataType: 'json', //后台返回的数据类型
            timeout: 45000, //超时时间
            data: $("#formyys2").serialize(),//应用于form表单的内容提交
            async: true,
            success: function (result) {

                if (result.status > 0) {
                    alert('授权成功');
                    window.location.href = "<?php echo asset('home'); ?>";
                } else {
                    alert(result.message);
                }
            },
            error: function (result) {
                alert(result);
            }
        })
    })
</script>
</html>