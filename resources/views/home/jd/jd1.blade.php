<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>京东授权</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<link rel="stylesheet" href="<?php echo asset('assets/weixin/css/neicss.css') ?>">
	<link rel="stylesheet" href="<?php echo asset('assets/weui-master/dist/style/weui.css') ?>">
	<link rel="stylesheet" href="<?php echo asset('assets/weui-master/dist/example/example.css') ?>">
	<script type="text/javascript" src="<?php echo asset('assets/weixin/js/jquery-1.9.1.min.js') ?>"></script>
</head>
<body ontouchstart>
	<div class="head2">
	<span>京东认证</span>	
	</div>
	<div class="kongbai1"></div>
	<div class="tishi">
		<p>京东认证：收集您在京东的基本信息用于验证。</p>
		<p>这是认证您信息的正常过程,请不必担心</p>
	</div>
<!--main-->
<div class="container" id="container">
	<div class="page__bd">
<form id="bd-jd" action="<?php echo asset('jxl/jd1')?>" method="post">
	<div class="weui-cells weui-cells_form">
<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">京东账号</label>
							</div>
							<div class="weui-cell__bd">
					<input type="hidden" name="token" value="<?php echo @$_GET['token']?>" id="token">
					<input type="text" id="shoujihao" name="shoujihao" class="weui-input" placeholder="请输入京东账号" value="<?php echo @$_GET['shoujihao']?>">
							</div>
							
						</div>

<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">密码</label>
							</div>
							<div class="weui-cell__bd">
					<input type="password" id="password" name="pwd" class="weui-input" placeholder="请输入密码" >
							</div>
							
						</div>


	</div>
	<div class="kongbai1"></div>
<a style="border-radius:0px;" class="weui-btn weui-btn_primary" id="jd1" >下一步</a>

</form>

<div id="loadingToast" style=" display: none;">
        <div class="weui-toast">
            <i class="weui-loading weui-icon_toast"></i>
            <p class="weui-toast__content">提交中 请稍等</p>
        </div>

    </div>


	</div>
	</div>
<!-- mian end-->

<script type="text/javascript">
$("#jd1").click(function(){
	var tokenValue = $('#token').val();
      	var shoujihaoValue = $('#shoujihao').val();
      	var passwordValue = $('#password').val();
      
  document.getElementById("loadingToast").style.display="block";
 $.ajax({ 
    	
      type:'post', 
      url:'<?php echo asset('jxl/jd1_ajax')?>', //发送后台的url 
        dataType:'json', //后台返回的数据类型
        timeout:45000, //超时时间
       async:true,
        data:$("#bd-jd").serialize(),
      success:function(result){ 

       if(result.data.process_code=='10008'){

    
   window.location.href="<?php echo asset('jxl/jd3')?>?token="+tokenValue+"&shoujihao="+shoujihaoValue;

       }else if(result.data.process_code=='10002'){


 window.location.href="<?php echo asset('jxl/jd2')?>?token="+tokenValue+"&shoujihao="+shoujihaoValue+"&pwd="+passwordValue;


       }



       else if(result.data.process_code=='30000'){
  alert("帐号需要进行密码重置");
 document.getElementById("loadingToast").style.display="none";
   window.location.href="<?php echo asset('jxl/jdqutoken')?>";
       }else if(result.data.process_code=='10003'){

       	alert("密码错误");
       	  document.getElementById("loadingToast").style.display="none";
       }
        },
        error:function(result){
 document.getElementById("loadingToast").style.display="none";

        	alert("未知错误发生,请稍后重试");
        }
    });





})
   
</script>
</body>
</html>