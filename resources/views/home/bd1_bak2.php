<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<title>表单填写</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<link rel="stylesheet" href="<?php echo base_url('public/')?>css/neicss.css">
	<link rel="stylesheet" href="<?php echo base_url('public/')?>weui-master/dist/style/weui.css">
	<link rel="stylesheet" href="<?php echo base_url('public/')?>weui-master/dist/example/example.css">

<script src="<?php echo base_url('public/')?>js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('public/')?>js/jsAddress.js" type="text/javascript"></script>





    <link rel="stylesheet" href="http://cache.amap.com/lbs/static/main1119.css"/>
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=b4fbc5e7c2097f9b9a19eeba7d3621d4"></script>
        <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=c86109f4135f98f235e2516e58fc2f8e&plugin=AMap.Geocoder"></script>
   <script type="text/javascript" src="http://cache.amap.com/lbs/static/addToolbar.js"></script>


<style>
/*这里设置透明度为0让小图不显示*/.plus img{width: 8.5vw;opacity: 0;}
.jindutiao1{

	width: 0%;
	   
}
.tupian input{
opacity: 0;
position: absolute;
}
.plus{
         float: left;
    font-size: 22px;

    display: table-cell;
    vertical-align: middle;
}
.tupian span{
	width: 1000%;
      margin-top: 1vw;
    position: absolute;
    margin-left: 12	vw;
}
.jgjg{
	width: 100%;
	color:red;
	display: none;
	padding-left: 6.5%;
}
.jgjg2{
	width: 100%;
	color:red;
	display: none;
	padding-left: 6.5%;
}



/*#bar .finish {
height: 100%;
width: 0%;
background-color: #FC0;
border-radius:5px;
}*/

</style>
</head>
<body ontouchstart>
	<div class="head2">
	<span>基本信息</span>	
	</div>


	<div class="container" id="container">
					<div class="weui-cells weui-cells_form">



					
<div style="display:none;">
		<div class="weui-cell weui-cell_select">
										<div class="weui-cell__bd">
									
										<select  class="weui-select" name="guanxi" >
										<option selected value="1">进度</option>	
										<option value="2">进行中</option>		
												<option value="2">已完成</option>	
													<option value="2">未完成</option>	
												
															
																

										</select>			
										</div>
						</div>


			<div class="weui-cell weui-cell_select">
										<div class="weui-cell__bd">
								
										<select  class="weui-select" name="guanxi" >
										<option selected value="1">产品类别</option>	
										<option value="2">1</option>		
												<option value="2">2</option>	
													<option value="2">3</option>	
												
																												

										</select>			
										</div>
						</div>




					<div class="weui-cell weui-cell_select">
										<div class="weui-cell__bd">
									
										<select  class="weui-select" name="guanxi" >
										<option selected value="1">审核人</option>	
										<option value="2">a</option>		
												<option value="2">b</option>	
													<option value="2">c</option>	
												
															
																

										</select>			
										</div>
						</div>		

<div class="kongbai1"><p style="text-align:center;line-height:2.5;  border-bottom: dotted #CCC 2px;">以上仅管理员可见</p></div>
</div>

<form action="<?php echo site_url('home/bd1')?>" method="post">



						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">姓名</label>
							</div>
							<div class="weui-cell__bd">
								<input type="text" class="weui-input" placeholder="请输入姓名" name="xingming">
							</div>
							
						</div>

							<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">手机号</label>
							</div>
							<div class="weui-cell__bd">
								<input type="text" class="weui-input" maxlength="11" placeholder="请输入手机号" name="shoujihao">
							</div>
							
						</div>

						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label" >身份证号</label>
							</div>
							<div class="weui-cell__bd">
								<input id="sfz" type="text" class="weui-input"  minlength="18" maxlength="18" placeholder="请输入身份证号" name="shenfenzheng">
							</div>
							
						</div>
						<div class="jgjg">*请输入正确的身份证号 </div>
						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label" >邮箱</label>
							</div>
							<div class="weui-cell__bd">
								<input id="emailerror" type="text" class="weui-input"  placeholder="请输入邮箱" name="email">
							</div>
							
						</div>
						<div class="jgjg2">*请输入正确的邮箱 </div>
							<div class="weui-cell weui-cell_select">
										<div class="weui-cell__bd">
									<!-- <select id="province" runat="server" onchange="selectprovince(this);" name="select1" class="weui-select"> -->
									<select  id="ssss" class="weui-select" name="xueli" value="">
										<option selected value="">学历</option>	
										<option value="高中以下">高中以下</option>	
											
												<option value="高中">高中</option>	
													<option value="本科">本科</option>	
														<option value="本科以上">本科以上</option>	
															
																

										</select>			
										</div>
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label" >工作单位全名</label>
							</div>
							<div class="weui-cell__bd">
								<input type="text" class="weui-input"  placeholder="请输入工作单位名" name="gongzuodanwei">
							</div>
							
						</div>

						<div class="weui-cell" style="display:none;">
							<div class="weui-cell__hd">
								<label class="weui-label" >每月收入</label>
							</div>
							<div class="weui-cell__bd">
								<input type="number" class="weui-input" placeholder="请输入月收入" name="shouru">
							</div>
						</div>



