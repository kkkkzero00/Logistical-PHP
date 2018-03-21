<?php
namespace User\Model;
use Common\Model\HyAllModel;

/**
 * 班级管理模型
 *
 * @author Homkai QQ:345887894
 */
class AreaManageModel extends HyAllModel {

	protected static $areaManageTab;
	/**
	 * @overrides
	 */

	protected function _initialize(){
		parent::_initialize();

		if($areaTab==null){
			self::$areaManageTab = M('AreaManage');
		}


	}
	protected function initTableName(){
		return 'area_manage';
	}
	
	/**
	 * @overrides
	 */
	protected function initInfoOptions() {
		return array (
			'title' => '区域',
			'subtitle' => '区域管理' 
		);
	}
	
	/**
	 * @overrides
	 */
	protected function initSqlOptions() {
		return array ( 
				'where' => array (
						'status'=>array('eq',1),
						
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
				
		);
	}
	/**
	 * @overrides
	 */
	protected function initFieldsOptions() {
		return array (
			'area_name'=>array(
				'title'=>'区域名',
				'list'=>array(
					'order' => 'CONVERT(`name` USING gbk)',
					'search' => array (
							'query' => 'like' 
					) 
				),
				'form'=>array(
					'validate'=>array(
						'required'=>true,
					)
				)
			),
			
			
			'status'=>array(
				'title'=>'状态',
				'list'=>array(
					'callback'=>array('status')
				),
				'form'=>array(
					'type'=>'select'
				)

			)

		);
	}
	

}
