<?php
namespace Receive\Model;
use Common\Model\HyAllModel;
use System\Model\HomkaiServiceModel;
use Receive\Model\ReceivingOrderModel;


class ReceivingOrderTModel extends ReceivingOrderModel{
	protected static $userTab;

	protected function _initialize(){
		parent::_initialize();

    	if(self::$userTab == null){
    		self::$userTab = M('User');
    	}
	}

	protected function initSqlOptions() {
		$userId = ss_uid();
		$res = self::$userTab
				->where(array('status'=>1,'id'=>$userId))
				->field('area_id')
				->find();
		// dump($res);
		return array (
			'where' => array (
					'status'=>array('eq',1),
					'area_id'=>array('eq',$res['area_id'])
			)
		);
	}
}