<div class="kongbai1">
<div class="weui-cells__title" style="line-height:3;margin-top:0 !important; ">
	<p style="font-size:1vw;">请上传身份证正面照,背面照,工作牌或社保卡各一张 ：</p>
</div></div>

<div class="jindutiao1">
	<div class="weui-cell">
		<div class="weui-cell__bd">
					<div class="tupian">
       
       <div class="plus">    <img id="img1" src="" alt=""></div>
        <span id="xianshi1">点击上传身份证正面照</span>
            <input id="tupian1" onchange="input1()" type="file" class="weui-input"  placeholder="身份证正面照" name="userfile1">
        
         </div>
		</div>
	</div>

</div>

<div class="jindutiao2">
							<div class="weui-cell">
							<div class="weui-cell__bd">
              <div class="tupian"> 
       <div class="plus">+</div>

        <span id="xianshi2">点击上传身份证背面照</span>

						<input  id="tupian2" onchange="input2()" type="file" class="weui-input"  placeholder="身份证背面照" name="userfile2">	

       </div>
    </div>  
	</div>
	</div>						


	<div class="jindutiao3">
		
							<div class="weui-cell">
		
							<div class="weui-cell__bd">
              <div class="tupian">
       
       <div class="plus">+</div>
        <span id="xianshi3">点击上传工作牌或社保卡</span>
						<input  id="tupian3" onchange="input3()" type="file" class="weui-input"  placeholder="工作牌或社保卡" name="userfile3">	
							</div>
						             </div>
    </div>	
    </div>
			<!--地图在这里-->	
<div class="kongbai2"></div>
<div id='container2' style="display:none;"></div>


        <a id="result" class="weui-btn weui-btn_default" style="background-color:#fff;">点击获取当前位置</a>
<input type="hide" name="dangqianweizhi" id="result1" style="display:none;">


<div class="kongbai1"></div>

<button id="do03" class="weui-btn weui-btn_primary" style="border-radius:0px !important; " >下一步</button>

</form>



					</div>

	</div>
<script type="text/javascript">

$("#emailerror").blur(function(){



 var temp = document.getElementById("emailerror");
 var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
 if(!myreg.test(temp.value))
 {
  $(".jgjg2").css("display","block");
 
}else{
	  $(".jgjg2").css("display","none");
}


})





$("#sfz").blur(function(){

    $.ajax({ 
    	
      type:'post', 
      url:"<?php echo site_url('home/shenfenzheng_ajax')?>", 
        dataType:'json', 
        timeout:45000, 
       async:false,
       data:{
             "shenfenzheng":$("#sfz").val()
       },
      success:function(result){ 
         if(result.code!="0")
         {

     $(".jgjg").css("display","block");
         }
         else{
         	 $(".jgjg").css("display","none");
         }
        },
        error:function(result){
        	alert("未知错误");
        }
    });

})



 $("#do03").click(function(){
 	ssss=document.getElementById("ssss");
  ObjInput=document.getElementsByTagName("input") ;
  if(ssss.value==''){
  	alert("请输入学历");
  return false;
}else{

for(i=0;i <=ObjInput.length;i++){ 
    if(ObjInput[i].value==''){ 
        if(i=='0'){
            alert("请填写姓名");
           return false;
        }else if(i=='1'){
            alert("请填写手机号");
            return false;
        }
        else if(i=='2'){
            alert("请填写身份证号");
            return false;
        }else if(i=='3'){
            alert("请填写邮箱");
            return false;
        } else if(i=='4'){
            alert("请填写工作单位的全名");
           return false;
        }else if(i=='5'){
            alert("请上传身份证正面照");
            return false;
        }else if(i=='6'){
            alert("请上传身份证背面照");
            return false;
        }else if(i=='7'){
            alert("请上传工作牌或社保卡");
            return false;
        }else if(i=='8'){
            alert("请点击获取当前地址");
            return false;
        }
}

}
}
});


$("#tupian1").change(function(){
	var objUrl = getObjectURL(this.files[0]) ;
	// console.log("objUrl = "+objUrl) ;
	if (objUrl) {
		$("#img1").attr("src", objUrl) ;
	}
}) ;
//建立一個可存取到該file的url
function getObjectURL(file) {

	var url = null ; 
	if (window.createObjectURL!=undefined) { // basic
		url = window.createObjectURL(file) ;
	} else if (window.URL!=undefined) { // mozilla(firefox)
		url = window.URL.createObjectURL(file) ;
	} else if (window.webkitURL!=undefined) { // webkit or chrome
		url = window.webkitURL.createObjectURL(file) ;
	}
	return url ;
}

