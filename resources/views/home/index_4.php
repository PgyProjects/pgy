<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
				<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/weixin/css/antd.min.css') ?>" /> 
		<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/weixin/css/style.css') ?>" />
	<script type="text/javascript" src="<?php echo asset('assets/weixin/js/jquery-1.9.1.min.js') ?>"></script>
				

		<link rel="stylesheet" type="text/css" href="<?php echo asset('assets/weixin/css/information.css') ?>" />
		<title>推荐</title>
		<style>
	.ant-spin-dot:after, .ant-spin-dot:before {
    content: '';
    border-radius: 50%;
    background-color: #2db7f5;
    -webkit-animation: antSpinBounce 2.2s infinite ease-in-out;
    animation: antSpinBounce 2.2s infinite ease-in-out;
    display: block;
    position: absolute;
    opacity: .5;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
}

.load{
	background: #fff;
	    width: 70vw;
    height: 35vw;
    border-radius: 15px;
    border: 1px solid #ccc;
    margin: auto;
}
.zhezhao{
	
	    position: absolute;
    top: 70vw;
	width: 100%;
	text-align: center;
}
</style>
	</head>
	<body style="font-family: '微软雅黑';">
	<div class="main" id="main">
		<div class="head-2">
          	<img src="<?php echo asset('assets/weixin/img/back-1.png') ?>" alt="" />
          	<div class="da-yuan"><img src="<?php echo asset('assets/weixin/img/boy.png') ?>" alt="" /></div>
          	<div class="xiao-yuan"><img src="<?php echo asset('assets/weixin/img/girl.png') ?>" alt="" /></div>     	
          </div>
          
          <div class="erweima"></div>
          <!--<p style="position: relative;top: 54vw;font-size: 5vw;text-align: center;">推广链接:
          <span style="border-radius: 11px;padding: 4px 8px;background: #9a99ff;color: #fff;background: #9a99f;font-size: 4vw;">复制链接</span></p>-->
          
          
    <!--  <a href="<?php echo asset('home/index_4_tj_info')?>">-->  <div class="click-tj">推荐客户详情</div><!--</a>  -->

	</div>
				
			<div class="footer" id="footer">
			<ul>
				<a href="<?php echo asset('home') ?>"><li>
					<img src="../assets/weixin/img/sy_white.png" />
				</li></a>
				<a href="<?php echo asset('home/index_2') ?>"><li>
					<img src="../assets/weixin/img/te_white.png" />
				</li></a>
				<a href="<?php echo asset('home/index_3') ?>"><li>
					<img src="../assets/weixin/img/jl_white.png" />
				</li></a>
				<a href="<?php echo asset('home/index_4') ?>"><li>
					<img src="../assets/weixin/img/tj_purple.png" />
				</li></a>
			</ul>
		</div>
		
		
		<div class="zhezhao">
	<div class="load">
		<span class="ant-spin-dot" style="width:10vw; height: 10vw;margin-top:8vw;margin-left: 11vw;float: left;"></span>
		<span style="text-align: left; float: right;width: 42vw;height: 10vw;margin-top: 10vw;font-size: 4vw;">开发中,敬请期待...</span>
		<p id="queren1" style="margin-left: 27vw;font-size: 4vw;position: absolute;top: 25vw;width: 17vw;height: 6vw;background: #2db7f5;color: #fff;border-radius: 5px;line-height: 6.5vw;">确认</p>
	</div>
	</div>

	</body>
		<script type="text/javascript">
		/*中间内容高度*/
		var srceenHeight = window.screen.height;
		var fHeght = document.getElementById('footer').offsetHeight;
		document.getElementById('main').style.height = srceenHeight - fHeght + 2 + 'px';


		$('.click-tj').click(function(){
          $('.zhezhao').css('display','block');


		})
		$('#queren1').click(function(){
			
			 $('.zhezhao').css('display','none');
			
		})
		
	</script>

</html>
