<?php
namespace Website\Model;
use Common\Model\HyAllModel;
/**
 * 重要公示管理模型
 *
 * @author Sameen
 */
class AnnounceModel extends HyAllModel{
    /**
     * @overwrite
     */
    protected function initTableName(){
        return 'announce';
    }
    /**
     * @overwite
     */
    protected function initInfoOptions(){
        return array(
            'title'=>'重要公示',
            'subtitle'=>'管理前台顶部滚动的重要公示信息'
        );
    }
    protected function initSqlOptions(){
        return array(
            'associate'=>array(
                'user|publisher_id|id|name as publisher_id_text||left'
            ),
            'where'=>array(
                'status'=>array('lt',9)
            )
        );
    }
    protected function initPageOptions(){
        return array(
            'checkbox'=>true,
            'deleType'=>'status|9',
            'action'=>array(
                'edit'=>array(
                    'title'=>'编辑',
                    'max'=>1
                ),
                'delete'=>array(
                    'title'=>'删除',
                    'confirm'=>true
                )
            ),
            'bottons'=>array(
                'add'=>array(
                    'title'=>'新增',
                    'icon'=>'fa-plus'
                )
            )
        );
    }
    protected function initFieldsOptions(){
        return array(
            'title'=>array(
                'title'=>'公示标题',
                'list'=>array(
                    'order'=>false,
                ),
                'form'=>array(
                    'type'=>'text',

                )

            ),

            'content'=>array(
                'title'=>'公示内容',
                'list'=>array(
                    'order'=>false,
                ),
                'form'=>array(
                    'type'=>'textarea',
                    'attr'=>'style="height:200px;"'

                )
            ),

            'publisher_id'=>array(
                'list'=>array(
                    'title'=>'公示人',
                    'order'=>false,
                    'callback'=>array('value','{:publisher_id_text}')
                ),
                'form'=>array(
                    'fill'=>array(
                        'both'=>array('value',ss_uid())
                    )
                )
            ),
            'link'=>array(
                'title'=>'公告链接',
                'list'=>array(
                    'order'=>false,
                ),
                'form'=>array(
                    'type'=>'text',


                )
            ),
            'create_time'=>array(
                'list'=>array(
                    'title'=>'发布时间',
                    'order'=>false,
                    'callback'=>array('getCtime')
                ),
                'form'=>array(
                    'fill'=>array(
                        'both'=>array('value',time())
                    )
                )
            ),

            'status' => array(
                'title' => '状态',
                'list' => array(
                    'width' => '30',
                    'callback' => array('status')
                ),
                'form' => array(
                    'type' => 'select',
                )
            )

        );
    }
    protected function callback_getPtime($time){
        return date('Y-m-d',$time);
    }
    protected function callback_getCtime($time){
        return date('Y-m-d',$time);
    }
}
