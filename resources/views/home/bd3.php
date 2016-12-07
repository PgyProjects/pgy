<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<title>表单填写</title>

	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<link rel="stylesheet" href="<?php echo base_url('public/')?>css/neicss.css">

	<link rel="stylesheet" href="<?php echo base_url('public/')?>weui-master/dist/style/weui.css">
	<link rel="stylesheet" href="<?php echo base_url('public/')?>weui-master/dist/example/example.css">

 <link rel="stylesheet" href="https://res.wx.qq.com/open/libs/weui/0.3.0/weui.css" />
<script src="<?php echo base_url('public/')?>js/jquery-1.9.1.min.js" type="text/javascript"></script>

<script src="<?php echo base_url('public/')?>js/Area.js" type="text/javascript"></script>
<script src="<?php echo base_url('public/')?>js/AreaData_min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="http://cache.amap.com/lbs/static/main1119.css"/>
    <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=b4fbc5e7c2097f9b9a19eeba7d3621d4"></script>
        <script type="text/javascript" src="http://webapi.amap.com/maps?v=1.3&key=c86109f4135f98f235e2516e58fc2f8e&plugin=AMap.Geocoder"></script>
    <script type="text/javascript" src="http://cache.amap.com/lbs/static/addToolbar.js"></script>


    <style>

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
      margin-top: 1vw;
    position: absolute;
    margin-left: 21vw;
}
    </style>
</head>
<body ontouchstart>
	<div class="head2">
	<span>身份验证3</span>	
	</div>
	<?php echo form_open_multipart('home/bd3');?>
	<div class="container" id="container">
		<div class="weui-cells weui-cells_form">
<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">芝麻分</label>
							</div>
							<div class="weui-cell__bd">
								<input type="hidden" name="shenfenzheng" value="<?php echo @$_GET['shenfenzheng']?>">
								<input type="text" class="weui-input" placeholder="请输入芝麻分" name="zhimafen">
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
						<div class="weui-cell" style="display:none;">
							<div class="weui-cell__hd">
								<label class="weui-label">借款用途</label>
							</div>
							<div class="weui-cell__bd">
								<input type="text" class="weui-input"  placeholder="请输入借款用途" name="yongtu">
							</div>
							
						</div>
<div class="kongbai2"></div>
<!--
<a id="baidu_geo" class="weui-btn weui-btn_default" style="background-color:#fff;">点击获取当前位置</a>-->







<div class="kongbai1">
<div class="weui-cells__title" style="line-height:3;margin-top:0 !important; ">
	<p style="font-size:1vw;">请上传身份证正面照,背面照,工作牌或社保卡各一张 ：</p>
</div></div>

	<div class="weui-cell">
		<div class="weui-cell__bd">
					<div class="tupian">
       
       <div class="plus">+</div>
        <span id="xianshi1">点击上传身份证正面照</span>
            <input id="tupian1" onchange="input1()" type="file" class="weui-input"  placeholder="身份证正面照" name="userfile1">
         </div>
		</div>
	</div>




							<div class="weui-cell">
							<div class="weui-cell__bd">
              <div class="tupian"> 
       <div class="plus">+</div>

        <span id="xianshi2">点击上传身份证背面照</span>

						<input  id="tupian2" onchange="input2()" type="file" class="weui-input"  placeholder="身份证背面照" name="userfile2">	

       </div>
    </div>  
	</div>
							
		
							<div class="weui-cell">
		
							<div class="weui-cell__bd">
              <div class="tupian">
       
       <div class="plus">+</div>
        <span id="xianshi3">点击上传工作牌或社保卡</span>
						<input  id="tupian3" onchange="input3()" type="file" class="weui-input"  placeholder="工作牌或社保卡" name="userfile3">	
							</div>
						             </div>
    </div>	
				

<!-- 
<div class="weui_cells weui_cells_form"  style="margin-top:0px;">
      <div class="weui_cell">

        <div class="weui_cell_bd weui_cell_primary">
          <div class="weui_uploader">
            <div class="weui_uploader_hd weui_cell">
              <div class="weui_cell_bd weui_cell_primary">图片上传</div>
              <div class="weui_cell_ft js_counter">0/3</div>
            </div>
            <div class="weui_uploader_bd">
              <ul class="weui_uploader_files">
           </ul>
              <div class="weui_uploader_input_wrp">
                <input class="weui_uploader_input js_file" type="file" accept="image/jpg,image/jpeg,image/png,image/gif" multiple="" name="userfile"></div>
                
            </div>
          </div>
        </div> -->
   
<div class="kongbai2"></div>
<div id='container2' style="display:none;"></div>
   
<!-- <input id="result" class="weui-btn weui-btn_default" name="dizhi"  placeholder="点击获取当前位置" style="background-color:#fff;"> -->




     
        <a id="result" class="weui-btn weui-btn_default" style="background-color:#fff;">点击获取当前位置</a>
<input type="hide" name="dangqianweizhi" id="result1" style="display:none;">

      




