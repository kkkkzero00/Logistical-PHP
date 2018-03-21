<?php
namespace User\Model;
use Common\Model\HyAllModel;

/**
 * 用户管理模型
 *
 * @author Homkai QQ:345887894
 */
class UsersModel extends HyAllModel {

	/**
	 * @overrides
	 */  
	protected function initTableName(){
		return 'users'; 
	}
	
	/**
	 * @overrides
	 */
	protected function initInfoOptions() {
		return array (
			'title' => '普通用户',
			'subtitle' => '管理普通用户' 
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

                'tips'=>array(
                    'edit'=>'请按格式填写!'
                ),
                'initJS'=>array(
                	'users'
                ),
                'detailTpl'=>'User@Users/detail'

		);
	}
	/**
	 * @overrides
	 */
	protected function initFieldsOptions(){
		return array(
            'username'=>array(
                'title'=>'用户名',
                'list'=>array(
                    // 'order' => 'CONVERT(`username` USING utf8)',
                    'callback'=>array('tplReplace',C('TPL_DETAIL_BTN')),
                    'search' => array(
                        'query' => 'like' 
                    ),
                    // 'width'=>'20px',
                ),
            ),
			'phone'=>array(
				'title'=>'登录账号（手机号）',
				'list'=>array(
					'search' => array(
							'query' => 'like' 
					) 
				),
				'form' => array (
                    'validate' => array (
                        'required' => true,
                        'regex' => '^1[34578]\d{9}$',

                    ),
				)
			),
			
			'password'=>array(
				'form'=>array(
					'title'=>'密码（重置）',
					'add'=>false,
					'callback'=>array('clean'),
					'fill'=>array(
						'edit'=>array('pwdEncrypt'),
					)
				)
			),

			'truename'=>array(
				'title'=>'真实姓名',
				'list'=>array(
					'search' => array(
                        'query'=>'like'
                    )
				),
				'form'=>array(
				),
			),
			'sex'=>array(
				'title'=>'性别',
				'list'=>array(
					'callback'=>array('get_sex')
				),
				'form'=>array(
					'type' =>'select',
				)
			),
			'address'=>array(
				'title'=>'地址',
				'list'=>array(
					
				),
				'form'=>array(
				
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
				'title'=>'注册时间',
				'list'=>array(
					'callback'=>array('dataTotime'),
				),
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
			),
            'identification_id'=>array(
                // 'title'=>'身份证'
            ),
            'is_identification'=>array(
                'title'=>'实名认证状态',
                'list'=>array(
                    'callback'=>array('isIdentified')
                ),
                'form'=>array(
                    'type'=>'select'
                )
            )
		);
	}

    public function detail($pk){
        $where=array($this->getPk()=>$pk);
        $arr = $this->associate(array('frame_file|identification_id|id|savepath,savename'))->where($where)->field('id,username,is_identification')->find();

        $is_disabled1 = false;
        $confirm_info = '';
        switch ($arr['is_identification']) {
            case 9:
                $is_disabled = false;
                
                $confirm_info = "未进行实名认证";
                break;
            case 2:
                $is_disabled = true;
              
                $confirm_info = "已进行实名认证";
                break;
            case 3:
                $is_disabled = true;
        
                $confirm_info = "实名认证不通过";
                break;
        }
        $data = is_null($arr)?['table'=>null]:[
            'table'=>[
                'path'=>is_null($arr['savepath'])?null:(__ROOT__."/Public".substr($arr['savepath'],1).$arr['savename']),
                'username'=>$arr['username'],
                'is_disabled'=>$is_disabled,
              
                'confirm_info'=>$confirm_info,
                'id'=>act_encrypt($arr['id'])
            ]
        ];
        return $data;
    }

	protected function callback_get_sex($sex){
        return $sex == 1? '男':'女';
    }

    protected function callback_clean(){
        return '';
    }

    protected function callback_pwdEncrypt($str){
        if(is_string($str) && ''!==trim($str)) 
        	return md5(C('CRYPT_KEY_PWD').$str);
        return false;
    }

    protected function getOptions_sex(){
        return array(1 => '男',2 => '女');
    }

    protected function getOptions_is_identification(){
        return array(
            0 => '未上传图片',
            9 => '待审核',
            2 => '已通过',
            3 => '审核失败'
        );
    }

    protected function callback_isIdentified($data){
        $res = '';
        switch($data){
            case 0:
                $res = '<span style="color:red;">未上传</span>';
                break;
            case 9:
                $res = '<span style="color:orange;">待审核</span>';
                break;
            case 2:
                $res = '<span style="color:green;">已认证</span>';
                break;
            case 3:
                $res = '<span style="color:red;">审核不通过</span>';
                break;
        }

        return $res;
       
    }

    

    protected function ajax_judgeRepeat(&$json){
    	$data = I();
        $name = $data['name'];
        $value = $data['value'];

    	$res = $this
    			->where(
    				array(
	    				'status'=>1,
	    				$name=>array('eq',$value)
    				)
    			)
    			->find(); 

    	if($res){
    		$json['status'] = false;
    		$json['info'] = '该手机号已存在！';
            return ;
    	}

    	$json['status'] = true;
		$json['info'] = '手机号可修改！';
    }

    protected function callback_dataTotime($time){
        return to_time($time,2);
    }

    protected function ajax_isIdentified(&$json){
        $type = I('type');
        if($type == 1){

            $res = $this->where(['id'=>act_decrypt(I('id'))])->save(['is_identification'=>2]);

            if(!!$res){
                $json['info'] = '实名认证成功！';
                $json['status'] = true;
            }else{
                $json['info'] = '实名认证失败！';
                $json['status'] = false;
            } 
        }else if($type == 2){
            $res = $this->where(['id'=>act_decrypt(I('id'))])->save(['is_identification'=>3]);
            if(!!$res){
                $json['info'] = '已拒绝此次认证！';
                $json['status'] = true;
            }else{
                $json['info'] = '拒绝认证失败！';
                $json['status'] = false;
            }       
        }
    }
}
