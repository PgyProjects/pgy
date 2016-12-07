<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="/assets/houtai2/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="/assets/houtai2/css/bootstrap-theme.css" />
		<link rel="stylesheet" type="text/css" href="/assets/houtai2/css/fangkuan_style.css" />
		<link rel="stylesheet" type="text/css" href="/assets/houtai2/css/page.css" />
		<link rel="stylesheet" type="text/css" href="/assets/houtai2/css/jquery.lightbox-0.5.css" />
		<script src="/assets/houtai2/js/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>
		<script src="/assets/houtai2/js/bootstrap.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="/assets/houtai2/js/laydate.js"></script>
		<script src="/assets/houtai2/js/jquery.page.js" type="text/javascript" charset="utf-8"></script>
		<script src="/assets/houtai2/js/jquery.lightbox-0.5.js" type="text/javascript" charset="utf-8"></script>
	</head>

	<body>
		<div class="header">
			<span class="topLeft">放款</span>
			<ul class="topRight">
				<li>
					<img src="/assets/houtai2/img/email.png" width="50" class="email" />
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
				<li>当日放款数:(人数)</li>
				<li>当日放款率:70%</li>
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

				</table>
			</div>
			<div class="oTable table-responsive">

				<div class="col-lg-1 color-e6 all_num" id="allNum">
					总量
				</div>
				<table border="" cellspacing="" cellpadding="" class="table table-bordered main_table" id="tableList">

				</table>
				<div class="tcdPageCode">

				</div>
			</div>
		</div>
		<div class="bgDiv"></div>
		<div class="alertInp">
			<div class="alertInp_header">
				<div class="title">数据详情</div>
				<img src="/assets/houtai2/img/close.png" class="havclose" />
			</div>
			<div class="alertInp_main">
				<div class="alertLeft col-lg-8" id="alertLeft">

				</div>
				<div class="alertRight col-lg-4">
					<div class="right_header" id="shPeople"></div>
					<ul class="chioce_list" id="chioce_list1">
						<li class="chioced">审核记录</li>
						<li>放款记录</li>
					</ul>
					<div class="chioce_main" id="shenhe">
						<div class="recordTop" id="shList">
							<!--<div  ><span>类型:</span><span>2</span></div>
							<div  ><span>时间:</span><span class="color-red">2000</span></div>
							<div  ><span>备注:</span><span>3000</span></div>-->
						</div>
					</div>
					<div class="chioce_main" id="fangkuan" style="display: none;">

					</div>
					<div class="right_footer">
						<textarea name="" rows="" cols="" placeholder="填写备注" id="bz"></textarea>
						<div class="pass_btn btn btn-success" id="fangkuan2">放款</div>
						<div class="nopass_btn btn btn-warning" id="wfangkuan">暂不放款</div>
					</div>
					<div class="showAlert" id="showAlert">

					</div>
					<div class="showAlert2" id="showAlert2">

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
					<div class="chioce_main" id="fangkuan3" style="display: none;height: 540px;border: none;">

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
		$('.dropdown-menu li a').click(function() {
			selectName = $(this).html();
			var selectType = selectName + '&nbsp;<span class="caret"></span>';
			$('.dropdown-menu').prev().html(selectType);

			return selectName;
		})
		jsonType(1);
		//基本列表
		function jsonType(page) {
			$.ajax({ //获取数据
				type: 'post',
				url: "/jkapi/page_ajax/" + page,
				dataType: 'json',
				async: true,
				success: function(data) {
					document.getElementById('allNum').innerHTML = '总量&nbsp;' + data.zongji;
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
					for(var i = 0; i < data.data.length; i++) {
						if(data.data[i].sex == '1') {
							oSex = '男';
						} else {
							oSex = '女';
						}
						str += '<tr class="showAlerts" id="' + data.data[i].wx_openid + '">';
						str += '<td class="color-cc ">' + data.data[i].id + '</td>';
						str += '<td class="color-e6">' + data.data[i].name + '</td>';
						str += '<td class="color-cc">' + oSex + '</td>';
						str += '<td class="color-e6">' + data.data[i].phone + '</td>';
						str += '<td class="color-cc">' + data.data[i].idCard + '</td>';
						str += '<td class="color-e6">';
						if(data.data[i].auth_jd == '1') {
							//							var oImg = 'assets/houtai2/img/jingdong.png';
							str += '<img src="/assets/houtai2/img/jingdong.png" />';
						}
						if(data.data[i].auth_tb == '1') {
							//							var oImg = 'assets/houtai2/img/taobao.png';
							str += '<img src="/assets/houtai2/img/taobao.png" />';
						}
						if(data.data[i].auth_yys == '1') {
							//							var oImg = 'assets/houtai2/img/family.png';
							str += '<img src="/assets/houtai2/img/family.png" />';
						}
						if(data.data[i].auth_zfb == '1') {
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

						var a = $(this).index();
						//					debugger;
						showDo(oId, a);
					});
					var num = Math.ceil(data.zongji / 5);
					$(".tcdPageCode").createPage({
						pageCount: num,
						current: page,
						backFn: function(p) {
							jsonType(p);
						}
					});
				},
				error: function(result) {

				}
			})
		}
		//弹出层
		function showDo(id, a) {
			$.ajax({ //获取数据
				type: 'get',
				url: "/jkapi/detail/" + id,
				dataType: 'json',
				async: true,
				success: function(data) {
					/*左侧基本信息*/
					var str = '';
					str += '<ul class="infoTop">';
					str += '<li id="weixin_tx">';
					str += '<a href="' + data.wx_img + '"><img src="' + data.wx_img + '" width="60" /></a>';
					str += '<span>' + data.wx_name + '</span>';
					str += '</li>';
					str += '<li>';
					str += '<div  >花呗</div>';
					str += '<div  >' + data.huabei + '</div>';
					str += '</li>';
					str += '<li>';
					str += '<div  >芝麻分</div>';
					str += '<div  >' + data.zhimafen + '</div>';
					str += '</li>';
					str += '<li>';
					str += '<div  >网龄</div>';
					str += '<div  >' + data.wangling + '</div>';
					str += '</li>';
					str += '<li>';
					str += '<div  >客户类型</div>';
					str += '<div  >' + data.type + '</div>';
					str += '</li>';
					str += '<li>';
					str += '<div  >原始数据</div>';
					str += '<div  ></div>';
					str += '</li>';
					str += '</ul>';
					str += '<div class="manInfomation">';
					str += '<ul class="people_jiben">';
					str += '<li class="no_width"><span>姓名:</span><span>' + data.name + '</span></li>';
					str += '<li><span>手机号:</span><span>' + data.phone + '</span></li>';
					str += '<li class="long_width"><span>身份证号:</span><span>' + data.idCard + '</span></li>';
					//					var oEducation;
					//					if(data.education == '1') {
					//						oEducation = '研究生及以上';
					//					} else if(data.education == '2') {
					//						oEducation = '本科';
					//					} else if(data.education == '3') {
					//						oEducation = '大专';
					//					} else if(data.education == '4') {
					//						oEducation = '高中/中专';
					//					} else if(data.education == '5') {
					//						oEducation = '初中及以下';
					//					}
					str += '<li class="no_width"><span>学历:</span><span>' + data.education + '</span></li>';
					str += '<li><span>邮箱号:</span><span>' + data.email + '</span></li>';
					str += '<li class="long_width"><span>工作单位:</span><span>' + data.company + '</span></li>';
					str += '</ul>';

					str += '<table border="" cellspacing="" cellpadding="" class="table-bordered table">';
					str += '<tr>';
					str += '<th class="col-lg-3">关系</th>';
					str += '<th class="col-lg-3">姓名</th>';
					str += '<th class="col-lg-6">电话</th>';
					str += '</tr>';
					str += '<tr>';
					str += '<td>父亲</td>';
					str += '<td>' + data.fname + '</td>';
					str += '<td>' + data.fphone + '</td>';
					str += '</tr>';
					str += '<tr>';
					str += '<td>母亲</td>';
					str += '<td>' + data.mname + '</td>';
					str += '<td>' + data.mphone + '</td>';
					str += '</tr>';
					str += '<tr>';
					str += '<td>配偶</td>';
					str += '<td>' + data.pname + '</td>';
					str += '<td>' + data.pphone + '</td>';
					str += '</tr>';
					str += '<tr>';
					str += '<td>朋友</td>';
					str += '<td>' + data.yname + '</td>';
					str += '<td>' + data.yphone + '</td>';
					str += '</tr>';
					str += '<tr>';
					str += '<td>公司</td>';
					str += '<td>' + data.lname + '</td>';
					str += '<td>' + data.lphone + '</td>';
					str += '</tr>';
					str += '</table>';
					if(data.shenfenzheng_img != "") {
						str += '<ul class="phone_list">';
						str += '<li><a href="/uploads/shenfenzheng/' + data.shenfenzheng_img[1] + '" ><img src="/assets/houtai2/img/img_id.png"/></a></li>';
						str += '<li><a href="/uploads/shenfenzheng/' + data.shenfenzheng_img[2] + '" ><img src="/assets/houtai2/img/img_id.png" /></a></li>';
						str += '<li><a href="/uploads/shenfenzheng/' + data.shenfenzheng_img[3] + '" ><img src="/assets/houtai2/img/img_id.png" /></a></li>';
						str += '</ul>';
					}

					str += '</div>';
					document.getElementById('alertLeft').innerHTML = str;
					$('#weixin_tx a').lightBox();
					$('.phone_list li a').lightBox();
					document.getElementById('shPeople').innerHTML = '放款员:' + data.manager_name;
					/*放款记录*/
					var str2 = '';
					var listNum = data.record_list.length;
					if(listNum != '0') {
						str2 += '<div class="recordTop">';
						str2 += '<div  ><span>累计笔数:</span><span>' + listNum + '</span></div>';
						str2 += '<div  ><span>当前金额:</span><span class="color-red">' + data.record_list[listNum - 1].amount + '</span></div>';
						var allMoney = 0;
						for(var k = 0; k < listNum; k++) {
							allMoney += parseInt(data.record_list[k].amount);
						}
						str2 += '<div  ><span>总金额:</span><span>' + allMoney + '</span></div>';
						str2 += '</div>';
						var oImg;
						for(var j = 0; j < listNum; j++) {
							str2 += '<div class="recordList">';
							str2 += '<div class="listTop">';
							str2 += '<div class="moneyTop">';
							str2 += '<span class="titleMoney"><span></span>金额(元)</span>';
							if(data.record_list[j].status == '0') {
								str2 += '<span class="titleFont">未还款</span>';
							} else if(data.record_list[j].status == '1') {
								oImg = 'assets/houtai2/img/hk.PNG';
								str2 += '<span class="titleFont">已还款</span>';
								str2 += '<img src="<?php echo asset("' + oImg + '") ?>" />';
							} else if(data.record_list[j].status == '2') {
								oImg = 'assets/houtai2/img/yq.PNG';
								str2 += '<span class="titleFont">有逾期</span>';
								str2 += '<img src="<?php echo asset("' + oImg + '") ?>" />';
							}
							str2 += '</div>';
							str2 += '<div class="topMoney">' + data.record_list[j].amount + '</div>';
							str2 += '</div>';
							str2 += '<div class="listMain">';
							str2 += '<div class="line_right">';
							str2 += '<span>借款日期:&nbsp;' + data.record_list[j].jkdate + '</span><br />';
							var allDay = Date.parse(data.record_list[j].hkdate) - Date.parse(data.record_list[j].jkdate);

							str2 += '<span>借款天数:&nbsp;' + parseInt(allDay / 3600 / 24 / 1000) + '&nbsp;天</span>';
							str2 += '</div>';
							str2 += '<div  >';

							str2 += '<span>计划还款日:&nbsp;' + data.record_list[j].hkdate + '</span><br />';
							str2 += '<span>实际还款日:&nbsp;</span>';
							str2 += '</div>';
							str2 += '</div>';
							for(var n = 0; n < data.record_list[j].cs_list.length; n++) {
								str2 += '<div class="listMain">';
								str2 += '<div class="line_right">';
								str2 += '<span>延期金额:&nbsp;' + data.record_list[j].cs_list[n].amount + '</span><br />';
								str2 += '<span>延期费用:&nbsp;' + data.record_list[j].cs_list[n].fee + '</span><br />';
								str2 += '<span>延期天数:&nbsp;' + data.record_list[j].cs_list[n].days + '&nbsp;天</span>';
								str2 += '</div>';
								str2 += '<div   style="float:right;">';
								str2 += '<span>延期开始日:&nbsp;' + data.record_list[j].cs_list[n].begin_date + '</span><br />';

								str2 += '<span>延期结束日:&nbsp;' + data.record_list[j].cs_list[n].end_date + '</span>';
								//								str2 += '<span>实际还款日:&nbsp;' + data.jiekuan_list[j].paydate + '</span>';
								str2 += '</div>';
								str2 += '</div>';
								str2 += '<div class="listBz">';
								str2 += '<ul>';
								str2 += '<li>延期备注:</li>';
								str2 += '<li class="bzNr">';
								str2 += '<span>' + data.record_list[j].cs_list[n].note + '</span>';
								str2 += '</li>';
								str2 += '</ul>';
								str2 += '</div>';
							}
							str2 += '<div class="listBz">';
							str2 += '<ul>';
							str2 += '<li>备注:</li>';
							str2 += '<li class="bzNr">';
							str2 += '<span>' + data.record_list[j].note + '</span>';
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

					document.getElementById('fangkuan').innerHTML = str2;
					/*放款*/
					var str3 = '';
					if(listNum == '0') {
						str3 += '<div class="input-group mTop">';
						str3 += '<span class="input-group-addon">花呗:</span>';
						str3 += '<input type="text" class="form-control" id="huabei1">';
						str3 += '</div>';
						str3 += '<div class="input-group mTop">';
						str3 += '<span class="input-group-addon">金额:</span>';
						str3 += '<input type="text" class="form-control" id="jine">';
						str3 += '</div>';
					} else {
						str3 += '<div class="input-group mTop">';
						str3 += '<span class="input-group-addon">金额:</span>';
						str3 += '<input type="text" class="form-control" id="jine" value="' + data.record_list[listNum - 1].amount + '">';
						str3 += '</div>';
					}
					str3 += '<div class="input-group mTop">';
					str3 += '<span class="input-group-addon">借款日:</span>';
					var date = new Date();
					var year = date.getFullYear();
					var month = date.getMonth() + 1;
					var date1 = date.getDate();
					var iTime = year + "-" + month + "-" + date1;
					str3 += '<input type="text" class="form-control" id="jkr" value="' + iTime + '">';
					str3 += '</div>';
					str3 += '<div class="input-group mTop">';
					str3 += '<span class="input-group-addon">还款日:</span>';
					var addDay;
					if(data.type == 'A') {
						addDay = 28;
					} else if(data.type == 'B') {
						addDay = 14;
					} else if(data.type == 'C') {
						addDay = 10;
					}
					str3 += '<input type="text" class="form-control" id="hkr" value="' + showTime(addDay, iTime) + '">';
					str3 += '</div>';
					str3 += '<button type="button" class="btn btn-primary mMiddle" id="hasFk">提交</button>';

					document.getElementById('showAlert').innerHTML = str3;
					$('#jkr').click(function() {
						laydate({
							elem: '#jkr',
							format: 'YYYY-MM-DD',
							festival: false, //显示节日
							choose: function(datas) { //选择日期完毕的回调
								$('#jkr').val(datas);
								var newTime = showTime(addDay, datas)
								$('#hkr').val(newTime);
							}
						});
					})
					$('#hkr').click(function() {
						laydate({
							elem: '#hkr',
							format: 'YYYY-MM-DD',
							festival: false, //显示节日
							choose: function(datas) { //选择日期完毕的回调
								$('#hkr').val(datas)
							}
						});
					})

					$('#hasFk').unbind().click(function() {
						var r = confirm("确认放款么!")
						if(r == true) {
							$('.showAlert').hide();
							$.ajax({ //获取数据
								type: 'post',
								url: "/jkapi/fangkuan",
								dataType: 'json',
								data: {
									wxid: id,
									beizhu: $('#bz').val(),
									jiekuanri: $('#jkr').val(),
									huankuanri: $('#hkr').val(),
									jine: $('#jine').val(),
									huabei: $('#huabei1').val()
								},
								async: true,
								success: function(data) {
									if(data.status == '0') {
										alert(data.message);
									} else {
										alert(data.message);
										newLoad();
										$('#tableList tr').eq(a).hide();
									}
								},
								error: function() {

								}
							})

						} else {

						}

					})

					/*未放款*/
					var str4 = '';
					str4 += '<div class="input-group mTop">';
					str4 += '<span class="input-group-addon">花呗:</span>';
					str4 += '<input type="text" class="form-control" id="hb2">';
					str4 += '</div>';
					str4 += '<button type="button" class="btn btn-primary mMiddle" id="noFk">提交</button>';
					document.getElementById('showAlert2').innerHTML = str4;
					$('#noFk').unbind().click(function() {
						var r = confirm("确认不放款么!")
						if(r == true) {
							$('.showAlert2').hide();
							$.ajax({ //获取数据
								type: 'post',
								url: "/jkapi/weifangkuan",
								dataType: 'json',
								data: {
									wxid: id,
									huabei: $('#hb2').val(),
									beizhu: $('#bz').val()
								},
								async: true,
								success: function(data) {
									if(data.status == '0') {
										alert(data.message);
									} else {
										alert(data.message);
										newLoad();
										$('#tableList tr').eq(a).hide();
									}

								},
								error: function() {

								}
							})

						} else {

						}
					})

					/*审核记录*/
					var str5 = '';
					str5 += '<div  ><span>类型:</span><span>' + data.type + '</span></div>';
					str5 += '<div  ><span>申请时间:</span><span class="color-red">' + data.create_at + '</span></div>';
					var psTime;
					if(data.passed_at == null) {
						psTime = '&nbsp;'
					} else {
						psTime = data.passed_at;
					}
					str5 += '<div  ><span>通过时间:</span><span class="color-red">' + psTime + '</span></div>';
					var npsTime;
					if(data.denide_at == null) {
						npsTime = '&nbsp;'
					} else {
						npsTime = data.denide_at;
					}
					str5 += '<div  ><span>拒绝时间:</span><span class="color-red">' + npsTime + '</span></div>';
					var npsTime;
					if(data.denide_at == null) {
						npsTime = '&nbsp;'
					} else {
						npsTime = data.denide_at;
					}
					str5 += '<div  ><span>审核备注:</span><span>&nbsp;' + data.comment + '</span></div>';
					str5 += '<div  ><span>暂不放款时间:</span><span>&nbsp;' + data.zbfk_time + '</span></div>';
					str5 += '<div  ><span>暂不放款备注:</span><span>&nbsp;' + data.zbfk_comment + '</span></div>';
					document.getElementById('shList').innerHTML = str5;
				},
				error: function() {

				}
			})
		}

		$('.havclose').click(function() {
			newLoad();
		})
		$('#fangkuan2').unbind().click(function() {
			$('.showAlert').toggle('slow');
			$('.showAlert2').hide();
		})
		$('#wfangkuan').unbind().click(function() {
			$('.showAlert').hide();
			$('.showAlert2').toggle('slow');
		})
		$('#chioce_list1 li').click(function() {
				if($(this).html() == '审核记录') {
					$(this).parent().children().removeClass('chioced');
					$(this).addClass('chioced');
					$('#shenhe').show();
					$('#fangkuan').hide();

				} else if($(this).html() == '放款记录') {
					$(this).parent().children().removeClass('chioced');
					$(this).addClass('chioced');
					$('#shenhe').hide();
					$('#fangkuan').show();
				}
			})
			/*关闭弹出层 样式重置*/
		function newLoad() {
			$('.bgDiv').hide();
			$('.alertInp').hide();
			$('.alertInp2').hide();
			$('.showAlert').hide();
			$('.showAlert2').hide();
			$('#bz').val('');
			$('#chioce_list1 li').removeClass('chioced');
			$('#chioce_list1 li').eq(0).addClass('chioced');
			$('#shenhe').show();
			$('#fangkuan').hide();
			$('#chioce_list li').removeClass('chioced');
			$('#chioce_list li').eq(0).addClass('chioced');
			$('#shenhe2').show();
			$('#fangkuan3').hide();
			$('#cuishou2').hide();
			document.getElementById('alertLeft').innerHTML = '';
			document.getElementById('shList').innerHTML = '';
			document.getElementById('shPeople').innerHTML = '放款员:';
		}
		/*计算时间*/
		function showTime(a, b) {
			//a需要间隔的时间,b为输入的时间
			var timeAry = b.split('-');
			var year = parseInt(timeAry[0]);
			var month = parseInt(timeAry[1]);
			var date1 = parseInt(timeAry[2]);
			var iTime = year + "-" + month + "-" + date1;
			if(b == '0') {
				return iTime;
			} else {
				var oTime;
				var oDate = date1 + a;

				if(month == '2') {
					if(year % 4 == 0) {
						if(oDate > '29') {
							month = month + 1;
							date1 = oDate - 29;
							if(date1 < 10) {
								date1 = '0' + date1;
							}
							if(month < 10) {
								month = '0' + month
							}
							oTime = year + "-" + month + "-" + date1;
						} else {
							if(month < 10) {
								month = '0' + month
							}
							oTime = year + "-" + month + "-" + date1;
						}
					} else {
						if(oDate > '28') {
							month = month + 1;
							date1 = oDate - 28;
							if(date1 < 10) {
								date1 = '0' + date1;
							}
							if(month < 10) {
								month = '0' + month
							}
							oTime = year + "-" + month + "-" + date1;
						} else {
							if(month < 10) {
								month = '0' + month
							}
							oTime = year + "-" + month + "-" + oDate;
						}
					}

				} else if(month == '1' || month == '3' || month == '5' || month == '7' || month == '8' || month == '10' || month == '12') {
					if(oDate > '31') {
						date1 = oDate - 31;
						if(date1 < 10) {
							date1 = '0' + date1;
						}
						month = month + 1;
						if(month > '12') {
							year = year + 1;
							month = 1;
							if(month < 10) {
								month = '0' + month
							}
							oTime = year + "-" + month + "-" + date1;
						} else {
							if(month < 10) {
								month = '0' + month
							}
							oTime = year + "-" + month + "-" + date1;
						}
					} else {
						if(month < 10) {
							month = '0' + month
						}
						oTime = year + "-" + month + "-" + oDate;
					}
				} else {

					if(oDate > '30') {
						month = month + 1;
						date1 = oDate - 30;
						if(date1 < 10) {
							date1 = '0' + date1;
						}
						if(month < 10) {
							month = '0' + month
						}
						oTime = year + "-" + month + "-" + date1;

					} else {
						if(month < 10) {
							month = '0' + month
						}
						//						debugger;
						oTime = year + "-" + month + "-" + oDate;
					}
				}
				return oTime;
			}

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
				$('#fangkuan3').hide();
				$('#cuishou2').hide();

			} else if($(this).html() == '放款记录') {
				$(this).parent().children().removeClass('chioced');
				$(this).addClass('chioced');
				$('#shenhe2').hide();
				$('#fangkuan3').show();
				$('#cuishou2').hide();
			} else if($(this).html() == '催收记录') {
				$(this).parent().children().removeClass('chioced');
				$(this).addClass('chioced');
				$('#shenhe2').hide();
				$('#fangkuan3').hide();
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
			document.getElementById('fangkuan3').innerHTML = str2;

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