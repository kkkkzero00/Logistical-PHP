<?php
/**
 * Created by PhpStorm.
 * User: shuojie
 * Date: 2015/7/19
 * Time: 16:36
 */
/**
 * Created by PhpStorm.
 * User: shuojie
 * Date: 2015/7/19
 * Time: 16:35
 */
namespace  Website\Model;
use Common\Model\HyAllModel;
/**
 * 友情链接管理模型
 *
 * @author
 */
class FriendLinkModel extends HyAllModel{

    /*
     * @overrides
     * */
    protected function initTableName(){

        return 'friend_link';
    }
    /**
     * @overrides
     */
    protected function initInfoOptions(){

        return array(
            'title'=>'友情链接管理信息',
            'subtitle'=>'管理网站友情链接及专题链接'
        );
    }
    /**
     * @overrides
     */
    protected function initSqlOptions(){

        return array(
			'associate'=>array(
				'frame_file|img|id|name as file_name||LEFT'
			),
            'where' => array(
                'status'=>array('eq',1)
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
								'confirm' => true
						)
				),
				'buttons'	=> array(
						'add'=>array(
								'title'=>'新增链接',
								'icon'=>'fa-plus'
						)
				),
				'initJS'	=> array(
					'friendLink'
				),
            'tips'=>array(
                'add'=>'如是友情链接类型，无需上传图片，如是专题展示，必须上传图片',
                'edit'=>'如是友情链接类型，无需上传图片，如是专题展示，必须上传图片'
            )
		);
	}
    /**
     * @overrides
     */
    protected function initFieldsOptions(){

        return array(
			'type'=>array(          //0是普通链接,1是主题链接
                'title'=>'类型',
				'list'=>array(
                    'callback'=>array('getType')
				),
				'form'=>array(
					'type'=>'select',
				)
			),
            'name'=>array(
                'title'=>'链接名称',
                'list'=>array(
                    'search' => array (
                        'query' => 'like'
                    )
                ),
                'form' => array (
                        'validate' => array (
                              'required' => true,
                        )
                 )
             ),
            'file_name'=>array(
                'list'=>array(
                    'title'=>'图片名称'
                )
            ),
            'url'=>array(
                'title'=>'链接地址',
            	'form' => array (
            			'type' => 'text',
            			'validate' => array (
            					'required' => true ,
            					'regex' => '^((https?|ftp|news):\/\/)?([a-z]([a-z0-9\-]*[\.。])+([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&]*)?)?(#[a-z][a-z0-9_]*)?$'
            			),
                    'tip'=>'示例：http://www.jxnu.edu.cn'
            	)
            ),
			'img'=>array(
				'title'=>'图片下载',
				'list'=>array(
					'callback'=>array('fileDown'),
					'order'=>false

				),
				'form'=>array(
                    'hidden'=>true,
					'title'	=>'轮播图片',
					'type'=>'file',
					'file'=>array(
						'ext'=>'jpg,png'
					),
                    'tip'=>'仅限上传jpg、png格式的图片',

				)
			),
            'rank' => array(
                'title'=>'权重',
                'list'=>array(),
                'form'=>array(
                    'type'=>'text',
                    'validate'=>array(
                        'regex'=>'^\d{0,3}$'
                    ),
                    'tip'=>'权重数值0-999'
                )
            ),
            'create_time'=>array(
                'list'=>array(
                    'title'=>'创建时间',
                    'callback'=>array('dateToTime')
                ),
                'form'=>array(
                    'fill'=>array(
                        'add'=>array('value',time()),
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

	protected function getOptions_type(){
		return array(
			'1'=>'专题展示',
            '0'=>'友情链接',
		);
	}
    protected function callback_dateToTime($time){
        return date('Y-m-d',$time);
    }

	protected function callback_getType($type){
		if($type==0){
			return '友情链接';
		}
        else if($type==1){
			return '<span style="color: green;">专题展示</span>';
		}
	}
}
