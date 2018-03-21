<?php
/**
 * 登录用户UID
 * @return number
 */
function ss_uid(){
    return session('userId');
}

/**
 * 用户所属学院id
 * @return number
 */
function ss_clgid(){
	return session('collegeId');
}
/**
 * 登录学生所在班级id
 * @return number
 */
function ss_clsid(){
	return session('classId');
}
function get_express_name($id){
	$tem = M('express_name')->where(array('id' => $id))->getField('name',true);
    return $tem[0];
}
function get_area_name($id){
   $tem = M('area')->where(array('id' => $id))->getField('area_name',true);
   return $tem[0];
}
/**
 * 统计SendOrder表的金额
 * @return array
 */
function SendOrder_total_money($lists){
	$all_need = 0;//统计本页面所有'need_payment'
	$all_received = 0;//同上
	foreach($lists as $k => $v){
		$all_need +=$v['need_payment'];
		$all_received +=$v['received_money'];
	}
	$arr = array(
		'sender' => '<b title=" 总计 " class="btn btn-xs red" > 总 计 </b>',
		'sender_phone' => '',
		'sender_company' => '',
		'sender_address' => '',
		'receiver' => '',
		'receiving_phone' => '',
        'receiving_company' => '',
        'receiving_address' => '',
        'express_remarks' => '',
        'sender_estimated_weight' => '',
	    'need_payment' => $all_need,
	    'received_money' => $all_received,
	    'express_payment' => '',
        'courier_number' => '',
        'dot' => '',
        'fetchgoods_remarks' => '',
        'price_area' => '',
        'express_id' => '',
        'weight' => '' ,
        'order_status' => '',
        'create_time' => '',
        'update_time' => null,
        'area_id' => '',
        'status' => '',
		);
	return 	$arr;
}