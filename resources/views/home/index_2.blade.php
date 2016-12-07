<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/weixin/css/style.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/weixin/css/information.css') ?>" />
		<link rel="stylesheet" href="<?php echo asset('assets/weixin/css/mui.min.css') ?>">

		<script src="<?php echo asset('assets/weixin/js/jquery-1.9.1.min.js') ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo asset('assets/weixin/js/mui.min.js') ?>"></script>
		<title>提额</title>
	</head>

	<body>
		<div class="main" id="main">
			<div class="head-2">
				<img src="/assets/weixin/img/back-1.png" alt="" />
				<div class="da-yuan"><img src="/assets/weixin/img/boy.png" alt="" /></div>
				<div class="xiao-yuan"><img src="/assets/weixin/img/girl.png" alt="" /></div>
			</div>

			<div class="point" style="color: #AAA;">完成<span style="color:#99f;">【必填】</span>项即可借款</div>
			<div class="content">
				<ul>
					<a href="<?php echo asset('/home/bd1') ?>" id="grxx">
						<li id="jiben">
							<img src="/assets/weixin/img/jiben.png" alt="" />
							<span>基本信息</span>
							<img src="/assets/weixin/img/bitian.png" alt="" style="float: right;margin-top: 0;height:74% !important;" id="jb-xx" />
						</li>
					</a>
					<li id="zhima">
						<img id="img-zmf" src="/assets/weixin/img/zmf.png" alt="" />
						<span>芝麻分</span>
						<img src="/assets/weixin/img/bitian.png" alt="" style="float: right;margin-top: 0;height:74% !important;" id="zm-sq" />
					</li>
					<li id="yys">
						<img id="img-yys" src="/assets/weixin/img/yys.png" alt="" />
						<span>运营商</span>
						<img src="/assets/weixin/img/bitian.png" alt="" style="float: right;margin-top: 0;height:74% !important;" id="yy-sq" />
					</li>
					<li id="taobao">
						<img id="img-tb" src="/assets/weixin/img/taobao.png" alt="" />
						<span>淘宝</span>
						<img src="/assets/weixin/img/bitian.png" alt="" style="float: right;margin-top: 0;height:74% !important;" id="tb-sq" />
					</li>
					<li id="jingdong">
						<img id="img-jd" src="/assets/weixin/img/jingdong.png" alt="" />
						<span>京东</span>
						<img src="/assets/weixin/img/tianxie.png" alt="" style="float: right;margin-top: 0;height:74% !important;" id="jd-sq" />
					</li>

				</ul>

			</div>
			<div id="khjl" style="width:100%;text-align:center;position:relative;top: 68vw;">
				<p style="    width: 80%;
    height: 30px;
    padding: 2vw;
    background: #99f;
    margin: auto;
    line-height: 5vw;
    color: #fff;
    font-size: 5vw;
    border-radius: 10px;">授权完毕后,点击联系客户经理</p>
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
						<img src="/assets/weixin/img/te_purple.png" />
					</li>
				</a>
				<a href="<?php echo asset('home/index_3') ?>">
					<li>
						<img src="/assets/weixin/img/jl_white.png" />
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
		/*中间内容高度*/
		var srceenHeight = window.screen.height;
		var fHeght = document.getElementById('footer').offsetHeight;
		document.getElementById('main').style.height = srceenHeight - fHeght + 2 + 'px';

		$(function() {

			$.ajax({
				type: 'post',
				url: "/home/kongzhi_ajax", //发送后台的url 
				dataType: 'json', //后台返回的数据类型
				timeout: 45000, //超时时间
				async: false, //异步状态 在ajax执行的同时会执行其他js
				success: function(data) {
					//										mui.alert(11)
					if(data.status == '0') {
						$('#yys').hide();
						$('#taobao').hide();
						$('#jingdong').hide();
						//						mui.alert(data.message);
						//						$('#jiben').unbind().click();
					} else if(data.status == '1') {
						if(data.message.kongzhi_zmf == '0') {
							$('#yys').hide();
							$('#taobao').hide();
							$('#jingdong').hide();
							$('#grxx').attr('href', '#');
							$('#jiben').click(function() {
								mui.alert('基本信息已填写');
							})
							document.getElementById('jb-xx').src = "/assets/weixin/img/ytx.png";
							$('#khjl').click(function() {
								mui.alert('芝麻分未授权')
							})
						} else if(data.message.kongzhi_zmf == '1') {
							document.getElementById('jb-xx').src = "/assets/weixin/img/ytx.png";
							if(data.message.kongzhi_zmf == '1') {
								document.getElementById('zm-sq').src = "/assets/weixin/img/ysq.png";
							}
							$('#grxx').attr('href', '#');
							$('#jiben').click(function() {
								mui.alert('基本信息已填写');
							})
							if(data.message.type == '0') {
								$('#yys').hide();
								$('#taobao').hide();
								$('#jingdong').hide();
								//								document.getElementById('jb-xx').src = "/assets/weixin/img/ytx.png";
								mui.alert('您的信息正在审核中');
								$('#khjl').click(function() {
									mui.alert('您的信息正在审核中')
								})
							} else {
								$('#yys').show();
								$('#taobao').show();
								$('#jingdong').show();
								//								document.getElementById('jb-xx').src = "/assets/weixin/img/ytx.png";
								//						document.getElementById('img-zmf').src = "/assets/weixin/img/" + data.message.img_zmf;
								//						document.getElementById('img-yys').src = "/assets/weixin/img/" + data.message.img_yys;
								//						document.getElementById('img-tb').src = "/assets/weixin/img/" + data.message.img_tb;
								//						document.getElementById('img-jd').src = "/assets/weixin/img/" + data.message.img_jd;
								if(data.message.kongzhi_yys == '1') {
									document.getElementById('yy-sq').src = "/assets/weixin/img/ysq.png";
								}
								if(data.message.kongzhi_tb == '1') {
									document.getElementById('tb-sq').src = "/assets/weixin/img/ysq.png";
								}
								if(data.message.kongzhi_jd == '1') {
									document.getElementById('jd-sq').src = "/assets/weixin/img/ysq.png";
								}
								//						mui.alert(data.message.kongzhi_yys)
								if(data.message.kongzhi_yys == '0' || data.message.kongzhi_tb == '0') {
									$('#khjl').click(function() {
										mui.alert('运营商或淘宝未授权')
									})
								}
								if(data.message.kongzhi_yys == '1' && data.message.kongzhi_tb == '1') {
									$('#khjl').click(function() {
										window.location.href = "/home/khjl";
									})
								}
							}
						}
					} else if(data.status == '2') {
						$('#yys').hide();
						$('#taobao').hide();
						$('#jingdong').hide();
						$('#grxx').attr('href', '/home/bd1');
					}

				},
				error: function(result) {
					//					mui.alert(JSON.stringify(result))
				}
			})

		})

		//		function khjlClick(a, b) {
		//			$('#khjl').click(function() {
		//
		//				window.location.href = "http://test.pgyxwd.com/home/khjl";
		//
		//			})
		//		}

		$("#zhima").click(function() {
			//			mui.alert(0)
			$.ajax({
				type: 'post',
				url: "/home/kongzhi_ajax", //发送后台的url 
				dataType: 'json', //后台返回的数据类型
				timeout: 45000, //超时时间
				async: true,
				success: function(data) {
					//					mui.alert(result.dizhi_zmf);
					if(data.message.user_data == '1') {
						if(data.message.kongzhi_zmf == '0') {

							window.location.href = data.message.dizhi_zmf;
						} else {

							mui.alert('您已完成该项授权');
						}
					} else {
						mui.alert('请先填写基本信息');
					}

				},
				error: function(data) {
					mui.alert(data)
				}
			})
		})

		$("#yys").click(function() {
			$.ajax({
				type: 'post',
				url: "<?php echo asset('home/kongzhi_ajax') ?>", //发送后台的url 
				dataType: 'json', //后台返回的数据类型
				timeout: 45000, //超时时间
				async: true,
				success: function(data) {
					if(data.message.kongzhi_yys == '0') {

						window.location.href = data.message.dizhi_yys;
					} else {
						mui.alert('您已完成该项授权');
					}
				},
				error: function(result) {

				}
			})
		})

		$("#jingdong").click(function() {
			$.ajax({
				type: 'post',
				url: "<?php echo asset('home/kongzhi_ajax') ?>", //发送后台的url 
				dataType: 'json', //后台返回的数据类型
				timeout: 45000, //超时时间
				async: true,
				success: function(data) {
					if(data.message.kongzhi_jd == '0') {

						window.location.href = data.message.dizhi_jd;
					} else {
						mui.alert('您已完成该项授权');
					}
				},
				error: function(result) {

				}
			})
		})

		$("#taobao").click(function() {
			$.ajax({
				type: 'post',
				url: "<?php echo asset('home/kongzhi_ajax') ?>", //发送后台的url 
				dataType: 'json', //后台返回的数据类型
				timeout: 45000, //超时时间
				async: true,
				success: function(data) {
					if(data.message.kongzhi_tb == '0') {

						window.location.href = data.message.dizhi_tb;
					} else {
						mui.alert('您已完成该项授权');
					}
				},
				error: function(result) {

				}
			})
		})
	</script>

</html>