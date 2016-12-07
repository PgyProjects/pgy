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
<form id="formyys">
    <div class="wang1"><input type="text" name="shoujihao" class="in1" placeholder="请输入手机号" id="shoujihao"></div>
    </br>
    <div class="wang1"><input type="password" name="password" class="in1" placeholder="请输入手机服务密码"></div>
    </br>
    &nbsp;&nbsp;
    <div style="margin-left:80%" onclick="duihua()">忘记密码？</div>
    </br></br>
    <div style="padding-left:10%;">
    </div>
    <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
    <input type="hidden" name="website" value="<?php echo $_GET['website']; ?>">
</form>
<button class="button" id="load">登 录</button>
<div style="margin-left:30%"><span style="color:red"><?php echo @$tishi ?></span></div>
</body>
<script type="text/javascript">
    function duihua() {
        alert('移动用户：拨打10086 拨通后按4 再按1。\n电信用户：拨打10000 拨通后按6机器人找回，或者按0人工找回。\n联通用户：拨打10010 拨通后按0人工找回。')
    }
    $('#load').click(function () {

        $.ajax({
            type: 'post',
            url: "<?php echo asset('jxl/yys1_ajax')?>", //发送后台的url
//            dataType: 'json', //后台返回的数据类型
            timeout: 45000, //超时时间
            data: $("#formyys").serialize(),//应用于form表单的内容提交
            async: true,
            success: function (result) {
                if (result.status > 0) {
                    alert('授权成功');
                    window.location.href = "<?php echo asset('home'); ?>";
                } else if (0 === result.status) {
                    window.location.href = result.message;
                } else {
                    var message = (JSON && JSON.stringify)?JSON.stringify(result):10800;
                    alert("运营商系统返回：" + message);
                }
            },
            error: function (result) {
                var message = (JSON && JSON.stringify)?JSON.stringify(result):10800;
                alert("运营商返回：" + message);
            }
        })
    })
</script>
</html>