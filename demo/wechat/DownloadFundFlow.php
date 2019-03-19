<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/19
 * Time: 9:38
 */
$wechatConfig = require_once 'Config.php';

//下载资金对账单
go(function () use ($wechatConfig) {
    $download = new \EasySwoole\Pay\WeChat\RequestBean\DownloadFundFlow();
    $download->setBillDate('20190312');
    $download->setAccountType('Basic');
    $pay = new \EasySwoole\Pay\Pay();
    $info = $pay->weChat($wechatConfig)->downloadFundFlow($download);
    echo htmlspecialchars($info, ENT_QUOTES);
});