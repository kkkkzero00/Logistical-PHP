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
   <style>
     .payattention{
      color: red;
      font-size: 1.2em;
      margin-right: 3px;
     }
     @media screen and (max-width: 960px) {
      .container{
        width:100%;
        padding:0;
        margin: 0;
      }
      .col-md-12{
        width:100%;
        padding:0;
        margin: 0;
      }
      .orderrow{
        width: 100%;
        margin: 0 auto;
      }
     }
     @media screen and (min-width: 960px) {
      .row-order{
        width: 80%;
        margin: auto;
        padding: auto;
      }
      .orderrow{
        width: 80%;
        margin: 0 auto;
      }
     }
     }
   </style>
   

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
		<div class="row orderrow" >
			<div class="col-md-12">

				<div class="container-botton">

<div class="container-totton-con">

			<div class="bottontitle"><span class="bottontitle-span1">查询快递</span><span class="bottontitle-span2">输入订单号快速查询快递情况，支持批量查询，每个订单可用英文逗号隔开输入即可,如12,12<span></div>
			<form class="form-horizontal" style="min-height: 400px" action="<?php echo U('index/search');?>" method="post">
			<div class="group">
			
  <div class="form-group" style="margin-top: 15px">
    <div >
    <center>
      <input style="width: 80%" type="text" class="form-control" id="name1" placeholder="请输入运单号，支持批量查询，每个订单可用英文逗号隔开输入即可,如12,12" name="number">
      </center>
    </div>
  </div>
</div>

  <div class="form-group">
    <div>
    <center>
      <input type="submit" class="btn btn-primary" value="立即查询" name="submit">
      </center>
    </div>
  </div>
  	<?php if(!empty($info)): ?><div class="information" style="text-align: center;margin-top: 15px;">
  			<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?><table class="table table-striped table-bordered" style="width: 80%;margin:10px auto;text-align: center; table-layout:fixed;word-wrap:break-word;">
				<tr>
					<td>订单号</td>
					<td>入库站点</td>
					<td>入库时间</td>
					<td>状态</td>
					<td>签收时间</td>
				</tr>
				<tr>
					<td><?php echo ($t['courier_number']); ?> </td>
					<td><?php echo ($t['area_name']); ?></td>
					<td><?php if(!empty($t['create_time'])): echo (date('Y-m-d H:i:s',$t['create_time'])); endif; ?></td>
					<td style="color: red"><?php echo ($t['order_status']); ?></td>
					<td>
						<?php if(!empty($t['receipt_time'])): echo (date('Y-m-d H:i:s',$t['receipt_time'])); endif; ?>
						
			</td>
				</tr>
			</table><?php endforeach; endif; else: echo "" ;endif; ?>
	<!-- <span>订单号：<?php echo ($info['order_status']); ?></span> -->


		</div>

	<?php else: ?>
		<?php if(isset($_POST['submit'])&&isset($_POST['number'])): ?><div class="information" style="text-align: center;margin-top: 15px;color: red;">
				<span>订单号：<?php echo ($_POST['number']); ?> 暂未到达本公司或订单不存在</span>
			</div>
		<?php else: ?>
			<div class="information" style="text-align: center;margin-top: 15px;color: red;">
				<span></span>
			</div><?php endif; endif; ?>
</form>






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


	


</html>