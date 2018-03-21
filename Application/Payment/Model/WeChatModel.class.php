<?php

namespace Payment\Model;
use Common\Model\HyAllModel;
/**
 *    
 *
 * @author 
 */
class WeChatModel extends HyAllModel {
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
				'title' => '微信接口管理',
				'subtitle' => '管理微信支付接口',
		);
	}
	/**
	 * @overrides
	 */
	protected function initSqlOptions() {

		return array (

			'where' => array (
				'id'=>array('eq',2),
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
			'wx_app_id'=>array(
				'title'=>'微信公众号ID',
				'list'=>array(
				),
				'form'=>array(
					'validate'=>array(
						'required'=>true,
					)
				)
			),
			'key'=>array(
				'title'=>'微信支付密匙（key）',
				'list'=>array(
				),
				'form'=>array(
					'validate'=>array(
						'required'=>true
					),
				)
			),
			'wx_mch_id'=>array(		
				'title'=>'受理商ID',
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
