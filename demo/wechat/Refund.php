<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/19
 * Time: 9:22
 */

$wechatConfig = require_once 'Config.php';

//申请退款
go(function () use ($wechatConfig) {
    $refund = new \EasySwoole\Pay\WeChat\RequestBean\Refund();
    $refund->setOutTradeNo('CN201903291438423064');
    $refund->setOutRefundNo('TK' . date('YmdHis') . rand(1000, 9999));
    $refund->setTotalFee(1);
    $refund->setRefundFee(1);
    $refund->setNotifyUrl('xxxxx');
    $pay = new \EasySwoole\Pay\Pay();
    $info = $pay->weChat($wechatConfig)->refund($refund);
    print_r($info);
});