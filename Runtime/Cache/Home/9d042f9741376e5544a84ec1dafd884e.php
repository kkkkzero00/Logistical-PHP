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
    <link href="/framework/gitTest/haoxun/Public/assets/global/styles/userinfo/userinfo.css" rel="stylesheet" type="text/css">
   
   

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
					<div class="index-center-img">
					<img src="/framework/gitTest/haoxun/Public/assets/global/img/category/nav.jpg" alt="" style="width: 100%;height: 100%;">
					</div>
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
								<div class="userimg">
									<img src="/framework/gitTest/haoxun/Public/UploadFile<?php echo ($user['savepath']); ?>"  alt="">
								</div>
								<div class="username">
									<?php echo ($user['username']); ?>
								</div>
							</div>
							<div class="order">
								<div class="ordertitle">
									<span class="iconfont" style="font-size: 30px;">&#xe735;</span>
									<span class="ordertitle-title">订单中心</span>
								</div>
								<div class="orderlist">
									<ul>
										<li><a href="<?php echo U('index/thinginfo',array('p'=>1));?>">普通订单</a></li>
										<li><a href="<?php echo U('index/citysendorder',array('p'=>1));?>">同城速运订单</a></li>
									</ul>
								</div>
							</div>
							<div class="userinfo">
								<div class="userinfotitle">
									<span class="iconfont" style="font-size: 30px;">&#xe601;</span><span class="userinfotitle-title">个人中心</span>
								</div>
								<div class="userinfolist">
									<ul>
										<li><a href="<?php echo U('index/userinfo',array('id'=>$user['id']));?>">我的个人中心</a></li>
										<li><a href="<?php echo U('index/manageaddr');?>">管理默认收货地址</a></li>
										<li><a href="<?php echo U('index/managecitysendaddr');?>">管理同城速运默认收货地址</a></li>
									</ul>
								</div>
							</div>
						</div>
					</center>
				</div>

				<div class="rightbox col-sm-12 col-md-9">
					<div class="rightcontainer">
						<div class="rightcontainer-title">
							<span class="iconfont" style="font-size: 30px;">&#xe601;</span><span>个人中心</span>
						</div>
						<div class="rightcontain-container">
							<div class="rightcobox">
								<div class="usersinfo">
									<table class="table">
										<tr>
											<td>用户名：</td>
											<td><?php echo ($user['username']); ?></td>
										</tr>
										<tr>
											<td>手机号：</td>
											<td class="phone"><?php echo ($user['phone']); ?></td>
										</tr>
										<tr>
											<td>实名认证状态：</td>
											<td><?php if(($user['is_identification'] == 0) ): ?><span style="color: red">未上传身份证</span>
											<?php elseif(($user['is_identification'] == 9)): ?>
											<span style="color: red">暂未审核</span>
											<?php elseif(($user['is_identification'] == 3)): ?>
												<span style="color: red">审核不通过，请重新上传身份证</span>
											<?php else: ?>
											<span style="color: green">认证成功</span><?php endif; ?></td>
										</tr>
										<tr>
											<td>性别：</td>
											<td><?php if(($user['sex'] == 1) ): ?>男<?php else: ?>女<?php endif; ?></td>
										</tr>
										<tr>
											<td>姓名：</td>
											<td><?php echo ($user['truename']); ?></td>
										</tr>
										<tr>
											<td>地址：</td>
											<td><?php echo ($addr['addr']); ?></td>
										</tr>
										
									</table>
							<div class="userbutton">
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">修改个人信息</button>

<!-- Modal -->
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title" id="myModalLabel">修改个人信息</h4>
								      </div>
								      <div class="modal-body">

								      	<form class="form-horizontal" action="<?php echo U('index/edit_users');?>" method="post">
								        <div class="form-group">
								    <label for="username1" class="col-sm-2 control-label">用户名</label>
								    <div class="col-sm-10">
								      <input type="text" class="form-control" id="username1" placeholder="昵称" name="username">
								    </div>
								  </div>
								  <div class="form-group">
								    <label for="username2" class="col-sm-2 control-label">姓名</label>
								    <div class="col-sm-10">
								      <input type="text" name="truename" class="form-control" id="username2" placeholder="姓名">
								    </div>
								  </div>
								
								 <div class="modal-footer">
								        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								        <button type="submit" class="btn btn-primary" name="submit">保存更改</button>
								      </div>
								</form>
								      </div>
								    </div>
								  </div>
								</div>
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">修改密码</button>

