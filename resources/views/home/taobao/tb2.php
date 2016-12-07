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
.tb-ewm img{
	width: 100%;

}





	</style>
</head>
<body ontouchstart>
	<div class="head2">
	<span>淘宝认证</span>	
	</div>
	<div class="kongbai1"></div>
	<div class="tishi">
		<p>保存下面的二维码,用手机淘宝打开</p>
		
	</div>
<div class="container" id="container">
	<div class="page__bd">
	<form>
<div class="tb-ewm">

<img src="<?php echo $_GET['erweima']?>" alt="">

</div>
	</form>
	</div>
	</div>
</body>
</html>