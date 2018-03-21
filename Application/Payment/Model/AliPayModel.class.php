<?php

namespace Payment\Model;
use Common\Model\HyAllModel;
/**
 *    
 *
 * @author 
 */
class AliPayModel extends HyAllModel {
	/**
	 * @overrides
	 */
	// public static function setTab($table,$name){
		
	// }

	protected function initTableName(){
 		return 'pay';
	}
	
	/**
	 * @overrides
	 */
	protected function initInfoOptions() {
		return array (
				'title' => '支付宝接口管理',
				'subtitle' => '管理支付宝接口',
		);
	}
	/**
	 * @overrides
	 */
	protected function initSqlOptions() {

		return array (

			'where' => array (
				'id'=>array('eq',1),
			)
		);
	}
	/**
	 * @overrides
	 */
	protected function initPageOptions() {
		return array (
				'checkbox'	=> true,
				'deleteType'=> 'delete',
				'actions' 	=> array (
						'edit' => array (
								'title' => '编辑',
								'max' => 1
						),	
				),
				'buttons'	=> array(
				),
                'tips'=>array(
                    'add'=>'请按格式填写!',
                    'edit'=>'请按格式填写!'
                ),
                'initJS'=>array(
                )
		);  
	}
	/**
	 * @overrides
	 */
	protected function initFieldsOptions() {
		
		return array (
			'alipay_seller_email'=>array(
				'title'=>'商家支付宝账号',
				'list'=>array(
				),
				'form'=>array(
					'validate'=>array(
						'required'=>true,
					)
				)
			),
			'key'=>array(
				'title'=>'支付宝密匙（key）',
				'list'=>array(
				),
				'form'=>array(
					'validate'=>array(
						'required'=>true
					),
				)
			),
			'alipay_pid'=>array(		
				'title'=>'支付宝接口PID',
				'list' =>array(
				),
				'form'=>array(
					'validate' =>array(
						'required' => true,
					)
				)
			)
		);
	}
}
