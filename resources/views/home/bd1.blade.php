<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<title>表单填写</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<link rel="stylesheet" href="/assets/weixin/css/neicss.css">
	<link rel="stylesheet" href="/assets/weixin/weui-master/dist/style/weui.css">
	<link rel="stylesheet" href="/assets/weixin/weui-master/dist/example/example.css">

<script src="/assets/weixin/js/jquery-1.9.1.min.js" type="text/javascript"></script>

<style>
/*这里设置透明度为0让小图不显示*/.plus img{height: 11vw;opacity: 0;}
.jindutiao1{
height: 12vw;
	width: 0%;
	   
}

.jindutiao2{
height: 12vw;
	width: 0%;
	   
}
.jindutiao3{
height: 12vw;
	width: 0%;
	   
}




.tupian input{
	width:100vw;
opacity: 0;
position: absolute;
}
.plus{
         float: left;
    font-size: 22px;

    display: table-cell;
    vertical-align: middle;
}
.plus b{line-height: 12vw;}
.tupian span{
	color:#999;
	line-height: 10vw;
	width: 1000%;
      margin-top: 1vw;
    position: absolute;
    margin-left: 30vw;
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
	<span>基本信息填写</span>	
	</div>
<form>

	<div class="container" id="container">
					<div class="weui-cells weui-cells_form">



					
<!-- <div style="display:none;">
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
</div> -->




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
								<input id="phone" type="text" class="weui-input" maxlength="11" placeholder="请输入手机号" name="shoujihao">
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
						<!-- <div class="jgjg">*请输入正确的身份证号 </div> -->
						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label" >邮箱</label>
							</div>
							<div class="weui-cell__bd">
								<input id="email" type="text" class="weui-input"  placeholder="请输入邮箱" name="email">
							</div>
							
						</div>
					<!-- 	<div class="jgjg2">*请输入正确的邮箱 </div> -->
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
						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label" >芝麻分</label>
							</div>
							<div class="weui-cell__bd">
								<input type="text" class="weui-input"  placeholder="请输入芝麻信用分数" name="zhimafen">
							</div>	
						</div>

							<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label" >地址</label>
							</div>
							<div class="weui-cell__bd">
								<input type="text" class="weui-input"  placeholder="请输入您的家庭地址" name="dangqianweizhi">
							</div>
							
						</div>

					
<div class="kongbai1">
<div class="weui-cells__title" style="line-height:3;margin-top:0 !important; ">
	<p style="font-size:3.5vw;">请上传身份证正面照,背面照,工作牌或社保卡各一张 ：</p>
</div>
</div>


<div class="jindutiao1">
	<div class="weui-cell"  style="padding:0px 15px;">
		<div class="weui-cell__bd">
					<div class="tupian">
       
       <div class="plus">   <b id="jiahao1">+</b> <img id="img1" src="" alt=""></div>
        <span id="xianshi1">身份证正面</span>
            <input id="tupian1"  onchange="input1()"  type="file" class="weui-input"  placeholder="身份证正面照" name="userfile1">
        
         </div>
		</div>
	</div>

</div>
<hr style="margin-left: 4vw;
    background: #f5f5f5;
    width: 100%;
    height: 1px;
   
    border: 1px solid #fff;">



<div class="jindutiao2">
							<div class="weui-cell"  style="padding:0px 15px;">
							<div class="weui-cell__bd">
              <div class="tupian"> 
       <div class="plus"> <b id="jiahao2">+</b>  <img id="img2" src="" alt=""></div>

        <span id="xianshi2">身份证背面</span>

						<input  id="tupian2" onchange="input2()" type="file" class="weui-input"  placeholder="身份证背面照" name="userfile2">	

       </div>
    </div>  
	</div>
	</div>						
<hr style="margin-left: 4vw;
    background: #f5f5f5;
    width: 100%;
    height: 1px;
   
    border: 1px solid #fff;">

	<div class="jindutiao3">
		
							<div class="weui-cell"  style="padding:0px 15px;">
		
							<div class="weui-cell__bd">
              <div class="tupian">
       
       <div class="plus">  <b id="jiahao3">+</b>  <img id="img3" src="" alt=""></div>
        <span id="xianshi3">工作牌或社保卡</span>
						<input  id="tupian3" onchange="input3()" type="file" class="weui-input"  placeholder="工作牌或社保卡" name="userfile3">	
							</div>
						             </div>
    </div>	
    </div>
    <hr style="margin-left: 4vw;
    background: #f5f5f5;
    width: 100%;
    height: 1px;
   
    border: 1px solid #fff;">
			<!--地图在这里-->	
<!-- <div class="kongbai2"></div>
<div id='container2' style="display:none;"></div> -->


       <!--  <a id="result" class="weui-btn weui-btn_default" style="background-color:#fff;">点击获取当前位置</a>
<input type="hide" name="dangqianweizhi" id="result1" style="display:none;"> -->





<div class="kongbai1"></div>
<button id="do03" class="weui-btn weui-btn_primary" style="border-radius:0px !important; " >下一步</button>
</form>


					</div>

	</div>
<script type="text/javascript">

$("#email").blur(function(){



 var temp = document.getElementById("email");
 var myreg = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
 if(!myreg.test(temp.value))
 {
 	alert("邮箱格式不正确,请填写正确邮箱")
  $("#email").css("border","1px solid red");
 
}else{
	  $("#email").css("border","0px");
}


})





$("#sfz").blur(function(){

    $.ajax({ 
    	
      type:'post', 
      url:"", 
        dataType:'json', 
        timeout:45000, 
       async:false,
       data:{
             "shenfenzheng":$("#sfz").val()
       },
      success:function(result){ 
         if(result.code!="0")
         {
alert("该身份证不存在,请填写正确身份证号")
     $("#sfz").css("border","1px solid red");
         }
         else{
         	 $("#sfz").css("border","0px");
         }
        },
        error:function(result){
        	alert("未知错误");
        }
    });

})



 $("#do03").click(function(){
 	var phone = document.getElementById('phone').value;
    if(!(/^1[34578]\d{9}$/.test(phone))){ 
        alert("手机号码有误，请重填");  
        return false; 
    }
 	ssss=document.getElementById("ssss");
  ObjInput=document.getElementsByTagName("input") ;
  if(ssss.value==''){
  	alert("请输入学历");
  return false;
}else if(ssss.value!=''){

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
 			alert("请输入您的芝麻分");
            return false;
        }
      else if(i=='7'){
      	 alert("请输入您的家庭地址");
            return false;
      }
        else if(i=='8'){
            alert("请上传身份证背面照");
            return false;
        }else if(i=='9'){
            alert("请上传工作牌或社保卡");
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

$("#tupian2").change(function(){
	var objUrl = getObjectURL(this.files[0]) ;
	// console.log("objUrl = "+objUrl) ;
	if (objUrl) {
		$("#img2").attr("src", objUrl) ;
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

$("#tupian3").change(function(){
	var objUrl = getObjectURL(this.files[0]) ;
	// console.log("objUrl = "+objUrl) ;
	if (objUrl) {
		$("#img3").attr("src", objUrl) ;
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
	$("#jiahao1").css("display","none");
	$("#xianshi1").css("margin-left","10vw");
	var imgsize = document.getElementById('tupian1').files[0].size;
	var imga =(imgsize/1024).toFixed(0);
$(".jindutiao1").css("width","0");
	if(imga<3076){
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
$(".jindutiao1").css("background-color","#7df");
}








function input2(){
	$("#jiahao2").css("display","none");
	$("#xianshi2").css("margin-left","10vw");
	var imgsize = document.getElementById('tupian2').files[0].size;
	var imga =(imgsize/1024).toFixed(0);
$(".jindutiao2").css("width","0");
	if(imga<3076){
if(imga>1024){

	imga=(imga/1024).toFixed(1);
	var str = $("#tupian2").val();

var y=str.substring(str.lastIndexOf("\\")+1)+' '+imga+'MB';
document.getElementById("xianshi2").innerHTML =y;
}else if(imga<1024){
var str = $("#tupian2").val();

var y=str.substring(str.lastIndexOf("\\")+1)+' '+imga+'KB';
document.getElementById("xianshi2").innerHTML =y;

}
$('#img2').css('opacity',1);


var i =0; 
var ms = 800; //变量MS: 从0%到100%需要的毫秒数
var time = setInterval(function(){
$(".jindutiao2").css("width",i+"%");

i=i+(1000/ms); 

if(i>100){
	$(".jindutiao2").css("background-color","#fff");
$(".jindutiao2").css("transition","1s");

clearInterval(time);
i=0;
// debugger;
}},10);
}else{
	alert("团片过大,请选择小于3兆的图片上传");
	return false;
}
$(".jindutiao2").css("background-color","#7df");
}




function input3(){
	$("#jiahao3").css("display","none");
	$("#xianshi3").css("margin-left","10vw");
	var imgsize = document.getElementById('tupian3').files[0].size;
	var imga =(imgsize/1024).toFixed(0);
$(".jindutiao3").css("width","0");
	if(imga<3076){
if(imga>1024){

	imga=(imga/1024).toFixed(1);
	var str = $("#tupian3").val();

var z=str.substring(str.lastIndexOf("\\")+1)+' '+imga+'MB';
document.getElementById("xianshi3").innerHTML =z;
}else if(imga<1024){
var str = $("#tupian3").val();

var z=str.substring(str.lastIndexOf("\\")+1)+' '+imga+'KB';
document.getElementById("xianshi3").innerHTML =z;

}
$('#img3').css('opacity',1);


var i =0; 
var ms = 800; //变量MS: 从0%到100%需要的毫秒数
var time = setInterval(function(){
$(".jindutiao3").css("width",i+"%");

i=i+(1000/ms); 

if(i>100){
	$(".jindutiao3").css("background-color","#fff");
$(".jindutiao3").css("transition","1s");

clearInterval(time);
i=0;
// debugger;
}},10);
}else{
	alert("团片过大,请选择小于3兆的图片上传");
	return false;
}
$(".jindutiao3").css("background-color","#7df");
}








</script>
</body>
</html>
