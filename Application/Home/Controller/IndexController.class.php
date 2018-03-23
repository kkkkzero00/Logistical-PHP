<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends BaseController
{
    public function _initialize()
    {
        parent::_initialize();
    }

    public function index()
    {   
        $this->display();
    }
    public function resetpass()
    {
        $this->display();
    }
    //智能拆分地址
    public function intelResolution(){

        //if(IS_POST){
        //$addrsign=M('addr')->where(array('userid'=>$_SESSION['id'],'sign'=>1,'status'=>1))->find();
        //原始地址
        $addr = trim($_POST['data']);
        //$addr = '河曦南南昌市南昌县高新开发区师大';
        // var_dump($addr);
        //过滤非法字符,获取当前字符的编码
        $encode = mb_detect_encoding($addr, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
        // var_dump($encode);
        $str_encode = mb_convert_encoding($addr, 'UTF-8', $encode);

        // var_dump($str_encode);

        /*/u 表示按unicode(utf-8)匹配（主要针对多字节比如汉字）*/
        $illegal_char = '/[^\dA-Za-z\x{4e00}-\x{9fa5}\-]/u';//匹配非汉字字母数字下划线
        $replace = '';
        //把汉字字母数字下划线意外的字符给去掉
        $addr = preg_replace($illegal_char,$replace,$addr);
        // var_dump($addr);
        //拆分后地址
        $province_id = null;
        $city_id = null;
        $detail_addr = null;

        //先进行省份检索
        $provinces = M('area')->where(array('area_deep' => array('eq',1))
        )->getField('id,area_name',true);

        foreach($provinces as $k => $province){
            //如果检索到可能的省份
            if(($pro_position = mb_strpos($addr, $province)) !== false){
                $province_id = $k;
                $citys = M('area')->where(
                    array('area_deep' => array('eq',2),'area_parent_id' => array('eq',$province_id))
                )->getField('id,area_name',true);
                // var_dump($citys);
                //根据可能的省份尝试检索城市
                foreach($citys as $v => $city){

                    $city = trim($city);
                    if(($city_position = mb_strpos($addr, $city)) !== false){
                        $city_id = $v;
                        $cityLen = mb_strlen($city);
                        break 2;//跳出两重循环
                    }
                    $cityLen = mb_strlen($city);
                    //如果上一步未检索到，执行模糊检索
                    if($city_id == null && mb_substr($city, $cityLen-1, $cityLen, 'utf-8') == '市'){
                        $city = mb_substr($city, 0, $cityLen-1, 'utf-8');

                        if(($city_position = mb_strpos($addr, $city)) !== false){
                            $city_id = $v;
                            $cityLen = mb_strlen($city);
                            break 2;
                        }
                    }
                }
            }
        }

        //通过省份未检索成功则直接通过地级市检索
        if($province_id == null || $city_id == null){
            //清空之前检索的状态
            $province_id = null;
            $city_id = null;

            $citys = M('area')->where(
                array('area_deep' => array('eq',2))
            )->getField('id,area_name,area_parent_id',true);


            foreach($citys as $k => $city){
                if(($city_position = mb_strpos($addr, $city['area_name'])) !== false){
                    $city_id = $city['id'];
                    $cityLen = mb_strlen($city['area_name']);
                    $province_id = $city['area_parent_id'];
                    break;
                }
                //如果上一步未检索到，执行模糊检索
                $cityLen = mb_strlen($city['area_name']);

                if(mb_substr($city['area_name'], $cityLen-1, $cityLen, 'utf-8') == '市'){
                    $city['area_name'] = mb_substr($city['area_name'], 0, $cityLen-1, 'utf-8');
                    if(($city_position = mb_strpos($addr, $city['area_name'])) !== false){
                        $city_id = $city['id'];
                        $cityLen = $cityLen-1;
                        $province_id = $city['area_parent_id'];
                        break;
                    }
                }
            }
        }

        //切割详细地址
        $detail_addr = mb_substr($addr, $city_position + $cityLen, mb_strlen($addr), 'utf-8');
        var_dump($detail_addr);
        //返回ajax数据
        $province_name = M('area')
                        ->where(
                            array('id' => array('eq',$province_id))
                        )
                        ->getField('id,area_name',true);

        $city_name = M('area')
                        ->where(
                            array('id' => array('eq',$city_id))
                        )
                        ->getField('id,area_name',true);
        
        $data = array(
            $province_name[$province_id],
            $city_name[$city_id],
            $detail_addr
        );

        $this->ajaxReturn($data);
        //}
    }

    public function citysend(){
        $uid = session('id');
        if (!empty($uid)) {
            if (isset($_POST['submit'])) {
                if (!empty($_POST['sender']) && !empty($_POST['senderphone']) && !empty($_POST['recipients2']) && !empty($_POST['receivename']) && !empty('receivephone') && !empty($_POST['sendaddr']) && !empty($_POST['remark2'])) {
                    $data['sender'] = I('post.sender');//寄件人姓名
                    $data['sender_phone'] = I('post.senderphone');//寄件人手机号
                    $data['sender_address'] = I('post.recipients2');//寄件地址
                    $data['fetchgoods_remarks'] = I('post.remark1');//取件方式备注
                    $data['dot'] = I('post.wangdian');
                    $data['express_remarks'] = I('post.remark2');//快递备注
                    $data['receiver'] = I('post.receivename');//收件人姓名
                    $data['receiving_company'] = I('post.cunit');//收件单位
                    $data['receiving_phone'] = I('post.receivephone');//收件人手机号
                    $data['receiving_address'] = I('post.sendaddr');//收件人地址
                    $data['sender_estimated_weight'] = I('post.weight');//预计重量
                    $data['order_status'] = 1;
                    $data['sender_userId'] = $uid;
                    $data['create_time'] = time();
                    $flag = I('post.flag');
                    if ($flag == 1) {
                        $addr['userid'] = $uid;
                        $addr['addr'] = $data['sender_address'];
                        $addr['sign'] = 1;
                        $addr['flag'] = 1;
                    } elseif ($flag == 0) {
                        $addr['userid'] = $uid;
                        $addr['addr'] = $data['sender_address'];
                        $addr['sign'] = 0;
                        $addr['flag'] = 1;
                    } else {

                    }
                    $flag = M('addr')->create($addr);
                    $flagdata = M('addr')->add();
                    $data = M('city_send')->create($data);
                    $dataflag = M('city_send')->add();
                    if ($dataflag) {
                        $this->success('下单成功，即将跳转至订单界面', U('index/citysendorder'), 1);
                    } else {
                        $this->error('下单失败，请确认登录并数据无误后重试！');
                    }
                } else {

                }
            } else {

            }
        } else {
            $this->error('您未登录!请先登录后再试！', U('index/login'), 1);
        }
        $sendorder = D('SendOrder');
        $userinfo = D('Users')->getuserinfo();
        $wang = $sendorder->getdot();
        $addr=
            M('addr')->where(
                array('userid'=>$uid,'sign'=>1,'status'=>1,'flag'=>1))->field('addr')->find();
            
        $this->assign('wangdian',$wang)
            ->assign('userinfo',$userinfo)
            ->assign('addr',$addr);
        $this->display();
    }

    public function managecitysend(){
        $uid = session('id');
        $id=I('get.id');
        if (!empty($uid)) {
            if (isset($_POST['submit'])&&isset($id)) {
                if (!empty($_POST['sender']) && !empty($_POST['senderphone']) && !empty($_POST['recipients2']) && !empty($_POST['receivename']) && !empty('receivephone') && !empty($_POST['sendaddr']) && !empty($_POST['remark2'])) {
                    $data['sender'] = I('post.sender');//寄件人姓名
                    $data['sender_phone'] = I('post.senderphone');//寄件人手机号
                    $data['sender_address'] = I('post.recipients2');//寄件地址
                    $data['fetchgoods_remarks'] = I('post.remark1');//取件方式备注
                    $data['dot'] = I('post.wangdian');
                    $data['express_remarks'] = I('post.remark2');//快递备注
                    $data['receiver'] = I('post.receivename');//收件人姓名
                    $data['receiving_company'] = I('post.cunit');//收件单位
                    $data['receiving_phone'] = I('post.receivephone');//收件人手机号
                    $data['receiving_address'] = I('post.sendaddr');//收件人地址
                    $data['sender_estimated_weight'] = I('post.weight');//预计重量
                    $data['order_status'] = 1;
                    $data['sender_userId'] = $uid;
                    $data['update_time'] = time();
                    $flag = I('post.flag');
                    if ($flag == 1) {
                        $addr['userid'] = $uid;
                        $addr['addr'] = $data['sender_address'];
                        $addr['sign'] = 1;
                        $addr['flag'] = 1;
                    } elseif ($flag == 0) {
                        $addr['userid'] = $uid;
                        $addr['addr'] = $data['sender_address'];
                        $addr['sign'] = 0;
                        $addr['flag'] = 1;
                    } else {

                    }
                    $flag = M('addr')->create($addr);
                    $flagdata = M('addr')->add();
                    $data = M('city_send')->where(array('id'=>$id))->save($data);
                    if ($data) {
                        $this->success('修改成功，即将跳转至订单界面', U('index/citysendorder'), 1);
                    } else {
                        $this->error('修改失败，请确认登录并数据无误后重试！');
                    }
                } else {
                    
                }
            } else {

            }
            $info=M('city_send')->where(array('id'=>$id))->find();
           

           
            $this->assign('info',$info);
        
            
        } else {
            $this->error('您未登录!请先登录后再试！', U('index/login'), 1);
        }
        $this->display();
    }

    public function tongcheng()
    {
        $this->display();
    }

    public function addr()
    {
        $this->display();
    }

    public function order(){
        $userid=session('id');
        if (isset($_POST['submit']) && isset($userid)) {
            if (!empty($_POST['sender']) && !empty($_POST['senderphone']) && !empty($_POST['receivename']) && !empty($_POST['receivephone'])) {
                if (!empty($_POST['recipients2'])) {
                    $senderaddr = I('post.recipients2');
                }
                if (!empty(!empty($_POST['recipients3']))) {
                    $senderaddr = I('post.s_province') . I('post.s_city') . I('post.recipients3');
                }
                if (!empty($_POST['recipients'])) {
                    $senderaddr = I('post.s_province') . I('post.s_city') . I('post.recipients');
                }
                $s_province = M('area')->where('area_deep=1')->select();
                foreach ($s_province as $key => $value) {
                    if (strstr($_POST['c_province'], $value['area_name'])) {
                        $s_id = $value['id'];
                    } else {
                        $s_id = NULL;
                    }
                    if (strstr($_POST['c_city'], '南昌市')) {
                        $s_id = 212;
                    }
                }
                $senderaddr2 = $_POST['c_province'] . $_POST['c_city'] . $_POST['sendaddr'];
                $data = array(
                    'sender' => $_POST['sender'],//寄件人姓名
                    'sender_phone' => $_POST['senderphone'],//寄件人手机号
                    'sender_company' => $_POST['junit'],//寄件人单位
                    'sender_address' => $senderaddr,//寄件详细地址
                    'fetchgoods_remarks' => $_POST['remark1'],//取件方式

                    'receiver' => $_POST['receivename'],//收件人姓名
                    'receiving_phone' => $_POST['receivephone'],//收件人手机号
                    'receiving_company' => $_POST['cunit'],//收件单位
                    'receiving_address' => $senderaddr2,//收件详细地址

                    'express_id' => $_POST['expressname'],//快递公司
                    'sender_estimated_weight' => $_POST['weight'],//预计重量
                    'express_remarks' => $_POST['remark2'],//快递备注
                    'create_time' => strtotime(date('Y-m-d H:i:s')),
                    'sender_userId' => $_SESSION['id'],
                    'price_area' => $s_id,
                    'order_status' => "1",//1未称重2未付款3未打印4未发货5已发货
                    'dot' => $_POST['wangdian'],
                );
                $data = M('send_order')->create($data);
                $flag = M('send_order')->add();
                $addrsign = M('addr')->where(array('userid' => $_SESSION['id'], 'sign' => 1, 'status' => 1))->find();
                if ($addrsign) {
                    $addrdata = array('userid' => $_SESSION['id'], 'addr' => $senderaddr, 'sign' => 0);
                    $addrdatas = M('addr')->create($addrdata);
                    $addrflag = M('addr')->add();
                } else {
                    $addrdata = array('userid' => $_SESSION['id'], 'addr' => $senderaddr, 'sign' => 1);
                    $addrdatas = M('addr')->create($addrdata);
                    $addrflag = M('addr')->add();
                }
                if ($flag) {
                    $this->success('下单成功即将跳转至个人用户中心!', U('Index/userinfo'), 2);
                } else {
                    $this->error('系统错误，下单失败！');
                }
            } else {
                $this->error('信息不全，下单失败！');
            }
        } else {

        }
        $sendorder = D('SendOrder');
        $userinfo = D('Users')->getuserinfo();
        $name = $sendorder->getexpressname();
        $wang = $sendorder->getdot();
        $addr = $sendorder->getaddr();
        $shiming = D('users')->where(array('id'=>$userid))->field('is_identification')->find();
        $this
            ->assign('expressname', $name)
            ->assign('wangdian', $wang)
            ->assign('addr', $addr)
            ->assign('flag', $flag)
            ->assign('shiming',$shiming)
            ->assign('userinfo',$userinfo);
        $this->display();
    }

    public function search(){

        if (isset($_POST['submit'])) {
            // var_dump($_POST['submit']);
            $ExpressNumber = I('post.number');
            $ExpressNumbe = explode(',',$ExpressNumber);
            
            $count=count($ExpressNumbe);
            
            $receivingorder=M('receiving_order');
            for($i=0;$i<$count;$i++){
                $exid[$i]=trim($ExpressNumbe[$i]);
            }
            
            $info = $receivingorder->alias('a')
            ->join('__AREA_MANAGE__ as b on a.area_id = b.id')
            ->where(array('a.courier_number' => array('in',$exid)))
            ->select();
            // var_dump($info);
            $info = D('SendOrder')->DeepChangeStatus($info);
            
               
            $this->assign('info', $info);
        }

        $this->display();
    }

    public function register()
    {
        $this->display();
    }

    public function thinginfo()
    {
        $userid = session('id');
        if (!empty($userid)) {
            $thinginfo = M('express_name')->alias('a')->join('__SEND_ORDER__ b on a.id=b.express_id')->where(array('b.sender_userId' => $userid, 'b.status' => 1))->order('create_time desc,b.id desc')->page($_GET['p'] . ',5')->select();
            $user = M('users')->where(array('id' => $userid, 'status' => 1))->field('img_id')->find();
            $userimg = M('frame_file')->where(array('id' => $user['img_id'], 'status' => 1))->find();
            $arr = $userimg['savepath'] . $userimg['savename'];
            $arr = substr($arr, 12);
            $count = M('express_name')->alias('a')->join('__SEND_ORDER__ b on a.id=b.express_id')->where(array('b.sender_userId' => $userid, 'b.status' => 1))->count();// 查询满足要求的总记录数
            $Page = new \Think\Page($count, 5);// 实例化分页类 传入总记录数和每页显示的记录数
            $show = $Page->show();// 分页显示输出
            $this->assign('list', $list);// 赋值数据集
            $this->assign('page', $show);// 赋值分页输出
            $this->assign('user', $arr);
            $thinginfo = D('SendOrder')->DeepChangeStatus($thinginfo);
            $wangdian = D('SendOrder')->getdot();
            $this->assign('thinginfo', $thinginfo)
                ->assign('wangdian', $wangdian);
        } else {
            $this->error('请登录后再试！', U('index/login'), 1);
        }
        $this->display();
    }

    public function citysendorder()
    {
        $userid = session('id');
        if (!empty($userid)) {
            $user = M('users')->where(array('id' => $userid, 'status' => 1))->field('img_id')->find();
            $userimg = M('frame_file')->where(array('id' => $user['img_id'], 'status' => 1))->find();
            $arr = $userimg['savepath'] . $userimg['savename'];
            $arr = substr($arr, 12);
            $thinginfo = M('city_send')->where(array('sender_userId' => $userid, 'status' => 1))->order('create_time desc,id desc')->page($_GET['p'] . ',5')->select();
            $count = M('city_send')->where(array('sender_userId' => $userid, 'status' => 1))->count();
            $Page = new \Think\Page($count, 5);// 实例化分页类 传入总记录数和每页显示的记录数
            $show = $Page->show();// 分页显示输出
            $thinginfo = D('SendOrder')->DeepChangeStatus($thinginfo);
            $this->assign('page', $show);
            $this->assign('thinginfo', $thinginfo);
            $this->assign('user', $arr);
        } else {
            $this->error('请先登录后再试！', U('index/login'), 1);
        }
        $this->display();
    }

    public function selectpaymethod()
    {
        $id = I('get.id');
        $flag = I('get.flag');
        if($flag == 1){
            $info = D('send_order')->where(array('id' => $id, 'status' => 1))->find();
        }elseif ($flag == 2) {
             $info = D('city_send')->where(array('id' => $id, 'status' => 1))->find();
        }else{
            $info = NULL;
        }
        
        $this->assign('info', $info);
        $this->display();
    }

    public function userinfo()
    {
        $id = session('id');
        $arr = M('Users')->where(array('status' => 1, 'id' => $id))->find();

        $userimg = M('frame_file')->where(array('id' => $arr['img_id'], 'status' => 1))->find();
        $arr['savepath'] = $userimg['savepath'] . $userimg['savename'];
        $arr['savepath'] = substr($arr['savepath'], 12);
        $sendorder = D('SendOrder');
        $addr = $sendorder->getaddr();
       
        $this->assign('user', $arr)
            ->assign('addr', $addr);
        $this->display();
    }

    public function manageaddr()
    {
        $userid = session('id');
        if (!empty($userid)) {
            $addr = M('addr')->where(array('userid' => $userid, 'status' => 1, 'flag' => 0))->order('id')->select();
            $this->assign('addr', $addr);
        } else {
            $this->error('请先登录后再试！', U('index/login'), 1);
        }

        $this->display();
    }

    public function managecitysendaddr()
    {
        $userid = session('id');
        if (!empty($userid)) {
            $addr = M('addr')->where(array('userid' => $userid, 'status' => 1, 'flag' => 1))->order('id')->select();
            $this->assign('addr', $addr);
        } else {
            $this->error('请先登录后再试！', U('index/login'), 1);
        }

        $this->display();
    }

    public function setaddr()
    {
        $id = I('get.id');
        $uid = session('id');
        $flag = I('get.flag');
        if (!empty($id) && !empty($uid) && isset($flag)) {
            $data['sign'] = 1;
            $datas['sign'] = 0;
            $add = M('addr')->where(array('id' => $id, 'userid' => $uid, 'flag' => $flag))->save($data);
            $adds = M('addr')->where(array('id' => array('NEQ', $id), 'userid' => array('eq', $uid), 'status' => 1, 'flag' => $flag))->save($datas);
            if ($add) {
                $this->success('设置成功！', U('index/managecitysendaddr'), 1);
            } else {
                $this->error('设置失败！');
            }
        }
    }

    public function changeaddr()
    {
        $id = I('get.id');
        $uid = session('id');
        $flag = I('get.flag');
        if (!empty($id) && !empty($uid) && isset($flag)) {
            $add = M('addr')->where(array('id' => $id, 'userid' => $uid, 'status' => 1, 'flag' => $flag))->find();
            $this->assign('addr', $add);
        }
        if (isset($_POST['submit']) && !empty($_POST['addr']) && !empty($uid) && !empty($flag)) {
            $tid = I('post.tid');
            $data['addr'] = I('post.addr');
            if ($tid == 0) {
                $data['sign'] = 0;
                $add = M('addr')->where(array('id' => $id, 'userid' => $uid, 'status' => 1, 'flag' => $flag))->save($data);
                if ($add) {
                    if ($flag == 0) {
                        $this->success('编辑成功！', U('index/manageaddr'), 1);
                    } else if ($flag == 1) {
                        $this->success('编辑成功！', U('index/managecitysendaddr'), 1);
                    } else {
                        $this->error('未知错误，编辑失败，请登陆后重试！');
                    }
                } else {
                    $this->error('编辑失败！即将返回！', 0);
                }
            } else {
                $data['sign'] = 1;
                $datas['sign'] = 0;
                $add = M('addr')->where(array('id' => $id, 'userid' => $uid, 'status' => 1, 'flag' => $flag))->save($data);
                $adds = M('addr')->where(array('id' => array('NEQ', $id), 'userid' => array('eq', $uid), 'flag' => $flag))->save($datas);
                if ($add) {
                    $this->success('编辑成功！', U('index/manageaddr'), 0);
                } else {
                    $this->error('编辑失败！', 0);
                }
            }
        }
        $this->display();
    }

    public function addaddr()
    {
        if (!empty($_POST['addr']) && isset($_POST['submit'])) {
            $uid = session('id');
            $flag = I('flag');
            if (!empty($uid) && isset($flag)) {
                if ($flag == 0) {
                    $datas['flag'] = 0;
                } elseif ($flag == 1) {
                    $datas['flag'] = 1;
                } else {
                    $this->error('未知错误，新增失败！,请返回地址管理页后重试！', U('index/userinfo'), 1);
                }
                if ($_POST['tid'] == 1) {
                    $data['sign'] = 1;
                    $datas['sign'] = 0;
                    $add = M('addr')->where(array('userid' => array('EQ', $uid), 'flag' => array('EQ', $flag), 'sign' => array('EQ', 0)))->save($datas);
                } else {
                    $data['sign'] = 0;
                }
                $data['userid'] = $uid;
                $data['addr'] = I('post.addr');
                $add = M('addr')->data($data)->add();
                if ($add) {
                    if ($flag == 0) {
                        $this->success('新增地址成功！', U('index/manageaddr'), 1);
                    } else {
                        $this->success('新增地址成功！', U('index/managecitysendaddr'), 1);
                    }

                } else {
                    $this->error('未知错误！新增失败，请登录后重试！');
                }
            } else {
                $this->error('请登录后再试！');
            }
        }
        $this->display();
    }

    public function deleteaddr()
    {
        $id = I('get.id');
        $flag = I('get.flag');
        if (!empty($id) && isset($flag)) {
            $addr = M('addr')->where(array('id' => $id, 'sign' => 0))->delete();
            if ($addr) {
                if ($flag == 0) {
                    $this->success('删除成功！', U('index/manageaddr'), 1);
                } else {
                    $this->success('删除成功！', U('index/managecitysendaddr'), 1);
                }
            } else {
                if ($flag == 0) {
                    $this->error('删除失败！注意默认地址不能删除！', U('index/manageaddr'), 1);
                } else {
                    $this->error('删除失败！注意默认地址不能删除！', U('index/managcitysendeaddr'), 1);
                }
            }
        } else {
            $this->error('未找到改地址，请登录刷新后再试！');
        }

    }
    
    public function name_certification()
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->rootPath = './Public';
        $upload->replace = true;
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath = './Identification/'; // 设置附件上传目录    // 上传文件
        $upload->autoSub = true;
        $upload->subName = array('date', 'Ymd');
        $info = $upload->upload();
        if (!$info) {// 上传错误提示错误信息

            $this->error($upload->getError());
        } else {// 上传成功
            $data['name'] = $info['userimg']['savename'];
            $data['savename'] = $info['userimg']['savename'];
            $data['savepath'] = $info['userimg']['savepath'];
            $data['create_time'] = strtotime(date('Y-m-d', time()));
            $data['ext'] = $info['userimg']['ext'];
            $data['size'] = $info['userimg']['size'];
            $data['md5'] = $info['userimg']['md5'];
            
            $imgfile = M('frame_file')->data($data)->add();
            $uid = session('id');
            $datas['identification_id'] = $imgfile;
             $datas['is_identification'] = 9;
            $user = M('users')->where(array('id' => $uid, 'status' => 1))->save($datas);

            if ($user) {
                $this->success('上传成功！');
            } else {
                $this->error('上传失败！');
            }


        }
    }

    public function userimgupload()
    {
        $upload = new \Think\Upload();// 实例化上传类
        $upload->rootPath = './Public';
        $upload->replace = true;
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        $upload->savePath = './UploadFile/'; // 设置附件上传目录    // 上传文件
        $upload->autoSub = true;
        $upload->subName = array('date', 'Ymd');
        $info = $upload->upload();
        if (!$info) {// 上传错误提示错误信息

            $this->error($upload->getError());
        } else {// 上传成功
            $data['name'] = $info['userimg']['savename'];
            $data['savename'] = $info['userimg']['savename'];
            $data['savepath'] = $info['userimg']['savepath'];
            $data['create_time'] = strtotime(date('Y-m-d', time()));
            $data['ext'] = $info['userimg']['ext'];
            $data['size'] = $info['userimg']['size'];
            $data['md5'] = $info['userimg']['md5'];

            $imgfile = M('frame_file')->data($data)->add();
            $uid = session('id');
            $datas['img_id'] = $imgfile;
            $user = M('users')->where(array('id' => $uid, 'status' => 1))->save($datas);

            if ($user) {
                $this->success('上传成功！');
            } else {
                $this->error('上传失败！');
            }


        }
    }

    public function join()
    {
        $this->display();
    }

    public function login()
    {
        $this->display();
    }


    //订单管理模块
    public function manageorder()
    {
        $uid = session('id');

        if (!empty($uid)) {
            $id = I('get.id');
            if (!empty($id)) {
                 $info = M('send_order')->alias('a')->join('__AREA_MANAGE__ as b on a.dot=b.id')->join('__EXPRESS_NAME__ as c on a.express_id=c.id')->where(array('a.id' => $id, 'a.status' => 1))->field('a.sender,a.sender_phone,a.sender_company,a.fetchgoods_remarks,b.area_name,a.sender_address,a.receiver,a.receiving_phone,a.receiving_company,a.receiving_address,c.name,a.sender_estimated_weight,a.express_remarks,a.id')->find();
                $sendorder = D('SendOrder');
                $wang = $sendorder->getdot();
                $name = $sendorder->getexpressname();

                $this->assign('info', $info)
                    ->assign('expressname', $name)
                    ->assign('wangdian', $wang)
                    ->assign('addr', $info['sender_address'])
                    ->assign('addrs', $info['receiving_address']);
                
            } else {
                $this->error('获取订单失败，即将返回订单中心！', U('index/thinginfo'));
            }
            if (isset($_POST['submit'])) {

                if (!empty($_POST['recipients2'])) {
                    $senderaddr = I('post.recipients2');
                }
                if (!empty($_POST['recipients1'])) {
                    $senderaddr = I('post.s_province') . I('post.s_city') . I('post.recipients1');
                }
                $s_province = M('area')->where('area_deep=1')->select();
                foreach ($s_province as $key => $value) {
                    $send = mb_substr($senderaddr, 0, 2);
                    if (strstr($value['area_name'], $send)) {
                        $s_id = $value['id'];
                    }
                }
                if (strstr('南昌市', mb_substr($senderaddr, 3, 4))) {
                    $s_id = 212;
                }
                if (!empty($_POST['sendaddr'])) {
                    $senderaddr2 = I('post.sendaddr');
                }
                if (!empty($_POST['sendaddr1'])) {
                    $senderaddr2 = I('post.c_province') . I('post.c_city') . I('post.sendaddr1');
                }
                $data = array(
                    'sender' => $_POST['sender'],//寄件人姓名
                    'sender_phone' => $_POST['senderphone'],//寄件人手机号
                    'sender_company' => $_POST['junit'],//寄件人单位
                    'sender_address' => $senderaddr,//寄件详细地址
                    'fetchgoods_remarks' => $_POST['remark1'],//取件方式

                    'receiver' => $_POST['receivename'],//收件人姓名
                    'receiving_phone' => $_POST['receivephone'],//收件人手机号
                    'receiving_company' => $_POST['cunit'],//收件单位
                    'receiving_address' => $senderaddr2,//收件详细地址

                    'express_id' => $_POST['expressname'],//快递公司
                    'sender_estimated_weight' => $_POST['weight'],//预计重量
                    'express_remarks' => $_POST['remark2'],//快递备注
                    'update_time' => time(),
                    'sender_userId' => $_SESSION['id'],
                    'price_area' => $s_id,
                    'dot' => $_POST['wangdian'],
                );

                $add = M('send_order')->where(array('id' => $id, 'status' => 1))->save($data);
                if ($add) {
                    $this->success('修改成功！', U('index/orderdetail', array('id' => $info['id'])), 1);
                } else {
                    $this->error('修改失败！');
                }


            }
        } else {
            $this->error('请登录后再试！', U('index/login'), 1);
        }

        $this->display();
    }

    //订单详情页
    public function orderdetail(){
        $id = I('get.id');
        $flag = I('get.flag');
        $uid=session('id');
        
        if (!empty($id)&&isset($flag)&&!empty($uid)) {
            if($flag==0){
                $info = M('send_order')->alias('a')->join('__AREA_MANAGE__ as b on a.dot=b.id')->join('__EXPRESS_NAME__ as c on a.express_id=c.id')->where(array('a.id' => $id, 'a.status' => 1))->field('a.sender,a.sender_phone,a.sender_company,a.fetchgoods_remarks,b.area_name,a.sender_address,a.receiver,a.receiving_phone,a.receiving_company,a.receiving_address,c.name,a.sender_estimated_weight,a.express_remarks')->find();
            $this->assign('info', $info);
        }elseif($flag==1){
            $info = M('city_send')->where(array('id'=>$id,'sender_userid'=>$uid))->find();
           
            $this->assign('info',$info);
        }else{

        }
        
        $this->display();
        }else{
            $this->error('请先登录后再试！',U('index/login'),1);
        }
    }

    // 登录登出模块
    public function logins()
    {
        /* 自动验证方法登录验证 */
        $users = D('Users');
        if (!$users->create($_POST, 4)) {
            return $this->error($users->getError(),U('index/register'));
        } else {
            return $this->success('登入成功！', 'Index/index', 1);
        }
    }

    public function logout()
    {
        if (session('name')) {
            session('[destroy]');
            cookie('name', null);
            cookie('password', null);
            return $this->success('用户退出成功！', 'index/login', 1);
        } else {
            return $this->error('用户退出失败！', 'index/index', 1);
        }
    }

    public function verify()
    {
        $Verify = new \Think\Verify();
        $Verify->fontSize = 18;
        $Verify->length = 4;
        $Verify->useNoise = false;
        $Verify->useCurve = false;
        $Verify->entry();
    }


    public function cz()
    {
        header("Content-type:text/html;charset=utf-8");
        if (!IS_POST) E('未知错误');
        //$my = safe(I('get.my', 0, 'intval')); //过滤
        //$tid = safe(I('get.tid', 0, 'intval'));
        $my = $_REQUEST['my'];
        $tid = $_REQUEST['tid'];
        $danhao = $_POST['courier_number'];
        if ($tid == '1') {
            //支付宝
            //$danhao = date('Ymd').substr(implode(NULL,array_map('ord',str_split( substr(uniqid(), 7, 13) , 1))), 0, 8); //随机订单号
            $alipay_config = C('alipay_config');
            $payment_type = "1"; //支付类型 //必填，不能修改
            $notify_url = C('alipay.notify_url'); //服务器异步通知页面路径
            $return_url = C('alipay.return_url'); //页面跳转同步通知页面路径
            $seller_email = C('alipay.seller_email');
            $out_trade_no = $danhao;//商户订单号 通过支付页面的表单进行传递，注意要唯一！
            $subject = '快递单付款';  //订单名称 //必填 通过支付页面的表单进行传递
            $total_fee = $my;   //付款金额  //必填 通过支付页面的表单进行传递
            $body = '快递单件付款';  //订单描述 通过支付页面的表单进行传递
            $show_url = strtolower('http://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/index.php')));  //商品展示地址 通过支付页面的表单进行传递

            $anti_phishing_key = "";//防钓鱼时间戳 //若要使用请调用类文件submit中的query_timestamp函数
            $exter_invoke_ip = get_client_ip(); //客户端的IP地址
            //将记录存到数据库中

            //$data['dh']  =$danhao;
            //$data['total_fee']  =$my;

            //$data['dtime']   = time();
            //$data['jklx'] = '1';
            //$ord=M('send_order');
            //$ord->save($data);
            /************************************************************/
            //构造要请求的参数数组，无需改动
            $parameter = array(
                "service" => "create_direct_pay_by_user",
                "partner" => trim($alipay_config['partner']),
                "payment_type" => $payment_type,
                "notify_url" => $notify_url,
                "return_url" => $return_url,
                "seller_email" => $seller_email,
                "out_trade_no" => $out_trade_no,
                "subject" => $subject,
                "total_fee" => $total_fee,
                "body" => $body,
                "show_url" => $show_url,
                "anti_phishing_key" => $anti_phishing_key,
                "exter_invoke_ip" => $exter_invoke_ip,
                "_input_charset" => trim(strtolower($alipay_config['input_charset']))
            );
            //建立请求
            $alipaySubmit = new \ AlipaySubmit($alipay_config);
            $html_text = $alipaySubmit->buildRequestForm($parameter, "post", "ok");
            echo $html_text;
        } elseif ($tid == '2') {
            session('wxje', $my);
            //微信
            if ($this->is_weixin()) {
                redirect(U('index/Paywxwap'));    //跳转到微信H5支付页面
            } else {
                redirect(U('index/Paywx', array('courier_number' => $danhao)));
            }
        } elseif ($tid == '3') {
            $ord = M('send_order');
            //$fee=M("send_order") -> where('courier_number='.$out_trade_no)->find();
            $data['order_status'] = '3';
            $ord->where('courier_number=' . $danhao)->save($data);
            $this->redirect('Index/userinfo');
        }
    }

    public function Paywx()
    {
        $wxje = session('wxje');//金额
        if ($wxje) {
            $unifiedOrder = new \UnifiedOrder_pub();
            $unifiedOrder->setParameter("body", "快递单件");//商品描述
            $out_trade_no = $_GET['courier_number'];//订单号

            $weburl = strtolower('http://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/index.php')) . '/index.php/Home/pno/wx');

            $unifiedOrder->setParameter("out_trade_no", "$out_trade_no");//商户订单号
            $unifiedOrder->setParameter("total_fee", $wxje * 100);//总金额
            $unifiedOrder->setParameter("notify_url", $weburl);//通知地址
            $unifiedOrder->setParameter("trade_type", "NATIVE");//交易类型
            $unifiedOrderResult = $unifiedOrder->getResult();
            if ($unifiedOrderResult["return_code"] == "FAIL") {
                //商户自行增加处理流程
                echo "通信出错：" . $unifiedOrderResult['return_msg'] . "<br>";
            } elseif ($unifiedOrderResult["result_code"] == "FAIL") {
                //商户自行增加处理流程
                echo "错误代码：" . $unifiedOrderResult['err_code'] . "<br>";
                echo "错误代码描述：" . $unifiedOrderResult['err_code_des'] . "<br>";
            } elseif ($unifiedOrderResult["code_url"] != NULL) {
                //从统一支付接口获取到code_url
                $code_url = $unifiedOrderResult["code_url"];
                //商户自行增加处理流程
            }
            $this->assign('out_trade_no', $out_trade_no);
            $this->assign('code_url', $code_url);
            $this->assign('wxje', $wxje);
            $this->assign('unifiedOrderResult', $unifiedOrderResult);
            $this->display();
        } else {
            $this->error("非法操作");
        }
    }

    public function wxcx()
    {
        if (!isset($_POST["out_trade_no"])) {
            $out_trade_no = "";
        } else {
            $out_trade_no = $_POST["out_trade_no"];
            $orderQuery = new \OrderQuery_pub();
            $orderQuery->setParameter("out_trade_no", "$out_trade_no");//商户订单号
            //获取订单查询结果
            $orderQueryResult = $orderQuery->getResult();
            //商户根据实际情况设置相应的处理流程,此处仅作举例
            if ($orderQueryResult["return_code"] == "FAIL") {
                $this->error($out_trade_no);
            } elseif ($orderQueryResult["result_code"] == "FAIL") {
                $this->error($out_trade_no);
            } else {
                $i = $_SESSION['i'];
                $i--;
                $_SESSION['i'] = $i;
                //判断交易状态
                switch ($orderQueryResult["trade_state"]) {
                    case SUCCESS:
                        //修改订单状态
                        $ord = M('send_order');
                        $fee = M("send_order")->where('courier_number=' . $out_trade_no)->find();
                        $data['order_status'] = '4';
                        $data['received_money'] = $fee['need_payment'];
                        $ord->where('courier_number=' . $out_trade_no)->save($data);
                        //$this->redirect('Index/userinfo');
                        $this->success("支付成功！", U('index/userinfo'));
                        break;
                    case REFUND:
                        $this->error("超时关闭订单：" . $i);
                        break;
                    case NOTPAY:
                        $this->error("超时关闭订单：" . $i);
                        break;
                    case CLOSED:
                        $this->error("超时关闭订单：" . $i);
                        break;
                    case PAYERROR:
                        $this->error('支付失败,请重新付款', U('index/userinfo'));
                        break;
                    default:
                        $this->error('未知错误,请重新付款', U('index/userinfo'));
                        break;
                }
            }
        }
    }

    public function notifyurl()
    {
        /*
        同理去掉以下两句代码；
        */
        //require_once("alipay.config.php");
        //require_once("lib/alipay_notify.class.php");

        //这里还是通过C函数来读取配置项，赋值给$alipay_config
        $alipay_config = C('alipay_config');

        //计算得出通知验证结果
        $alipayNotify = new AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();

        if ($verify_result) {
            //验证成功
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表
            $out_trade_no = $_POST['out_trade_no'];      //商户订单号
            $trade_no = $_POST['trade_no'];          //支付宝交易号
            $trade_status = $_POST['trade_status'];      //交易状态
            $total_fee = $_POST['total_fee'];         //交易金额
            $notify_id = $_POST['notify_id'];         //通知校验ID。
            $notify_time = $_POST['notify_time'];       //通知的发送时间。格式为yyyy-MM-dd HH:mm:ss。
            $buyer_email = $_POST['buyer_email'];       //买家支付宝帐号；
            $parameter = array(
                "out_trade_no" => $out_trade_no, //商户订单编号；
                "trade_no" => $trade_no,     //支付宝交易号；
                "total_fee" => $total_fee,    //交易金额；
                "trade_status" => $trade_status, //交易状态
                "notify_id" => $notify_id,    //通知校验ID。
                "notify_time" => $notify_time,  //通知的发送时间。
                "buyer_email" => $buyer_email,  //买家支付宝帐号；
            );
            if ($_POST['trade_status'] == 'TRADE_FINISHED') {
                //
            } else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
                if (!checkorderstatus($out_trade_no)) {
                    orderhandle($parameter);
                    //进行订单处理，并传送从支付宝返回的参数；
                }
            }
            echo "success";        //请不要修改或删除
        } else {
            //验证失败
            echo "fail";
        }
    }

    public function returnurl()
    {
        $alipay_config = C('alipay_config');
        $alipayNotify = new \ AlipayNotify($alipay_config);//计算得出通知验证结果
        $verify_result = $alipayNotify->verifyReturn();
        if ($verify_result) {
            //验证成功
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表
            $out_trade_no = $_GET['out_trade_no'];      //商户订单号
            $trade_no = $_GET['trade_no'];          //支付宝交易号
            $trade_status = $_GET['trade_status'];      //交易状态
            $total_fee = $_GET['total_fee'];         //交易金额
            $notify_id = $_GET['notify_id'];         //通知校验ID。
            $notify_time = $_GET['notify_time'];       //通知的发送时间。
            $buyer_email = $_GET['buyer_email'];       //买家支付宝帐号；
            if ($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
                $ord = M('send_order');
                //$fee=M("send_order") -> where('courier_number='.$out_trade_no)->find();
                $data['order_status'] = '4';
                $data['received_money'] = $total_fee;
                $ord->where('courier_number=' . $out_trade_no)->save($data);
                $this->redirect('Index/userinfo');
            } else {
                //echo "trade_status=".$_GET['trade_status'];
                //付款失败
                $this->redirect('Index/userinfo');
            }
        } else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            $this->redirect('Index/userinfo');
        }
    }
    ////////////////////////////////////////////////////////////////////////
    //						微信JS支付开始 								  //
    ////////////////////////////////////////////////////////////////////////

    //微信JS支付,目前不使用
    public function Paywxwap()
    {
        header("Content-Type:text/html;cahrset=utf-8");
        $weburl = strtolower('http://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/index.php')) . '/index.php/Home/Index/Paywxwap.html');
        $wxje = session('wxje');//金额
        $unifiedOrder = new \UnifiedOrder_pub();
        $tools = new \JsApi_pub();
        //获取用户OPENID
        if (empty($_SESSION['wx_openid'])) {
            if (empty($_GET['code'])) {
                $codeurl = $tools->createOauthUrlForCode($weburl);
                echo "<script>location.href='" . $codeurl . "'</script>";
            } else {
                $tools->setCode($_GET['code']);
                $openidurl = $tools->createOauthUrlForOpenid();
                //初始化curl
                $ch = curl_init();
                //设置超时
                curl_setopt($ch, CURLOPT_URL, $openidurl);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                //运行curl，结果以jason形式返回
                $res = curl_exec($ch);
                curl_close($ch);
                //取出openid
                $data = json_decode($res, true);
                $openid = $data['openid'];
                $_SESSION['wx_openid'] = $openid;
            }
        }
        $reurl = strtolower('http://' . $_SERVER['HTTP_HOST'] . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/index.php')) . '/index.php/Home/pno/wx');
        $unifiedOrder->setParameter("body", "快递单件");//商品描述
        $out_trade_no = $_GET['out_trade_no'];//订单号
        $unifiedOrder->setParameter("out_trade_no", "$out_trade_no");//商户订单号
        $unifiedOrder->setParameter("total_fee", $wxje * 100);//总金额
        $unifiedOrder->setParameter("notify_url", $reurl);//通知地址 
        $unifiedOrder->setParameter("trade_type", "JSAPI");//交易类型
        $unifiedOrder->setParameter("openid", $_SESSION['wx_openid']);//交易类型
        $unifiedOrderResult = $unifiedOrder->getResult();
        $tools->setPrepayId($unifiedOrderResult['prepay_id']);
        $result = $tools->getParameters();
        //商户自行增加处理流程
        $data['u_id'] = session('uid');
        $data['dh'] = $out_trade_no;
        $data['total_fee'] = $wxje;
        $data['dstatus'] = '0';
        $data['dtime'] = time();
        $data['jklx'] = '2';
        $ord = M('Orderlist');
        $ord->add($data);
        $this->assign("result", $result);
        $this->assign("orderno", $out_trade_no);
        $this->display();
        //$this -> display();
    }

    public function is_weixin()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            return true;
        }
        return false;
    }

    //微信支付回调
    public function wxwapnotify()
    {
        header("Content-Type:text/html;charset=utf-8");
        $out_trade_no = $_GET['orderno'];
        $orderQuery = new \OrderQuery_pub();
        //获取订单信息
        $orderinfo = M("orderlist")->where("dh='" . $out_trade_no . "'")->find();
        $orderQuery->setParameter("out_trade_no", $out_trade_no);//商户订单号
        //获取订单查询结果
        $orderQueryResult = $orderQuery->getResult();
        //商户根据实际情况设置相应的处理流程,此处仅作举例
        if ($orderQueryResult["trade_state"] == "SUCCESS") {
            $ddarr['dstatus'] = '1';
            M("orderlist")->where('dh=' . $out_trade_no)->save($ddarr);        //修改订单状态
            M("user")->where('uid=' . $orderinfo['u_id'])->setInc('money', $orderinfo['total_fee']);        //修改用户金额
            echo "<script>alert('恭喜您，付款成功');location.href='/'</script>";
        } else {
            echo "<script>alert('付款失败，请重试');location.href='/'</script>";
        }
    }

    public function edit_password()
    {
        $datas = md5($_POST['passwords']);
        $data = $_POST['password'];
        $yanzheng = $_POST['yanzheng'];
        $id = session('id');

        $a = D('Users')->where(array('status' => 1, 'id' => $id))->find();

        if (session('codes')) {
            if ($yanzheng == session('codes')) {
                if ($datas == $a['password'] && $data != NULL) {

                    $b = D('Users')->create();
                    $b['password'] = md5($b['password']);
                    $b['update_time'] = time();                    
                    $save_password = D('Users')->where(array('status' => 1, 'id' => $id))->save($b);
                    if ($save_password) {
                        $this->success('修改成功', U('Index/userinfo'), 1);
                    } else {
                        $this->error('修改失败', U('Index/userinfo'), 1);
                    }
                } else {
                    $this->error('原密码不正确或修改密码不能为空', U('Index/userinfo'), 1);
                }
            } else {
                session('codes', null);
                $this->error('验证码错误', U('Index/userinfo'), 1);
            }
        } else {
            $this->error('验证码不存在', U('Index/userinfo'), 1);
        }
    }

    public function e_password()
    {
        $data['phone'] = $_POST['phone'];
        $data['password'] = $_POST['password'];
        $yanzheng = $_POST['yanzheng'];
        $a = D('Users')->where(array('status' => 1, 'phone' => $data['phone']))->find();

        if (session('codes')) {
            if ($yanzheng == session('codes')) {
                if ($data['password'] != NULL) {
                    session('codes', null);
                    $b = D('Users')->create();
                    $b['password'] = md5(C('CRYPT_KEY_PWD').$data['password']);
                    $b['update_time'] = time();
                    $save_password = D('Users')->where(array('status' => 1, 'phone' => $data['phone']))->save($b);
                    if ($save_password) {
                        $this->success('重置成功', U('Index/login'), 1);
                    } else {
                        $this->error('重置失败', U('Index/resetpass'), 1);
                    }
                } else {
                    $this->error('密码不能为空', U('Index/resetpass'), 1);
                }

            } else {
                session('codes', null);
                $this->error('验证码错误', U('Index/resetpass'), 1);
            }
        } else {
            $this->error('验证码不存在', U('Index/resetpass'), 1);
        }
    }

    public function edit_users()
    {
        $uid = session('id');
        if (!empty($uid)) {
            if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['truename'])) {
                $data['username'] = I('post.username');
                $data['truename'] = I('post.truename');
                $data['update_time'] = time();
                $data['update_time'] = strtotime(date('Y-m-d H:i:s'));
                $add = M('users')->where(array('id' => $uid, 'status' => 1))->save($data);
                if ($add) {
                    $this->success('修改成功！');
                } else {
                    $this->error('修改失败！');
                }
            } else {
                $this->error('修改失败！');
            }
        }

    }

    public function registerss()
    {
        $data['yanzheng'] = $_POST['yanzheng'];
        $data['phone'] = $_POST['phone'];
        $data['username'] = $_POST['username'];
        $data['sex'] = $_POST['sex'];
        $data['password'] = md5(C('CRYPT_KEY_PWD').$_POST['password']);
        $data['email'] = $_POST['email'];
        $data['truename'] = $_POST['truename'];

        if (session('codes')) {
            if ($data['yanzheng'] == session('codes')) {
                session('codes', null);
                $addq = D('Users')->where(array('status' => 1, 'phone' => $data['phone']))->find();
                if ($addq == NULL) {
                    $add = D('Users')->adduser($data);
                    if ($add) {
                        $this->success('注册成功', U('Index/login'), 1);
                    } else {
                        $this->error('注册失败', U('Index/register'), 1);
                    }
                } else {
                    $this->error('此用户名已注册', U('Index/register'), 1);
                }

            } else {
                session('codes', null);
                $this->error('验证码错误', U('Index/register'), 1);
            }
        } else {
            $this->error('验证码不存在', U('Index/register'), 1);
        }

    }

    public function registers()
    {
        import('Org.Alidayu.top.TopClient');
        import('Org.Alidayu.top.ResultSet');
        import('Org.Alidayu.top.RequestCheckUtil');
        import('Org.Alidayu.top.TopLogger');
        import('Org.Alidayu.top.request.AlibabaAliqinFcSmsNumSendRequest');

        $call = $_POST['call'];
        $code = rand(100000, 999999);
        if ($code) {
            session('codes', $code);
        }
        $product = '昊讯会员';
        $smsParam = "{'code':'{$code}','product':'{$product}'}";
        $c = new \TopClient;
        $c->appkey = "23801896";
        $c->secretKey = "888286504efa14e3f31395042bc1f044";
        $req = new \AlibabaAliqinFcSmsNumSendRequest;
        // $req ->setExtend( "" );
        $req->setSmsType("normal");
        $req->setSmsFreeSignName("昊讯快递");
        $req->setSmsParam($smsParam);
        $req->setRecNum($call);
        $req->setSmsTemplateCode("SMS_69835346");
        $resp = $c->execute($req);

    }
}