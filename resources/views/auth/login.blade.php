<!DOCTYPE html>
<!-- saved from url=(0034)https://admin.xiaoe-tech.com/login -->
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="renderer" content="webkit">
		<script src="/assets/houtai2/js/jquery-1.9.1.min.js"></script>
		<link rel="stylesheet" type="text/css" href="/assets/houtai2/css/login.css">
		<title></title>
		<style>
			#changdu {
				position: absolute;
				height: 100%;
			}
		</style>
	</head>

	<body>
		<div class="backgroundLayer" id="changdu">
			<div class="whiteLayer"></div>
			<div class="blueLayer"></div>
		</div>

		<div class="wrapper">

			<div class="content" id="normalLogin" style="display: block;">
				<ul class="loginTitle">
					<!--  <li><a href="javascript:void(0)" style="margin-left: 46%;">微信登录</a></li>-->
					<li>
						<a href="" style="margin-left:75%;border-bottom: 2px solid #2696f1;">账号登录</a>
					</li>
				</ul>
				<div class="loginArea">

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {!! csrf_field() !!}
						<div class="loginDiv">
							<img src="/assets/houtai2/img/user.png">
							<input type="text" name="email" class="loginInput" placeholder="请输入登录邮箱" autocomplete="off" value="{{ old('email') }}">
						</div>

						<div class="loginDiv">
							<img src="/assets/houtai2/img/password.png">
							<input type="password" name="password" class="loginInput" placeholder="请输入密码" autocomplete="off">
						</div>

						<input type="checkbox" name="rememberMe" class="loginCheckbox">
						<span class="rememberMeHTML">记住密码</span>

						<button class="loginButton">
                            登&nbsp;&nbsp;&nbsp;&nbsp;录</button>

						<!--<span class="noAccount">还没有账户？<span class="sign">立即注册</span></span>-->
					</form>
				</div>
			</div>

			<div class="footer">

			</div>
		</div>

	</body>

</html>