<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/weixin/css/style.css') ?>" />
	<script type="text/javascript" src="<?php echo asset('assets/weixin/js/jquery-1.9.1.min.js') ?>"></script>
				
	
		<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/weixin/css/information.css') ?>" />
		<title>客户经理二维码</title>
	</head>
	<body style="font-family: '微软雅黑';">
	<div class="main" id="main">
		<div class="head-2">
          	<img src="<?php echo asset('assets/weixin/img/back-1.png') ?>" alt="" />
          	<div class="da-yuan"><img src="<?php echo asset('assets/weixin/img/boy.png') ?>" alt="" /></div>
          	<div class="xiao-yuan"><img src="<?php echo asset('assets/weixin/img/girl.png') ?>" alt="" /></div>     	
          </div>
          

          
          <div class="erweima">
        	<img src="<?php echo asset('assets/weixin/img/erweima.png') ?>" style="width:100%;"/>
          </div>
          
          <div class="click-tj" style="background: #fff !important;border: none;color:#000">扫描微信二维码联系客户经理</div>
  			<!--<span>
        		扫描微信二维码联系客户经理
          </span>-->
	</div>
			
			
			
			
			
			
			
			
			
			<div class="footer" id="footer">
			<ul>
				<a href="<?php echo asset('home') ?>"><li>
					<img src="../assets/weixin/img/sy_white.png" />
				</li></a>
				<a href="<?php echo asset('home/index_2') ?>"><li>
					<img src="../assets/weixin/img/te_purple.png" />
				</li></a>
				<a href="<?php echo asset('home/index_3') ?>"><li>
					<img src="../assets/weixin/img/jl_white.png" />
				</li></a>
				<a href="<?php echo asset('home/index_4') ?>"><li>
					<img src="../assets/weixin/img/tj_white.png" />
				</li></a>
			</ul>
		</div>
	</body>
		<script type="text/javascript">
		/*中间内容高度*/
		var srceenHeight = window.screen.height;
		var fHeght = document.getElementById('footer').offsetHeight;
		document.getElementById('main').style.height = srceenHeight - fHeght + 2 + 'px';
		
	</script>

</html>
