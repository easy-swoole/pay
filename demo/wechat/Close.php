<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/19
 * Time: 9:14
 */

$wechatConfig = require_once 'Config.php';

//关闭订单
go(function () use ($wechatConfig) {
    $close = new \EasySwoole\Pay\WeChat\RequestBean\Close();
    $close->setOutTradeNo('CN201903291441449067');
    $pay = new \EasySwoole\Pay\Pay();
    $info = $pay->weChat($wechatConfig)->close($close);
    print_r((array)$info);
});