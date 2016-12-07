<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/houtai2/css/bootstrap.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/houtai2/css/bootstrap-theme.css') ?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/houtai2/css/shenhe_style.css') ?>" />
		<link rel="stylesheet" href="<?php echo asset('assets/houtai2/css/manager.css') ?>" />
		<script src="<?php echo asset('assets/houtai2/js/jquery-1.9.1.min.js') ?>" type="text/javascript" charset="utf-8"></script>
		<script src="<?php echo asset('assets/houtai2/js/bootstrap.js') ?>" type="text/javascript" charset="utf-8"></script>
		<title></title>
	</head>

	<body style="overflow:-Scroll;overflow-x:hidden;">
		<!--
    	作者：522752726@qq.com
    	时间：2016-11-16
    	描述：分配相关权限的点击弹出层
    -->
		<div class="tanchu-zhezhao" style="display: none;">
			<div class="tanchu-mg">
				<div class="tanchu-bd" style="padding-top: 2.5vw;">
					<div class="input-group" style="margin-top: 0.3vw;">
						<span class="input-group-addon">姓&nbsp;&nbsp;名&nbsp; </span>
						<input type="text" class="form-control" placeholder="">
					</div>
					<div class="input-group" style="margin-top: 0.3vw;">
						<span class="input-group-addon">性&nbsp;&nbsp;别&nbsp;</span>
						<input type="text" class="form-control" placeholder="">
					</div>
					<div class="input-group" style="margin-top: 0.3vw;">
						<span class="input-group-addon" style="    padding: 4px 11px;">手机号</span>
						<input type="text" class="form-control" placeholder="">
					</div>
					<div class="input-group" style="margin-top: 0.3vw;">
						<span class="input-group-addon">权&nbsp;&nbsp;限&nbsp; </span>
						<select type="text" class="form-control" placeholder="">
							<option value="">审核员</option>
							<option value="">放款员</option>
							<option value="">催收员</option>
							<option value="">自定义</option>
						</select>
					</div>
					<div class="btn-group">
						<button type="button" id="btn-tj" class="btn btn-default" style="  margin-right: 2vw;  font-size: 17px;
    margin-top: 2vw;
    background: #5cb85c;
    border-color: #4cae4c;
    color: #fff;
    padding: 3px 30px;">确认</button>

						<button id="btn-qx" type="button" class="btn btn-default" style="    font-size: 17px;
    margin-top: 2vw;
    background: #d9534f;
    border-color: #d43f3a;
    color: #fff;
    padding: 3px 30px;">取消</button>
					</div>

				</div>
			</div>
		</div>
		<!--弹出层结束-->

		<div class="header">
			<span class="topLeft">管理员</span>
			<ul class="topRight">
				<li>
					<img src="<?php echo asset('assets/houtai2/img/email.png') ?>" width="50" class="email" />
					<p>消息通知</p>
				</li>
				<li>
					<div class="touxiang"></div>
					<p>头像</p>
				</li>
				<li><span>退出</span></li>
			</ul>
		</div>
		<div class="main">
			<!--
        	作者：522752726@qq.com
        	时间：2016-11-21
        	描述：头部的数据展示
        -->
			<ul class="main_top">
				<li id="sq">申请人数: <span></span></li>
				<li id="zkh">总客户数: <span></span></li>
				<li id="ls-fkzr">历史放款总人数: <span></span></li>
				<li id="ls-fkzj">历史放款总金额: <span></span></li>
				<li id="yq">平均逾期率: <span></span></li>
			</ul>
			<div class="search">
				<div class="">
					<div class="inputType">
						<div class="input-group">
							<div class="input-group-btn">
								<button type="button" class="btn btn-default dropdown-toggle border-color border-right" data-toggle="dropdown">搜索 <span class="caret"></span></button>
								<ul class="dropdown-menu" role="menu">
	
									<li>
										<a href="#">姓名</a>
									</li>
									<li>
										<a href="#">手机号</a>
									</li>
									<li>
										<a href="#">身份证</a>
									</li>
								</ul>
							</div>
							<input type="text" class="form-control border-color">
						</div>

					</div>
				</div>

			</div>

			<div class="list-left">
				<ul>
					<li class="current">
						总客户
					</li>

					<li id="fenpei">
						分配相关权限
					</li>

					<li id="tubiao">
						统计分析
					</li>

					<li>
						对账
					</li>

					<li>
						佣金对账
					</li>

				</ul>

			</div>

			<div class="left-select">
				<div class="dropdown">
