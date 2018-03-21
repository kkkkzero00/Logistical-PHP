<?php
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller {
	protected $errorMessage = '';
	
	public function _initialize(){
		$nav = D('Category')->getNav();
		
		$this->assign('nav',$nav);
		 vendor('Alipay.Corefunction');
        vendor('Alipay.Md5function');
        vendor('Alipay.Notify');
        vendor('Alipay.Submit');
		vendor('WxPayPubHelper.WxPayPubHelper');

	}

}