<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" href="<?php echo base_url('public/')?>css/css.css">
	<script type="text/javascript" src="<?php echo base_url('public/')?>js/jquery-1.9.1.min.js"></script>

<style>

.xiaoguo{

      width: 100%;
    height: 100%;
    border-radius: 50%;
   box-shadow: 0px 0px 40px 5px rgba(0, 0, 0, 0.8);
    background: rgba(0,0,0,0.5);
}

</style>
</head>
<body>
<div class="head">
	<span><?php echo $xingming?></span><span>审核中</span>


</div>
<!-- <div class="shenhe">
<p style="text-align:center;">ID</p>
<p style="text-align:center;">审核状态</p>
<p style="text-align:center;">请点击以下图标进行基本信息填写</p>
</div> -->
	<div class="a1">
	   <ul>
	   <li>
	     <div class="xiaoguo" id="xiaoguo">
	   		
	   			<img src="<?php echo base_url('public/')?>icon/<?php echo $user?>">
	   			<!-- <a><img id="user" src="<?php echo base_url('public/')?>icon/yidong.png" alt=""></a> -->
	   		</div>	
	   		</li>








	   		<li style="display:none;">
	   			<!-- <a><img id="yys" src="<?php echo base_url('public/')?>icon/<?php echo $yys_ico?>" alt=""></a> -->
	   		</li>
	   	<li style="display:none;">
	   		<a href="tbrz.php"><img src="<?php echo base_url('public/')?>icon/1.png" alt=""></a>
	   	</li>
	   	<li style="display:none;">
	   		<a href="jdrz.php"><img src="<?php echo base_url('public/')?>icon/2.png" alt=""></a>
	   		</li>
	   		<li style="display:none;">
	   			<a href=""><img src="<?php echo base_url('public/')?>icon/3.png" alt=""></a>
	   		</li>
	   		
	   	
	   </ul>	
	</div>



		<script type="text/javascript">
    var xiaoguo=document.getElementById("xiaoguo");

xiaoguo.addEventListener('touchstart', function(event) { 



$("#xiaoguo").css("box-shadow","0px 0px 40px 5px rgba(0, 0, 0, 0.0)");
})

xiaoguo.addEventListener('touchend', function(event) { 



$("#xiaoguo").css("box-shadow","0px 0px 40px 5px rgba(0, 0, 0, 0.8)");
})
	</script>	
</body>

</html>