<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<link rel="stylesheet" href="<?php echo base_url('public/')?>css/css.css">
	<script type="text/javascript" src="<?php echo base_url('public/')?>js/jquery-1.9.1.min.js"></script>

<style>
.a2{padding-top: 0%;}
body{margin:0;}
.shenhe{
  text-align: center;
  margin-top: -8vw;
}

.xiaoguo{

      width: 100%;
    height: 100%;
    border-radius: 50%;
   box-shadow: 0px 0px 40px 5px rgba(0, 0, 0, 0.8);
       background: rgba(0,0,0,0.5);
}

.a2 li{
  margin-left: 18.5% !important;
}
.btm{
  height: 12vw;
  width: 100%;
  position: fixed;

  bottom: 14vw;
}
.kh-btn{
  display: block;
  border-radius: 15px;
  margin:auto;
width: 50%;
  background-color: #1AAD19;
  height: 12vw;
    color: #fff;
    font-size: 6vw;
    text-align: center;
    line-height: 12vw;
    font-family: 微软雅黑;


}
</style>
</head>
<body>
<div class="head">
	<span>蒲公英小微贷</span>


</div>
<div class="shenhe">
<p style="text-align:center;"><?php echo $xingming?></p>
<p style="text-align:center;"><?php echo $shenhezhuangtai?></p>
<p style="text-align:center;">请点击以下图标进行相关授权</p>
<p style="text-align:center;color:red">京东授权非必填项 但填写完全可以提升放款额度</p>

<p></p>


</div>
	<div class="a2">
	   <ul>

<li >
<div class="xiaoguo" id="xiaoguo">
         <img id="zmf" src="<?php echo base_url('public/')?>icon/<?php echo $zmf?>" alt=""><!--z芝麻分-->
          </div>
        </li>


	<li >
  <div class="xiaoguo" id="xiaoguo">
	   			<img id="yys" src="<?php echo base_url('public/')?>icon/<?php echo $yys?>"> <!--运营商-->
           </div>
	   		</li>

	   		
<li>
<div class="xiaoguo" id="xiaoguo">
<img id="jingdong" src="<?php echo base_url('public/')?>icon/<?php echo $jd?>" alt=""><!--京东-->
</div>
</li>





	   	
	   	<li>
      <div class="xiaoguo" id="xiaoguo">
	   		<img id="taobao" src="<?php echo base_url('public/')?>icon/<?php echo $tb?>" alt="">
        </div>
	   	</li>








	   	<li style="display:none;">
	   		<a href="jdrz.php"><img src="<?php echo base_url('public/')?>icon/2.png" alt=""></a>
	   		</li>
	   		
	   	
	   </ul>	
	</div>



<div class="btm">
<a class="kh-btn" onclick="abc()">咨询客户经理</a>


</div>

		<script type="text/javascript">

// var xiaoguo=document.getElementById("xiaoguo");

// xiaoguo.addEventListener('touchstart', function(event) { 
// $("#xiaoguo").css("box-shadow","0px 0px 40px 5px rgba(0, 0, 0, 0.0)");
// })

// xiaoguo.addEventListener('touchend', function(event) { 
// $("#xiaoguo").css("box-shadow","0px 0px 40px 5px rgba(0, 0, 0, 0.8)");
// })



function abc(){

$.ajax({ 
      type:'post', 
      url:"<?php echo site_url('admin/domain')?>", //发送后台的url 
         dataType:'json', //后台返回的数据类型 
         async:true,//异步状态 在ajax执行的同时会执行其他js
      success:function(result){

   if(result==1){
window.location.href="http://test.pgyxwd.com/home/index_3"; 
   }else if(result==0){
    alert("请完成除京东外的其他授权");
    return false;
   }


       },
      error:function(result){


        alert("未知错误");
      }
})


}

	
$("#yys").click(function(){
	$("#yys").parent(".xiaoguo").css("box-shadow","0px 0px 40px 5px rgba(0, 0, 0, 0.0)");
	setTimeout('$("#yys").parent(".xiaoguo").css("box-shadow","0px 0px 40px 5px rgba(0, 0, 0, 0.8)")',200);
	 	
$.ajax({ 
    	
      type:'post', 
      url:'<?php echo site_url('home/index_ajax')?>', //发送后台的url 
        dataType:'json', //后台返回的数据类型
        timeout:45000, //超时时间
       async:true,
      success:function(result){  //data为后台返回的数据
       if(result.yys=="0"){
      
      window.location.href=result.yysdz//跳转地址
       }else if(result.yys=="1"){
         
       alert("您已完成该项内容的填写");
       }
        }
    });


})

	
$("#zmf").click(function(){
	$("#zmf").parent(".xiaoguo").css("box-shadow","0px 0px 40px 5px rgba(0, 0, 0, 0.0)");
	setTimeout('$("#zmf").parent(".xiaoguo").css("box-shadow","0px 0px 40px 5px rgba(0, 0, 0, 0.8)")',200);
$.ajax({ 
    	
      type:'post', 
      url:'<?php echo site_url('home/index_ajax')?>', //发送后台的url 
        dataType:'json', //后台返回的数据类型
        timeout:45000, //超时时间
       async:true,
      success:function(result){  //data为后台返回的数据
       if(result.zmf=="0"){
      window.location.href=result.zmfdz//跳转地址
       }else if(result.zmf=="1"){
         
   alert("您已完成该项内容的填写");
       }
        }
    });


})

$("#taobao").click(function(){
	$("#taobao").parent(".xiaoguo").css("box-shadow","0px 0px 40px 5px rgba(0, 0, 0, 0.0)");
	setTimeout('$("#taobao").parent(".xiaoguo").css("box-shadow","0px 0px 40px 5px rgba(0, 0, 0, 0.8)")',200);
$.ajax({ 
    	
      type:'post', 
      url:'<?php echo site_url('home/index_ajax')?>', //发送后台的url 
        dataType:'json', //后台返回的数据类型
        timeout:45000, //超时时间
       async:true,
      success:function(result){  //data为后台返回的数据
       if(result.tb=="0"){
      window.location.href=result.tbdz//跳转地址
       }else if(result.tb=="1"){
           alert("您已完成该项内容的填写");
 
       }
        }
    });


})


$("#jingdong").click(function(){
	$("#jingdong").parent(".xiaoguo").css("box-shadow","0px 0px 40px 5px rgba(0, 0, 0, 0.0)");
	setTimeout('$("#jingdong").parent(".xiaoguo").css("box-shadow","0px 0px 40px 5px rgba(0, 0, 0, 0.8)")',200);
$.ajax({ 
    	
      type:'post', 
      url:'<?php echo site_url('home/index_ajax')?>', //发送后台的url 
        dataType:'json', //后台返回的数据类型
        timeout:45000, //超时时间
       async:true,
      success:function(result){  //data为后台返回的数据
       if(result.jd=="0"){
      window.location.href=result.jddz//跳转地址
       }else if(result.jd=="1"){
           alert("您已完成该项内容的填写");
 
       }
        }
    });


})

// $(document).ready(function(){
  
//     $(".a1").animate({left:'16%'},300);

// });

	</script>	
</body>

</html>