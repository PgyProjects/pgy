<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/weixin/css/style.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/weixin/css/information.css') ?>" />
		<link rel="stylesheet" href="<?php echo asset('assets/weixin/css/jiekuan.css') ?>" />
		<script src="<?php echo asset('assets/weixin/js/jquery-1.9.1.min.js') ?>" type="text/javascript" charset="utf-8"></script>
		<title>借款记录</title>
	</head>

	<body>
		<div class="main" id="main">
			
				<div class="click-jkjl">借款记录</div>
			
			<div class="jilubiao">
				<img src="<?php echo asset('assets/weixin/img/jilu.png') ?>" alt="" />
				<h2>最近借款金额</h2>
				<div class="jk1-1">
					<p>借款金额</p><span id="jine"></span></div>
				<div class="jk1-2">
					<p>还款日</p><span id="hkrq"></span></div>
			</div>
		</div>

		<div class="footer" id="footer">
			<ul>
				<a href="<?php echo asset('home') ?>">
					<li>
						<img src="/assets/weixin/img/sy_white.png" />
					</li>
				</a>
				<a href="<?php echo asset('home/index_2') ?>">
					<li>
						<img src="/assets/weixin/img/te_white.png" />
					</li>
				</a>
				<a href="<?php echo asset('home/index_3') ?>">
					<li>
						<img src="/assets/weixin/img/jl_purple.png" />
					</li>
				</a>
				<a href="<?php echo asset('home/index_4') ?>">
					<li>
						<img src="/assets/weixin/img/tj_white.png" />
					</li>
				</a>
			</ul>
		</div>
	</body>
	<script type="text/javascript">
		window.onload = function() {
				$.ajax({ //获取数据
					type: 'post',
					url: "/jkapi/jkexist/"+wx_openid,
//					dataType: 'json',				
//					async: false,
					success: function(data) {
//						alert(data.status+"   "+data.message)
						if(data.status == '0') {
							alert(data.message)
						} else {
							if(data.message ==''){
								window.location.href = "<?php echo asset('home/index_3_jk') ?>";
							}else{
//								alert(data.message)
								document.getElementById('jine').innerHTML = data.message.amount;
								document.getElementById('hkrq').innerHTML = data.message.hkdate;
							}
						}
					},
					error: function(data) {
					
					}
				})
			}
			/*中间内容高度*/
		var srceenHeight = window.screen.height;
		var fHeght = document.getElementById('footer').offsetHeight;
		document.getElementById('main').style.height = srceenHeight - fHeght + 2 + 'px';
	</script>

</html>