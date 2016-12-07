<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/weixin/css/style.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/weixin/css/information.css') ?>" />
  
       <script src="<?php echo asset('assets/weixin/js/jquery-1.9.1.min.js') ?>" type="text/javascript" charset="utf-8"></script>

		<title></title>
	</head>

	<body>
		<div class="main" id="main">
          <div class="head-2">
          	<img src="/assets/weixin/img/back-1.png" alt="" />
          	<div class="da-yuan"><img src="/assets/weixin/img/boy.png" alt="" /></div>
          	<div class="xiao-yuan"><img src="/assets/weixin/img/girl.png" alt="" /></div>     	
          </div>
          
          <div class="point">完成<span style="color:#99f;">【必填】</span>项即可借款</div>
          <div class="content">
          	<ul>
          		<a href="<?php echo asset('/home/bd1') ?>"><li id="jiben">
                         <img  src="/assets/weixin/img/jiben.png" alt="" />
                         <span>基本信息填写</span>
                         <img src="/assets/weixin/img/bitian.png" alt="" style="float: right;margin-top: 0;height:74% !important;" />
                    </li></a>
          		<li id="zhima">
          			<img id="img-zmf" src="/assets/weixin/img/" alt="" />
          			<span>芝麻分授权</span>
          				<img src="/assets/weixin/img/bitian.png" alt="" style="float: right;margin-top: 0;height:74% !important;" />
          		</l>
          		<li id="yys">
          			<img id="img-yys" src="/assets/weixin/img/" alt="" />
          			<span>运营商授权</span>
          				<img src="/assets/weixin/img/bitian.png" alt="" style="float: right;margin-top: 0;height:74% !important;" />
          		</li>
          		<li id="taobao">
          			<img id="img-tb" src="/assets/weixin/img/" alt="" />
          			<span>淘宝授权</span>
          				<img src="/assets/weixin/img/bitian.png" alt="" style="float: right;margin-top: 0;height:74% !important;" />
          		</li>
          		<li id="jingdong">
          			<img id="img-jd" src="/assets/weixin/img/" alt="" />
          			<span>京东授权</span>
          				<img src="/assets/weixin/img/bitian.png" alt="" style="float: right;margin-top: 0;height:74% !important;" />
          		</li>
          		
          	</ul>
          	
          </div>
          
          
          
		</div>
		<div class="footer" id="footer">
			<ul>
				<a href="<?php echo asset('home') ?>"><li>
					<img src="/assets/weixin/img/sy_white.png" />
				</li></a>
				<a href="<?php echo asset('home/index_2') ?>"><li>
					<img src="/assets/weixin/img/te_purple.png" />
				</li></a>
				<a href="<?php echo asset('home/index_3') ?>"><li>
					<img src="/assets/weixin/img/jl_white.png" />
				</li></a>
				<a href="<?php echo asset('home/index_4') ?>"><li>
					<img src="/assets/weixin/img/tj_white.png" />
				</li></a>
			</ul>
		</div>
	</body>
	<script type="text/javascript">
		/*中间内容高度*/
		var srceenHeight = window.screen.height;
		var fHeght = document.getElementById('footer').offsetHeight;
		document.getElementById('main').style.height = srceenHeight - fHeght + 2 + 'px';


$(function(){

$.ajax({ 
      type:'post', 
      url:"<?php echo asset('home/kongzhi_ajax') ?>", //发送后台的url 
         dataType:'json', //后台返回的数据类型
        timeout:45000, //超时时间
         async:false,//异步状态 在ajax执行的同时会执行其他js
      success:function(result){ 
      
 				 document.getElementById('img-zmf').src="/assets/weixin/img/"+ result.img_zmf;
 				  document.getElementById('img-yys').src="/assets/weixin/img/"+ result.img_yys;
 				   document.getElementById('img-tb').src="/assets/weixin/img/"+ result.img_tb;
 				    document.getElementById('img-jd').src="/assets/weixin/img/"+ result.img_jd;
         }
      })
     
})



$("#zhima").click(function(){
$.ajax({ 
      type:'post', 
      url:"<?php echo asset('home/kongzhi_ajax') ?>", //发送后台的url 
         dataType:'json', //后台返回的数据类型
        timeout:45000, //超时时间
         async:true,
      success:function(result){ 
         if(result.kongzhi_zmf=='0'){


          window.location.href=result.dizhi_zmf;
     }else{
     
         alert('您已完成该项授权');
     }
      },
      error:function(result){
         
      }
})
})



$("#yys").click(function(){
$.ajax({ 
      type:'post', 
      url:"<?php echo asset('home/kongzhi_ajax') ?>", //发送后台的url 
         dataType:'json', //后台返回的数据类型
        timeout:45000, //超时时间
         async:true,
      success:function(result){ 
         if(result.kongzhi_yys=='0'){


          window.location.href=result.dizhi_yys;
     }else{
          alert('您已完成该项授权');
     }
      },
      error:function(result){
         
      }
})
})

$("#jingdong").click(function(){
$.ajax({ 
      type:'post', 
      url:"<?php echo asset('home/kongzhi_ajax') ?>", //发送后台的url 
         dataType:'json', //后台返回的数据类型
        timeout:45000, //超时时间
         async:true,
      success:function(result){ 
         if(result.kongzhi_jd=='0'){


          window.location.href=result.dizhi_jd;
     }else{
          alert('您已完成该项授权');
     }
      },
      error:function(result){
         
      }
})
})

$("#taobao").click(function(){
$.ajax({ 
      type:'post', 
      url:"<?php echo asset('home/kongzhi_ajax') ?>", //发送后台的url 
         dataType:'json', //后台返回的数据类型
        timeout:45000, //超时时间
         async:true,
      success:function(result){ 
         if(result.kongzhi_tb=='0'){


          window.location.href=result.dizhi_tb;
     }else{
          alert('您已完成该项授权');
     }
      },
      error:function(result){
         
      }
})
})

	</script>

</html>