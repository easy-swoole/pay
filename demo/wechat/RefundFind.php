<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/19
 * Time: 9:34
 */

$wechatConfig = require_once 'Config.php';

//退款查询
go(function () use ($wechatConfig) {
    $refundFind = new \EasySwoole\Pay\WeChat\RequestBean\RefundFind();
    $refundFind->setOutTradeNo('CN201903181044383609');
    $pay = new \EasySwoole\Pay\Pay();
    $info = $pay->weChat($wechatConfig)->refundFind($refundFind);
    print_r((array)$info);
});