<button style="padding:3px 11px !important" class="btn btn-default dropdown-toggle" type="button" id="drop-manager" data-toggle="dropdown">管理员<span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="drop-manager" id="manager">
						<li role="presentation">
							<a role="menuitem" tabindex="-1">管理员1</a>
						</li>

					</ul>
				</div>
				<div class="dropdown">
					<button style="padding:3px 11px !important" class="btn btn-default dropdown-toggle" type="button" id="drop-year" data-toggle="dropdown">年份<span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="drop-manager" id="year">
						<li role="presentation">
							<a role="menuitem" tabindex="-1">2016</a>
						</li>
					</ul>
				</div>
				<div class="dropdown">
					<button style="padding:3px 11px !important" class="btn btn-default dropdown-toggle" type="button" id="drop-month" data-toggle="dropdown">月份<span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu" aria-labelledby="drop-manager" id="month">
						<li role="presentation">
							<a role="menuitem" tabindex="-1">1月</a>
						</li>
						<li role="presentation">
							<a role="menuitem" tabindex="-1">2月</a>
						</li>
						<li role="presentation">
							<a role="menuitem" tabindex="-1">3月</a>
						</li>
						<li role="presentation">
							<a role="menuitem" tabindex="-1">4月</a>
						</li>
						<li role="presentation">
							<a role="menuitem" tabindex="-1">5月</a>
						</li>
						<li role="presentation">
							<a role="menuitem" tabindex="-1">6月</a>
						</li>
						<li role="presentation">
							<a role="menuitem" tabindex="-1">7月</a>
						</li>
						<li role="presentation">
							<a role="menuitem" tabindex="-1">8月</a>
						</li>
						<li role="presentation">
							<a role="menuitem" tabindex="-1">9月</a>
						</li>
						<li role="presentation">
							<a role="menuitem" tabindex="-1">10月</a>
						</li>
						<li role="presentation">
							<a role="menuitem" tabindex="-1">11月</a>
						</li>
						<li role="presentation">
							<a role="menuitem" tabindex="-1">12月</a>
						</li>
					</ul>
				</div>
			</div>
			<button id="add-mg" class="btn bgBtn" style="display: none;">添加管理员</button>
			<div class="oTable table-responsive">
				<div id="biaoge">

					<div class="col-lg-1 color-e6 all_num">
						总量
					</div>
					<table id="yongjin" border="" cellspacing="" cellpadding="" class="table table-bordered">
						<tr>
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
							<td class="color-e6"><img src="<?php echo asset('assets/houtai2/img/zhima.png') ?>" />
								<img src="<?php echo asset('assets/houtai2/img/family.png') ?>" />
								<img src="<?php echo asset('assets/houtai2/img/taobao.png') ?>" />
								<img src="<?php echo asset('assets/houtai2/img/jingdong.png') ?>" /></td>
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
						</tr>
					</table>
				</div>

			</div>

			<div class="tubiao-box">
				<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto;"></div>
			</div>

		</div>

	</body>
	<script src="<?php echo asset('assets/houtai2/js/highcharts.js') ?>"></script>
	<script src="<?php echo asset('assets/houtai2/js/exporting.js') ?>"></script>

	<script type="text/javascript">
		window.onload = function() {

			$.ajax({ //表头数据拉取
				type: 'post',
				url: "http://test.pgyxwd.com/testing",
				dataType: 'json',
				async: true,
				success: function(result) {
					$('#sq span').html();
					$('#zkh span').html();
					$('#ls-fkzr span').html();
					$('#ls-fkzj span').html();
					$('#yq span').html();
					
				},
				error: function(result) {}
			})

		}


