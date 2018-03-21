<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-COMPATIBLE">
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<title>快递</title>
	<link rel="stylesheet" href="/framework/gitTest/haoxun/Public/assets/global/plugins/bootstrap/css/bootstrap.min.css" type="text/css">
	<link rel="shortcut icon" type="image/x-icon" href="/framework/gitTest/haoxun/Public/assets/global/img/public/logo.png" media="screen" />
<link rel="stylesheet" href="/framework/gitTest/haoxun/Public/assets/global/styles/frameset/frameset.css" type="text/css">
<link rel="stylesheet" href="/framework/gitTest/haoxun/Public/assets/global/styles/frameset/iconfont.css" type="text/css">
	
    <link href="/framework/gitTest/haoxun/Public/assets/global/styles/order/order.css" rel="stylesheet" type="text/css">
    <link href="/framework/gitTest/haoxun/Public/assets/global/styles/thinginfo/thinginfo.css" rel="stylesheet" type="text/css">
    <style type="text/css">
    	.payattention{
    		color: red;
    	}
    </style>
   <script type="text/javascript" src="/framework/gitTest/haoxun/Public/assets/global/plugins/jquery.min.js"></script>

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
		
    <div class="containers" style="margin: 0;padding: 0">
	<div class="row" style="margin: 0;padding: 0">
		<div class="col-md-12" style="margin: 0;padding: 0">
			<div  class="index-center">
				<div class="index-center-img"><img src="/framework/gitTest/haoxun/Public/assets/global/img/category/nav.jpg" alt="" style="width: 100%;height: 100%;"></div>
				
			</div>
		</div>
	</div>
</div>		
	
<div class="container">
	<div class="row">
		<div class="containerbox">
			<div class="leftbox col-md-3 col-sm-12">
			<center>
			<div class="leftboxcon">
					<div class="user">
				<div class="userimg"><img src="/framework/gitTest/haoxun/Public/UploadFile<?php echo ($user); ?>"  alt=""></div>
				<div class="username"><?php echo ($_SESSION['name']); ?></div>
			</div>
			<div class="order">
				<div class="ordertitle"><span class="iconfont" style="font-size: 30px;">&#xe735;</span><span class="ordertitle-title">订单中心</span></div>
				<div class="orderlist">
					<ul>
						<li><a href="<?php echo U('index/thinginfo',array('id'=>$_SESSION['id'],'p'=>1));?>">普通订单</a></li>
						<li><a href="<?php echo U('index/citysendorder',array('id'=>$_SESSION['id'],'p'=>1));?>">同城速运订单</a></li>
					</ul>
				</div>
			</div>
			<div class="userinfo">
				<div class="userinfotitle"><span class="iconfont" style="font-size: 30px;">&#xe601;</span><span class="userinfotitle-title">个人中心</span></div>
				<div class="userinfolist">
					<ul>
						<li><a href="<?php echo U('index/userinfo',array('id'=>$_SESSION['id']));?>">我的个人中心</a></li>
            <li><a href="<?php echo U('index/manageaddr');?>">管理默认收货地址</a></li>
					</ul>
				</div>
			</div>
			</div>
		</center>
		</div>


	<div class="rightbox col-md-9 col-sm-12">
			<div class="rightcontainer">
				<div class="rightcontainer-title" >
				<span class="iconfont" style="font-size: 30px;">&#xe649;</span><span>我的订单</span>
				</div>
				<div class="rightcontain-container">
				<?php if(is_array($thinginfo)): $i = 0; $__LIST__ = $thinginfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$thing): $mod = ($i % 2 );++$i;?><table class="table-bordered table" style="table-layout: fixed;">
						
						<tr>
							<td colspan="4" style="padding:10px 0;"><span style="padding-left: 15px;color: #7f7d7d;">订单号：</span><span style="font-weight: 800"><?php echo ($thing['courier_number']); ?></span><span style="padding-left: 60px;color: #7f7d7d">下单时间：</span><span style="font-weight: 800"><?php echo (date('Y-m-d H:i:s',$thing['create_time'])); ?></span></td>
						</tr>
						<tr style="text-align: center;">
							<td>快递公司</td>
							<td>订单状态</td>
							<td>支付金额</td>
							<td>操作</td>
						</tr>
						<tr>
							<td>
							<div class="express" style="margin: 5px auto;text-align: center;">
							<!-- 	<img src="/framework/gitTest/haoxun/Public/assets/global/img/course/shunfen.jpg" alt=""> -->
								<div class="rightimgcontainersp1" style="margin-top: 5px;"><?php echo ($thing['name']); ?></div>
							</div>
								

								
							</td>
							<td style="font-weight: 800;font-size: 1.1em;color: red;text-align: center;"><?php echo ($thing['order_status']); ?>
              </td>
							<td style="text-align: center;font-weight: 800;color: red;">
							 <?php if(empty($thing['need_payment']) ): ?>等待计算<?php else: echo ($thing['need_payment']); endif; ?>
               </td>
							<td style="text-align: center;"><!-- //1未称重2未付款3未付款(现金支付)4未打印5未发货6已发货 -->
                <?php if(($thing['order_status'] == '未付款')): ?><a href="<?php echo U('index/orderdetail',array('id'=>$thing['id'],'flag'=>0));?>" target="_blank">查看订单</a>
                  <a href="<?php echo U('index/manageorder',array('id'=>$thing['id']));?>">修改订单</a>
                  <br>
                  <!-- <a href="<?php echo U('index/selectpaymethod',array('id'=>$thing['id'],'flag'=>1));?>">立即付款</a> -->
                   <a class="payNow" id="payNow" href="javaScript:;">立即支付</a>
                <?php else: ?> 
                <a href="<?php echo U('index/orderdetail',array('id'=>$thing['id'],'flag'=>0));?>" target="_blank">查看订单</a>
                <a href="<?php echo U('index/manageorder',array('id'=>$thing['id']));?>">修改订单</a><?php endif; ?>
							</td>
						</tr>
					</table><?php endforeach; endif; else: echo "" ;endif; ?>

				</div>
				<div class="pagelist" style=""><center><?php echo ($page); ?></center></div>

			</div>


		</div>




		
	
</div>	</div>
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
						<img src="/framework/gitTest/haoxun/Public/assets/global/img/index/weixin.jpg" alt="微信" style="margin-right:5px ">
						
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
<script src="/framework/gitTest/haoxun/Public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/framework/gitTest/haoxun/Public/assets/global/scripts/jquery.cookie.js" type="text/javascript"></script>
<script src="/framework/gitTest/haoxun/Public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>


	<script type="text/javascript" src="/framework/gitTest/haoxun/Public/assets/global/scripts/order.js"></script>
	<script type="text/javascript">
		var payNow = document.getElementById('payNow');
		var payclose = document.getElementById('payClose');
		//console.log(container);
		payNow.onclick = function(){
			document.getElementById('payImg').style.display='block';
		}
		payClose.onclick = function(){
			document.getElementById('payImg').style.display='none';
		}
	</script>


</html>