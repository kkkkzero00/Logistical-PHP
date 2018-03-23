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
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <title>昊迅快递有限公司</title>
    <!--引用百度地图API-->
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=30whLbTVF8LFaKkKf7UMSoEfmRNDWN4Y"></script>
    <style>
    .container{
      margin: 0;
      padding: 0;
    }
    .col-md-12{
      padding: 0;
    }
     @media screen and (max-width: 960px) {
      .orderrow{
        width: 100%;
        margin: 0 auto;
      }
     }
     @media screen and (min-width: 960px) {
      .orderrow{
        width: 80%;
        margin: 0 auto;
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
    				<div class="index-center-img">
              <img src="/framework/gitTest/Logistical-PHP/Public/assets/global/img/category/nav.jpg" alt="" style="width: 100%;height: 100%;">
            </div>
    			</div>
    		</div>
    	</div>
    </div>		
	
	<div class="container">
		<div class="row orderrow">
			<div class="col-md-12 col-sm-12">
				<div class="container-botton">
            <div class="container-totton-con">
      			  <div class="bottontitle">
                <span class="bottontitle-span1">网点分布地图</span>
                <span class="bottontitle-span2">查看网点位置</span>
              </div>
      		
        	    <!--百度地图容器-->
              <div style="width:95%;height:550px;border:#ccc solid 1px;font-size:12px;margin:15px auto;" id="map"></div>
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


	<script type="text/javascript">
     //创建和初始化地图函数：
    function initMap(){
      createMap();//创建地图
      setMapEvent();//设置地图事件
      addMapControl();//向地图添加控件
      addMapOverlay();//向地图添加覆盖物
    }
    function createMap(){ 
      map = new BMap.Map("map"); 
      map.centerAndZoom(new BMap.Point(115.91645,28.709024),18);
    }
    function setMapEvent(){
      map.enableScrollWheelZoom();//启用滚轮放大缩小
      map.enableKeyboard();
      map.enableDragging();//启用拖放
      map.enableDoubleClickZoom()
    }
    function addClickHandler(target,window){
      target.addEventListener("click",function(){
        target.openInfoWindow(window);
      });
    }
    function addMapOverlay(){
      var markers = [
        {content:"江西省南昌市东湖区紫金城红郡4门",title:"网点地址",imageOffset: {width:-46,height:-21},position:{lat:28.709824,lng:115.916207}}
      ];
      for(var index = 0; index < markers.length; index++ ){
        var point = new BMap.Point(markers[index].position.lng,markers[index].position.lat);
        var marker = new BMap.Marker(point,{icon:new BMap.Icon("http://api.map.baidu.com/lbsapi/createmap/images/icon.png",new BMap.Size(20,25),{
          imageOffset: new BMap.Size(markers[index].imageOffset.width,markers[index].imageOffset.height)
        })});
        var label = new BMap.Label(markers[index].title,{offset: new BMap.Size(25,5)});
        var opts = {
          width: 200,
          title: markers[index].title,
          enableMessage: false
        };
        var infoWindow = new BMap.InfoWindow(markers[index].content,opts);
        marker.setLabel(label);
        addClickHandler(marker,infoWindow);
        map.addOverlay(marker);
      };
    }
    //向地图添加控件
    function addMapControl(){
      var scaleControl = new BMap.ScaleControl({anchor:BMAP_ANCHOR_BOTTOM_LEFT});
      scaleControl.setUnit(BMAP_UNIT_IMPERIAL);
      map.addControl(scaleControl);
      var navControl = new BMap.NavigationControl({anchor:BMAP_ANCHOR_TOP_LEFT,type:BMAP_NAVIGATION_CONTROL_LARGE});
      map.addControl(navControl);
      var overviewControl = new BMap.OverviewMapControl({anchor:BMAP_ANCHOR_BOTTOM_RIGHT,isOpen:true});
      map.addControl(overviewControl);
    }
    var map;
    initMap();
  </script>


</html>