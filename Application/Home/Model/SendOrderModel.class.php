<?php
namespace Home\Model;
use Think\Model;
class SendOrderModel extends BaseModel{
	function getexpressname(){
		$name=D('express_name')->where('status=1')->select();
		return $name;
	}
	function getdot(){
		return M('area_manage')->where('status = 1')->select();
	}
	public function getaddr(){
		$userid=cookie('id');
		$addr=M('addr')->where(array('userid'=>$userid,'sign'=>1,'status'=>1,'flag'=>0))->field('addr')->find();
		return $addr;
	}

 public function ChangeStatus($value){
		if(!empty($value)){//1未称重2未付款3未付款(现金支付)4未打印5未发货6已发货
			for($i=0;$i<count($value);$i++){
				switch ($value[$i]['order_status']) {
					case 1:
						$value[$i]['order_status']="未称重";
						break;
					case 2:
						$value[$i]['order_status']="未付款";
						break;
					case 3:
						$value[$i]['order_status']="现金支付（未付款）";
						break;
					case 4:
						$value[$i]['order_status']="未打印";
						break;
					case 5:
						$value[$i]['order_status']="未发货";
						break;	
					case 6:
						$value[$i]['order_status']="已发货";
						break;
                    case 7:
                        $value[$i]['order_status']="未签收";
                        break;
                    case 8:
                        $value[$i]['order_status']="已签收";
                        break;
					default:
						$value[$i]['order_status']="未处理";
						break;
				}
			}
				
		}
	
		
		return $value;
	}
	public function DeepChangeStatus($value){
		if(!empty($value)){//1未称重2未付款3未打印4未发货5已发货

			for($i=0;$i<count($value);$i++){
				if($value[$i]['order_status']=='1'){
					$value[$i]['order_status']="未称重";
				}else if ($value[$i]['order_status']=='2') {
					$value[$i]['order_status']="未付款";
				}else if ($value[$i]['order_status']=='3') {
					$value[$i]['order_status']="现金支付（未付款）";
				}else if ($value[$i]['order_status']=='4') {
					$value[$i]['order_status']="未打印";
				}else if ($value[$i]['order_status']=='5') {
					$value[$i]['order_status']="未发货";
				}else if ($value[$i]['order_status']=='6') {
					$value[$i]['order_status']="已发货";
				}
                else if ($value[$i]['order_status']=='7') {
                    $value[$i]['order_status']="未签收";
                }
                else if ($value[$i]['order_status']=='8') {
                    $value[$i]['order_status']="已签收";
                }else{
					$value[$i]['order_status']="未处理";
				}
			}
		
		}
		return $value;
	}
	
}