$('.dropdown-menu li a').click(function(){
      var selectType = $(this).html() + '&nbsp;<span class="caret"></span>';
      $(this).parent().parent().prev().html(selectType);
    })



		$('#yongjin tr').click(function() {
			window.open('tuijian.html');
		})
		$('#fenpei').click(function() {
			$('#add-mg').show();
		})
		$('#fenpei').siblings().click(function() {
			$('#add-mg').hide();
		})

		$('#add-mg').click(function() {
			$('.tanchu-zhezhao').css('display', 'block');
		})
		$('#btn-qx').click(function() {
			$('.tanchu-zhezhao').css('display', 'none');

		})
		$('#tubiao').click(function() {
			$('#container').show();
			$('#biaoge').hide();
			$('.left-select').show();
			dotubiao();
		})
		$('#tubiao').siblings().click(function() {
			$('.left-select').hide();
			$('#container').hide();
			$('#biaoge').show();
		})
		$(".list-left li").click(function() {
			$('.list-left li').not(this).removeClass('current');
			$(this).addClass('current');
		})

		function dotubiao() {
		//	$.ajax({ //拿管理员
//				type: 'post',
//				url: "http://test.pgyxwd.com/testing",
//				dataType: 'json',
//				async: true,
				//			                data:{
				//			                	
				//			                },
				//							headers: {
				//									'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				//									},
				//							success: function(result) {
				//											var list = result.guanliyuan;
				//											var optionstring = "";
				//											for(var j = 0; j < list.length; j++) {
				//											optionstring += "<a role="menuitem" tabindex="-1">" + list[j].username + "</a>";
				//											}
				//				    						$("#manager").html("<li role='presentation'> " + optionstring + "</li>");
				//			          					$("#manager").val('admin'); 
				//								debugger;
				//							},

//				error: function(result) {}
		//	})
		
		
		
		}
		
		
		
		
		
		$('#year li a').click(function(){
                  selectajax();
			})

			$('#month li a').click(function(){
				 selectajax();
			})

			$('#manager li a').click(function(){
      			  selectajax();
			})

function selectajax(){
			    var year = $('#drop-year').text();
				var manager = $('#drop-manager').text();
				var month = $('#drop-month').text();
			  $.ajax({
			  	type:"post",
			  	url:"",
			  	dataType: 'json',
			  	async:true,
			  	data:{
			  		"month":month,
			  		"year":year,
			  		"manager":manager
			  	},
			  	success:function(){
			  		if($('#month').text()=='月份'){
			  					var yueArr = new Array();
								var renArr = new Array();
								var jineArr = new Array();
								var zongrenshuArr = new Array();
								var yuqiArr = new Array();
								for(var i = 0; i < 12; i++) {
									renArr[i] = result.ren[i];
									yueArr[i] = result.yue[i];
									jineArr[i] = result.jine[i];
									zongrenshuArr[i] = result.zongrenshu[i];
									yuqiArr[i] = resule.yuqi[i];
								}
								biao1(renArr,yueArr,jineArr,zongrenshuArr,yuqiArr);
							}else{
								var riArr = new Array();
								var renArr = new Array();
								var jineArr = new Array();
								var zongrenshuArr = new Array();
								var yuqiArr = new Array();
								for(var i = 0; i < 31; i++) {
									renArr[i] = result.ren[i];
									riArr[i] = result.ri[i];
									jineArr[i] = result.jine[i];      
									zongrenshuArr[i] = result.zongrenshu[i];
									yuqiArr[i] = resule.yuqi[i];
								}
								biao1(renArr,riArr,jineArr,zongrenshuArr,yuqiArr);
							}
							
			  	},
			  	error:function(){}
			  })
	
	
}


		
		
		
		
		function biao1(a,b,c,d,e){
			
			$('#container').highcharts({
				chart: {
					type: 'column'
				},
				title: {
					text: '统计图表'
				},
				subtitle: {
					text: ''
				},
				xAxis: {
					categories:b,
					crosshair: true
				},
				yAxis: {
					min: 0,
					title: {
						text: ''
					}
				},
				tooltip: {
					headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
					pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
						'<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
					footerFormat: '</table>',
					shared: true,
					useHTML: true
				},
				plotOptions: {
					column: {
						pointPadding: 0.2,
						borderWidth: 0
					}
				},
				series: [{
						name: '人数（人）',
						color: '#6d0',
						data: a

					}, {
						name: '金额（万元）',
						data:c

					}, {

						name: '逾期率(%)',
						color: '#99f',
						data: e
					},
					{

						name: '申请人数(人)',
						color: '#fa3',
						data: d
					}

				]
			});
			
			
		}
			
	</script>

</html>