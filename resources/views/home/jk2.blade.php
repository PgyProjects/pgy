<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<link rel="stylesheet" type="text/css" href="/assets/weixin/css/style.css" />
		<link rel="stylesheet" type="text/css" href="/assets/weixin/css/information.css" />
		<link rel="stylesheet" href="/assets/weixin/css/jiekuan.css" />
		<title>借款记录</title>
	</head>

	<body>
		<div class="main" id="main">
			<div class="click-jkjl">借款记录</div>
			<div class="jilubiao">
				<img src="/assets/weixin/img/jilu.png" alt="" />
				<!--<h2>借款记录状态</h2>-->
				<a href="<?php echo asset('home/index_2') ?>">
					<div class="click-jk" style="top:40vw !important;"><img src="/assets/weixin/img/button.png" alt="" />
						<p>我要借款</p>
					</div>
				</a>
			</div>
		</div>

		<div class="footer" id="footer">
			<ul>
				<a href="<?php echo asset('home')?>">
					<li>
						<img src="/assets/weixin/img/sy_white.png" />
					</li>
				</a>
				<a href="<?php echo asset('home/index_2')?>">
					<li>
						<img src="/assets/weixin/img/te_white.png" />
					</li>
				</a>
				<a href="<?php echo asset('home/index_3')?>">
					<li>
						<img src="/assets/weixin/img/jl_purple.png" />
					</li>
				</a>
				<a href="<?php echo asset('home/index_4')?>">
					<li>
						<img src="/assets/weixin/img/tj_white.png" />
					</li>
				</a>
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