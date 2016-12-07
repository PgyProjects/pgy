<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="/assets/houtai2/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="/assets/houtai2/css/bootstrap-theme.css" />
		<link rel="stylesheet" type="text/css" href="/assets/houtai2/css/shenhe_style.css" />
		<link rel="stylesheet" type="text/css" href="/assets/houtai2/css/page.css" />
		<link rel="stylesheet" type="text/css" href="/assets/houtai2/css/jquery.lightbox-0.5.css" />
		<script src="/assets/houtai2/js/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/assets/houtai2/js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="/assets/houtai2/js/laydate.js"></script>
		<script src="/assets/houtai2/js/jquery.page.js" type="text/javascript" charset="utf-8"></script>
		<script src="/assets/houtai2/js/jquery.lightbox-0.5.js" type="text/javascript" charset="utf-8"></script>
		<style type="text/css">
			.searchDiv {
				width: 80%;
				margin: 20px auto;
			}
		</style>
	</head>

	<body>
		<div class="header">
			<span class="topLeft">审核</span>
			<ul class="topRight">
				<li>
					<img src="<?php echo asset('assets/houtai2/img/email.png') ?>" width="50" class="email" />
					<p>消息通知</p>
				</li>
				<li>
					<div class="touxiang"></div>
					<p>{{Auth::user()->name}}</p>
				</li>
				<li>
					<a href="/logout">退出</a>
				</li>
			</ul>
		</div>
		<div class="main">
			<ul class="main_top">
				<li id="ysPass"></li>
				<li id="tdPass"></li>
			</ul>
			<div class="search">
				<div>
					<div class="inputType">
						<div class="input-group">
							<div class="input-group-btn">
								<button type="button" class="btn btn-default dropdown-toggle border-color border-right" data-toggle="dropdown" id="choice_btn">姓名&nbsp;<span class="caret"></span></button>
								<ul class="dropdown-menu" role="menu" id="choice_type">
									<!--<li>
										<a href="#">ID</a>
									</li>-->
									<li>
										<a href="#">姓名</a>
									</li>
									<li>
										<a href="#">手机号</a>
									</li>
									<li>
										<a href="#">身份证号</a>
									</li>
								</ul>
							</div>
							<input type="text" class="form-control border-color" id="choice_val">
						</div>

					</div>
				</div>
			</div>
			<div class="oTable">
				<table class="table table-bordered main_table" id="searchList">
					<!--<tr>
						<td class="color-cc col-lg-1">1</td>
						<td class="color-e6 col-lg-1">高强</td>
						<td class="color-cc col-lg-1">男</td>
						<td class="color-e6 col-lg-2">12345678912</td>
						<td class="color-cc col-lg-2">123456789123456789</td>
						<td class="color-e6 col-lg-5"><img src="<?php echo asset('assets/houtai2/img/zhima.png') ?>" /><img src="<?php echo asset('assets/houtai2/img/family.png') ?>" /><img src="<?php echo asset('assets/houtai2/img/taobao.png') ?>" /></td>
					</tr>-->
				</table>
			</div>

			<button class="btn bgBtn btn-success" id="hadBtn">获取客户</button>
			<div class="oTable table-responsive">

				<div class="col-lg-1 all_num">
					<!--总量-->
					&nbsp;
				</div>
				<table border="" cellspacing="" cellpadding="" class="table table-bordered main_table" id="tableList">
					<!--<tr>
						<th class="col-lg-1 color-cc">序号</th>
						<th class="col-lg-1 color-e6">姓名</th>
						<th class="col-lg-1 color-cc">性别</th>
						<th class="col-lg-2 color-e6">手机号</th>
						<th class="col-lg-2 color-cc">身份证</th>
						<th class="col-lg-5 color-e6">授权状态</th>
					</tr>
					<tr>
						<td class="color-cc">1</td>
						<td class="color-e6">高强</td>
						<td class="color-cc">男</td>
						<td class="color-e6">12345678912</td>
						<td class="color-cc">123456789123456789</td>
						<td class="color-e6"><img src="<?php echo asset('assets/houtai2/img/zhima.png') ?>" /><img src="<?php echo asset('assets/houtai2/img/family.png') ?>" /><img src="<?php echo asset('assets/houtai2/img/taobao.png') ?>" /></td>
					</tr>
					<tr>
						<td class="color-cc">1</td>
						<td class="color-e6">高强</td>
						<td class="color-cc">男</td>
						<td class="color-e6">12345678912</td>
						<td class="color-cc">123456789123456789</td>
						<td class="color-e6"></td>
					</tr>
					<tr>
						<td class="color-cc">1</td>
						<td class="color-e6">高强</td>
						<td class="color-cc">男</td>
						<td class="color-e6">12345678912</td>
						<td class="color-cc">123456789123456789</td>
						<td class="color-e6"></td>
					</tr>
					<tr>
						<td class="color-cc">1</td>
						<td class="color-e6">高强</td>
						<td class="color-cc">男</td>
						<td class="color-e6">12345678912</td>
						<td class="color-cc">123456789123456789</td>
						<td class="color-e6"></td>
					</tr>
					<tr>
						<td class="color-cc">1</td>
						<td class="color-e6">高强</td>
						<td class="color-cc">男</td>
						<td class="color-e6">12345678912</td>
						<td class="color-cc">123456789123456789</td>
						<td class="color-e6"></td>
					</tr>-->
				</table>
			</div>
		</div>
		<div class="bgDiv"></div>
		<div class="alertInp">
			<div class="alertInp_header">
				<div class="title">数据详情</div>
				<img src="<?php echo asset('assets/houtai2/img/close.png') ?>" class="havclose" />
			</div>
			<div class="alertInp_main">
				<div class="alertLeft col-lg-8" id="alertLeft">
					<!--<ul class="infoTop">
						<li>
							<img src="img/family.png" width="60" />
							<span>昵称昵</span>
						</li>
						<li>
							<div >花呗</div>
							<div >600</div>
						</li>
						<li>
							<div >芝麻分</div>
							<div >600</div>
						</li>
						<li>
							<div >网龄</div>
							<div >10</div>
						</li>
						<li>
							<div >客户类型</div>
							<div >A</div>
						</li>
						<li>
							<div >原始数据</div>
							<div ></div>
						</li>
					</ul>
					<div class="manInfomation">
						<ul class="people_jiben">
							<li><span>姓名:</span><span>111</span></li>
							<li><span>手机号:</span><span>111</span></li>
							<li><span>身份证号:</span><span>111</span></li>
							<li><span>学历:</span><span>111</span></li>
							<li><span>邮箱号:</span><span>111</span></li>
							<li><span>工作单位:</span><span>111</span></li>
						</ul>

						<table border="" cellspacing="" cellpadding="" class="table-bordered table">
							<tr>
								<th class="col-lg-3">关系</th>
								<th class="col-lg-3">姓名</th>
								<th class="col-lg-6">电话</th>
							</tr>
							<tr>
								<td>父亲</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>母亲</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>配偶</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>朋友</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>公司</td>
								<td></td>
								<td></td>
							</tr>
						</table>
						<ul class="phone_list">
							<li><img src="img/family.png" /></li>
							<li><img src="img/jiben.png" /></li>
							<li><img src="img/jingdong.png" /></li>
						</ul>
					</div>-->
				</div>
				<div class="alertRight col-lg-4">
					<div class="right_header" id="shPeople"></div>
					<ul class="chioce_list">
						<li class="chioced">审核记录</li>
					</ul>
					<div class="chioce_main">
						<div class="recordTop" id="shList">
							<!--<div ><span>类型:</span><span>2</span></div>
							<div ><span>时间:</span><span class="color-red">2000</span></div>
							<div ><span>备注:</span><span>3000</span></div>-->
						</div>
					</div>
					<div class="right_footer">
						<textarea name="" rows="" cols="" placeholder="填写备注" id="bz"></textarea>
						<div class="pass_btn btn btn-success" id="passed">通过</div>
						<div class="nopass_btn btn btn-danger" id="unpassed">未通过</div>
					</div>
				</div>
			</div>
		</div>

		<div class="alertInp2">
			<div class="alertInp_header">
				<div class="title">数据详情</div>
				<img src="<?php echo asset('assets/houtai2/img/close.png') ?>" class="havclose" />
			</div>
			<div class="alertInp_main">
				<div class="alertLeft col-lg-8" id="alertLeft2">

				</div>
				<div class="alertRight col-lg-4">
					<div class="right_header" id="shPeople2"></div>
					<ul class="chioce_list" id="chioce_list">
						<li class="chioced" style="width: 33%;">审核记录</li>
						<li style="width: 33%;">放款记录</li>
						<li style="width: 33%;">催收记录</li>
					</ul>
					<div class="chioce_main" id="cuishou2" style="display: none;height: 540px;border: none;">

					</div>
					<div class="chioce_main" id="fangkuan2" style="display: none;height: 540px;border: none;">

					</div>
					<div class="chioce_main" id="shenhe2" style="height: 540px;border: none;">

					</div>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		var selectName = '姓名';
		$('.topLeft').unbind().click(function() {
			location.reload();
		})
		window.onload = function() {
			jsonType();
		}
		$('#hadBtn').click(function() {
			jsonType();
		})

		function jsonType() {
			$.ajax({ //获取数据
				type: 'post',
				url: "/admin/showCustom",
				dataType: 'json',
				async: true,
				success: function(data) {
					document.getElementById('ysPass').innerHTML = '今日通过数:' + data.new[0];
					document.getElementById('tdPass').innerHTML = '昨日通过数:' + data.new[1];
					showTable(data);
				},
				error: function(result) {

				}
			})
		}
		$('.havclose').click(function() {
			$('.bgDiv').hide();
			$('.alertInp').hide();
			$('.alertInp2').hide();
			$('#bz').val('');
			document.getElementById('alertLeft').innerHTML = '';
			document.getElementById('shList').innerHTML = '';
			document.getElementById('shPeople').innerHTML = '审核员:';
			$('#chioce_list li').removeClass('chioced');
			$('#chioce_list li').eq(0).addClass('chioced');
			$('#shenhe2').show();
			$('#cuishou2').hide();
			$('#fangkuan2').hide();
		})
		$('.dropdown-menu li a').click(function() {
			selectName = $(this).html();
			var selectType = selectName + '&nbsp;<span class="caret"></span>';
			$('.dropdown-menu').prev().html(selectType);

			return selectName;
		})

		function showTable(data) {
			var str = '';
			var oSex;
			str += '<tr>';
			str += '<th class="col-lg-1 color-cc">序号</th>';
			str += '<th class="col-lg-1 color-e6">姓名</th>';
			str += '<th class="col-lg-1 color-cc">性别</th>';
			str += '<th class="col-lg-2 color-e6">手机号</th>';
			str += '<th class="col-lg-2 color-cc">身份证</th>';
			str += '<th class="col-lg-5 color-e6">授权状态</th>';
			str += '</tr>';
			for(var i = 0; i < data.info.length; i++) {
				if(data.info[i].sex == '1') {
					oSex = '男';
				} else {
					oSex = '女';
				}
				str += '<tr class="showAlerts" id="o' + i + '">';
				str += '<td class="color-cc ">' + data.info[i].id + '</td>';
				str += '<td class="color-e6">' + data.info[i].name + '</td>';
				str += '<td class="color-cc">' + oSex + '</td>';
				str += '<td class="color-e6">' + data.info[i].phone + '</td>';
				str += '<td class="color-cc">' + data.info[i].idCard + '</td>';
				str += '<td class="color-e6">';
				if(data.info[i].auth_jd == '1') {
					//							var oImg = 'assets/houtai2/img/jingdong.png';
					str += '<img src="/assets/houtai2/img/jingdong.png" />';
				}
				if(data.info[i].auth_tb == '1') {
					//							var oImg = 'assets/houtai2/img/taobao.png';
					str += '<img src="/assets/houtai2/img/taobao.png" />';
				}
				if(data.info[i].auth_yys == '1') {
					//							var oImg = 'assets/houtai2/img/family.png';
					str += '<img src="/assets/houtai2/img/family.png" />';
				}
				if(data.info[i].auth_zfb == '1') {
					//							var oImg = 'assets/houtai2/img/zhima.png';
					str += '<img src="/assets/houtai2/img/zhima.png" />';
				}
				str += '</td>';
				str += '</tr>';
			}
			document.getElementById('tableList').innerHTML = str;
			$('.showAlerts').click(function() {
				$('.bgDiv').show();
				$('.alertInp').show();
				var oId = $(this).attr('id');
				var num = oId.split('o');
				var a = $(this).index();
				//					debugger;
				showDo(data, num[1], a);
			})
		}

		function showDo(data, k, a) {
			var str = '';
			str += '<ul class="infoTop">';
			str += '<li id="weixin_tx">';
			str += '<a href="' + data.info[k].wx_img + '"><img src="' + data.info[k].wx_img + '" width="60" /></a>';
			str += '<span>' + data.info[k].wx_name + '</span>';
			str += '</li>';
			str += '<li>';
			str += '<div >花呗</div>';
			str += '<div >' + data.info[k].huabei + '</div>';
			str += '</li>';
			str += '<li>';
			str += '<div >芝麻分</div>';
			str += '<div >' + data.info[k].zhimafen + '</div>';
			str += '</li>';
			str += '<li>';
			str += '<div >网龄</div>';
			str += '<div >' + data.info[k].wangling + '</div>';
			str += '</li>';
			str += '<li>';
			str += '<div >客户类型</div>';
			str += '<div >' + data.info[k].type + '</div>';
			str += '</li>';
			str += '<li>';
			str += '<div >原始数据</div>';
			str += '<div ></div>';
			str += '</li>';
			str += '</ul>';
			str += '<div class="manInfomation">';
			str += '<ul class="people_jiben">';
			str += '<li class="no_width"><span>姓名:</span><span>' + data.info[k].name + '</span></li>';
			str += '<li><span>手机号:</span><span>' + data.info[k].phone + '</span></li>';
			str += '<li class="long_width"><span>身份证号:</span><span>' + data.info[k].idCard + '</span></li>';
			//			var oEducation;
			//			if(data.info[k].education == '1') {
			//				oEducation = '研究生及以上';
			//			} else if(data.info[k].education == '2') {
			//				oEducation = '本科';
			//			} else if(data.info[k].education == '3') {
			//				oEducation = '大专';
			//			} else if(data.info[k].education == '4') {
			//				oEducation = '高中/中专';
			//			} else if(data.info[k].education == '5') {
			//				oEducation = '初中及以下';
			//			}
			str += '<li class="no_width"><span>学历:</span><span>' + data.info[k].education + '</span></li>';
			str += '<li><span>邮箱号:</span><span>' + data.info[k].email + '</span></li>';
			str += '<li class="long_width"><span>工作单位:</span><span>' + data.info[k].company + '</span></li>';
			str += '</ul>';

			str += '<table border="" cellspacing="" cellpadding="" class="table-bordered table">';
			str += '<tr>';
			str += '<th class="col-lg-3">关系</th>';
			str += '<th class="col-lg-3">姓名</th>';
			str += '<th class="col-lg-6">电话</th>';
			str += '</tr>';
			str += '<tr>';
			str += '<td>父亲</td>';
			str += '<td>' + data.info[k].fname + '</td>';
			str += '<td>' + data.info[k].fphone + '</td>';
			str += '</tr>';
			str += '<tr>';
			str += '<td>母亲</td>';
			str += '<td>' + data.info[k].mname + '</td>';
			str += '<td>' + data.info[k].mphone + '</td>';
			str += '</tr>';
			str += '<tr>';
			str += '<td>配偶</td>';
			str += '<td>' + data.info[k].pname + '</td>';
			str += '<td>' + data.info[k].pphone + '</td>';
			str += '</tr>';
			str += '<tr>';
			str += '<td>朋友</td>';
			str += '<td>' + data.info[k].yname + '</td>';
			str += '<td>' + data.info[k].yphone + '</td>';
			str += '</tr>';
			str += '<tr>';
			str += '<td>公司</td>';
			str += '<td>' + data.info[k].lname + '</td>';
			str += '<td>' + data.info[k].lphone + '</td>';
			str += '</tr>';
			str += '</table>';
			if(data.info[k].shenfenzheng_img != "") {
				str += '<ul class="phone_list">';
				str += '<li><a href="/uploads/shenfenzheng/' + data.info[k].shenfenzheng_img[1] + '" ><img src="/assets/houtai2/img/img_id.png" /></a></li>';
				str += '<li><a href="/uploads/shenfenzheng/' + data.info[k].shenfenzheng_img[2] + '" ><img src="/assets/houtai2/img/img_id.png" /></a></li>';
				str += '<li><a href="/uploads/shenfenzheng/' + data.info[k].shenfenzheng_img[3] + '" ><img src="/assets/houtai2/img/img_id.png" /></a></li>';
				str += '</ul>';
			}
			str += '</div>';
			document.getElementById('alertLeft').innerHTML = str;
			$('#weixin_tx a').lightBox();
			$('.phone_list li a').lightBox();
			document.getElementById('shPeople').innerHTML = '审核员:' + data.info[k].verifyBy;
			var str2 = '';
			str2 += '<div ><span>类型:</span><span>' + data.info[k].type + '</span></div>';
			str2 += '<div ><span>申请时间:</span><span class="color-red">' + data.info[k].create_at + '</span></div>';
			var psTime;
			if(data.info[k].passed_at == null) {
				psTime = '&nbsp;'
			} else {
				psTime = data.info[k].passed_at;
			}
			str2 += '<div ><span>通过时间:</span><span class="color-red">' + psTime + '</span></div>';
			var npsTime;
			if(data.info[k].denide_at == null) {
				npsTime = '&nbsp;'
			} else {
				npsTime = data.info[k].denide_at;
			}
			str2 += '<div ><span>拒绝时间:</span><span class="color-red">' + npsTime + '</span></div>';
			str2 += '<div ><span>审核备注:</span><span>' + data.info[k].comment + '</span></div>';
			document.getElementById('shList').innerHTML = str2;
			//			debugger;
			$('#passed').unbind().click(function() {
				//				debugger;
				var r = confirm("确认通过么!")
				if(r == true) {
					$.ajax({ //获取数据
						type: 'post',
						url: "/admin/pass",
						dataType: 'json',
						data: {
							id: data.info[k].id,
							comment: $('#bz').val(),
						},
						async: true,
						success: function(data) {

							if(data == true) {
								$('.bgDiv').hide();
								$('.alertInp').hide();
								$('#tableList tr').eq(a).hide();
								var psVal = $('#ysPass').html();
								var num = psVal.split(':') ;
								var oNum = parseInt(num[1])+1; 
								document.getElementById('ysPass').innerHTML = '今日通过数:' + oNum;
							}

						},
						error: function() {

						}
					})

				} else {

				}
			})
			$('#unpassed').unbind().click(function() {
				//				debugger;
				var r = confirm("确认不通过么!")
				if(r == true) {
					$('.bgDiv').hide();
					$('.alertInp').hide();
					$('#tableList tr').eq(a).hide();
					$.ajax({ //获取数据
						type: 'post',
						url: "/admin/denide",
						dataType: 'json',
						data: {
							id: data.info[k].id,
							comment: $('#bz').val(),
						},
						async: true,
						success: function(data) {
							if(data == true) {
								$('.bgDiv').hide();
								$('.alertInp').hide();
								$('#tableList tr').eq(a).hide();
							}
						},
						error: function() {

						}
					})
				} else {

				}
			})
		}

		/*搜索*/
		document.getElementById('choice_val').onkeydown = function() {
			var e = event || window.event || arguments.callee.caller.arguments[0];
			if(e && e.keyCode == 13) { // enter 键
				var oVal = selectName;
				var choiceType;
				if(oVal == 'ID') {
					choiceType = 'id';
				} else if(oVal == '姓名') {
					choiceType = 'name';
				} else if(oVal == '手机号') {
					choiceType = 'phone';
				} else if(oVal == '身份证号') {
					choiceType = 'idCard';
				}

				$.ajax({ //获取数据
					type: 'post',
					url: "/searchBar",
					dataType: 'json',
					data: {
						type: choiceType,
						value: $('#choice_val').val(),
					},
					async: true,
					success: function(data) {
						if(data == false) {
							$('#searchList').html('');
							alert('该用户不存在!');
						} else {
							searchList(data);
						}

					},
					error: function() {
						//						debugger;
					}
				})
			}

		}

		$('#chioce_list li').click(function() {
			if($(this).html() == '审核记录') {
				$(this).parent().children().removeClass('chioced');
				$(this).addClass('chioced');
				$('#shenhe2').show();
				$('#fangkuan2').hide();
				$('#cuishou2').hide();

			} else if($(this).html() == '放款记录') {
				$(this).parent().children().removeClass('chioced');
				$(this).addClass('chioced');
				$('#shenhe2').hide();
				$('#fangkuan2').show();
				$('#cuishou2').hide();
			} else if($(this).html() == '催收记录') {
				$(this).parent().children().removeClass('chioced');
				$(this).addClass('chioced');
				$('#shenhe2').hide();
				$('#fangkuan2').hide();
				$('#cuishou2').show();
			}
		})

		function searchList(data) {
			var str = '';
			str += '<tr>';
			str += '<th class="col-lg-1 color-cc">序号</th>';
			str += '<th class="col-lg-1 color-e6">姓名</th>';
			str += '<th class="col-lg-1 color-cc">性别</th>';
			str += '<th class="col-lg-2 color-e6">手机号</th>';
			str += '<th class="col-lg-2 color-cc">身份证</th>';
			str += '<th class="col-lg-5 color-e6">授权状态</th>';
			str += '</tr>';
			//			for(var i = 0; i < data.info.length; i++) {
			if(data.info.sex == '1') {
				oSex = '男';
			} else {
				oSex = '女';
			}
			str += '<tr class="showSearch">';
			str += '<td class="color-cc ">' + data.info.id + '</td>';
			str += '<td class="color-e6">' + data.info.name + '</td>';
			str += '<td class="color-cc">' + oSex + '</td>';
			str += '<td class="color-e6">' + data.info.phone + '</td>';
			str += '<td class="color-cc">' + data.info.idCard + '</td>';
			str += '<td class="color-e6">';
			if(data.info.auth_jd == '1') {
				str += '<img src="/assets/houtai2/img/jingdong.png" />';
			}
			if(data.info.auth_tb == '1') {
				str += '<img src="/assets/houtai2/img/taobao.png" />';
			}
			if(data.info.auth_yys == '1') {
				str += '<img src="/assets/houtai2/img/family.png" />';
			}
			if(data.info.auth_zfb == '1') {
				str += '<img src="/assets/houtai2/img/zhima.png" />';
			}
			str += '</td>';
			str += '</tr>';
			//			}
			document.getElementById('searchList').innerHTML = str;
			$('.showSearch').click(function() {
				$('.bgDiv').show();
				$('.alertInp2').show();
				searchAlert(data);
			})
		}

		function searchAlert(data) {
			/*左侧基本信息*/
			var str = '';
			str += '<ul class="infoTop">';
			str += '<li class="weixin_tx">';
			str += '<a href="' + data.info.wx_img + '"><img src="' + data.info.wx_img + '" width="60" /></a>';
			str += '<span>' + data.info.wx_name + '</span>';
			str += '</li>';
			str += '<li>';
			str += '<div  >花呗</div>';
			str += '<div  >' + data.info.huabei + '</div>';
			str += '</li>';
			str += '<li>';
			str += '<div  >芝麻分</div>';
			str += '<div  >' + data.info.zhimafen + '</div>';
			str += '</li>';
			str += '<li>';
			str += '<div  >网龄</div>';
			str += '<div  >' + data.info.wangling + '</div>';
			str += '</li>';
			str += '<li>';
			str += '<div  >客户类型</div>';
			str += '<div  >' + data.info.type + '</div>';
			str += '</li>';
			str += '<li>';
			str += '<div  >原始数据</div>';
			str += '<div  ></div>';
			str += '</li>';
			str += '</ul>';
			str += '<div class="manInfomation">';
			str += '<ul class="people_jiben">';
			str += '<li class="no_width"><span>姓名:</span><span>' + data.info.name + '</span></li>';
			str += '<li><span>手机号:</span><span>' + data.info.phone + '</span></li>';
			str += '<li class="long_width"><span>身份证号:</span><span>' + data.info.idCard + '</span></li>';
			str += '<li class="no_width"><span>学历:</span><span>' + data.info.education + '</span></li>';
			str += '<li><span>邮箱号:</span><span>' + data.info.email + '</span></li>';
			str += '<li class="long_width"><span>工作单位:</span><span>' + data.info.company + '</span></li>';
			str += '</ul>';

			str += '<table border="" cellspacing="" cellpadding="" class="table-bordered table">';
			str += '<tr>';
			str += '<th class="col-lg-3">关系</th>';
			str += '<th class="col-lg-3">姓名</th>';
			str += '<th class="col-lg-6">电话</th>';
			str += '</tr>';
			str += '<tr>';
			str += '<td>父亲</td>';
			str += '<td>' + data.info.fname + '</td>';
			str += '<td>' + data.info.fphone + '</td>';
			str += '</tr>';
			str += '<tr>';
			str += '<td>母亲</td>';
			str += '<td>' + data.info.mname + '</td>';
			str += '<td>' + data.info.mphone + '</td>';
			str += '</tr>';
			str += '<tr>';
			str += '<td>配偶</td>';
			str += '<td>' + data.info.pname + '</td>';
			str += '<td>' + data.info.pphone + '</td>';
			str += '</tr>';
			str += '<tr>';
			str += '<td>朋友</td>';
			str += '<td>' + data.info.yname + '</td>';
			str += '<td>' + data.info.yphone + '</td>';
			str += '</tr>';
			str += '<tr>';
			str += '<td>公司</td>';
			str += '<td>' + data.info.lname + '</td>';
			str += '<td>' + data.info.lphone + '</td>';
			str += '</tr>';
			str += '</table>';
			if(data.info.shenfenzheng_img != "") {
				str += '<ul class="phone_list">';
				str += '<li><a href="/uploads/shenfenzheng/' + data.info.shenfenzheng_img[1] + '" ><img src="/assets/houtai2/img/img_id.png" /></a></li>';
				str += '<li><a href="/uploads/shenfenzheng/' + data.info.shenfenzheng_img[2] + '" ><img src="/assets/houtai2/img/img_id.png" /></a></li>';
				str += '<li><a href="/uploads/shenfenzheng/' + data.info.shenfenzheng_img[3] + '" ><img src="/assets/houtai2/img/img_id.png" /></a></li>';
				str += '</ul>';
			}
			str += '</div>';
			document.getElementById('alertLeft2').innerHTML = str;
			$('.weixin_tx a').lightBox();
			$('.phone_list li a').lightBox();
			document.getElementById('shPeople2').innerHTML = '审核员:' + data.info.verifyBy;

			/*审核记录*/
			var str1 = '';
			str1 += '<div class="recordTop">';
			var psType;
			if(data.info.type == '') {
				psType = '&nbsp;'
			} else {
				psType = data.info.type;
			}
			str1 += '<div  ><span>类型:</span><span>' + psType + '</span></div>';
			str1 += '<div  ><span>申请时间:</span><span class="color-red">' + data.info.create_at + '</span></div>';
			var psTime;
			if(data.info.passed_at == null) {
				psTime = '&nbsp;'
			} else {
				psTime = data.info.passed_at;
			}
			str1 += '<div  ><span>通过时间:</span><span class="color-red">' + psTime + '</span></div>';
			var npsTime;
			if(data.info.denide_at == null) {
				npsTime = '&nbsp;'
			} else {
				npsTime = data.info.denide_at;
			}
			str1 += '<div  ><span>拒绝时间:</span><span class="color-red">' + npsTime + '</span></div>';
			str1 += '<div  ><span>审核备注:</span><span>&nbsp;' + data.info.comment + '</span></div>';
			var zbfkTime;
			if(data.info.zbfk_time == null){
				zbfkTime = '&nbsp;'
			}else{
				zbfkTime = data.info.zbfk_time;
			}
			str1 += '<div  ><span>暂不放款时间:</span><span>&nbsp;' + zbfkTime + '</span></div>';
			str1 += '<div  ><span>暂不放款备注:</span><span>&nbsp;' + data.info.zbfk_comment + '</span></div>';
			str1 += '</div>';
			document.getElementById('shenhe2').innerHTML = str1;

			/*放款记录*/
			var str2 = '';
			var listNum = data.jk.length;
			if(listNum != '0') {
				str2 += '<div class="recordTop">';
				str2 += '<div  ><span>累计笔数:</span><span>' + listNum + '</span></div>';
				str2 += '<div  ><span>当前金额:</span><span class="color-red">' + data.jk[listNum - 1].amount + '</span></div>';
				var allMoney = 0;
				for(var k = 0; k < listNum; k++) {
					allMoney += parseInt(data.jk[k].amount);
				}
				str2 += '<div  ><span>总金额:</span><span>' + allMoney + '</span></div>';
				str2 += '</div>';
				var oImg;
				for(var j = 0; j < listNum; j++) {
					str2 += '<div class="recordList">';
					str2 += '<div class="listTop">';
					str2 += '<div class="moneyTop">';
					str2 += '<span class="titleMoney"><span></span>金额(元)</span>';
					if(data.jk[j].status == '0') {
						str2 += '<span class="titleFont">未还款</span>';
					} else if(data.jk[j].status == '1') {
						oImg = 'assets/houtai2/img/hk.PNG';
						str2 += '<span class="titleFont">已还款</span>';
						str2 += '<img src="<?php echo asset("' + oImg + '") ?>" />';
					} else if(data.jk[j].status == '2') {
						oImg = 'assets/houtai2/img/yq.PNG';
						str2 += '<span class="titleFont">有逾期</span>';
						str2 += '<img src="<?php echo asset("' + oImg + '") ?>" />';
					}
					str2 += '</div>';
					str2 += '<div class="topMoney">' + data.jk[j].amount + '</div>';
					str2 += '</div>';
					str2 += '<div class="listMain">';
					str2 += '<div class="line_right">';
					str2 += '<span>借款日期:&nbsp;' + data.jk[j].jkdate + '</span><br />';
					var allDay = Date.parse(data.jk[j].hkdate) - Date.parse(data.jk[j].jkdate);

					str2 += '<span>借款天数:&nbsp;' + parseInt(allDay / 3600 / 24 / 1000) + '&nbsp;天</span>';
					str2 += '</div>';
					str2 += '<div   style="float: right;">';

					str2 += '<span>计划还款日:&nbsp;' + data.jk[j].hkdate + '</span><br />';
					str2 += '<span>实际还款日:&nbsp;' + data.jk[j].paydate + '</span>';
					str2 += '</div>';
					str2 += '</div>';

					for(var n = 0; n < data.jk[j].yanqi.length; n++) {
						str2 += '<div class="listMain">';
						str2 += '<div class="line_right">';
						str2 += '<span>延期金额:&nbsp;' + data.jk[j].yanqi[n].amount + '</span><br />';
						str2 += '<span>延期费用:&nbsp;' + data.jk[j].yanqi[n].fee + '</span><br />';
						str2 += '<span>延期天数:&nbsp;' + data.jk[j].yanqi[n].days + '&nbsp;天</span>';
						str2 += '</div>';
						str2 += '<div   style="float:right;">';
						str2 += '<span>延期开始日:&nbsp;' + data.jk[j].yanqi[n].begin_date + '</span><br />';

						str2 += '<span>延期结束日:&nbsp;' + data.jk[j].yanqi[n].end_date + '</span>';
						//								str2 += '<span>实际还款日:&nbsp;' + data.jk[j].paydate + '</span>';
						str2 += '</div>';
						str2 += '</div>';
						str2 += '<div class="listBz">';
						str2 += '<ul>';
						str2 += '<li>延期备注:</li>';
						str2 += '<li class="bzNr">';
						str2 += '<span>' + data.jk[j].yanqi[n].note + '</span>';
						str2 += '</li>';
						str2 += '</ul>';
						str2 += '</div>';
					}

					str2 += '<div class="listBz">';
					str2 += '<ul>';
					str2 += '<li>备注:</li>';
					str2 += '<li class="bzNr">';
					str2 += '<span>' + data.jk[j].note + '</span>';
					str2 += '</li>';
					str2 += '</ul>';
					str2 += '</div>';
					str2 += '</div>';
				}
			} else {
				str2 += '<div class="recordTop">';
				str2 += '<div  ><span>累计笔数:</span><span>0</span></div>';
				str2 += '<div  ><span>当前金额:</span><span class="color-red">0</span></div>';

				str2 += '<div  ><span>总金额:</span><span>0</span></div>';
				str2 += '</div>';
			}
			document.getElementById('fangkuan2').innerHTML = str2;

			/*催收记录*/
			if(data.jk.length > 0) {
				var str3 = '';
				for(var n = 0; n < data.jk[listNum - 1].cs.length; n++) {
					str3 += '<div class="recordTop" style="margin-bottom:10px;">';
					var oType;
					if(data.jk[listNum - 1].cs[n].status == '0') {
						oType = '逾期 ';
					} else if(data.jk[listNum - 1].cs[n].status == '1') {
						oType = '承诺还款 ';
					} else if(data.jk[listNum - 1].cs[n].status == '2') {
						oType = '已经还款 ';
					} else {
						oType = '延期 ';
					}
					str3 += '<div  ><span>状态:</span><span>' + oType + '</span></div>';
					str3 += '<div  ><span>时间:</span><span class="color-red">' + data.jk[listNum - 1].cs[n].add_time + '</span></div>';
					str3 += '<div  ><span>备注:</span><span>' + data.jk[listNum - 1].cs[n].note + '</span></div>';
					str3 += '</div>';
				}
				document.getElementById('cuishou2').innerHTML = str3;
			}
		}
	</script>

</html>