<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/8
 * Time: 9:27
 */

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use EasySwoole\Pay\WeChat\Config;
use EasySwoole\Pay\WeChat\RequestBean\OfficialAccount;

$wechatConfig = new Config();
$wechatConfig->setAppId('');
$wechatConfig->setMchId('');
$wechatConfig->setKey('');
$wechatConfig->setNotifyUrl('');
$wechatConfig->setApiClientCert('');
$wechatConfig->setApiClientKey('');
/**
 * 公众号支付测试
 */
//go(function () use ($wechatConfig) {
//    $officialAccount = new OfficialAccount();
//    $officialAccount->setOpenid('');
//    $ourTradeNo = 'CN' . date('YmdHis') . rand(1000, 9999);
//    $officialAccount->setOutTradeNo($ourTradeNo);
//    $officialAccount->setBody('xxxxx-测试');
//    $officialAccount->setTotalFee(1);
//    $officialAccount->setSpbillCreateIp('47.98.131.103');
//    $pay = new \EasySwoole\Pay\Pay();
//    $params = $pay->weChat($wechatConfig)->officialAccount($officialAccount);
//    print_r($params->toArray());
//});


//go(function () use ($wechatConfig) {
//    $pay = new \EasySwoole\Pay\Pay();
//    $outTradeNo = 'CN' . date('YmdHis') . rand(1000, 9999);
//    $wap = new \EasySwoole\Pay\WeChat\RequestBean\Wap();
//    $wap->setOutTradeNo($outTradeNo);
//    $wap->setBody('xxxxx-WAP测试' . $outTradeNo);
//    $wap->setTotalFee(1);
//    $wap->setSpbillCreateIp('47.98.131.103');
//    $params = $pay->weChat($wechatConfig)->wap($wap);
//    print_r($params->toArray());
//});

