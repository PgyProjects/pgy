<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<link rel="stylesheet" type="text/css" href="/assets/weixin/css/style.css" />
		<link rel="stylesheet" type="text/css" href="/assets/weixin/css/tj_info.css" />
		<title></title>
	</head>

	<body>
		<div class="main" id="main">
			<ul class="top_ul">
				<li>
					<div class="border_left_top">待结算佣金</div>
					<div class="border_right_top">10000</div>
				</li>
				<li>
					<div class="border_left_bottom">已结算佣金</div>
					<div class="border_right_bottom">10000</div>
				</li>
			</ul>
			<div class="btn">推荐客户信息</div>
			<ul class="info_people">
				<li>
					<span class="">姓名</span>
					<span class="">手机</span>
					<span class="">状态</span>
					<span class="">时间</span>
				</li>
				<li>
					<span class=""></span>
					<span class=""></span>
					<span class=""></span>
					<span class=""></span>
				</li>
				<li>
					<span class=""></span>
					<span class=""></span>
					<span class=""></span>
					<span class=""></span>
				</li>
				<li>
					<span class=""></span>
					<span class=""></span>
					<span class=""></span>
					<span class=""></span>
				</li>
				<li>
					<span class=""></span>
					<span class=""></span>
					<span class=""></span>
					<span class=""></span>
				</li>
			</ul>
		</div>
		<div class="footer" id="footer">
			<ul>
				<a href="index.html"><li>
					<img src="/assets/weixin/img/sy_white.png" />
				</li></a>
				<a href="information.html"><li>
					<img src="/assets/weixin/img/te_white.png" />
				</li></a>
				<a href="jk1.html"><li>
					<img src="/assets/weixin/img/jl_white.png" />
				</li></a>
				<a href="erweima.html"><li>
					<img src="/assets/weixin/img/tj_purple.png" />
				</li></a>
			</ul>
		</div>
	</body>
	<script type="text/javascript">
		/*中间内容高度*/
		var srceenHeight = window.screen.availHeight;
		var fHeght = document.getElementById('footer').offsetHeight;
		document.getElementById('main').style.height = srceenHeight - fHeght + 'px';
	</script>

</html>