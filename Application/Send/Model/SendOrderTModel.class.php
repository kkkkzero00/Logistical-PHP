<?php
namespace Send\Model;
use Common\Model\HyAllModel;
use System\Model\HomkaiServiceModel;
use Send\Model\SendOrderModel;

/**
 * 
 *
 * @author
 */
class SendOrderTModel extends SendOrderModel {

    protected static $userTab;

    protected function _initialize(){
        parent::_initialize();

        if(self::$userTab == null){
            self::$userTab = M('User');
        }
    }

    protected function initSqlOptions() {
        $userId = ss_uid();
        $res = self::$userTab
                ->where(array('status'=>1,'id'=>$userId))
                ->field('area_id')
                ->find();
        return array (
            'where'=>array (
                    'status'=>array('neq',0),
                    'dot'=>array('eq',$res['area_id'])
                    )
            );
    }

    protected function initPageOptions() {
        return array (
                'checkbox'  => true,
                'deleteType'=> 'delete',
                'actions'   => array (
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
                'buttons'   => array(
                        'add'=>array(
                                'title'=>'新增',
                                'icon'=>'fa-plus'
                        )
                ),
                'tips'=>array(
                    'add'=>'请按格式填写!',
                    'edit'=>'请按格式填写!'
                ),
                'initJS'  => 'LodopFuncs,Send',
                'detailTpl' => 'Send@Send/detail',
                'detailTpl_status' => 'Send@Send/detail_s',
        );
    }
}
