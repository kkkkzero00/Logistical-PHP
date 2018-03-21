<?php
namespace Home\Model;
use Think\Model;
class UsersModel extends BaseModel{
	protected $_validate = array(
		array('verify','checkVerify','验证码错误！',1,'callback',4), 
	 	array('phone','checkName','不存在这个账号',1,'callback',4),   
	 	array('password','checkPassword','密码错误！',1,'callback',4)
	 	 );
   public function checkName(){
		$data['name']=$_POST['username'];
	    $ckN = $this->where(array('status'=>1,'phone'=>$data['name']))->find();
		if($ckN){ 
				return true;
			}else{
				return false;
		}	
	}
	public function checkPassword(){
		$data['name']=$_POST['username'];
		$pass = C(CRYPT_KEY_PWD).$_POST['password'];
		$data['password']=md5($pass);
	    $ckP = $this->where(array('status'=>1,'password'=>$data['password'],'phone'=>$data['name']))->find();
		if($ckP){ 
			 cookie('name',$ckP['username'],3000);
  			 cookie('password',$ckP['password'],3000);
   			 session('name',$ckP['username']);
  			 session('password',$ckP['passwrd']);
  			 session('id',$ckP['id']);
				return true;
			}else{
				return false;
		}	

	}
	function checkVerify($code,$id = ''){
	    $verify = new \Think\Verify();    
	    return $verify->check($code,$id);
	}

	public function adduser($array){
		$get=$this->create();
		$pass = C(CRYPT_KEY_PWD).$get['password'];
		$get['password']=md5($pass);
		$get['create_time'] = time();
		$get['is_identification'] = 0;
		$gets=$this->data($get)->add();
		return $gets;
	}
	public function getuserinfo(){
		$userid = session('id');
		$userinfo = D('users')->where(array('id'=>$userid))->field('phone,truename')->find();
		return $userinfo;
	}
}
