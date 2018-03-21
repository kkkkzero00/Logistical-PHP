<?php
namespace SysSet\Model;
use Common\Model\HyAllModel;

/**
 *
 *
 * @author 
 */
class SysSetModel extends HyAllModel {
	
	/**
	 * @overrides
	 */
	protected function initTableName(){
 		return 'frame_setting';
	}
	
	/**
	 * @overrides
	 */
	protected function initInfoOptions() {
		return array (
				'title' => '系统管理',
				'subtitle' => '管理系统的基本配置'
		);
	}
	/**
	 * @overrides
	 */
	protected function initSqlOptions() {
		return array (
				'associate' => array (
				),
				'where' => array (
						'status'=>array('lt',9),
                        'key' => array(IN,'SITE_BANNER,SITE_ICP,SITE_ADMIN_TITLE')
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
						)
				),
				'buttons'	=> array(
				)
		);
	}
	/**
	 * @overrides
	 */
	protected function initFieldsOptions() {
		return array (
				'value' => array (
						'title' => '标题',
						'list'=>array(

						),
						'form' => array (
								'type' => 'text',
						)
				),
				'update_time' => array (
						'list'=>array(
                            'title' => '更新时间',
								'callback'=>array('to_time'),
						),
						'form' => array (
                            'fill'=>array(
                                'both'=> array('value',time())
                            )
						)
				),
				'remark' => array (
						'title' => '备注',
						'list'=>array(
							
						)
				),
				'status' => array (
						'title' => '状态',
						'list' => array (
								'width' => '30',
								'callback' => array('status')
						),
						'form' => array (
								'type' => 'select',
						) 
				)
		);
	}
}