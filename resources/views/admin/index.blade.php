<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<link rel="stylesheet" type="text/css" href="/assets/weixin/css/style.css" />
		<link rel="stylesheet" type="text/css" href="/assets/weixin/css/index_style.css" />
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
							<img src="/assets/weixin/img/tanhao.png"/>
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
							<span class="num">28</span>
							<span>借款期限(天)</span>
						</div>
					</div>
				</li>
				<li class="lastLi">
					<div class="divLast">
						<img src="/assets/weixin/img/chibang.png"/>
						<div class="btn">
							<img src="/assets/weixin/img/btn.png"/>
							<span>我要提额</span>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<div class="footer" id="footer">
			<ul>
				<a href="/weixin"><li>
					<img src="/assets/weixin/img/sy_purple.png" />
				</li></a>
				<a href="/weixin/information"><li>
					<img src="/assets/weixin/img/te_white.png" />
				</li></a>
				<a href="/weixin/jk1"><li>
					<img src="/assets/weixin/img/jl_white.png" />
				</li></a>
				<a href="/weixin/erweima"><li>
					<img src="/assets/weixin/img/tj_white.png" />
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