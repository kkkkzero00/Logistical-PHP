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
	
    <link href="/framework/gitTest/Logistical-PHP/Public/assets/global/styles/order/order.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/framework/gitTest/Logistical-PHP/Public/assets/global/plugins/jquery.min.js"></script>
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
		
  <div class="containers" >
    	<div class="row" style="margin: 0;padding: 0">
    		<div class="col-md-12" style="margin: 0;padding: 0">
    			<div  class="index-center">
    				<div class="index-center-img"><img src="/framework/gitTest/Logistical-PHP/Public/assets/global/img/category/nav.jpg" alt="" style="width: 100%;height: 100%;"></div>
    				
    			</div>
    		</div>
    	</div>
  </div>		
	
	<div class="container">
		<div class="row orderrow">
			<div class="col-md-12">
				<div class="container-botton">
          <div class="container-totton-con">

          			<div class="bottontitle">
                  <span class="bottontitle-span1">网上预约快递</span>
                  <span class="bottontitle-span2">
                    <span style="color: red">*为必填信息！</span>为方便快递员取货，请提供您真实有效的信息，并在登陆后下单。
                  </span>
                </div>

          			<form class="form-horizontal" method="post" action="<?php echo U('index/order');?>">
            			<div class="group">
              			<div class="group-title">寄件人信息</div>
                    
                    <div class="form-group">
                      <label for="name1" class="col-sm-2 control-label"><span class="payattention">*</span>姓名</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="name1" placeholder="姓名" name="sender" value="<?php echo ($userinfo['truename']); ?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="tel1" class="col-sm-2 control-label"><span class="payattention">*</span>手机/固话</label>
                      <div class="col-sm-10">
                        <input type="tel" class="form-control" id="tel1" placeholder="手机号/固话号" name="senderphone" value="<?php echo ($userinfo['phone']); ?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label for="unit1" class="col-sm-2 control-label">寄件单位</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="unit1" placeholder="寄件单位" name="junit">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="remark1" class="col-sm-2 control-label">取件方式备注</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="remark1" placeholder="取件方式有上门取件，自提等" name="remark1">
                      </div>
                    </div>

                    <div class="form-group">
                        <label for="remark3" class="col-sm-2 control-label">
                          <span class="payattention">*</span>网点
                        </label>
                        <div class="col-sm-10">
                          <select class="form-control" name="wangdian">
                            <?php if(is_array($wangdian)): $i = 0; $__LIST__ = $wangdian;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$wang): $mod = ($i % 2 );++$i;?><option value="<?php echo ($wang['id']); ?>"><?php echo ($wang['area_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                          </select>
                        </div>
                    </div>

                    <?php if(empty($addr)): ?><div class="form-group">
                        <label for="addr" class="col-sm-2 control-label"><span class="payattention">*</span>上门地址</label>
                        <div class="col-sm-10">
                          <select id="s_province" name="s_province" class="control-label"></select> 
                        <select id="s_city" name="s_city" class="control-label"></select> 
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="addr1" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="addr1" name="recipients" placeholder="请输入详细上门地址">
                        </div>
                      </div>

                    <?php else: ?>

                      <div class="form-group" style="display: none;" id="addrglup">
                        <label for="addr" class="col-sm-2 control-label"><span class="payattention">*</span>上门地址</label>
                        <div class="col-sm-10">
                          <select id="s_province" name="s_province" class="control-label"></select> 
                        <select id="s_city" name="s_city" class="control-label"></select> 
                        </div>
                      </div>

                      <div class="form-group">
                          <label for="addr3" class="col-sm-2 control-label" id="addrtitle">默认收货地址</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="addr3" name="recipients2" placeholder="" value="<?php echo ($addr['addr']); ?>" style="width: 75%;margin-right: 3%;float: left;">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary btn-lg" id="changeaddr" style="width: 22%;height: 70%;font-size: 1em;padding: 7px;">
                             更换地址
                            </button>
                          </div>
                      </div><?php endif; ?>
                  </div>

                  <div class="group">
                  	<div class="group-title">收件人信息</div>
                    <div class="form-group">
                      <label for="name2" class="col-sm-2 control-label"><span class="payattention">*</span>姓名</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="name2" name="receivename" placeholder="姓名">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="tel2" class="col-sm-2 control-label"><span class="payattention">*</span>手机/固话</label>
                      <div class="col-sm-10">
                        <input type="tel" class="form-control" id="tel2" placeholder="手机号/固话号" name="receivephone">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="unit2" class="col-sm-2 control-label">收件单位</label>
                      <div class="col-sm-10">
                        <input type="tel" class="form-control" id="unit2" placeholder="收件单位" name="cunit">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="addrs" class="col-sm-2 control-label"><span class="payattention">*</span>收件地址</label>
                      <div class="col-sm-10">
                        <select id="c_province" name="c_province" class="control-label"></select> 
                        <select id="c_city" name="c_city" class="control-label"></select> 
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="addr2" class="col-sm-2 control-label"></label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" id="addr2" name="sendaddr" placeholder="请输入详细收货地址" style="width: 65%;margin-right: 3%;float: left;"><button type="button" class="btn btn-primary btn-lg" id="sendaddr" style="width: 30%;height: 70%;margin-left: 1%;font-size: 1em;padding: 7px;">
                              一键识别地址
                          </button>
                      </div>
                    </div> 
                  </div>

                  <div class="group">
                  		<div class="group-title">快递信息</div>
                      <div class="form-group">
                        <label  class="col-sm-2 control-label"><span class="payattention">*</span>快递公司</label>
                        <div class="col-sm-10">
                          <select class="form-control" name="expressname">
                              <?php if(is_array($expressname)): $i = 0; $__LIST__ = $expressname;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$express): $mod = ($i % 2 );++$i;?><option value="<?php echo ($express['id']); ?>"><?php echo ($express['name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                          <label for="weight" class="col-sm-2 control-label">预计重量（kg）</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="预计重量（kg）" id="weight" name="weight">
                          </div>
                      </div>

                      <div class="form-group">
                        <label for="option3" class="col-sm-2 control-label"><span class="payattention">*</span>取件备注</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" placeholder="易碎品、液体、贵重物品请特殊说明" id="option3" name="remark2">
                        </div>
                      </div> 
                  </div>


                  <div class="form-group">
                    <div > 
                      <center>
                        <?php if(isset($_SESSION['id'])): ?><input type="submit" class="btn btn-primary" value="立即下单" name="submit" id="submit"> <?php else: ?>
                          <input type="submit" class="btn btn-primary" value="立即下单" name="submit" id="submit" ><?php endif; ?>
                        <script type="text/javascript">
                            var strSession = "<?php echo $_SESSION['name']; ?>".toString(); 
                            var shiming = "<?php echo $shiming['is_identification']; ?>".toString(); 
                                  if(strSession==''){
                                    alert('请先登录！');
                                    var url="<?php $url=U('index/login');echo $url ?>".toString();
                                    window.location.href=url;  
                                }
                                 if(shiming=='0'){
                                    alert('请先前往个人中心完成实名认证后即可登陆！');
                                    var url="<?php $url=U('index/userinfo');echo $url ?>".toString();
                                    window.location.href=url;  
                                }
                              $('#changeaddr').click(function(){
                                $("#addrglup").css("display","block");
                                $("#addr3").val('');
                                $("#addr3").html('');
                                $("#addr3").attr('name','recipients3');
                                $("#addrtitle").html(''); 
                                
                           
                              });
                            $('#sendaddr').click(function(){
                                var url="<?php $url=U('index/intelResolution'); echo $url; ?>".toString();
                                var ddd = $('#addr2').val();
                                // console.log(ddd);

                                $.ajax({
                                    type:"post",
                                    url:url,
                                    data:{data:ddd},
                                    success:function(datas){

                                        $('#c_province').find("option:selected").text(datas[0]);
                                        $('#c_city').find("option:selected").text(datas[1]);
                                        $('#addr2').val(datas[2]);
                                    }
                                });
                            });
                        </script>
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


	<script type="text/javascript" src="/framework/gitTest/Logistical-PHP/Public/assets/global/scripts/order.js"></script>
  <script type="text/javascript" src="/framework/gitTest/Logistical-PHP/Public/assets/global/scripts/addr.js"></script>
  <script type="text/javascript">
    
  </script>


</html>