<div class="kongbai2"></div>
	<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">备注</label>
							</div>
							<div class="weui-cell__bd">
								<input type="text" class="weui-input" maxlength="11" placeholder="请输入备注" name="beizhu">
							</div>
							
						</div>
<div class="kongbai1"></div>
<button class="weui-btn weui-btn_primary" style="border-radius:0px !important;" id="do03">提交</button>
		</div>

	</form>

<script>  
   $("#do03").click(function(){
  ObjInput=document.getElementsByTagName("input") ;
 var a=0;
for(i=0;i <=ObjInput.length;i++){ 
    if(ObjInput[i].value==''){ 
        if(i=='1'){
            alert("请填写芝麻分");
           return false;
        }else if(i=='2'){
            alert("请填写手机号");
           return false;
        }else if(i=='3'){
            alert("请填写借款用途");
           return false;
        }else if(i=='4'){
            alert("请上传身份中正面照");
            return false;
        }else if(i=='5'){
            alert("请上传身份证背面照");
          return false;
        }else if(i=='6'){
            alert("请上传工作证或社保卡");
           return false;
        }else if(i=='7'){
            alert("请点击获取当前地址");
          return false;
        }
}
}
});


function input1(){

var x = document.getElementById("tupian1").value;

document.getElementById("xianshi1").innerHTML =x;
}

function input2(){

var y = document.getElementById("tupian2").value;

document.getElementById("xianshi2").innerHTML =y;
}


function input3(){

var z = document.getElementById("tupian3").value;

document.getElementById("xianshi3").innerHTML =z;
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
  
  // $(function () {  
  //   // 允许上传的图片类型  
  //   var allowTypes = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];  
  //   // 1024KB，也就是 1MB  
  //   var maxSize = 1024 * 1024;  
  //   // 图片最大宽度  
  //   var maxWidth = 300;  
  //   // 最大上传图片数量  
  //   var maxCount = 3;  
  //   $('.js_file').on('change', function (event) {  
  //     var files = event.target.files;  
      
  //       // 如果没有选中文件，直接返回  
  //       if (files.length === 0) {  
  //         return;  
  //       }  
        
  //       for (var i = 0, len = files.length; i < len; i++) {  
  //         var file = files[i];  
  //         var reader = new FileReader();  
          
  //           // 如果类型不在允许的类型范围内  
  //           if (allowTypes.indexOf(file.type) === -1) {  
  //             $.weui.alert({text: '该类型不允许上传'});  
  //             continue;  
  //           }  
            
  //           if (file.size > maxSize) {  
  //             $.weui.alert({text: '图片太大，不允许上传'});  
  //             continue;  
  //           }  
            
  //           if ($('.weui_uploader_file').length >= maxCount) {  
  //             $.weui.alert({text: '最多只能上传' + maxCount + '张图片'});  
  //             return;  
  //           }  
            
  //           reader.onload = function (e) {  
  //             var img = new Image();  
  //             img.onload = function () {  
  //                   // 不要超出最大宽度  
  //                   var w = Math.min(maxWidth, img.width);  
  //                   // 高度按比例计算  
  //                   var h = img.height * (w / img.width);  
  //                   var canvas = document.createElement('canvas');  
  //                   var ctx = canvas.getContext('2d');  
  //                   // 设置 canvas 的宽度和高度  
  //                   canvas.width = w;  
  //                   canvas.height = h;  
  //                   ctx.drawImage(img, 0, 0, w, h);  
  //                   var base64 = canvas.toDataURL('image/png');  
                    
  //                   // 插入到预览区  
  //                   var $preview = $('<li class="weui_uploader_file weui_uploader_status" style="background-image:url(' + base64 + ')"><div class="weui_uploader_status_content">0%</div></li>');  
  //                   $('.weui_uploader_files').append($preview);  
  //                   var num = $('.weui_uploader_file').length;  
  //                   $('.js_counter').text(num + '/' + maxCount);  
                    
  //                   // 然后假装在上传，可以post base64格式，也可以构造blob对象上传，也可以用微信JSSDK上传  
                    
  //                   var progress = 0;  
  //                   function uploading() {  
  //                     $preview.find('.weui_uploader_status_content').text(++progress + '%');  
  //                     if (progress < 100) {  
  //                       setTimeout(uploading, 30);  
  //                     }  
  //                     else {  
  //                           // 如果是失败，塞一个失败图标  
  //                           //$preview.find('.weui_uploader_status_content').html('<i class="weui_icon_warn"></i>');  
  //                           $preview.removeClass('weui_uploader_status').find('.weui_uploader_status_content').remove();  
  //                         }  
  //                       }  
  //                       setTimeout(uploading, 30);  
  //                     };  
                      
  //                     img.src = e.target.result;  
  //                   };  
  //                   reader.readAsDataURL(file);  
  //                 }  
  //               });  
  // });  
//# sourceURL=pen.js  


</script>

</body>
</html>