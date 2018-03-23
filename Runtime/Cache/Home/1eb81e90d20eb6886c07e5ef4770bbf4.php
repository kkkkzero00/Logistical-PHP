<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-COMPATIBLE">
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<title>快递</title>
	<link rel="stylesheet" href="/framework/gitTest/Logistical-PHP/Public/assets/global/plugins/bootstrap/css/bootstrap.min.css" type="text/css">
	<link rel="shortcut icon" type="image/x-icon" href="/framework/gitTest/Logistical-PHP/Public/assets/global/img/public/logo.png" media="screen" />
<link rel="stylesheet" href="/framework/gitTest/Logistical-PHP/Public/assets/global/styles/frameset/frameset.css" type="text/css">
<link rel="stylesheet" href="/framework/gitTest/Logistical-PHP/Public/assets/global/styles/frameset/iconfont.css" type="text/css">
	
  <link rel="stylesheet" type="text/css" href="/framework/gitTest/Logistical-PHP/Public/assets/global/styles/tongcheng/tongcheng.css"/>

	<script>
		var _hmt = _hmt || [];
		(function() {
		  var hm = document.createElement("script");
		  hm.src = "https://hm.baidu.com/hm.js?d23716d82de1864f9475cf08a2a59734";
		  var s = document.getElementsByTagName("script")[0]; 
		  s.parentNode.insertBefore(hm, s);
		})();
	</script>



</head>
<body>

		<div class="header">
			
			<nav class="navbar navbar-default" role="navigation" style="">
				<div class="container">
					<div class="navbar-header">
						<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-responsive-collapse">
				         <span class="sr-only"></span>
				         <span class="icon-bar"></span>
				         <span class="icon-bar"></span>
				         <span class="icon-bar"></span>
				       </button>
		       <!-- 确保无论是宽屏还是窄屏，navbar-brand都显示 -->
		       <a href="##" class="navbar-brand"></a>
					</div>

					<div class="collapse navbar-collapse navbar-responsive-collapse" id="bs-example-navbar-collapse-1" >
						<ul class="nav navbar-nav" style="width: 100%;padding-left: 50px">
							<li class="dropdown"><a href="<?php echo U('Index/index');?>" style="color: white;"><span class="iconfont" style="font-size: 55px;">&#xe65b;</span></a></li>
							<?php if(is_array($nav)): foreach($nav as $k=>$vo): ?><li class="dropdown" >
			                		<?php if($k == 0): ?><a href="<?php echo U('Index/order');?>" style="color: white;opacity:1;"><?php echo ($vo['name']); ?></a><?php endif; ?>
									<?php if($k == 1): ?><a href="<?php echo U('Index/search');?>" style="color: white;opacity:1;"><?php echo ($vo['name']); ?></a><?php endif; ?>
			      					<?php if($k == 2): ?><a href="<?php echo U('Index/join');?>" style="color: white;opacity:1;"><?php echo ($vo['name']); ?></a><?php endif; ?>
									<?php if($k == 3): ?><a href="<?php echo U('Index/addr');?>" style="color: white;opacity:1;"><?php echo ($vo['name']); ?></a><?php endif; ?>
			                	</li><?php endforeach; endif; ?>

		                   	<li class="dropdown log">
		                   	<a href="<?php echo U('Index/tongcheng');?>" style="color: white;">同城速递</a>
		                   	</li>
		                   	<?php if(isset($_SESSION['name']) ): ?><li class="dropdown log" style="float: right;">
		                   	<a href="<?php echo U('Index/logout');?>" style="color: white;">注销</a>
		                   	</li>
		                   
							<li class="dropdown log" style="float: right;">
							<a href="<?php echo U('Index/userinfo',array('id'=>$_SESSION['id']));?>" style="color: white;"><?php echo ($_SESSION['name']); ?></a>
							</li>    
							<li class="dropdown log" style="float: right;">
							<a href="<?php echo U('Index/userinfo',array('id'=>$_SESSION['id']));?>" style="color: white;"><i class="iconfont" style="font-size: 40px;">&#xe601;</i></a></li>
							<?php else: ?>

							<li class="dropdown log" style="float: right;">
							<a href="<?php echo U('Index/register');?>" style="color: white;">注册</a></li>
								
							<li class="dropdown log" style="float: right;"><a href="<?php echo U('Index/login');?>" style="color: white;">登录</a></li>
							<li class="dropdown log" style="float: right;"><a href="<?php echo U('Index/login');?>" style="color: white;"><i class="iconfont" style="font-size: 40px;">&#xe601;</i></a></li><?php endif; ?>
		                   	
							
						</ul>					
					</div>
				</div>
			</nav>
		</div>	




	
	<div id="main">
		
	<div class="container">
		<div class="row">
			<div class="col-md-12" style="padding: 0;">
				<div class="centerimgbox">
					<div class="centerimg"><img class="img-responsive" src="/framework/gitTest/Logistical-PHP/Public/assets/global/img/bg/loginbg.jpg" "></div>
					<div class="center_container">
						<h1>同城速递1小时到达，300万配送员为您服务</h1>
						<h3>帮取件，代送件，随时下单，立刻上门</h3>
						<a href="<?php echo U('index/citysend');?>"><button type="button" class="btn btn-info btn-lg">立即下单</button></a>
					</div>
				</div>
			</div>
		</div>
	</div>



	</div>

	<footer id="footer">
		
		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<ul class="link">
						<li>公司地址：江西省南昌市东湖区证券街紫金城红郡-西4门</li>
						<li>邮政编码：130500</li>
						<li>昊迅快递有限公司</li>
						<li>Copyright 2017 Inc.All right reserved</li>
					</ul>
				</div>
				<div class="col-md-4">
				<div class="linkus">
					<div>关注我们</div>
					<div style="margin-top: 5px;">
						<img src="/framework/gitTest/Logistical-PHP/Public/assets/global/img/index/weixin.jpg" alt="微信" style="margin-right:5px ">
						
					</div>
				</div>
					
				</div>
				<div class="col-md-4">
					<div class="linkphone">
						<div>全国服务热线</div>
					<div style="font-size: 2em;"> 0791-86862855</div>
					</div>
					
				</div>
			</div>
		</div>
	</footer>
</body>
<script src="/framework/gitTest/Logistical-PHP/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/framework/gitTest/Logistical-PHP/Public/assets/global/scripts/jquery.cookie.js" type="text/javascript"></script>
<script src="/framework/gitTest/Logistical-PHP/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


	




</html>