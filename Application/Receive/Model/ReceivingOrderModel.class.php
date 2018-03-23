<?php

namespace Receive\Model;
use Common\Model\HyAllModel;
/**
 *    
 *
 * @author 
 */
class ReceivingOrderModel extends HyAllModel {
	protected static $companyTab,$userTab,$areaTab,$area;
	
	protected function _initialize(){
		parent::_initialize();

		if(self::$companyTab == null){
    		self::$companyTab = M('ExpressName');
    	}

    	if(self::$userTab == null){
    		self::$userTab = M('User');
    	}

    	if(self::$areaTab==null){
    		self::$areaTab = M('AreaManage');
    	}

    	self::$area =  self::$userTab
				->where(array('status'=>1,'id'=>ss_uid()))
				->field('area_id')
				->find();   

        // var_dump(
        //     // $this
        //     // ->where(array("status"=>1))
        //     // ->field('id,sender')
        //     // ->select()
        // ); 	
	}

	
	/**
	 * @overrides
	 */
	// public static function setTab($table,$name){
		
	// }

	protected function initTableName(){
 		return 'receiving_order';
	}
	
	/**
	 * @overrides
	 */
	protected function initInfoOptions() {
		return array (
				'title' => '收件订单',
				'subtitle' => '管理收件订单',
		);
	}
	/**
	 * @overrides
	 */
	protected function initSqlOptions() {

		return array (
			'where' => array (
				'status'=>array('eq',1),
			),
            // 'field' => array()
		);
	}
	/**
	 * @overrides
	 */
	protected function initPageOptions() {
		return array (
				'checkbox'	=> true,
                'okRefresh' =>  false,
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
						
				),
				'buttons'	=> array(
					'scan_add'=>array(
							'title'=>'扫码新增',
							'icon'=>'fa-plus'
					),
                    'receipt_change'=>array(
                            'title'=>'签收',
                            'icon'=>'fa-plus-circle'
                    ),
                    'unreceipt_change'=>array(
                            'title'=>'未签收',
                            'icon'=>'fa-plus-circle'
                    ),
					
				),
                'tips'=>array(
                    'add'=>'请按格式填写!',
                    'edit'=>'请按格式填写!'
                ),
                'initJS'=>array(
                	'receiving'
                )
		);  
	}
	/**
	 * @overrides
	 */
	protected function initFieldsOptions() {
		
		return array (
			'courier_number'=>array(
				'title'=>'快递单号',
				'list'=>array(
					'search' => array (
                        // 'callback' => array('searchCourier')
                        'query'=>'like'
					) 
				),
				'form'=>array(
				    'type'=>'text',
                    'searchChange' => true,
                    'scanAdd'=>true,
					'validate'=>array(
						'required'=>true,	
                        // 'regex'=>"^[0-9A-Za-z\-]{8,25}$"
					)
				)
			),
			'express_id'=>array(
				'title'=>'公司',
				'list'=>array(
					'search' => array (
						'type' => 'select'
					),
					'callback'=>array('getCompany'),
				),
				'form'=>array(
					'type'=>'select',
                    
                    'scanAdd'=>true,
					'validate'=>array(
						'required'=>true
					),
					'select'=> array(
						// 'first'=>'请选择'
					)
				)
			),
			'create_time'=>array(		
				'list'=>array(
					'title'=>'入库时间',
					'callback'=>array('dataTotime'),
					'search'=>array(
                        'title' => '接收时间',
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
            'receipt_time'=>array(      
                'list'=>array(
                    'title'=>'已签收时间',
                    'callback'=>array('dataTotime'),
                    'search'=>array(
                        'title' => '已签收时间',
                        'type'=>'daterange',
                        'daterange' => array(
                            'from' => '',
                            'to' => ''
                        ),
                        'sql'=>"`receipt_time` BETWEEN '{:receipt_time}' AND '{:receipt_time_to}'",
                        'timestamp'=>true

                    )
                ),
            ),
			'area_id'=>array(
				'list'=>array(
					'title'=>'所属地区',
					'callback'=>array('getArea')
				),
				'form'=>array(
					'fill'=>array(
						'add'=>array('value',self::$area)
					)
				)
			),
			'order_status'=>array(
				'title'=>'状态',
				'list'=>array(
					'callback'=>array('getOrderStatus'),
					'search' => array (
						'type' => 'select'
					)
				),
				'form'=>array(
					'type'=>'select',
                    'scanAdd'=>true,

					/*'fill'=>array(
	                    'add'=> array('value',1)
	                 )*/
				)
			)
			
		);

	}

	
    

    public function detail($pk){
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

    protected function callback_getCompany($id){
    	

    	$company = self::$companyTab;
    	$name = $company
    			->where(array('status'=>1,'id'=>$id))
    			->field('name')
    			->find();
    	return $name['name'];
    }

    protected function callback_getOrderStatus($id){
    	switch ($id) {
    		case 7:
    			return "<b style='color:red'>未签收</b>";
    			break;
    		
    		case 8:
    			return "<b style='color:#33CC33'>已签收</b>";
    			break;
    	}
    }

    protected function callback_getArea($id){
    	$area = self::$areaTab;
    	return $area
    			->where(array('status'=>1,'id'=>$id))
    			->field('area_name')
    			->find()['area_name'];
    }

    protected function callback_dataTotime($time){
        return to_time($time,2);
    }


    protected function getOptions_express_id(){
    	// dump(234);
    	$company = self::$companyTab;
    	return $company
		    	->where(array('status'=>1))
		    	->getField('id,name');
    }

    protected function getOptions_order_status(){
    	return array(
    		'7' => '未签收',
            '8' => '已签收'
    	);
    }
    
    public function _after_insert($data){
        
    	if(cookie('pre_company_info')['id']!=$data['express_id']){
            
            $company_info = self::$companyTab
                            ->where(array('status'=>1,'id'=>$data['express_id']))
                            ->field('id,name')
                            ->find();

            cookie('pre_company_info',$company_info);
        }

    }

    

    protected function ajax_judgeRepeat(&$json){
        $json['status'] = false;
    	$data = I();
        $courier_number = $data['courier_number'];

        if(!preg_match('/^[0-9A-Za-z\-]{8,25}$/',trim($courier_number))){
                $json['status'] = false;
                $json['info'] = '快递单号不合法！';              
                return;
        }

        $res = $this->where(array('status'=>1,'courier_number'=>array('eq',$courier_number)))->find();
        // dump($res);
        if(is_null($res)||$res == false){  
            $data['create_time'] = time();
            $data['area_id'] = self::$area['area_id'];
            $this->add($data);
            $json['status'] = true;
            $json['info'] = '入库成功！';
            return;
        }
        
        $json['status'] = false;
        $json['info'] = '该单号已存在！';
        return ;
    	
    }

    public function _after_update($data){

        if($data['order_status']==7){
            $this->where(array('id'=>$data['id']))->save(array('receipt_time'=>''));
        }else if($data['order_status']==8){
            $this->where(array('id'=>$data['id']))->save(array('receipt_time'=>time()));
        }
   
    }


    protected function ajax_judgeReceive(&$json){
        $json['status'] = false;
        $info = I();
        $name = $info['name'];
        $value = $info['value'];
        $type = $info['type'];

        if(!preg_match('/^[0-9A-Za-z\-]{8,25}$/',trim($value))){
                $json['status'] = false;
                $json['info'] = '快递单号不合法！';              
                return;
        }
        
        $courierInfo = M('ReceivingOrder')
                        ->where(array('status'=>1,$name=>$value))
                        ->field('id,order_status')
                        ->find();

        if($courierInfo == null){
            $json['status'] = false;
            $json['info'] = '该快递不存在！';
            return ;
        }else{
            if($type==1){
                if($courierInfo['order_status']==8){
                    $json['status'] = false;
                    $json['info'] = '该快递已被签收！';
                    return ;
                }

                $courier_number = $value;
                $data['order_status'] = 8;
                $data['receipt_time'] = time();
                // dump(time());
                $result = M('ReceivingOrder')
                            ->where(array('courier_number'=>$courier_number))
                            ->save($data);
              
                if($result){
                    $json['status'] = true;
                    $json['info'] = '已将快递改为签收状态！';
                }else{
                    $json['status'] = false;
                    $json['info'] = '数据处理失败！';
                }
                
                return;
            }else if($type == 2){
                if($courierInfo['order_status']==7){
                    $json['status'] = false;
                    $json['info'] = '该快递已是未签收状态！';
                    return;
                }

                $courier_number = $value;
                $data['order_status'] = 7;
                $data['receipt_time'] = '';
                // dump(time());
                $result = M('ReceivingOrder')
                            ->where(array('courier_number'=>$courier_number))
                            ->save($data);


                if($result){
                    $json['status'] = true;
                    $json['info'] = '已将快递改为未签收状态！';
                }else{
                    $json['status'] = false;
                    $json['info'] = '数据处理失败！';
                }

                return;
            }else{
                $json['status'] = false;
                $json['info'] = '非法操作！';
                return;
            }
        }   
    
    }



    protected function callback_getDays($data){
    	$startTime = strtotime($data);
    	$endTime = $startTime+24*60*60-1;
    	return 'create_time > ('.$startTime.') and create_time < ('.$endTime.')';
    } 
}
