<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/')?>css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/')?>css/page.css" />
		<script src="<?php echo base_url('public/')?>js/jquery-1.9.1.min.js" type="text/javascript" charset="utf-8"></script>

		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/')?>css/jquery.lightbox-0.5.css" media="screen" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/')?>css/cuishou.css" />
		<script type="text/javascript" src="<?php echo base_url('public/')?>js/jquery.lightbox-0.5.js"></script>
		<script src="http://api.map.baidu.com/api?v=2.0&ak=zi2IsR2IT5v3FdCMkXTXXFsBtb0E9h5R" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" src="<?php echo base_url('public/')?>js/laydate1.js"></script>
		<script src="<?php echo base_url('public/')?>js/jquery.page.js"></script>
		<script src="<?php echo base_url('public/')?>js/SimpleCanleder.js"></script>
		<link href="<?php echo base_url('public/')?>css/SimpleCanleder.css" rel="stylesheet">
		<script type="text/javascript">
			//			$(function() {
			//				$('#imggallery a').lightBox();
			//				$('#gallery dd a').lightBox();
			//				$('.wxxx a').lightBox();
			//
			//			});
		</script>
		<style type="text/css">
			.alertMain .alertMainRight {
				width: 269px !important;
				height: 735px !important;
			}
			
			.TypeOpe {
				margin-top: 10px !important;
			}
			
			.lcList {
				height: 300px;
			}
			
			.lcList_xia {
				margin-top: 10px;
				padding-left: 115px;
				cursor: pointer;
			}
			
			.mainheader {
				margin-bottom: 10px !important;
				cursor: pointer;
			}
			
			.lcList_xia img {
				display: inline-block;
				width: 18px;
				opacity: 0.7;
			}
			
			.move_top {
				transform: rotate(180deg);
				-ms-transform: rotate(180deg);
				/* IE 9 */
				-moz-transform: rotate(180deg);
				/* Firefox */
				-webkit-transform: rotate(180deg);
				/* Safari 和 Chrome */
				-o-transform: rotate(180deg);
				/* Opera */
			}
			
			.alldata {
				width: 95%;
				margin: 0 auto;
			}
			
			.alldata span {
				text-align: center;
				width: 24%;
				font-size: 0.8vw;
				display: inline-block;
			}
			
			.type3 input {
				background: #fdfdfd;
				border: none;
				padding-left: 5px;
			}
			
			.line_left {
				border-left: 1px solid #D9D9D9;
				height: 18px;
				padding-left: 3px;
			}
			
			.line_right {
				border-right: 1px solid #D9D9D9;
			}
			/*.line_top{
				border-top:1px solid #D9D9D9;
			}*/
			
			.line_bottom {
				border-bottom: 1px solid #D9D9D9;
			}
			
			.border_radio_left {
				border-radius: 5px 0 0 0;
			}
			
			.border_radio_right {
				border-radius: 0 5px 0 0;
			}
			
			.border_radio_right_bottom {
				border-radius: 0 0 5px 0;
			}
			
			.border_radio_left_bottom {
				border-radius: 0 0 0 5px;
			}
			
			.font_gy {
				color: #A0D264;
			}
			
			#yanqi {
				display: none;
			}
			
			#yanqi dt,
			#yanqi dd {
				margin-top: 6px !important;
			}
			
			#yanqi input {
				background: #fdfdfd;
				border: none;
				padding-left: 5px;
			}
			
			.alertMainShen {
				height: 324px;
			}
			
			.leftchose {
				width: 100%;
				cursor: pointer;
				display: inline-block;
			}
			
			.leftchose li {
				width: 33%;
				text-align: center;
				list-style: none;
				float: left;
				height: 27px;
				line-height: 27px;
			}
			
			.onActive {
				border-bottom: 5px solid #09f;
			}
		</style>
	</head>

	<body>
		<div class="header">

		</div>
		<div class="main">
			<div class="mainheader">催收列表</div>
			<div class="alldata">
				<span>上月逾期率:xx</span>
				<span>本月逾期率:xx</span>
				<span>本月逾期人数:xx</span>
				<span>综合逾期率:xx</span>

			</div>
			<table border="" cellspacing="" cellpadding="" id="tableList">

			</table>
			<div style="margin-right: 2.5%;float: right;">
				<div class="tcdPageCode">
				</div>
			</div>
		</div>
		<div class="alertBag">

		</div>
		<div class="alertInp">
			<div class="inpTop">
				<div class="inpTopLeft">数据详情</div>
				<div class="close"><img src="<?php echo base_url('public/')?>img/close.png" /></div>
			</div>
			<div class="alertMain">
				<div class="alertMainLeft">
					<div class="alertMainCan" style=" border-bottom: 1px solid #e9e9e9;height: auto;">
						<h2 style="text-align: center;padding-top:5px;">用户基本信息</h2>
						<dl class="details" id="gallery" style="height: 600px;width:561px;overflow: auto;">

						</dl>
						<!--<div class="info_bottom">
							<img src="<?php echo base_url('public/')?>img/bottom.png" style="margin: 0 auto;display: inherit;padding: 5px 0;opacity: 0.6;cursor: pointer;" />
						</div>-->
					</div>
					<div class="alertMainFot">
						<div class="FotChange">

						</div>
						<div class="FotBut">
							<span class="btnLeft"><img src="<?php echo base_url('public/')?>img/left.png"/></span>
							<span class="btnright"><img src="<?php echo base_url('public/')?>img/right.png"/></span>
						</div>
						<div class="FotLine">
							<span class="">20</span>
							<span class="">/</span>
							<span class="">40</span>
						</div>

					</div>
				</div>
				<div class="alertMainRight">
					<div class="leftchose">
						<ul>
							<li class="onActive" id="li1">催收记录</li>
							<li id="li2">借款记录</li>
							<li id="li3">审核信息</li>
						</ul>
					</div>
					<dl class="lcList" id="list1">
						<!--<dt style="margin-top:10px;">序号:</dt>
						<dd style="margin-top:10px;">20</dd>
						<dt>客户经理:</dt>
						<dd></dd>
						<dt>客户类型:</dt>
						<dd></dd>
						<dt class="line_top">借款总次数:</dt>
						<dd class="line_top"></dd>
						<dt>借款总金额:</dt>
						<dd></dd>
						<dt>上次借款金额:</dt>
						<dd></dd>-->
						<!--start-->
						<!--<dt>&nbsp;</dt>
						<dd style="height:18px;"><img src="<?php echo base_url('public/')?>icon/yq.png" style="position: relative;top: -7px;left:70px;" width="80" height="80" /></dd>
						<dt class="line_top line_left border_radio_left">状态:</dt>
						<dd class="line_top line_right border_radio_right font_gy">延期</dd>
						<dt class="line_left">时间:</dt>
						<dd class="line_right">2016年10月19日09:15:59</dd>
						<dt class="line_left line_bottom border_radio_left_bottom">备注:</dt>
						<dd class="line_right line_bottom border_radio_right_bottom font_gy"></dd>-->
						<!--end-->
					</dl>
					<dl class="lcList" id="list2" style="display: none;">

						<!--end-->
					</dl>
					<dl class="lcList" id="list3" style="display: none;">

						<!--end-->
					</dl>
					<div class="lcList_xia">
						<img src="<?php echo base_url('public/')?>img/bottom.png" />
					</div>
					<div class="TypeOpe">
						<dl>
							<dt class="">已逾期:</dt>
							<dd>
								<span style="color:red;font-weight:bold;font-size:14px;">8&nbsp;&nbsp;</span>天
							</dd>
							<dt>审核状态:</dt>
							<dd>
								<select name="" class="xgzt">
									<option value="1">逾期中</option>
									<option value="2">承诺还款</option>
									<option value="3">已还款</option>
									<option value="4">延期</option>
								</select>
							</dd>
						</dl>
						<dl id="yuqizhong" style="display: none;">
							<dt class="type1">备注:</dt>
							<dd class="bz type1">
								<textarea name="" rows="" cols="" placeholder="填写备注"></textarea>
							</dd>
						</dl>
						<form id="chengnuo_form">
							<dl id="chengnuo" style="display: none;">
								<dt class="type2" id="shij">时间:</dt>
								<dd class="bz_time type2">
									<input placeholder="请选择时间" name="cnhktime" id="shij2" value="" onClick="laydate({istime: true, format: 'YYYY-MM-DD'})" style="width:75px;" />
									<select name="sxw1" style="border: solid 1px #fdfdfd;background: #fdfdfd;">
										<option value="上午">上午</option>
										<option value="上午">下午</option>

									</select>
								</dd>
								<dt class="type1">备注:</dt>
								<dd class="bz type1">
									<textarea name="beizhu" rows="" cols="" placeholder="填写备注"></textarea>
								</dd>
							</dl>
						</form>
						<form id="yihuankuan_form">
							<dl id="yihuankuan" style="display: none;">
								<dt class="type2" id="shij">时间:</dt>
								<dd class="bz_time type2">
									<input placeholder="请选择时间" name="hktime" id="shij2_2" value="" onClick="laydate({istime: true, format: 'YYYY-MM-DD'})" style="width:75px;" />
									<select name="sxw1" style="border: solid 1px #fdfdfd;background: #fdfdfd;">
										<option value="上午">上午</option>
										<option value="上午">下午</option>

									</select>
								</dd>

								<dt class="type3">违约金:</dt>
								<dd class="wy type3">
									<input type="text" name="weiyuejin" id="weiyuejin" placeholder="xxxxx">
								</dd>

								<dt class="type1">备注:</dt>
								<dd class="bz type1">
									<textarea name="beizhu" rows="" cols="" placeholder="填写备注"></textarea>
								</dd>

							</dl>
						</form>
						<form id="yanqi_form">
							<dl id="yanqi" style="display: none;">
								<dt>延期天数:</dt>
								<dd>
									<input type="" name="delay_days" id="yqTime" value="" placeholder="填写延期天数" />
								</dd>
								<dt>延期费用:</dt>
								<dd>
									<input type="" name="delay_fee" id="" value="" placeholder="填写延期费用" />
								</dd>
								<dt>借款日:</dt>
								<dd>
									<input type="" name="jiekuanri" id="newData" value="" placeholder="选择借款日" onClick="laydate({istime: true, format: 'YYYY-MM-DD'});" />
								</dd>
								<dt>金额:</dt>
								<dd>
									<input type="" name="jine" id="" value="" placeholder="填写金额" />
								</dd>
								<dt>备注:</dt>
								<dd class="bz">
									<textarea name="beizhu" rows="" cols="" placeholder="填写备注"></textarea>
								</dd>
							</dl>
						</form>
						<span class="sbmBtn">提交</span>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script type="text/javascript">
		//分页
		function fenye(a, b, c, d) {
			var urlType = '';
			if(c == '0') {
				urlType = '<?php echo site_url("csapi/page_ajax")?>/' + a;
			} else if(c == '1') {
				urlType = '<?php echo site_url("csapi/page_ajax2/")?>' + a + '?' + d;
			}
			//			debugger;
			$.ajax({
				type: 'post',
				url: urlType, //发送后台的url 
				dataType: 'json', //后台返回的数据类型
				timeout: 45000, //超时时间
				async: false,
				success: function(data) { //data为后台返回的数据
					var str = '';
					var strT = '';
					//										debugger;
					str += '<tr>';
					str += '<th><input type="" name="" value="" class="num inputType" placeholder="序号" /></th>';
					str += '<th>';
					str += '<select name="" class="zt">';
					str += '<option value="">按状态筛选</option>';
					str += '<option value="逾期中">逾期中</option>';
					str += '<option value="承诺还款">承诺还款</option>';
					str += '</select>';
					str += '</th>';
					str += '<th><input type="" name="" id="xingming" value="" class="name inputType" placeholder="姓名" /></th>';
					str += '<th><input type="" name="" id="shouji" value="" class="tel inputType" placeholder="手机号码" /></th>';
					str += '<th><input type="" name="" id="jine" value="" class="je inputType" placeholder="金额" /></th>';
					str += '<th>';
					str += '<select name="" class="xb">';
					str += '<option value="">按性别筛选</option>';
					str += '<option value="男">男</option>';
					str += '<option value="女">女</option>';
					str += '</select>';
					str += '</th>';
					str += '<th><input type="" name="" id="nianlin" value="" class="nl inputType" placeholder="年龄" /></th>';
					str += '<th><input type="" name="" id="jkr" value="" class="jkr inputType" placeholder="借款日" /><button>搜索</button></th>';
					str += '<th><input type="" name="" id="hkr" value="" class="hkr inputType" placeholder="还款日" /><button>搜索</button></th>';
					str += '</tr>';
					var oType = '';
					for(var i = 0; i < data.data.length; i++) {
						if(data.data[i].cs_status == '0') {
							oType = '逾期中';
						} else if(data.data[i].cs_status == '1') {
							oType = '承诺还款';
						}
						strT += '<tr class="showAlert">';
						strT += '<td id="o' + data.data[i].jk_id + '" class="xhId">' + data.data[i].jk_id + '</td>';
						strT += '<td>' + oType + '</td>';
						strT += '<td>' + data.data[i].xingming + '</td>';
						strT += '<td>' + data.data[i].shoujihao + '</td>';
						strT += '<td>' + data.data[i].jine + '</td>';
						strT += '<td>' + data.data[i].sex + '</td>';
						strT += '<td>' + data.data[i].nianlin + '</td>';
						strT += '<td>' + data.data[i].jiekuanri + '</td>';
						strT += '<td>' + data.data[i].huankuanri + '</td>';
						strT += '</tr>';

					}
					document.getElementById('tableList').innerHTML = '';
					document.getElementById('tableList').innerHTML = str;
					document.getElementById('tableList').innerHTML += strT;

					//日历
					$("#jkr").simpleCanleder();
					$("#hkr").simpleCanleder();
					$("#jkr").change(function() {
						var chance = "key=jk&value=" + $(this).val();
						fenye(1, 10, 1, chance)
					});
					$("#hkr").change(function() {
						var chance = "key=hk&value=" + $(this).val();
						fenye(1, 10, 1, chance)
					});
					$('#xingming').bind("keypress", function(event) {
						if(event.keyCode == "13") {
							var chance = "key=nm&value=" + $(this).val();
							fenye(1, 10, 1, chance)
						}
					});
					$('#shouji').bind("keypress", function(event) {
						if(event.keyCode == "13") {
							var chance = "key=phone&value=" + $(this).val();
							fenye(1, 10, 1, chance)
						}
					});
					$('#jine').bind("keypress", function(event) {
						if(event.keyCode == "13") {
							var chance = "key=jine&value=" + $(this).val();
							fenye(1, 10, 1, chance)
						}
					});
					$('#nianlin').bind("keypress", function(event) {
						if(event.keyCode == "13") {
							var chance = "key=age&value=" + $(this).val();
							fenye(1, 10, 1, chance)
						}
					});
					$('.zt').change(function() {
						var thisVal = $(this).val();
						if(thisVal == '逾期中') {

							var chance = "key=status&value=yq";
							fenye(1, 10, 1, chance)
						} else if(thisVal == '承诺还款') {
							var chance = "key=status&value=cn";
							fenye(1, 10, 1, chance)
						}

					})
					$('.xb').change(function() {
						var thisVal = $(this).val();
						if(thisVal == '男') {
							var chance = "key=sex&value=M";
							fenye(1, 10, 1, chance)
						} else if(thisVal == '女') {
							var chance = "key=sex&value=F";
							fenye(1, 10, 1, chance)
						}

					})
					tanchu();

					var num = Math.ceil(data.zongji / b);
					$(".tcdPageCode").createPage({
						pageCount: num,
						current: a,
						backFn: function(p) {
							//								console.log("回调函数：" + p);
							fenye(p, b, c, d);
						}
					});
				}
			});
		};

		fenye(1, 10, 0);

		var oIndex = 1;
		$('.info_bottom').click(function() {
				if(oIndex == '1') {
					$('.alertMainCan').css('height', '720px');
					$('.details').css('height', '617px');
					$('.alertMainShen').hide();
					$(this).children('img').addClass('move_top');
					oIndex = 2;
				} else if(oIndex == '2') {
					$('.alertMainCan').css('height', 'auto');
					$('.details').css('height', '294px');
					$('.alertMainShen').show();
					$(this).children('img').removeClass('move_top');
					oIndex = 1;
				}
			})
			//导航页
		$('.leftchose ul li').click(function() {
				//			debugger;
				if($(this).attr('id') == 'li1' && !$(this).hasClass('onActive')) {
					$('#list1').css('display', 'block');
					$('#list2').css('display', 'none');
					$('#list3').css('display', 'none');
					$(this).addClass('onActive');
					$('#li2').removeClass('onActive');
					$('#li3').removeClass('onActive');
					for(var o = 0; o < oRecord.length; o++) {
						var oNode = $('.thisBz')[o];
						var oHeight = $(oNode).css('height');
						$(oNode).prev().css('height', oHeight);
					}
				} else if($(this).attr('id') == 'li2' && !$(this).hasClass('onActive')) {
					$('#list1').css('display', 'none');
					$('#list2').css('display', 'block');
					$('#list3').css('display', 'none');
					$(this).addClass('onActive');
					$('#li1').removeClass('onActive');
					$('#li3').removeClass('onActive');
					for(var o = 0; o < oRecord.length; o++) {
						var oNode = $('.thisBz')[o];
						var oHeight = $(oNode).css('height');
						$(oNode).prev().css('height', oHeight);
					}
				} else if($(this).attr('id') == 'li3' && !$(this).hasClass('onActive')) {
					$('#list1').css('display', 'none');
					$('#list2').css('display', 'none');
					$('#list3').css('display', 'block');
					$(this).addClass('onActive');
					$('#li1').removeClass('onActive');
					$('#li2').removeClass('onActive');
				}
			})
			//点击标题刷新当前页
		$('.mainheader').click(function() {
			location.reload();
		});

		function tanchu() {
			$('.showAlert').click(function() {
				$('.alertBag').show();
				$('.alertInp').show();

				var i = $(this).children('.xhId').text(); //当前选择数据的id
				var o = $(this).index(); //在当前表格中的位置，即第几个数据
				//				debugger;
				$.ajax({
					type: 'post',
					url: '<?php echo site_url("csapi/getDetail/")?>' + i, //发送后台的url 
					dataType: 'json', //后台返回的数据类型
					timeout: 45000, //超时时间
					async: false,
					success: function(data) {

						function thisInfo(val) {
							//							debugger;
							var str1 = '';
							str1 += '<dt>姓名</dt>';
							str1 += '<dd>' + val.xingming + '</dd>';

							str1 += '<dt>手机号</dt>';
							str1 += '<dd>' + val.shoujihao + '</dd>';

							str1 += '<dt>身份证号</dt>';
							str1 += '<dd>' + val.shenfenzheng + '</dd>';

							str1 += '<dt>邮箱</dt>';
							str1 += '<dd>' + val.email + '</dd>';

							str1 += '<dt>学历</dt>';
							str1 += '<dd>' + val.xueli + '</dd>';

							str1 += '<dt>工作单位全名</dt>';
							str1 += '<dd>' + val.gongzuodanwei + '</dd>';

							str1 += '<dt>身份证正面照</dt>';
							str1 += '<dd><a href="<?php echo base_url("uploads/shenfenzheng/")?>' + val.shenfenzheng_img[1] + '"><img src="<?php echo base_url("uploads/shenfenzheng/")?>' + val.shenfenzheng_img[1] + '" /></a></dd>';

							str1 += '<dt>身份证反面照</dt>';
							str1 += '<dd><a href="<?php echo base_url("uploads/shenfenzheng/")?>' + val.shenfenzheng_img[2] + '"><img src="<?php echo base_url("uploads/shenfenzheng/")?>' + val.shenfenzheng_img[2] + '" /></a></dd>';

							str1 += '<dt>工作牌或社保卡</dt>';
							str1 += '<dd><a href="<?php echo base_url("uploads/shenfenzheng/")?>' + val.shenfenzheng_img[3] + '"><img src="<?php echo base_url("uploads/shenfenzheng/")?>' + val.shenfenzheng_img[3] + '" /></a></dd>';
							str1 += '<dt>地理位置</dt>';
							str1 += '<dd><div id="r-result">' + val.dangqianweizhi + '</div><div id="l-map"></div></dd>';

							str1 += '<dt>父亲姓名</dt>';
							str1 += '<dd>' + val.fuqin_xingming + '</dd>';

							str1 += '<dt>手机</dt>';
							str1 += '<dd>' + val.fuqin_shoujihao + '</dd>';

							str1 += '<dt>母亲姓名</dt>';
							str1 += '<dd>' + val.muqin_xingming + '</dd>';

							str1 += '<dt>手机</dt>';
							str1 += '<dd>' + val.muqin_shoujihao + '</dd>';

							str1 += '<dt>老公/老婆/男朋友/女朋友</dt>';
							str1 += '<dd>' + val.peiou_xingming + '</dd>';

							str1 += '<dt>手机</dt>';
							str1 += '<dd>' + val.peiou_shoujihao + '</dd>';

							str1 += '<dt>单位领导</dt>';
							str1 += '<dd>' + val.lingdao_xingming + '</dd>';

							str1 += '<dt>手机</dt>';
							str1 += '<dd>' + val.lingdao_shoujihao + '</dd>';

							str1 += '<dt>朋友姓名</dt>';
							str1 += '<dd>' + val.pengyou_xingming + '</dd>';

							str1 += '<dt>手机</dt>';
							str1 += '<dd>' + val.pengyou_shoujihao + '</dd>';

							document.getElementById('gallery').innerHTML = str1;
							showDitu();
							//图片预览 
							$('#gallery dd a').lightBox();
						}

						function csJilu(val) {
							var oRecord = val.record_list;
							var str2 = '';
							str2 += '<dt style="margin-top:10px;">序号:</dt>';
							str2 += '<dd style="margin-top:10px;">' + val.jk_id + '</dd>';
							str2 += '<dt>催收员:</dt>';
							str2 += '<dd>' + val.kehujingli + '</dd>';
							str2 += '<dt>客户类型:</dt>';
							str2 += '<dd>' + val.kehuleixing + '</dd>';
							str2 += '<dt class="line_top">借款总次数:</dt>';
							str2 += '<dd class="line_top">' + oRecord.length + '</dd>';
							str2 += '<dt>借款总金额:</dt>';
							var allMoney = 0;
							//							debugger
							for(var i = 0; i < oRecord.length; i++) {
								//								debugger;
								allMoney += parseInt(oRecord[i].jine);
							}
							str2 += '<dd>' + allMoney + '</dd>';
							str2 += '<dt>上次借款金额:</dt>';
							str2 += '<dd>' + oRecord[oRecord.length - 1].jine + '</dd>';
							for(var k = 0; k < oRecord.length; k++) {
								var urlImg = '';
								var oImg = '';
								var oType = '';
								if(oRecord[k].status == '3') {
									urlImg = "<?php echo base_url('public/')?>icon/yq.png";
									oImg = '<img src="' + urlImg + '" style="position: relative;top: -7px;left:70px;" width="80" height="80" />';
								} else if(oRecord[k].status == '2') {
									urlImg = "<?php echo base_url('public/')?>icon/hk.png";
									oImg = '<img src="' + urlImg + '" style="position: relative;top: -7px;left:70px;" width="80" height="80" />';
								}
								str2 += '<dt>&nbsp;</dt>';
								str2 += '<dd style="height:18px;">' + oImg + '</dd>';
								str2 += '<dt class="line_top line_left border_radio_left">状态:</dt>';
								if(oRecord[k].status == '0') {
									oType = '逾期中';
								} else if(oRecord[k].status == '1') {
									oType = '承诺还款';
								} else if(oRecord[k].status == '2') {
									oType = '已还款';
								} else if(oRecord[k].status == '3') {
									oType = '延期';
								}
								str2 += '<dd class="line_top line_right border_radio_right font_gy">' + oType + '</dd>';
								str2 += '<dt class="line_left">时间:</dt>';
								str2 += '<dd class="line_right">' + oRecord[k].cnhktime + '</dd>';
								if(oRecord[k].status == '2') {
									str2 += '<dt class="line_left">违约金:</dt>';
									str2 += '<dd class="line_right">' + oRecord[k].weiyuejin + '</dd>';
								}
								str2 += '<dt class="line_left line_bottom border_radio_left_bottom">备注:</dt>';
								str2 += '<dd class="line_right line_bottom border_radio_right_bottom font_gy thisBz">' + oRecord[k].beizhu + '</dd>';
							}

							document.getElementById('list1').innerHTML = str2;
							for(var o = 0; o < oRecord.length; o++) {
								//								debugger;
								var oNode = $('.thisBz')[o];
								var oHeight = $(oNode).css('height');
								$(oNode).prev().css('height', oHeight);
							}
						}

						function jkJilu(val) {
							var oRecord = val.jiekuan_list;
							var str4 = '';
							str4 += '<dt style="margin-top:10px;">序号:</dt>';
							str4 += '<dd style="margin-top:10px;">' + val.id + '</dd>';
							str4 += '<dt>客户经理:</dt>';
							str4 += '<dd>' + val.kehujingli + '</dd>';
							str4 += '<dt>客户类型:</dt>';
							str4 += '<dd>' + val.kehuleixing + '</dd>';
							str4 += '<dt class="line_top">借款总次数:</dt>';
							str4 += '<dd class="line_top">' + oRecord.length + '</dd>';
							str4 += '<dt>借款总金额:</dt>';
							var allMoney = 0;
							//							debugger
							for(var i = 0; i < oRecord.length; i++) {
								//								debugger;
								allMoney += parseInt(oRecord[i].jine);
							}
							str4 += '<dd>' + allMoney + '</dd>';
							str4 += '<dt>上次借款金额:</dt>';
							str4 += '<dd>' + oRecord[oRecord.length - 1].jine + '</dd>';
							for(var k = 0; k < oRecord.length; k++) {
								var urlImg = '';
								var oImg = '';
								if(oRecord[k].status == '2') {
									urlImg = "<?php echo base_url('public/')?>icon/yq.png";
									oImg = '<img src="' + urlImg + '" style="position: relative;top: -7px;left:70px;" width="80" height="80" />';
								} else if(oRecord[k].status == '1') {
									urlImg = "<?php echo base_url('public/')?>icon/hk.png";
									oImg = '<img src="' + urlImg + '" style="position: relative;top: -7px;left:70px;" width="80" height="80" />';
								}
								str4 += '<dt>&nbsp;</dt>';
								str4 += '<dd style="height:18px;">' + oImg + '</dd>';
								str4 += '<dt class="line_top line_left border_radio_left">借款状态:</dt>';
								str4 += '<dd class="line_top line_right border_radio_right font_gy">' + oRecord[k].zhuangtai + '</dd>';
								str4 += '<dt class="line_left">借款日:</dt>';
								str4 += '<dd class="line_right">' + oRecord[k].jiekuanri + '</dd>';
								str4 += '<dt class="line_left">合同还款日:</dt>';
								str4 += '<dd class="line_right">' + oRecord[k].huankuanri + '</dd>';
								str4 += '<dt class="line_left">实际还款日:</dt>';
								str4 += '<dd class="line_right">' + oRecord[k].shijihuankuanri + '</dd>';
								str4 += '<dt class="line_left">金额:</dt>';
								str4 += '<dd class="line_right font_gy">' + oRecord[k].jine + '</dd>';
								str4 += '<dt class="line_left line_bottom border_radio_left_bottom">备注:</dt>';
								str4 += '<dd class="line_right line_bottom border_radio_right_bottom thisBz">' + oRecord[k].beizhu + '</dd>';
							}

							document.getElementById('list2').innerHTML = str4;

						}
						//提交
						function sbmBt(data) {
							$('.sbmBtn').unbind('click').click(function() {
								var Id = data.jk_id;
								var val = $('.xgzt').val();
								if(val == '1') {
									//逾期中
								} else if(val == '2') {
									//承诺还款
									$.ajax({
										type: 'post',
										url: '<?php echo site_url("csapi/addChengnuo?jk_id=")?>' + Id + '&', //发送后台的url 
										data: $('#chengnuo_form').serialize(),
										dataType: 'json', //后台返回的数据类型
										timeout: 45000, //超时时间
										async: false,
										success: function(data) { //data为后台返回的数		
											//												debugger;			
											if(data.status == '0') {
												alert(data.message);
											} else {
												$('.alertBag').hide();
												$('.alertInp').hide();
												$('#o' + Id).parent().hide();
											}
										}
									});
								} else if(val == '3') {
									//已还款
									$.ajax({
										type: 'post',
										url: '<?php echo site_url("csapi/addHuankuan?jk_id=")?>' + Id + '&', //发送后台的url 
										data: $('#yihuankuan_form').serialize(),
										dataType: 'json', //后台返回的数据类型
										timeout: 45000, //超时时间
										async: false,
										success: function(data) { //data为后台返回的数		
											//												debugger;			
											if(data.status == '0') {
												alert(data.message);
											} else {
												$('.alertBag').hide();
												$('.alertInp').hide();
												$('#o' + Id).parent().hide();
											}
										}
									});
								} else if(val == '4') {
									//延期
									$.ajax({
										type: 'post',
										url: '<?php echo site_url("csapi/addYanqi?jk_id=")?>' + Id + '&', //发送后台的url 
										data: $('#yanqi_form').serialize(),
										dataType: 'json', //后台返回的数据类型
										timeout: 45000, //超时时间
										async: false,
										success: function(data) { //data为后台返回的数		
											//												debugger;			
											if(data.status == '0') {
												alert(data.message);
											} else {
												$('.alertBag').hide();
												$('.alertInp').hide();
												$('#o' + Id).parent().hide();
											}
										}
									});
								}
							})
						}
						thisInfo(data);
						csJilu(data);
						jkJilu(data);
						sbmBt(data);
						var str3 = '';
						var oNum = parseInt(o) + 1;
						var oLength = $('table tr.showAlert').length;
						str3 += '<span class="" id="nowPage">' + oNum + '</span>';
						str3 += '<span class="">/</span>';
						str3 += '<span class="">' + oLength + '</span>';
						document.getElementById('FotLine').innerHTML = str3;

						//弹出层向左翻页
						$('.btnLeft').click(function() {
							var k = o - 1;
							if(k <= 0) {
								k = 0;
								//							alert(11)
							}
							var l = k;
							var kId = $('table tr.showAlert:eq(' + l + ')').children()[0].id;
							var oId = kId.split('o');
							//						debugger;
							var str2 = '';
							var str3 = '';
							$.ajax({
								type: 'post',
								url: '<?php echo site_url("csapi/getDetail/")?>' + oId[1], //发送后台的url 
								dataType: 'json', //后台返回的数据类型
								timeout: 45000, //超时时间
								async: false,
								success: function(data) { //data为后台返回的数据
									//								debugger;
									thisInfo(data);
									csJilu(data);
									jkJilu(data);
									document.getElementById('nowPage').innerHTML = l + 1;
									o = l;
								},
								error: function(data) {

								}
							});
						});
						//弹出层向右翻页
						$('.btnright').click(function() {
							var k = o + 1;

							if(k >= oLength) {
								k = oLength
							}
							var l = k;
							var kId = $('table tr.showAlert:eq(' + l + ')').children()[0].id;
							var oId = kId.split('o');
							//						debugger;
							var str2 = '';
							var str3 = '';
							$.ajax({
								type: 'post',
								url: '<?php echo site_url("csapi/getDetail/")?>' + oId[1], //发送后台的url 
								dataType: 'json', //后台返回的数据类型
								timeout: 45000, //超时时间
								async: false,
								success: function(data) { //data为后台返回的数据
									//								debugger;
									thisInfo(data);
									csJilu(data);
									jkJilu(data);
									document.getElementById('nowPage').innerHTML = l + 1;
									o = l;
								},
								error: function(data) {

								}
							});
						});

					}
				})
			})
		}
		var index = 1;
		$('.lcList_xia').click(function() {
			if(index == '1') {
				$('.lcList').css('height', '660px');
				$('.TypeOpe').hide();
				$(this).children('img').addClass('move_top');
				index = 2;
			} else if(index == '2') {
				$('.lcList').css('height', '300px');
				$('.TypeOpe').show();
				$(this).children('img').removeClass('move_top');
				index = 1;
			}
		})
		$('.close').click(function() {
			$('.alertBag').hide();
			$('.alertInp').hide();
			$('#list1').show();
			$('#list2').hide();
			$('#list3').hide();
			if(!$('#li1').hasClass('onActive')) {

				$('#li1').addClass('onActive');
				$('#li2').removeClass('onActive');
				$('#li3').removeClass('onActive');
			} else if(!$('#li2').hasClass('onActive')) {

				$('#li2').addClass('onActive');
				$('#li1').removeClass('onActive');
				$('#li3').removeClass('onActive');
			} else if(!$('#li3').hasClass('onActive')) {

				$('#li3').addClass('onActive');
				$('#li1').removeClass('onActive');
				$('#li2').removeClass('onActive');
			}
		})

		$('.xgzt').change(function() {
				var i = $(this).val();
				if(i == 2) {
					$('#yuqizhong').hide();
					$('#chengnuo').show();
					$('#yihuankuan').hide();
					$('#yanqi').hide();
				} else if(i == 3) {
					$('#yuqizhong').hide();
					$('#chengnuo').hide();
					$('#yihuankuan').show();
					$('#yanqi').hide();
					var mydate = new Date();
					var year = mydate.getFullYear();
					var month = mydate.getMonth() + 1;
					var date1 = mydate.getDate();
					//					$('#shij').html("还款时间");
					$('#shij2_2').val(year + '-' + month + '-' + date1);

				} else if(i == 4) {
					$('#yuqizhong').hide();
					$('#chengnuo').hide();
					$('#yihuankuan').hide();
					$('#yanqi').show();

					$('#yqTime').val(28);
					var date = new Date();
					var year = date.getFullYear();
					var month = date.getMonth() + 1;
					var date1 = date.getDate();
					var iTime = year + "-" + month + "-" + date1;
					var oTime = $('#yqTime').val();
					var iTime1 = showTime(parseInt(oTime), iTime);
					$('#newData').val(iTime);
					$('#newData2').val(iTime1);
					$('#yqTime').change(function() {
						var oTime = $(this).val();

						var timestamp = Date.parse(new Date());
						timestamp = timestamp / 1000;
						timestamp = timestamp + oTime * 24 * 60 * 60;
						//						debugger;
						var thisTime = new Date(timestamp * 1000);
						var year = thisTime.getFullYear();
						var month = thisTime.getMonth() + 1;
						var date1 = thisTime.getDate();
						if(month < 10) {
							month = '0' + month;
						}
						var oTime = year + "-" + month + "-" + date1;
						$('#newData2').val(oTime);
					})
				} else {
					$('#yuqizhong').show();
					$('#chengnuo').hide();
					$('#yihuankuan').hide();
					$('#yanqi').hide();
				}
			})
			// 百度地图API功能
		function showDitu() {
			function G(id) {
				return document.getElementById(id);
			}
			var map = new BMap.Map("l-map");
			map.centerAndZoom("北京", 12);
			map.centerAndZoom(new BMap.Point());

			function setPlace() {
				map.clearOverlays();

				var myValue = $('#r-result').text();

				function myFun() {
					var pp = local.getResults().getPoi(0).point;
					map.centerAndZoom(pp, 18);
					map.addOverlay(new BMap.Marker(pp));
					map.enableScrollWheelZoom(true);
				}
				var local = new BMap.LocalSearch(map, {
					onSearchComplete: myFun
				});
				local.search(myValue)
			}
			setPlace()
		}

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
	</script>

</html>