<!-- Modal -->
								<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title" id="myModalLabel">修改密码</h4>
								      </div>
								      <div class="modal-body">
								       
									<form class="form-horizontal" method="post" action="<?php echo U('Index/edit_password');?>">
								<div class="form-group">
								    <label for="yanzhengma" class="col-sm-2 control-label">验证码</label>
								    <div class="col-sm-10">
								      <input type="text" class="form-control" id="yangzhengma" placeholder="验证码" style="display: inline-block;width: 78%" name="yanzheng" required="required">
								      <button class="btn btn-primary" type="button" id="yanzheng" name="<?php echo U('Index/registers');?>">发送验证码</button>
								    </div>
								  </div>
								  <div class="form-group">
								    <label for="password1" class="col-sm-2 control-label">当前密码</label>
								    <div class="col-sm-10">
								      <input type="password" class="form-control" id="password1" placeholder="当前密码" name="passwords">
								    </div>
								  </div>
								<div class="form-group">
								    <label for="password2" class="col-sm-2 control-label">新密码</label>
								    <div class="col-sm-10">
								      <input type="password" class="form-control" id="password2" placeholder="新密码" name="password">
								    </div>
								  </div>
								  <div class="modal-footer">
								        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								        <button type="submit" class="btn btn-primary">保存更改</button>
								      </div>
								</form>
								      </div>
								      
								    </div>
								  </div>
								</div>

<?php if(($user['is_identification'] == 0) ): ?><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal4">实名认证</button>
											<?php elseif(($user['is_identification'] == 3)): ?>
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal4">实名认证</button>
											<?php else: ?>
											<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal4" disabled="disabled">实名认证</button><?php endif; ?>


<!-- Modal -->
								<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title" id="myModalLabel">实名认证</h4>
								        <span style="font-size: 0.5em;color: gray;">注意上传的身份证需是正面的</span>
								      </div>
								      <div class="modal-body">
								       
									<form class="form-horizontal"  enctype="multipart/form-data" method="post" action="<?php echo U('index/name_certification');?>">
								<div class="form-group">
								    <label for="yanzhengma" class="col-sm-2 control-label">选择文件</label>
								    <div class="col-sm-10">
								      <input type="file" class="file_input" name="userimg">
								     
								    </div>
								  </div>
								  
								  <div class="modal-footer">
								        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								        <button type="submit" class="btn btn-primary" name="submit">上传</button>
								      </div>
								</form>
								      </div>
								      
								    </div>
								  </div>
								</div>

								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal3">修改头像</button>

<!-- Modal -->
								<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								        <h4 class="modal-title" id="myModalLabel">修改头像</h4>
								      </div>
								      <div class="modal-body">
								       
									<form class="form-horizontal"  enctype="multipart/form-data" method="post" action="<?php echo U('index/userimgupload');?>">
								<div class="form-group">
								    <label for="yanzhengma" class="col-sm-2 control-label">选择文件</label>
								    <div class="col-sm-10">
								      <input type="file" class="file_input" name="userimg">
								     
								    </div>
								  </div>
								  
								  <div class="modal-footer">
								        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								        <button type="submit" class="btn btn-primary" name="submit">上传</button>
								      </div>
								</form>
								      </div>
								      
								    </div>
								  </div>
								</div>

							</div>
						</div>
					</div>
				<div class="leftcobox">
					<div class="leftcoboxco">
						<div class="leftcoboxboimg">
							<img src="/framework/gitTest/haoxun/Public/UploadFile<?php echo ($user['savepath']); ?>"  alt="">
						</div>
						
    
</div></center></form></div>
						</div>
					</div>
				</div>
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


	<script type="text/javascript">
	  $(document).ready(function(){
	    var timeagain = 60;   //设置再次发送验证码的时间
	    var times = timeagain;    
	    var btn = $("#yanzheng");
	    var reg = /^1[0-9]{10}$/;

	    function timeCount(){	        
	        if (times >= 0) {
	            btn.text(times+"秒后重发");
	            setTimeout(timeCount,1000);
	            times -= 1;
	        }else{
	            btn.text("重新发送");
	            times = timeagain;
	            btn.removeAttr("disabled");
	        }
	    }

	    btn.on("click",function(){
	        $(this).attr("disabled",true);
	        var calls=$(".phone").text();
	        var urls=$(this).attr('name');
	        var data={'call':calls};
	        $.ajax({
	           type:"post",
	           url:urls,
	           data:data,
	           success:function(datas){
	                
	            }
	        });
	        timeCount(this);
	    });
	  });
	</script>


</html>