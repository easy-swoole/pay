<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/19
 * Time: 9:09
 */
//查询订单

$wechatConfig = require_once 'Config.php';

go(function () use ($wechatConfig) {
    $orderFind = new \EasySwoole\Pay\WeChat\RequestBean\OrderFind();
    $orderFind->setOutTradeNo('CN201903291438423064');
    $pay = new \EasySwoole\Pay\Pay();
    $info = $pay->weChat($wechatConfig)->orderFind($orderFind);
    print_r((array)$info);
});



