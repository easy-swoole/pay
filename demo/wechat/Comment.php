<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/19
 * Time: 9:40
 */

/**
 * 微信支付订单评价
 * 商户签名失败,有测试成功的麻烦告知下,谢谢
 * 微信就是个坑坑坑坑
 */

$wechatConfig = require_once 'Config.php';

go(function () use ($wechatConfig) {
    $comment = new \EasySwoole\Pay\WeChat\RequestBean\Comment();
    $comment->setBeginTime('20190312000000');
    $comment->setEndTime('20190315000000');
    $comment->setOffset(0);
//    $comment->setLimit(100);
    $pay = new \EasySwoole\Pay\Pay();
    $info = $pay->weChat($wechatConfig)->comment($comment);
    var_dump($info);
//    print_r($info);
});