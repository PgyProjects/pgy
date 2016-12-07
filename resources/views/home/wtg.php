<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<link rel="stylesheet" href="<?php echo base_url('public/')?>css/neicss.css">
	<link rel="stylesheet" href="<?php echo base_url('public/')?>weui-master/dist/style/weui.css">
	<link rel="stylesheet" href="<?php echo base_url('public/')?>weui-master/dist/example/example.css">

<script src="<?php echo base_url('public/')?>js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('public/')?>js/Area.js" type="text/javascript"></script>
<script src="<?php echo base_url('public/')?>js/AreaData_min.js" type="text/javascript"></script>
<style>

/*.weui-cells{ background-color: #6fbcf7 !important;}*/

.jinggao2 li p:first-letter{margin-left: -7vw;}

.wc-head{
	    font-family: 微软雅黑;
    height: 16vw;

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
padding-top: 4vw;
	height: 140vw;

	width: 100%;
}
.jinggao2 ul{
	margin-top:5vw;
}
.jinggao2 li{
	font-size: 5vw;
	color: #30cead;
	padding:0 14.5vw;
	line-height: 7vw;
}
.nlz img{
	width: 100%;

	margin: 0 auto;
}
</style>
</head>
<body ontouchstart>
		
	<div class="container" id="container">
		<div class="weui-cells weui-cells_form" style="margin-top:0px;padding-bottom:50px;">


<div class="wc-head">
<p style="text-align:center;color:#30cead"><?php echo $xingming?></p>
<p style="text-align:center;margin-top:2vw;color:#30cead">审核未通过</p>
	<p style="    margin-top: 7vw;display:none;">您未通过审核，可以点击识别下面的二维码来向您的客户经理寻求帮助</p>
</div>



<!-- <div class="wc-ewm">
<img src="321.jpg" alt="">
</div> -->


<!-- <div class="wc-wxm">
微信号：XXXXXXXXXXX

</div> -->


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
    color: #30cead;

    font-size: 4vw;">没通过的原因</p>

<ul>

<li>
<p><span>1、</span>法院有在执行记录。</p>
</li>
<li>
<p><span>2、</span>从事的职业有风险</p>
</li>
<li>
<p><span>3、</span>其他借款机构有过逾期。</p>
</li>
<li>
<p><span>4、</span>经常联系的朋友在金融机构恶意逾期。</p>
</li>
<li>
<p><span>5、</span>平时的消费习惯，打车爽约等行为习惯。</p>
</li>
</ul>

<div class="nlz">
<img src="<?php echo base_url('public/nlz/')?><?php echo $wtg_img?>" alt="">
<div class="zhezhao321" style="    position: absolute;
    width: 100%;
    height: 96vw;
    top: 87vw;">


</div>

</div>

<!-- <p style="text-align:center;color:#fff;line-height:7vw;margin-top:5vw;font-size:4vw;">提醒各位借款人,当还款有困难时,</p>
<p style="text-align:center;color:#fff;line-height:7vw;text-indent:3vw;font-size:4vw;">可以及时申请延期,千万不要逾期。</p> -->
<hr style="width:90vw;margin:auto;margin-top:89vw;background-color:#fff;border:none;height:1px;">
<hr style="width:80vw;margin:auto;margin-top:4vw;background-color:#fff;border:none;height:1px;">
</div>


</div>
</div>





</body>
</html>