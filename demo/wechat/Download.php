<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/19
 * Time: 9:36
 */

$wechatConfig = require_once 'Config.php';

//下载对账单
go(function () use ($wechatConfig) {
    $download = new \EasySwoole\Pay\WeChat\RequestBean\Download();
    $download->setBillDate('20190312');
    $download->setBillType('ALL');//坑爹的微信文档，这个参数必传
    $pay = new \EasySwoole\Pay\Pay();
    $info = $pay->weChat($wechatConfig)->download($download);
    echo htmlspecialchars($info, ENT_QUOTES);
});