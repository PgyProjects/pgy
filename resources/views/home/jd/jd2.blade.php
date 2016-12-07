<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>信息认证第二步</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<link rel="stylesheet" href="<?php echo asset('assets/weixin/css/neicss.css') ?>">
	<link rel="stylesheet" href="<?php echo asset('assets/weui-master/dist/style/weui.css') ?>">
	<link rel="stylesheet" href="<?php echo asset('assets/weui-master/dist/example/example.css') ?>">
	<script type="text/javascript" src="<?php echo asset('assets/weixin/js/jquery-1.9.1.min.js') ?>"></script>
</head>
<body ontouchstart>
	<div class="head2">
	<span>信息认证</span>	
	</div>
		<div class="kongbai1"></div>
					
	<div class="tishi">
		<p><span style="font-weight:bold;font-size:4.5vw;letter-spacing:0.1em;">输入短信验证码</span>(验证码一分钟内发送到手机) </p>
	</div>

<div class="container" id="container">
	<div class="page__bd">
		<form id="bd-3"><!--表单在这里-->
							<div class="weui-cells weui-cells_form">
											<div class="weui-cell">
												<div class="weui-cell__hd">
													<label class="weui-label">验证码</label>
												</div>
												<div class="weui-cell__bd">
													<input type="hidden" name="shoujihao" id="shoujihao" value="<?php echo $_GET['shoujihao']?>">
													<input type="hidden" name="pwd" value="<?php echo $_GET['pwd']?>">
													<input type="hidden" name="token" id="token" value="<?php echo $_GET['token']?>">
													
													<input type="text" class="weui-input" placeholder="请输入验证码" name="yzm">
												</div>	
											</div>
					                  
								</div>



							<div class="daoshu">
								  <div id="yzm"></div>
								</div>



		<div class="kongbai1"></div>
<a class="weui-btn weui-btn_primary" id="do3">确定</a>

		</form>
		</div>
		</div>
<div id="loadingToast" style=" display: none;">
        <div class="weui-toast">
            <i class="weui-loading weui-icon_toast"></i>
            <p class="weui-toast__content">验证中 请稍等</p>
        </div>

    </div>


<script type="text/javascript">

var seconds=59;
var speed=1000;
var span = document.createElement('span');
 document.getElementById("yzm").appendChild(span);

function countDown(seconds,speed){

	
                var txt ="验证码已发送, "+((seconds < 10) ? "0" + seconds : seconds)+" 秒后可重新发送";
                span.innerHTML = txt;
                var timeId = setTimeout("countDown(seconds--,speed)",speed);
               

                if(seconds == 0){
                        clearTimeout(timeId);
                          var txt ="没有收到验证码?点击重新发送";
	   span.innerHTML ="<a href=''>"+ txt+"</a>";
                        
                };

	



}


countDown(seconds,speed);




$("#do3").click(function(){
	var tokenValue = $('#token').val();
      	var shoujihaoValue = $('#shoujihao').val();
	 document.getElementById("loadingToast").style.display="block";
 $.ajax({ 
    	
      type:'post', 
      url:"<?php echo asset('jxl/jd2_ajax')?>", //发送后台的url 
        dataType:'json', //后台返回的数据类型
        timeout:45000, //超时时间
        data:$("#bd-3").serialize(),
       async:true,
      success:function(result){  //data为后台返回的数据
     if(result.data.process_code=='10008'){
  window.location.href="<?php echo asset('jxl/jd3')?>?token="+tokenValue+"&shoujihao="+shoujihaoValue;	
     }else if(result.data.process_code=='10002'){
     	alert("输入短信验证码");
     }else if(result.data.process_code=='10004'){
        alert("短信验证码错误");
     }else if(result.data.process_code=='10006'){
     	alert("短信验证码已失效,系统已自动下发新验证码")

     }else if(result.data.process_code=='30000'){
     	alert("发送错误");
     }
        },
        error:function(result){
        alert("未知错误发生,请稍后重试");
        }
    });





})
</script>
</body>
</html>