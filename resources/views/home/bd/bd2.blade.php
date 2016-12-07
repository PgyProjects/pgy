<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<title>表单填写</title>
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
		<link rel="stylesheet" href="<?php echo asset('assets/weixin/css/neicss.css') ?>">
		<link rel="stylesheet" href="<?php echo asset('assets/weixin/css/mui.min.css') ?>">
		<link rel="stylesheet" href="<?php echo asset('assets/weui-master/dist/style/weui.css') ?>">
		<link rel="stylesheet" href="<?php echo asset('assets/weui-master/dist/example/example.css') ?>">

		<script src="<?php echo asset('assets/weixin/js/jquery-1.9.1.min.js') ?>" type="text/javascript"></script>
		<script src="<?php echo asset('assets/weixin/js/mui.min.js') ?>"></script>
		<script src="<?php echo asset('assets/weixin/js/Area.js') ?>" type="text/javascript"></script>
		<script src="<?php echo asset('assets/weixin/js/AreaData_min.js') ?>" type="text/javascript"></script>
		<style>
			.du-botton {
				padding-top: 2vw;
				background-color: #f8f8f8;
			}
			
			.down {
				margin: auto;
				background-color: #f8f8f8;
				width: 8vw;
			}
			
			.down img {
				width: 100%;
			}
			
			.du-botton p {
				color: #999;
				text-align: center;
			}
			/*ios可以输入*/
			/*-webkit-user-select: auto !important;*/
		</style>
	</head>

	<body ontouchstart>

		<div class="head2" style="background:#9a99ff !important">
			<span>联系人信息填写</span>
		</div>
		<form action="<?php echo asset('home/bd2') ?>" method="post">
			<div class="container" id="container">
				<div class="weui-cells weui-cells_form">
					<div class="kongbai1" style="height:18vw !important;">

						<div class="weui-cells__title" style="margin-top:0 !important; padding-bottom:3px;">
							<p style="font-weight:bold;color:#000;">联系人信息</p>
							<p>以下信息均需填写,审核过程中不会打电话给联系人,请如实填写</p>
						</div>
					</div>
					<div class="weui-cell">
						<div class="weui-cell__hd">
							<label class="weui-label">父亲</label>
						</div>
						<div class="weui-cell__bd">
							<input type="hidden" name="openid" value="<?php echo @$_GET['openid']?>">
							<input type="text" class="weui-input weui-input1" placeholder="请输入姓名" name="fuqin_xingming">
						</div>

					</div>
					<div class="weui-cell">
						<div class="weui-cell__hd">
							<label class="weui-label">手机</label>
						</div>
						<div class="weui-cell__bd">
							<input id="fphone" type="tel" class="weui-input weui-input1" maxlength="11" placeholder="请输入号码" name="fuqin_shoujihao">
						</div>

					</div>

					<div class="kongbai2"></div>

					<div class="weui-cell">
						<div class="weui-cell__hd">
							<label class="weui-label">母亲</label>
						</div>
						<div class="weui-cell__bd">
							<input type="text" class="weui-input weui-input1" placeholder="请输入姓名" name="muqin_xingming">
						</div>

					</div>
					<div class="weui-cell">
						<div class="weui-cell__hd">
							<label class="weui-label">手机</label>
						</div>
						<div class="weui-cell__bd">
							<input id="mphone" type="tel" class="weui-input weui-input1" maxlength="11" placeholder="请输入号码" name="muqin_shoujihao">
						</div>

					</div>
					<div class="kongbai2"></div>
					<div class="weui-cell">
						<div class="weui-cell__hd">
							<label class="weui-label">配偶</label>
						</div>
						<div class="weui-cell__bd">
							<input type="text" class="weui-input weui-input1" placeholder="请输入姓名" name="peiou_xingming">
						</div>

					</div>
					<div class="weui-cell">
						<div class="weui-cell__hd">
							<label class="weui-label">手机</label>
						</div>
						<div class="weui-cell__bd">
							<input id="pphone" type="tel" class="weui-input weui-input1" maxlength="11" placeholder="请输入号码" name="peiou_shoujihao">
						</div>

					</div>

					<div class="kongbai2"></div>

					<div class="yincang" style="display:none;">
						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">单位领导</label>
							</div>
							<div class="weui-cell__bd">
								<input type="text" class="weui-input" placeholder="请输入姓名" name="lingdao_xingming">
							</div>

						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">手机</label>
							</div>
							<div class="weui-cell__bd">
								<input id="1phone" type="tel" class="weui-input" maxlength="11" placeholder="请输入号码" name="lingdao_shoujihao">
							</div>

						</div>
						<div class="kongbai2"></div>

						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">朋友姓名</label>
							</div>
							<div class="weui-cell__bd">
								<input type="text" class="weui-input" placeholder="请输入姓名" name="pengyou_xingming">
							</div>

						</div>
						<div class="weui-cell">
							<div class="weui-cell__hd">
								<label class="weui-label">手机</label>
							</div>
							<div class="weui-cell__bd">
								<input id="yphone" type="tel" class="weui-input" maxlength="11" placeholder="请输入号码" name="pengyou_shoujihao">
							</div>

						</div>

					</div>
					<div class="du-botton">
						<div class="down"><img id="du" src="<?php echo asset('assets/weixin/icon/+.png') ?>" alt=""></div>

						<p id="tishi-01">点击填写更多信息来提升额度</p>

					</div>
					<div class="kongbai1"></div>
					<button id="do02" class="weui-btn weui-btn_primary" style="border-radius:0px !important;background:#9a99ff !important;font-family:微软雅黑;">下一步</button>
				</div>
				<input type="hidden"  id="peopleName" value="" class="weui-input weui-input1"/>
				<input type="hidden"  id="peoplePhone" value="" class="weui-input weui-input1"/>
			</div>
		</form>

		<script type="text/javascript">
		

		window.onload = function(){
			var oName = localStorage.getItem('peopleName');
			var oPhone = localStorage.getItem('peoplePhone');
			$('#peopleName').val(oName);
			$('#peoplePhone').val(oPhone);
//			$('input').click(function(){
//
//  			this.selectionStart = 0;
//
//  			this.selectionEnd = this.val().length;
//
//			})
//			alert($('#peopleName').val());
//			alert($('#peoplePhone').val());
		}
			//		mui.alert(11)
			$("#do02").click(function() {
				//mui.alert(111)
				ObjInput = document.getElementsByTagName("input");
				for(i = 0; i <= ObjInput.length; i++) {
					if(ObjInput[i].value == '') {
						//						mui.alert(111)
						if(i == '1') {
							mui.alert("请填写您父亲的姓名");
							return false;
						} else if(i == '2') {
							mui.alert("请填写您父亲手机号");
							return false;
						} else if(i == '3') {
							mui.alert("请填写您母亲的姓名");
							return false;
						} else if(i == '4') {
							mui.alert("请填写您母亲的手机号");
							return false;
						} else if(i == '5') {
							mui.alert("请填写您配偶的姓名");
							return false;
						} else if(i == '6') {
							mui.alert("请填写您配偶的手机号");
							return false;
						}
						if($('.yincang').css('display') != 'none') {
							if(i == '7') {
								mui.alert("请填写您领导的姓名");
								return false;
							} else if(i == '8') {
								mui.alert("请填写您领导的手机号");
								return false;
							} else if(i == '9') {
								mui.alert("请填写您朋友的姓名");
								return false;
							} else if(i == '10') {
								mui.alert("请填写您朋友的手机号");
								return false;
							}
						}

					} else {
						for(o = 0; o <= ObjInput.length; o++) {
							var oNum = 0;
							if($('.yincang').css('display') == 'none') {
								$(".weui-input1").each(function() {
									if($(this).val() == '') {
										//										debugger
										oNum++;
									}
								})
							} else {
								$(".weui-input").each(function() {
									if($(this).val() == '') {
										//										debugger
										oNum++;
									}
								})
							}
							if(oNum == 0) {

								var fphone = document.getElementById('fphone').value;
								if(!(/^1[34578]\d{9}$/.test(fphone))) {
									mui.alert("父亲手机号码有误，请重填");
									$("#fphone").css("border", "1px solid red");
									return false;
								}

								var mphone = document.getElementById('mphone').value;
								if(!(/^1[34578]\d{9}$/.test(mphone))) {
									mui.alert("母亲手机号码有误，请重填");
									$("#mphone").css("border", "1px solid red");
									return false;
								}

								var pphone = document.getElementById('pphone').value;
								if(!(/^1[34578]\d{9}$/.test(pphone))) {
									mui.alert("配偶手机号码有误，请重填");
									$("#pphone").css("border", "1px solid red");
									return false;
								}

								var ophone = document.getElementById('1phone').value;
								if(!(/^1[34578]\d{9}$/.test(pphone))) {
									mui.alert("领导手机号码有误，请重填");
									$("#1phone").css("border", "1px solid red");
									return false;
								}

								var yphone = document.getElementById('yphone').value;
								if(!(/^1[34578]\d{9}$/.test(pphone))) {
									mui.alert("朋友手机号码有误，请重填");
									$("#yphone").css("border", "1px solid red");
									return false;
								}
								//								debugger;
								//填写数值不相同
								if($('.yincang').css('display') == 'none') {
									var allVal = [];
									$(".weui-input1").each(function() {
											allVal.push($(this).val());
										})
										//							mui.alert(allVal)
									for(var k = 0; k < $('.weui-input1').length; k++) {
										//								mui.alert(k)
										delete allVal[k];
										if(allVal.indexOf($('.weui-input1').eq(k).val()) != '-1') {
											mui.alert("有信息重复,请重新填写");
											return false;
										}
									}
								} else {
									var allVal = [];
									$(".weui-input").each(function() {
										allVal.push($(this).val());
									})
									for(var k = 1; k < $('.weui-input').length; k++) {
										delete allVal[k];
										if(allVal.indexOf($('.weui-input').eq(k).val()) != '-1') {
											mui.alert("有信息重复,请重新填写");
											return false;
										}
									}
								}
							}
							//					return false;
						}
					}

				}

			})

			var index = 1;
			$('.down').click(function() {

				if(index == '1') {
					//$('.yincang').css('height', '660px');
					$('.yincang').slideToggle();
					$('#du').attr('src', '<?php echo asset("assets/weixin/icon/-.png") ?>');
					$('#tishi-01').html('');
					//$(this).children('img').addClass('move_top');
					index = 2;
				} else if(index == '2') {
					//$('.lcList').css('height', '300px');
					$('.yincang').slideToggle();
					$('#du').attr('src', '<?php echo asset("assets/weixin/icon/+.png") ?>');
					$('#tishi-01').html('点击填写更多信息来提升额度');
					//$(this).children('img').removeClass('move_top');
					index = 1;
				}
			})
		</script>
	</body>

</html>