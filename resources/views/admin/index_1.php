<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/weixin/css/style.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/weixin/css/index_style.css') ?>" />
		<title></title>
	</head>

	<body>
		<div class="main" id="main">
			<ul>
				<li class="firstLi">
					<p>已有<span>10000</span>人成功放款</p>
				</li>
				<li class="edu">
					<div class="edu_indx">
						<div class="moneyNum">暂无额度</div>
						<div class="tishi">
							<img src="<?php echo asset('assets/weixin/img/tanhao.png') ?>"/>
							<p>仅支持<span class="colorE4">500</span>元以上贷款，快去<span class="colorE4">提额</span>吧</p>
						</div>
					</div>
				</li>
				<li class="thirdLi">
					<div class="divMain">
						<div class="divMain_left">
							<span class="num">6000</span>
							<span>信用额度(元)</span>
						</div>
						<div class="divMain_right">
							<span class="num">30</span>
							<span>借款期限(天)</span>
						</div>
					</div>
				</li>
				<li class="lastLi">
					<div class="divLast">
						<img src="<?php echo asset('assets/weixin/img/chibang.png') ?>"/>
						<a href="<?php echo asset('home/index_2') ?>"><div class="btn">
							<img src="<?php echo asset('assets/weixin/img/btn.png') ?>"/>
							<span>我要提额</span>
						</div></a>
					</div>
				</li>
			</ul>
		</div>
		<div class="footer" id="footer">
			<ul>
				<a href="<?php echo asset('home/') ?>"><li>
					<img src="<?php echo asset('assets/weixin/img/sy_purple.png') ?>" />
				</li></a>
				<a href="<?php echo asset('home/index_2') ?>"><li>
					<img src="<?php echo asset('assets/weixin/img/te_white.png') ?>" />
				</li></a>
				<a href="<?php echo asset('home/index_3') ?>"><li>
					<img src="<?php echo asset('assets/weixin/img/jl_white.png') ?>" />
				</li></a>
				<a href="<?php echo asset('home/index_4') ?>"><li>
					<img src="<?php echo asset('assets/weixin/img/tj_white.png') ?>" />
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