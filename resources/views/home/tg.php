<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>完成页</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<link rel="stylesheet" href="<?php echo base_url('public/')?>css/neicss.css">
	<link rel="stylesheet" href="<?php echo base_url('public/')?>weui-master/dist/style/weui.css">
	<link rel="stylesheet" href="<?php echo base_url('public/')?>weui-master/dist/example/example.css">

<style>
.jinggao2 li p:first-letter{margin-left: -7vw;}
#erweima123{
	position: absolute;
    width: 25vw;
    height: 25vw;
    top: 7.5vw;
    left: 37.5vw;
}
.wc-head{

	    font-family: 微软雅黑;
    height: 16vw;
    background-color: #6fbcf7;
    font-size: 4.5vw;
    padding: 20px;}
 .wc-head p{
 	color: #fff;
 	font-weight: bold;
 }
.wc-wxm{

font-family: 微软雅黑;
text-align: center;

}
.wc-ewm img{ width: 100%; }
.jinggao{width: 100%;
height: 100%;}
.jinggao2{
padding-top: 56vw;
	height: 95vw;
	background-color:#6fbcf7; 
	width: 100%;
}
.jinggao2 ul{
	margin-top:8vw;
}
.jinggao2 li{
	font-size: 3.2vw;
	color: #fff;
	padding:0 15vw;
	line-height: 7vw;
}
</style>
</head>
<body>
		



<div class="wc-head">
<p style="text-align:center"><?php echo $xingming?></p>
<p style="text-align:center;margin-top:2vw;"> 审核状态</p>
	<p style="    margin-top: 7vw;display:none;">您已借款成功，如有疑问可以点击识别下面的二维码来联系您的客户经理</p>
</div>



<div class="wc-ewm" style="background-color:#6fbcf7;position:absolute;">
<img src="<?php echo base_url('public/')?>1027.jpg" alt="">
<div id="erweima123">
<img src="<?php echo base_url('public/')?>jl.jpg" alt="" style="width:100%;">


</div>
</div>


<div class="wc-wxm" style="width: 100%;
    background-color: #6fbcf7;
    color: #fff;
    position: absolute;
    margin-top: 40vw;">
微信号：Dandelion-04


</div>


<div class="jinggao2">

<img style="display:none;" src="ts.jpg" alt="">
<p style="    letter-spacing: 0.5vw;
    height: 9vw;
    width: 30vw;
    text-align: center;
    background: #fff;
    margin: 0 auto;
    border-radius: 9px;
    line-height: 9vw;
    font-weight: bold;
    color: #6fbcf7;

    font-size: 5vw;">逾期影响</p>

<ul>

<li>
<p><span>1、</span>会影响你的芝麻分,严重逾期会上传央行征信体系。</p>
</li>
<li>
<p><span>2、</span>所有亲属将会对你失去信任。</p>
</li>
<li>
<p><span>3、</span>本地催收人员上门催收。</p>
</li>
<li>
<p><span>4、</span>起诉强制执行。</p>
</li>
</ul>
<p style="text-align:center;color:#fff;line-height:7vw;margin-top:5vw;font-size:3.2vw;">提醒各位借款人,当还款有困难时,</p>
<p style="text-align:center;color:#fff;line-height:7vw;text-indent:3vw;font-size:3.2vw;">可以及时申请延期,千万不要逾期。</p>
<hr style="width:90vw;margin:auto;margin-top:5vw;background-color:#fff;border:none;height:1px;">
<hr style="width:80vw;margin:auto;margin-top:4vw;background-color:#fff;border:none;height:1px;">
</div>







</body>
</html>