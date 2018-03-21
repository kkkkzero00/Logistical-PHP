<?php
namespace Lib\Alidayu;
include('TopSdk.php');
//就是下面两句把我搞惨了，别嫌弃，我只是入门了而已
use TopClient; 
use AlibabaAliqinFcSmsNumSendRequest;
class SendMSM {
    
    public function send($recNum='', $smsParam='', $smsTemplateCode='SMS_67125557', $smsFreeSignName='快递宝宝提醒您'){
        $c = new TopClient;
        $c->format = "json";
        // $c->appkey = C('AlidayuAppKey');
        // $c->secretKey = C('AlidayuAppSecret');
        $c->appkey = "23801896";
        $c->secretKey = "888286504efa14e3f31395042bc1f044";
        $req = new AlibabaAliqinFcSmsNumSendRequest;
        //$req->setExtend("123456");
        $req->setSmsType("normal");
        $req->setSmsFreeSignName($smsFreeSignName);
        $req->setSmsParam($smsParam);
        $req->setRecNum($recNum);
        $req->setSmsTemplateCode($smsTemplateCode);
        $resp = $c->execute($req);
        return $resp;
    }
    
}