<?php

namespace Send\Model;
use Common\Model\HyAllModel;
/**
 *
 *
 * @author 
 */
class ExpressModel extends HyAllModel {
	
	/**
	 * @overrides
	 */
	protected function initTableName(){
 		return 'express_name';
	}
	
	/**
	 * @overrides
	 */
	protected function initInfoOptions() {
		return array (
				'title' => '快递公司',
				'subtitle' => '管理快递公司',
		);
	}
	/**
	 * @overrides
	 */
	protected function initSqlOptions() {
		return array (
				// 'associate' => array (
	   //              'express_name|express_id|id|name AS express_name||left',
	   //              'area|price_area|id|area_name||left' ,
	   //          ),
				'where' => array (
						'status'=>array('lt',9),
				)
		);
	}
	/**
	 * @overrides
	 */
	protected function initPageOptions() {
		return array (
				'checkbox'	=> true,
				'deleteType'=> 'status|9',
				'actions' 	=> array (
						'edit' => array (
								'title' => '编辑',
								'max' => 1
						),
						'delete' => array (
								'title' => '删除',
								// 是否需要确认
								'confirm' => true
						)
				),
				'buttons'	=> array(
						'add'=>array(
								'title'=>'新增',
								'icon'=>'fa-plus'
						)
				),
                'tips'=>array(
                    'add'=>'请按格式填写!',
                    'edit'=>'请按格式填写!'
                )
		);
	}
	/**
	 * @overrides
	 */
	protected function initFieldsOptions() {
		
		return array (
				'name' => array(
						'title' => '公司名称',
						'list'  => array(
							//'callback'=>array('tplReplace',C('TPL_DETAIL_BTN'))
						),
						'form' => array (
								'type' => 'text',
                                'validate' => array (
                                    'required' => true,
                                ),
   						)
				),
				'status' => array (
						'title' => '状态',
						'list' => array (
							'callback' => array ('status')
						),
						'form' => array (
								'type' => 'select',
						)
				),
		);
	}
}