//正文

function input1(){
	var imgsize = document.getElementById('tupian1').files[0].size;
	var imga =(imgsize/1024).toFixed(0);
$(".jindutiao1").css("width","0");
	if(imga<1024){
if(imga>1024){

	imga=(imga/1024).toFixed(1);
	var str = $("#tupian1").val();

var x=str.substring(str.lastIndexOf("\\")+1)+' '+imga+'MB';
document.getElementById("xianshi1").innerHTML =x;
}else if(imga<1024){
var str = $("#tupian1").val();

var x=str.substring(str.lastIndexOf("\\")+1)+' '+imga+'KB';
document.getElementById("xianshi1").innerHTML =x;

}
$('#img1').css('opacity',1);


var i =0; 
var ms = 800; //变量MS: 从0%到100%需要的毫秒数
var time = setInterval(function(){
$(".jindutiao1").css("width",i+"%");

i=i+(1000/ms); 

if(i>100){
	$(".jindutiao1").css("background-color","#fff");
$(".jindutiao1").css("transition","1s");

clearInterval(time);
i=0;
// debugger;
}},10);






}else{
	alert("团片过大,请选择小于3兆的图片上传");
	return false;
}

$(".jindutiao1").css("background-color","#fc0");





}









function input2(){

var y = document.getElementById("tupian2").value;

document.getElementById("xianshi2").innerHTML =y;

$(".jindutiao2").css("background-color","#fc0");

var i =0; 
var ms = 1000; //变量MS: 从0%到100%需要的毫秒数
var time = setInterval(function(){
$(".jindutiao2").css("width",i+"%");
i=i+(1000/ms); 

if(i>100){
clearInterval(time);
}},10);
}


function input3(){

var z = document.getElementById("tupian3").value;

document.getElementById("xianshi3").innerHTML =z;

$(".jindutiao3").css("background-color","#fc0");

var i =0; 
var ms = 1000; //变量MS: 从0%到100%需要的毫秒数
var time = setInterval(function(){
$(".jindutiao3").css("width",i+"%");
i=i+(1000/ms); 

if(i>100){
clearInterval(time);
}},10);
}

  var map, geolocation;
    //加载地图，调用浏览器定位服务
   map = new AMap.Map('container2', {
        resizeEnable: true
    });

$("#result").click(function(){
  map.plugin('AMap.Geolocation', function() {
        geolocation = new AMap.Geolocation({
            enableHighAccuracy: true,//是否使用高精度定位，默认:true
            timeout: 10000,          //超过10秒后停止定位，默认：无穷大
            buttonOffset: new AMap.Pixel(10, 20),//定位按钮与设置的停靠位置的偏移量，默认：Pixel(10, 20)
            zoomToAccuracy: true,      //定位成功后调整地图视野范围使定位位置及精度范围视野内可见，默认：false
            buttonPosition:'RB'
        });
        map.addControl(geolocation);
        geolocation.getCurrentPosition();
        AMap.event.addListener(geolocation, 'complete', onComplete);//返回定位信息
        AMap.event.addListener(geolocation, 'error', onError);      //返回定位出错信息
    });




})  

    //解析定位结果
    function onComplete(data) {
        var str=['定位成功'];
        str.push('经度：' + data.position.getLng());
        str.push('纬度：' + data.position.getLat());
 
       
       // alert(data.position.getLng());
        fuck1 = data.position.getLng();
        fuck2 = data.position.getLat();
        dealjw();  //获取经纬度
    }
    function dealjw(){

  lnglatXY = [fuck1, fuck2]; 
   regeocoder();

    }
    //解析定位错误信息
    function onError(data) {
        document.getElementById('tip').innerHTML = '定位失败';
    }

   //已知点坐标

    function regeocoder() {  //逆地理编码

        var geocoder = new AMap.Geocoder({
            radius: 1000,
            extensions: "all"
        });        
        geocoder.getAddress(lnglatXY, function(status, result) {

             if (status === 'complete' && result.info === 'OK') {
                geocoder_CallBack(result);
             }
        });        
        // var marker = new AMap.Marker({  //加点
        //     map: map,
        //     position: lnglatXY
        // });
        // map.setFitView();
    }
    function geocoder_CallBack(data) {

        var address = data.regeocode.formattedAddress; //返回地址描述
        document.getElementById("result").innerHTML = address;
        document.getElementById("result1").value = address;
    }


  $.weui = {};  
  $.weui.alert = function(options){  
    options = $.extend({title: '警告', text: '警告内容'}, options);  
    var $alert = $('.weui_dialog_alert');  
    $alert.find('.weui_dialog_title').text(options.title);  
    $alert.find('.weui_dialog_bd').text(options.text);  
    $alert.on('touchend click', '.weui_btn_dialog', function(){  
      $alert.hide();  
    });  
    $alert.show();  
  };  
</script>
</body>
</html>
