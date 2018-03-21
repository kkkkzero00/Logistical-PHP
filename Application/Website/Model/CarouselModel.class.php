<?php
/**
 * Created by PhpStorm.
 * User: shuojie
 * Date: 2015/7/19
 * Time: 16:35
 */
namespace  Website\Model;
use Common\Model\HyAllModel;
/**
 * 轮播管理模型
 *
 * @author yunliuyan
 */
class CarouselModel extends HyAllModel{

     /*
      * @overrides
      * */
    protected function initTableName(){

        return 'banner';
    }
    /**
     * @overrides
     */
    protected function initInfoOptions(){
        return array(
          'title'=>'轮播管理信息',
          'subtitle'=>'管理首页背景轮播图片'
        );
    }
    /**
     * @overrides
     */
    protected function initSqlOptions(){
        return array(
        	'associate'=>array(
        		'frame_file|img_title|id|name||LEFT'
        	),
            'where' => array(
                'status'=>array('eq',1)
            )
        );
    }
    /**
     * @overrides
     */
    protected  function  initPageOptions(){
        return array(
            'checkbox'=>true,
            'deleteType'=>'status|9',
            'action'=>array(
                'edit'=>array(
                    'title'=>'编辑',
                    'max'=>1
                ),
                'delete'=>array(
                    'title'=>'删除',
                    //确认是否要删除
                    'confirm'=>true
                )
            ),
            'buttons'=>array(
                'add'=>array(
                    'title'=>'新增轮播图片',
                    'icon'=>'fa-plus'
                )
            )

        );
    }
    /**
     * @overrides
     */
    protected function initFieldsOptions(){
        return array(
       'name'=>array(
           'title'=>'图片名称',
           'list'=>array(
               'order'=>false
           )
       ),
            'img_title'=>array(
                'title'=>'图片下载',
                'list'=>array(
                    'callback'=>array('fileDown'),
                    'order'=>false

                ),
                'form'=>array(
                    'title'	=>'轮播图片',
                    'type'=>'file',
                    'file'=>array(
                        'ext'=>'jpg,png'
                    )
                )
            ),
            'create_time'=>array(
						'list'=>array(
                                'title'=>'创建时间',
								'callback'=>array('dataTotime')
						),
						'form'=>array(
								'fill'=>array(
										'add'=> array('value',time()),
								)
						)
            ),
            'index_show'=>array(
                    'title'=>'首页显示',
                    'list'=>array(
                            'callback'=>array('getIndex')
                    ),
                    'form'=>array(
                            'title'=>'设置轮播图片',
                            'type'=>'select',
                            'style'=>'no_bs_select',
                            'tip' => '只能设置一张图片为轮播图片第一张显示！',
                            'validate'=>array(
                                'required'=>true,
                            )


                    )
            )
        );
    }
    protected function getOptions_index_show(){
        return array(
            '1'=>'显示',
            '2'=>'显示并且第一张显示',
            '0'=>'不显示'
        );
    }
    protected  function callback_dataTotime($time){
//        return $time;
    	return to_time($time);
    }
    protected function callback_TimeTodate($t){
    	return strtotime($t);
    }
    protected function callback_getIndex($index_show){
        if(!$index_show){
            return '<p style="color:#aaaaaa;">不显示</p>';
        }
        elseif($index_show==1){
            return '<p style="color:#00b200;">显示</p>';
        }
        elseif($index_show==2){
            return '<p style="color:blue;">显示且第一张显示</p>';
        }

    }

    //下面是林金章写的点击进去后可下载
  /*  protected function callback_getName($id) {
        return M('frame_file')->where ( array (
            'id' => $id
        ) )->getField ( 'name' );
    }*/




}
