<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>淘宝授权</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<link rel="stylesheet" href="<?php echo asset('assets/weixin/css/neicss.css') ?>">
	<link rel="stylesheet" href="<?php echo asset('assets/weui-master/dist/style/weui.css') ?>">
	<link rel="stylesheet" href="<?php echo asset('assets/weui-master/dist/example/example.css') ?>">
	<script type="text/javascript" src="<?php echo asset('assets/weixin/js/jquery-1.9.1.min.js') ?>"></script>
	<style>
#erweima{
	width: 100%;
}
#zhezhao{
	display: none;
	position: absolute;
	width: 100%;
text-align: center;
	top: 0;
	height: 100%;
      background: rgba(0,0,0,0.6);
}
#zhezhao img{
	width: 80%;
margin-top: 20%;
}
#zhezhao p{
	margin-top: 20%;
    font-size: 5vw;
	color:#fff;
	font-family: 微软雅黑;
}
.smqueren{
    background: #1AAD19;
    position: relative;
    display: block;
    margin-left: auto;
    margin-right: auto;
    padding-left: 14px;
    padding-right: 14px;
    box-sizing: border-box;
    font-size: 18px;
    text-align: center;
    text-decoration: none;
    color: #FFFFFF;
    line-height: 2.55555556;
    border-radius: 5px;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    border-radius: 0px;
    margin-top: 7vw;


}
	</style>


</head>
<body ontouchstart>
	<div class="head2">
	<span>淘宝认证</span>	
	</div>
	<div class="kongbai1"></div>
	<div class="tishi">
		<p>淘宝认证：收集您在淘宝的基本信息用于验证。</p>
		<p>这是认证您信息的正常过程,请不必担心</p>
	</div>
<div class="container" id="container">
	<div class="page__bd">
	<form id="tbform">
	<div class="weui-cells weui-cells_form">

<div class="weui-cell">
		<div class="weui-cell__hd">

								<label class="weui-label">淘宝账号</label>
							</div>
							<div class="weui-cell__bd">
					<input type="hidden" name="token" id="token" value="<?php echo $_GET['token']?>">
					<input type="text" id="tbname" id="tbname" name="tbname" class="weui-input" placeholder="请输入淘宝账号" value="">
							</div>
							
						</div>
							<div class="kongbai1"></div>

<a style="border-radius:0px;" class="weui-btn weui-btn_primary" id="jd1" >下一步</a>

	</div>
	</form>
	</div>
	</div>


		
	<div id="loadingToast" style=" display: none;">
        <div class="weui-toast">
            <i class="weui-loading weui-icon_toast"></i>
            <p class="weui-toast__content">提交中 请稍等</p>
        </div>

    </div>

  <div id="zhezhao"></div>  


<script type="text/javascript">






$("#jd1").click(function(){
var tokenValue = $('#token').val();
      	var tbnameValue = $('#tbname').val();


 document.getElementById("loadingToast").style.display="block";
$.ajax({ 
    	
      type:'post', 
      url:'<?php echo asset('jxl/tb1_ajax')?>', //发送后台的url 
        dataType:'json', //后台返回的数据类型
        timeout:45000, //超时时间
       async:true,
        data:$("#tbform").serialize(),
      success:function(result){ 

if(result.code=='1'){
 document.getElementById("loadingToast").style.display="none";
 document.getElementById("zhezhao").style.display="block";
var str='';
str += "<p>保存二维码并在手机淘宝扫码打开</p>";
str += '<img src="'+result.erweima+'" />';
str +='<a class="smqueren" id="smqueren">请在扫描成功点击确认</a>';
document.getElementById('zhezhao').innerHTML = str;

$("#smqueren").click(function(){
$.ajax({ 
    	
      type:'post', 
      url:'<?php echo asset('jxl/tb1_ajax_ok')?>', 
        dataType:'json', 
        timeout:45000, 
       async:true,
        data:{

       	token:$("#token").val()

        },
      success:function(result){
if (result.data.process_code=='10008') {
  alert("授权成功");
 window.location.href="<?php echo asset('home')?>";

}

      },
      error:function(result){

      	alert("授权失败,请稍后重试");

  }

})
})

}
 },
 error:function(){
alert("未知错误发生,请稍后重试");

 }
})





})





</script>

</body>
</html>