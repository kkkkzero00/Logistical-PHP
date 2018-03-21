<?php
namespace System\Model;
use Common\Model\HyAccountModel;
use Common\Controller\HyFrameController;
use Common\Model\HyAllModel;

/**
 * 用户编辑模型
 *
 * @author
 */
class UserModel extends HyAllModel {

    /**
     * @overrides
     */
    protected function initTableName(){
        return 'user';
    }

    /**
     * @overrides
     */
    protected function initInfoOptions() {
    }
    /**
     * @overrides
     */
    protected function initSqlOptions() {
        return array(
            'decrypt'=>true,
            // 'initJS'=>'userProfile',
        );
    }
    /**
     * @overrides
     */
    protected function initPageOptions() {
        return array(
            'initJS'=>'userProfile',
        );
    }
    /**
     * @overrides
     */
    protected function initFieldsOptions() {
        return array(

        );
    }
    /**
     * 写入回调 - 密码加密
     * @param string $str
     * @return string | boolean
     */
//    protected function callback_pwdEncrypt($str){
//        if(is_string($str) && ''!==trim($str)) return D('HyAccount')->pwdEncrypt($str);
//        return false;
//    }
    /**
     * 个人信息修改入口
     * @param array $json
     */
    public function getBaseInfoFields(){
        return array(
            'phone'=>array('name'=>'电话'),
            'qq'=>array('name'=>'QQ号'),
            'email'=>array('name'=>'电子邮箱')
        );
    }
    public function ajax_updateMe(&$json){
        $data['phone']=val_encrypt(I('phone'));
        $data['qq']=I('qq');
        $data['email']=I('email');
        $json['data']=$data;

        foreach ($this->getBaseInfoFields() as $k=>$v) $this->updateFields[]=$k;

        $json['status']=!! M('user')->where(array('id'=>ss_uid()))->save($data);
        $json['info']=($json['status'] ? '信息编辑成功！' : ($this->getError() ?: '信息编辑失败！'));
    }

    /**
     * 个人密码修改入口
     * @param array $json
     */
    public function ajax_pwdMe(&$json){
        $aM=new HyAccountModel();
        $this->updateFields[]='password';
        $p = $aM->pwdDecrypt($this->getFieldById(ss_uid(),'password'));
        $key = substr($p, 5, 32);
        $true = aes_decrypt_base(I('p'), $key);
        if($true!=$p){
            $json['info']='旧密码输入有误！';
            return false;
        }
        $_POST['password']=$aM->pwdEncrypt(trim(I('password')));
        $json['status']=!!$this->update(ss_uid());
        $json['info']=($json['status'] ? '密码修改成功！' : ($this->getError() ?: '密码修改失败！'));
    }

    public function profile(){
        $user=$this->where(array('id'=>ss_uid()))->find();
        $user['phone']=val_decrypt($user['phone']);
        $user['base']=array(
            '最后登陆时间'=>to_time($user['login_last_time']),
            '累计登录次数'=>$user['login_times'].'次',
        );
        $user['form']=$this->getBaseInfoFields();
        $user['logs']=M('frame_log')->where(array('user_id'=>ss_uid(),'status'=>1,'controller'=>'HyStart','action'=>'ajax'))->order('id desc')->getField('id,create_time,ip,description',5);

        return $user;
    }

}
