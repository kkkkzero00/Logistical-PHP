<?php

namespace Send\Model;
use Common\Model\HyAllModel;
/**
 *
 *
 * @author 
 */
class SendPriceModel extends HyAllModel {
	
	/**
	 * @overrides
	 */
	protected function initTableName(){
 		return 'express_price';
	}
	
	/**
	 * @overrides
	 */
	protected function initInfoOptions() {
		return array (
				'title' => '价格管理',
				'subtitle' => '管理寄件价格',
		);
	}
	/**
	 * @overrides
	 */
	protected function initSqlOptions() {
		return array (
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
				'express_id' => array (
						'title' => '快递公司',
						'list' => array (
							'callback' => array('get_express_name')
						),
						'form' => array (
								'type' => 'select',
								'required' => true,
						)
				),
				'area_id' => array (
						'title' => '快递目的地',
						'list' => array (
							'callback' => array('get_area_name')
						),
						'form' => array (
							'type' => 'select',
							'validate' => array(
								'required' => true,
							)
						)
				),
				'first_weight' => array (
						'title' => '首重（kg）',
						'list' => array (
						),
						'form' => array (
							'type' => 'text',
							'validate' => array(
								'required' => true,
								//'regex' => '^'
							)
						)
				),
				'first_price' => array (
						'title' => '首重（kg/元）',
						'list' => array (
						),
						'form' => array (
							'type' => 'text',
							'validate' => array(
								'required' => true,
								//'regex' => '^'
							)
						)
				),
				'additional_price' => array (
						'title' => '续重（kg/元）	',
						'list' => array (
							//'callback' => array('get_area_name')
						),
						'form' => array (
							'type' => 'text',
							'validate' => array(
								'required' => true,
							)
						)
				),
				'express_first_price' => array (
						'title' => '快递公司首重（kg/元）',
						'list' => array (
						),
						'form' => array (
							'type' => 'text',
							'validate' => array(
								'required' => true,
								//'regex' => '^'
							)
						)
				),
				'express_additional_price' => array (
						'title' => '快递公司续重（kg/元）	',
						'list' => array (
							//'callback' => array('get_area_name')
						),
						'form' => array (
							'type' => 'text',
							'validate' => array(
								'required' => true,
							)
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

	protected function getOptions_express_id(){
        return M('express_name')->where(array('id' => array('lt',35)))->getField('id,name',true);
    }

    protected function getOptions_area_id(){
        $area = M('area')->where(array('id' => array(array('elt',35),array('eq',212), 'or')))->getField('id,area_name',true);
    	$area[14] = '江西（除南昌外）';
        return $area;
    }

	protected function callback_get_express_name($id){
        return M('express_name')->where(array('id' => $id))->getField('name',true);
    }

    protected function callback_get_area_name($id){
        return M('area')->where(array('id' => $id))->getField('area_name',true);
    }
}