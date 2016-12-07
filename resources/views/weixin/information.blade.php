<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<link rel="stylesheet" type="text/css" href="/assets/weixin/css/style.css" />
		<link rel="stylesheet" type="text/css" href="/assets/weixin/css/information.css" />
		<title></title>
	</head>

	<body>
		<div class="main" id="main">
          <div class="head-2">
          	<img src="/assets/weixin/img/back-1.png" alt="" />
          	<div class="da-yuan"><img src="/assets/weixin/img/boy.png" alt="" /></div>
          	<div class="xiao-yuan"><img src="/assets/weixin/img/girl.png" alt="" /></div>     	
          </div>
          
          <div class="point">完成<span style="color:#99f;">【必填】</span>项即可借款</div>
          <div class="content">
          	<ul>
          		<li>
          			<img src="/assets/weixin/img/jiben.png" alt="" />
          			<span>基本信息填写</span>
          			<img src="/assets/weixin/img/bitian.png" alt="" style="float: right;margin-top: 0;height:74% !important;" />
          		</li>
          		<li>
          			<img src="/assets/weixin/img/zhima.png" alt="" />
          			<span>芝麻分授权</span>
          				<img src="/assets/weixin/img/bitian.png" alt="" style="float: right;margin-top: 0;height:74% !important;" />
          		</li>
          		<li>
          			<img src="/assets/weixin/img/yys.png" alt="" />
          			<span>运营商授权</span>
          				<img src="/assets/weixin/img/bitian.png" alt="" style="float: right;margin-top: 0;height:74% !important;" />
          		</li>
          		<li>
          			<img src="/assets/weixin/img/taobao.png" alt="" />
          			<span>淘宝授权</span>
          				<img src="/assets/weixin/img/bitian.png" alt="" style="float: right;margin-top: 0;height:74% !important;" />
          		</li>
          		<li>
          			<img src="/assets/weixin/img/jingdong.png" alt="" />
          			<span>京东授权</span>
          				<img src="/assets/weixin/img/bitian.png" alt="" style="float: right;margin-top: 0;height:74% !important;" />
          		</li>
          		
          	</ul>
          	
          </div>
          
          
          
		</div>
		<div class="footer" id="footer">
			<ul>
				<a href="/weixin"><li>
					<img src="/assets/weixin/img/sy_white.png" />
				</li></a>
				<a href="/weixin/information"><li>
					<img src="/assets/weixin/img/te_purple.png" />
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
		var srceenHeight = window.screen.height;
		var fHeght = document.getElementById('footer').offsetHeight;
		document.getElementById('main').style.height = srceenHeight - fHeght + 2 + 'px';
	</script>

</html>