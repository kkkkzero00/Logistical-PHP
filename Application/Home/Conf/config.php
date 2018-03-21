<?php
$res=M('pay')->where(array('id'=>1))->find();
// var_dump($res);
return array(
  'CRYPT_KEY_PWD'     =>  'a@#y$V4%9i$&*JG%$#Li*(K:!*3%Q~p0',
  'INDEX_ARTICLE_NUM'=>'5',
  //支付宝配置参数
'DEFAULT_FILTER'        => 'strip_tags,htmlspecialchars',
   'alipay_config'=>array(
      'partner' =>$res['alipay_pid'],   //这里是你在成功申请支付宝接口后获取到的PID；
      'key'=>$res['key'],//这里是你在成功申请支付宝接000000000000000000000000000000000000000000+后获取到的Key
      //'seller_email'=>$res['alipay_seller_email'],
      'sign_type'=>strtoupper('MD5'),
      'input_charset'=> strtolower('utf-8'),
      'cacert'=> getcwd().'\\cacert.pem',
      'transport'=> 'http',
        ),
         //以上配置项，是从接口包中alipay.config.php 文件中复制过来，进行配置；
     'alipay'   =>array(
     //这里是卖家的支付宝账号，也就是你申请接口时注册的支付宝账号
     'seller_email'=>$res['alipay_seller_email'],
     //这里是异步通知页面url，提交到项目的Pay控制器的notifyurl方法；
     'notify_url'=>strtolower('http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/index.php')).'/index.php/Home/Index/notifyurl'),
     //这里是页面跳转通知url，提交到项目的Pay控制器的returnurl方法；
     'return_url'=>strtolower('http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/index.php')).'/index.php/Home/Index/returnurl'),
     'successpage'=>'Index/index',
     'errorpage'=>'Index/Paybuy', 
   ),
  
);