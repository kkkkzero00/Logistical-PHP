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
    <div class="row orderrow">
      <div class="col-md-12">

        <div class="container-botton">

<div class="container-totton-con">


      <div class="bottontitle"><span class="bottontitle-span1">用户注册</span><span class="bottontitle-span2">注册成为会员，享受更多的服务！<span></div>
      <form class="form-horizontal" method="post" action="<?php echo U('index/registerss');?>">
      <div class="group">
  <div class="form-group">
    <label for="tel" class="col-sm-2 control-label">*手机号</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="tel" placeholder="手机号" name="phone" required="required">
    </div>
  </div>
  <div class="form-group">
    <label for="tel1" class="col-sm-2 control-label">*手机验证码</label>
    <div class="col-sm-10">
      <input type="tel" class="form-control" id="tel1" placeholder="手机号/固话号"  name="yanzheng" style="width: 70%; float: left;margin-right: 25px;" required="required">
      <button type="button" class="btn btn-primary" name="<?php echo U('Index/registers');?>" id="send" disabled="disabled"></button>
    </div>
  </div>
  <div class="form-group">
    <label for="addr" class="col-sm-2 control-label">用户名</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="用户名" id="addr" name="username" required="required">
    </div>
  </div>
   <div class="form-group">
    <label for="addr" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" placeholder="" id="addr" name="password" required="required">
    </div>
  </div>
   <div class="form-group">
    <label for="addr" class="col-sm-2 control-label">确认密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" placeholder="" id="addr" required="required" name="qpassword">
    </div>
  </div>
   <div class="form-group" style="margin-bottom: 40px;">
    <label for="addr" class="col-sm-2 control-label">邮箱</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" placeholder="邮箱" id="addr" name="email">
    </div>
  </div>
   <div class="form-group" id="form-group1" style="border-top:5px dotted #f4f4f4;padding-top: 40px">
    <label for="addr" class="col-sm-2 control-label">姓名</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="姓名" id="addr" name="truename" required="required">
    </div>
  </div>
  <div class="form-group">
    <label for="addr" class="col-sm-2 control-label">性别</label>
    <div class="col-sm-10">
      <select name="sex" id="addr" class="form-control">
        <option value="1">男</option>
        <option value="0">女</option>
      </select>
    </div>
  </div>

</div>



  <div class="form-group">
    <div >
    <center>
      <input type="submit" class="btn btn-primary" value="立即注册">
      </center>
    </div>
  </div>
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


<script type="text/javascript">
  $(document).ready(function(){
    var timeagain = 60;   //设置再次发送验证码的时间
    if ($.cookie('the_time') <= 0 || !($.cookie('the_time'))) {
      $.cookie('the_time', 60);
    }
    var btn = $("#send");
    var call = $("#tel");
    var reg = /^1[0-9]{10}$/;
    if($.cookie('the_time') == 60){
      btn.text("发送验证码");
    }else{
      timeCount();
    }

    call.bind('input propertychange',function(){
      if (reg.test(call.val())) {
          btn.removeAttr("disabled");
       } else{
          btn.attr("disabled",true);
       }
    });

    function timeCount(){
        if ($.cookie('the_time') >= 0) {
            btn.text($.cookie('the_time')+"秒后重发");
            setTimeout(timeCount,1000);
            $.cookie('the_time',$.cookie('the_time')-1);
        }else{
            btn.text("重新发送");
            $.cookie('the_time',timeagain);
            if (reg.test(call.val())) {
                btn.removeAttr("disabled");
             } else{
                btn.attr("disabled",true);
             }
        }
    }

    btn.on("click",function(){
        $(this).attr("disabled",true);
        var calls=call.val();
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