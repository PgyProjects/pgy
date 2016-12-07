<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<title>表单填写</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0" />
	<link rel="stylesheet" href="/assets/weixin/css/neicss.css" />
	<link rel="stylesheet" href="/assets/weixin/weui-master/dist/style/weui.css" />
	<link rel="stylesheet" href="/assets/weixin/weui-master/dist/example/example.css" />

<script src="/assets/weixin/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<style>
.du-botton{
	padding-top: 2vw;
	background-color: #f8f8f8;
}
.down{
	margin: auto;
	background-color: #f8f8f8;
	width: 8vw;
}
.down img{
	width: 100%;

}
.du-botton p{    color: #999;
    text-align: center;}
</style>
</head>
<body ontouchstart>
	
	<div class="head2">
	<span>联系人信息填写</span>	
	</div>
	<form action="" method="post">
	<div class="container" id="container">
		<div class="weui-cells weui-cells_form">
<div class="kongbai1" style="height:18vw !important;">

<div class="weui-cells__title" style="margin-top:0 !important; padding-bottom:3px;">
<p style="font-weight:bold;color:#000;">联系人信息</p>
	<p>以下信息均需填写,审核过程中不会打电话给联系人,请如实填写</p>
</div></div>
	<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">父亲</label>
							</div>
							<div class="weui-cell__bd">
								<input type="hidden" name="shenfenzheng" value="<?php echo @$_GET['shenfenzheng']?>">
								<input type="text" class="weui-input" placeholder="请输入姓名" name="fuqin_xingming">
							</div>
							
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">手机</label>
							</div>
							<div class="weui-cell__bd">
								<input id="fphone" type="tel" class="weui-input" maxlength="11" placeholder="请输入号码" name="fuqin_shoujihao">
							</div>
							
						</div>

<div class="kongbai2"></div>

					<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">母亲</label>
							</div>
							<div class="weui-cell__bd">
								<input  type="text" class="weui-input" placeholder="请输入姓名" name="muqin_xingming">
							</div>
							
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">手机</label>
							</div>
							<div class="weui-cell__bd">
								<input id="mphone" type="tel" class="weui-input" maxlength="11" placeholder="请输入号码" name="muqin_shoujihao">
							</div>
							
						</div>
<div class="kongbai2"></div>
					<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">配偶</label>
							</div>
							<div class="weui-cell__bd">
								<input type="text" class="weui-input" placeholder="请输入姓名" name="peiou_xingming">
							</div>
							
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">手机</label>
							</div>
							<div class="weui-cell__bd">
								<input id="pphone" type="tel" class="weui-input" maxlength="11" placeholder="请输入号码" name="peiou_shoujihao">
							</div>
							
						</div>

<div class="kongbai2"></div>








<div class="yincang" style="display:none;">
			<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">单位领导</label>
							</div>
							<div class="weui-cell__bd">
								<input type="text" class="weui-input" placeholder="请输入姓名" name="lingdao_xingming">
							</div>
							
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">手机</label>
							</div>
							<div class="weui-cell__bd">
								<input id="1phone" type="tel" class="weui-input" maxlength="11" placeholder="请输入号码" name="lingdao_shoujihao">
							</div>
							
						</div>
<div class="kongbai2"></div>
 

			<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">朋友姓名</label>
							</div>
							<div class="weui-cell__bd">
								<input type="text" class="weui-input" placeholder="请输入姓名" name="pengyou_xingming">
							</div>
							
						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">手机</label>
							</div>
							<div class="weui-cell__bd">
								<input id="yphone" type="tel" class="weui-input" maxlength="11" placeholder="请输入号码" name="pengyou_shoujihao">
							</div>
							
						</div>

					</div>	
					<div class="du-botton"> <div class="down"><img id="du" src="/assets/weixin/icon/+.png" alt=""></div>

<p id="tishi-01">点击填写更多信息来提升额度</p>


					</div>
						<div class="kongbai1"></div>
<button id="do02" class="weui-btn weui-btn_primary" style="border-radius:0px !important;">下一步</button>
	</div>
	</div>
</form>

</body>

<script type="text/javascript">

 $("#do02").click(function(){




  ObjInput=document.getElementsByTagName("input") ;
for(i=0;i <=ObjInput.length;i++){ 
    if(ObjInput[i].value==''){ 
        if(i=='1'){
            alert("请填写您父亲的姓名");
            return false;
        }else if(i=='2'){
            alert("请填写您父亲手机号");
              return false;
        }else if(i=='3'){
            alert("请填写您母亲的姓名");
            return false;
        }else if(i=='4'){
            alert("请填写您母亲的手机号");
            return false;
        }else if(i=='5'){
            alert("请填写您配偶的姓名");
             return false;
        }else if(i=='6'){
            alert("请填写您配偶的手机号");
              return false;
        }
}else{

	var fphone = document.getElementById('fphone').value;
    if(!(/^1[34578]\d{9}$/.test(fphone))){ 
        alert("父亲手机号码有误，请重填");  
        $("#fphone").css("border","1px solid red");
        return false; 
    }

var mphone = document.getElementById('mphone').value;
    if(!(/^1[34578]\d{9}$/.test(mphone))){ 
        alert("母亲手机号码有误，请重填"); 
           $("#mphone").css("border","1px solid red"); 
        return false; 
    }

var pphone = document.getElementById('pphone').value;
    if(!(/^1[34578]\d{9}$/.test(pphone))){ 
        alert("配偶手机号码有误，请重填");  
            $("#pphone").css("border","1px solid red"); 
        return false; 
    }

}




}
})

var index = 1;
 $('.down').click(function() {

			if(index == '1') {
				//$('.yincang').css('height', '660px');
				$('.yincang').slideToggle();
					$('#du').attr('src','icon/-.png')
                    $('#tishi-01').html('');
				//$(this).children('img').addClass('move_top');
				index = 2;
			} else if(index == '2') {
				//$('.lcList').css('height', '300px');
				$('.yincang').slideToggle();
				$('#du').attr('src','icon/+.png')
				  $('#tishi-01').html('点击填写更多信息来提升额度');
				//$(this).children('img').removeClass('move_top');
				index = 1;
			}
		})





</script>
</html>