<?php
namespace User\Model;
use Common\Model\HyAllModel;

/**
 * 班级管理模型
 *
 * @author Homkai QQ:345887894
 */
class UserModel extends HyAllModel {

	protected static $areaTab,$rolesTab;
	/**
	 * @overrides
	 */  

	protected function _initialize(){
		parent::_initialize();
   
		if($areaTab==null){
			self::$areaTab = M('AreaManage');
		}

		if($rolesTab==null){
			self::$rolesTab = M('FrameRole');
		}

	}
	protected function initTableName(){
		return 'user'; 
	}
	
	/**
	 * @overrides
	 */
	protected function initInfoOptions() {
		return array (
			'title' => '管理员',
			'subtitle' => '管理所有管理员信息' 
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
						) 
				),
				'buttons'	=> array(
						'add'=>array(
								'title'=>'新增',
								'icon'=>'fa-plus'
						)
				),
				'tips'		=> array(
                	'add'	=> '新增用户初始密码123123',
                )
				
		);
	}
	/**
	 * @overrides
	 */
	protected function initFieldsOptions() {
		return array (
			'name'=>array(
				'title'=>'姓名',
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
			'user_no'=>array(
				'title'=>'登录账号（只能是数字）',
				'form'=>array(
					'validate'=>array(
						'required'=>true,
						'number'=>true
					)
				)
			),
			'password'=>array(
				'form'=>array(
					'title'=>'密码',
					'add'=>false,
					'callback'=>array('clean'),
					'fill'=>array(
						'edit'=>array('pwdEncrypt'),
						'add'=>array('value','tHHPF4VYX4V7S7CAryffPdAFtpHlcSZVIL7aUKqVAIEuoQedpaPeSU62_ARBH4fa-6H7qT-vCApYp6CpHSqJn1aUi3XGBsAer2IzMIET7f4TxeJscQxCKd2aNiQe2fyW'),
					)
				)
			),
			'roles'=>array(
				'title'=>'角色',
				'list'=>array(
					'callback'=>array("getRoles"),
					'search' => array (
                        'type' => 'select',
                        'query'=>'like'
                    )

				),
				'form'=>array(
					'type' => 'select',
                    'select'=>array(
                        'multiple'=>true,
                        'editmultiple'=>true
                    ),
                    'fill'=>array(
                    	'both'=>array('setRoles')
                    )
				),
			),
			'sex'=>array(
				'title'=>'性别',
				'list'=>array(),
				'form'=>array()
			),
			'area_id'=>array(
				'title'=>'管理地区',
				'list'=>array(
					'callback'=>array('getArea')
				),
				'form'=>array(
					'type'=>'select'
				)
			),
			'login_last_time'=>array(
				'list'=>array(
					'title'=>'上次登录时间',
					'callback'=>array('dataTotime')
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
			),
			'create_time'=>array(
				'list'=>array(
					'title'=>'注册时间',
					'callback'=>array('dataTotime'),

				),
				'form'=>array(
					'fill'=>array(
                        'add'=> array('value',time())
                    )
				)
			),
			'update_time'=>array(
				'list'=>array(
					'title'=>'修改时间',
					'callback'=>array('dataTotime'),
				),
				'form'=>array(
					'fill'=>array(
                        'edit'=> array('value',time())
                    )
				)
			)

		);
	}
	/**
	 * 用于支持fieldsOptions
	 */
	
	/*public function detail($pk){
		$where = array('id'=>$pk);
		$arr = $this->where($where)->find();
		$total = $this->associate(array('student|id|class_id'))->where($where)->count();
		return array('table'=>array(
				'base'=>array(
						'title'=>'班级信息',
						'icon'=>'fa-users',
						'style'=>'green',
						'value'=>array(
								'名称：'=>$arr['name'],
								'年级 ：'=>$arr['grade'],
								'毕业年份：'=>$arr['graduate'],
								'备注：'=>$arr['remark'],
						)
				),
				'student'=>array(
						'title'=>'学生信息',
						'icon'=>'fa-pencil',
						'style'=>'purple-plum',
						'value'=> array(
								'总人数：'=>$total.'人',
								'花名册：'=>'<a href="'.U('User/Student/all',array('class_id_text'=>$arr['id'])).'" class="btn default red-stripe pull-right">查看班级花名册</a>'
						)
				)
		));
	}*/

	protected function callback_dataTotime($time){
		// dump(2131);
        return to_time($time);
    }

    protected function callback_getArea($id){
    	$area = self::$areaTab;

    	return $area
    			->where(array('status'=>1,'id'=>$id))
    			->field('area_name')
    			->find()['area_name'];
    }

    protected function getOptions_area_id(){
    	$area = self::$areaTab;
    	return $area
    			->where(array('status'=>1,'area_parent_id'=>0))
    			->getField("id,area_name");
    }

    protected function getOptions_roles() {
        return self::$rolesTab
        		->where (array('status' =>array('eq',1)))
        		->order('id desc')
        		->getField('id,title');
    }



    protected function callback_getRoles($data){
    	$rolesArr = explode(',',$data);
    	// dump(23424);
    	$roles = self::$rolesTab;

    	foreach ($rolesArr as $k => $v) {
    		$arr[$k] = $roles->where(array('status'=>1,'id'=>$v))->field('title')->find()['title'];
    	}
    	return implode(',',$arr);

    }

    protected function callback_setRoles($data){
     	// dump($data);
     	return implode(',',$data);
     }

    protected function callback_pwdEncrypt($str){
    	// dump(343);
        if(is_string($str) && ''!==trim($str)) 
        	return D('HyAccount')->pwdEncrypt($str);
        return false;
    }
    protected function callback_clean($str){

    	return "";
    }

}
