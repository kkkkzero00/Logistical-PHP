<?php

namespace Send\Model;
use Common\Model\HyAllModel;
/**
 *
 *
 * @author 
 */
class CitySendModel extends HyAllModel {
	protected static $companyTab,$userTab,$areaTab,$area;

	protected function _initialize(){
		parent::_initialize();

    	if(self::$userTab == null){
    		self::$userTab = M('User');
    	}
 	
	}
	/**
	 * @overrides
	 */

	protected function initTableName(){
 		return 'send_order';
	}
	
	/**
	 * @overrides
	 */
	protected function initInfoOptions() {
		return array (
				'title' => '寄件订单',
				'subtitle' => '管理寄件订单',
		);
	}
	/**
	 * @overrides
	 */
	protected function initSqlOptions() {
		return array (
				'where' => array (
						'status'=>array('neq',0),
				)		);
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
						'delete' => array (
								'title' => '删除',
								// 是否需要确认
								'confirm' => true
						),
						// 'bind' => array (
						// 		'title' => '绑定快递单号',
						// 		'max' => 1
						// )
				),
				'buttons'	=> array(
						'add'=>array(
								'title'=>'新增',
								'icon'=>'fa-plus'
						),
						// 'change'=>array(
						// 		'title'=>'出库',
						// 		'icon'=>'fa-plus'
						// ),
				),
                'tips'=>array(
                    'add'=>'请按格式填写!',
                    'edit'=>'请按格式填写!'
                ),
            	'initJS'  => 'LodopFuncs,Send',
                'detailTpl'	=> 'Send@Send/detail',
                'detailTpl_status' => 'Send@Send/detail_s',
		);
	}
	/**
	 * @overrides
	 */
	protected function initFieldsOptions() {
		
		return array (
				'sender' => array(
					'title' => '寄件人',
					'list'  => array(
						'callback'=>array('tplReplace',C('TPL_DETAIL_BTN'))
					),
					'form' => array (
							'type' => 'text',
                            'validate' => array (
                                'required' => true,
                            ),
					)
				),
				'sender_phone' => array(
					'title' => '寄件人电话',
					'list'  => array(
						'search' => array (
							'type'=>'text',
							'query' => 'like'
						)
					),
					'form' => array (
							'type' => 'text',
                            'validate' => array (
                                'required' => true,
                                'regex' => '^1[34578]\d{9}$',
                            ),
						)
				),
				'sender_address' => array(
					'title' => '寄件人地址',
					'list'  => array(
						'hidden' => true,
					),
					'form' => array (
							'type' => 'text',
                            'validate' => array (
                                'required' => true,
                            ),
						)
				),
				'receiver' => array (
					'title' => '收件人',
					'list' => array (
					),
					'form' => array (
						'type' => 'text',
						'validate' => array(
							'required' => true,
						)
					)
				),
                'receiving_phone' => array (
	                'title' => '收件人电话',
	                'list' => array (
	                    'hidden' => true,
	                ),
	                'form' => array (
	                    'type' => 'text',
	                    'validate' => array(
	                        'required' => true,
	                        'regex' => '^1[34578]\d{9}$'
	                    )
	                )
                ),
				'receiving_company' => array(
					'title' => '收件人单位',
					'list'  => array(
						'hidden'  => true,
					),
					'form' => array (
						'type' => 'text',
						)
				),
				'receiving_address' => array (
					'title' => '收件人地址',
					'list' => array (
						'hidden'	=>	true,
					),
					'form' => array (
						'type' => 'text',
						'validate' => array(
							'required' => true,
						)
					)
				),
                'express_remarks' => array (
                    'title' => '订单备注',
                    'list'=>array(
                        'hidden' => true,
                    ),
                    'form' => array (
                    )
                ),
				'sender_estimated_weight' => array (
					'title' => '客户估计重量',
					'list'=>array(
						'hidden' => true,
					),
					'form' => array (
						'attr' => 'disabled',
						'fill' => array(
							'both' => array('estimated_weight')
						),
					)
				),
				'need_payment' => array (
					'title' => '客户应付金额(元）',
					'list'=>array(
						'callback' =>array('needPayment'),
					),
					'form' => array (
						'attr' => 'disabled',
					)
				),
				'received_money' => array (
					'title' => '客户实付金额(元）',
					'list'=>array(
						'callback' =>array('fill_received_money'),
					),
					'form' => array (
						'add' => false,
						'attr' => 'disabled',
						'type' => 'text',
                        'fill' => array(
                        	'both' => array('fill_received_money')
                        )
					)
				),
				'fetchgoods_remarks' => array (
					'title' => '取件备注',
					'list' => array (
						'hidden' => true,
					),
					'form' => array (
							'type' => 'textarea',
					)
				),
				'price_area' => array (
					'title' => '快递目的地',
					'list' => array (
						'hidden' => true,
					),
					'form' => array (
						'type' => 'select',
						'validate' => array(
							'required' => true,
						)
					)
				),
				'weight' => array (
					'title' => '重量（kg）',
					'list'=>array(
						'hidden' => true,
					),
					'form' => array (
							'type' => 'text',
					)
				),
				'order_status' => array(
					'title' => '订单状态',
					'list' => array(
						'callback'=>array('get_order_list'),
						'search'=>array(
							'type'=> 'select',
						)
					),
					'form' => array(
							'type' => 'select',
					)
				),
				'create_time'=>array(
					'list'=>array(
						'title'=>'订单创建时间',
						'callback'=>array('dataTotime'),
						'search'=>array(
	                        'title' => '创建时间',
	                        'type'=>'daterange',
	                        'daterange' => array(
	                            'from' => '',
	                            'to' => ''
	                        ),
	                        'sql'=>"`create_time` BETWEEN '{:create_time}' AND '{:create_time_to}'",
	                        'timestamp'=>true
                    	)
					),
					'form'=>array(
						'fill'=>array(
	                        'add'=> array('value',time())
	                    )
					)
				),
				'update_time'=>array(
					'title'=> '订单更新时间',
					'list'=>array(
						'callback'=>array('dataTotime'),
					),
					'form'=>array(
						'fill'=>array(
	                        'edit'=> array('value',time())
	                    )
					)
				),
				// 'status' => array (
				// 	'title' => '面单详情',
				// 	'list' => array (
				// 		'callback' => array ('tplReplace',C('TPL_PRINCIPAL_BIN'))
				// 	),
				// 	'form'=>array(
    //                     'title'=>'审核',
    //                     'add'=>false,
    //                     'edit'=>false,
    //                     'fill'=>array(
    //                         'add'=>array('value',1),
    //                         'edit'=>array('value',1)
    //                     )
    //                 )
				// ),
		);
	}

	protected function getOptions_express_id(){
        return M('express_name')->where(array('id' => array('lt',35)))->getField('id,name',true);
    }

    protected function getOptions_price_area(){
    	$area = M('area')->where(array('id' => array(array('elt',35),array('eq',212), 'or')))->getField('id,area_name',true);
    	$area[14] = '江西（除南昌外）';
        return $area;
    }

    protected function getOptions_order_status(){
        return array(1 => '未称重',
        			 2 => '未付款',
        			 3 => '现金支付（未付款）',
        			 4 => '未打印',
        			 5 => '未发货',
        			 6 => '已发货');
    }

	protected function callback_get_express_name($id){
        return M('express_name')->where(array('id' => $id))->getField('name',true);
    }

    protected function callback_get_area_name($id){
        return M('area')->where(array('id' => $id))->getField('area_name',true);
    }
	protected function callback_dataTotime($time){
        return to_time($time,2);
    }
	protected function callback_get_order_list($status){
		switch($status){
			case 1:
				$status = '<b style="color: orange;">未称重</b>';
				break;
			case 2:
				$status = '<b style="color: orange;">未付款</b>';
				break;
			case 3:
				$status = '<b style="color: orange;">现金支付（未付款）</b>';	
				break;
			case 4:
				$status = '<b style="color: orange;">未打印</b>';
				break;
			case 5:
				$status = '<b style="color: orange;">未发货</b>';
				break;
			case 6:
				$status = '<b style="color: green;">已发货</b>';
				break;
			default:
				$status = '<b style="color: red">状态出错，请重新修改</b>';
		}
        return $status;
    }
	protected function callback_estimated_weight($weight){
		return $weight? $weight:0;
	}
	protected function callback_fill_received_money($money){
		return $money? $money:'0.00';
	}
	protected function callback_needPayment($money){
		return $money? $money:"<i style='color:red'>待计算</i>";
	}
	
    public function detail($pk){
        $where=array($this->getPk()=>$pk);
        $arr = $this->where($where)->find();
       
        return array('table'=>array(
        	'base'=>array(
                'title'=>'订单信息',
                'icon'=>'fa-list-alt',
                'style'=>'blue',
                'value'=>array(
                    '寄件目的地：'=>get_area_name($arr['price_area']),
                    '包裹重量：'=>$arr['weight'],
                    '包裹信息：'=>$arr['express_information'],
                    '用户估计重量：'=>$arr['sender_estimated_weight'],
                    '订单最后修改时间：'=>to_time($arr['update_time']),
                )
            ),
            'sender'=>array(
                'title'=>'寄件人信息',
                'icon'=>'fa-user',
                'style'=>'green',
                'value'=>array(
                    '寄件人：'=>$arr['sender'],
                    '寄件人电话：'=>$arr['sender_phone'],
                    '寄件人地址：'=>$arr['sender_address'],
                )
            ),
            'address'=>array(
                'title'=>'收件人信息',
                'icon'=>'fa-user',
                'style'=>'purple-plum',
                'value'=>array(
                    '收件人：'=>$arr['receiver'],
                    '收件人电话：'=>$arr['receiving_phone'],
                    '收件人单位：'=>$arr['receiving_company'],
                    '收件人地址：'=>$arr['receiving_address'],
                )
            ),
            'express_remarks'=>array(
                'title'=>'订单备注',
                'icon'=>'fa-list-alt',
                'style'=>'yellow',
                'value'=>array(
                    '备注'=>$arr['express_remarks'],
                )
            ),
            'fetchgoods_remarks'=>array(
                'title'=>'取件备注',
                'icon'=>'fa-list-alt',
                'style'=>'red',
                'value'=>array(
                    '备注'=>$arr['fetchgoods_remarks'],
                )
            ),
        ));
    }
    public function detail_status($pk){
        $where=array($this->getPk()=>$pk);
        $arr = $this->where($where)->find();
       
        return array('table'=>array(
            'base'=>array(
                'title'=>'订单信息',
                'icon'=>'fa-users',
                'style'=>'green',
                'value'=>array(
                    '寄件人：'=>$arr['sender'],
                )
            ),
            'address'=>array(
                'title'=>'订单详细地址',
                'icon'=>'fa-pencil',
                'style'=>'purple-plum',
                'value'=>array(
                    '地址：'=>$arr['receiving_address'],
                )
            )
        ));
    }
}
