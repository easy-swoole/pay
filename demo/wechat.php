<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/8
 * Time: 9:27
 */

require_once dirname(__DIR__) . '/vendor/autoload.php';

use EasySwoole\Pay\WeChat\Config;
use EasySwoole\Pay\WeChat\RequestBean\OfficialAccount;

$wechatConfig = new Config();
$wechatConfig->setAppId('');
$wechatConfig->setMchId('');
$wechatConfig->setKey('');
$wechatConfig->setNotifyUrl('');
$wechatConfig->setCertClient('');
$wechatConfig->setCertKey('');
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

/**
 * 查询订单
 */
//go(function () use ($wechatConfig) {
//    $orderFind = new \EasySwoole\Pay\WeChat\RequestBean\OrderFind();
//    $orderFind->setOutTradeNo('CN201903151343107239');
//    $pay = new \EasySwoole\Pay\Pay();
//    $info = $pay->weChat($wechatConfig)->orderFind($orderFind);
//    print_r($info);
//});

/**
 * 关闭订单
 */
//go(function () use ($wechatConfig) {
//    $close = new \EasySwoole\Pay\WeChat\RequestBean\Close();
//    $close->setOutTradeNo('CN201903151343107239');
//    $pay = new \EasySwoole\Pay\Pay();
//    $info = $pay->weChat($wechatConfig)->close($close);
//    print_r($info);
//});


/**
 * 申请退款
 */
//go(function () use ($wechatConfig) {
//    $refund = new \EasySwoole\Pay\WeChat\RequestBean\Refund();
//    $refund->setOutTradeNo('CN201903151503449597');
//    $refund->setOutRefundNo('TK' . date('YmdHis') . rand(1000, 9999));
//    $refund->setTotalFee(1);
//    $refund->setRefundFee(1);
//    $refund->setNotifyUrl('');
//    $pay = new \EasySwoole\Pay\Pay();
//    $info = $pay->weChat($wechatConfig)->refund($refund);
//    print_r($info);
//});


/**
 * 退款查询
 */
go(function () use ($wechatConfig) {
    $refundFind = new \EasySwoole\Pay\WeChat\RequestBean\RefundFind();
    $refundFind->setOutTradeNo('CN201903151503449597');
    $pay = new \EasySwoole\Pay\Pay();
    $info = $pay->weChat($wechatConfig)->refundFind($refundFind);
    print_r($info);
    echo json_encode($info);
});


/**
 * 下载对账单
 */

//go(function () use ($wechatConfig) {
//    $download = new \EasySwoole\Pay\WeChat\RequestBean\Download();
//    $download->setBillDate('20190312');
//    $download->setBillType('ALL');//坑爹的微信文档，这个参数必传
//    $pay = new \EasySwoole\Pay\Pay();
//    $info = $pay->weChat($wechatConfig)->download($download);
//    echo htmlspecialchars($info, ENT_QUOTES);
//});

/**
 * 下载资金对账单
 */
//go(function () use ($wechatConfig) {
//    $download = new \EasySwoole\Pay\WeChat\RequestBean\DownloadFundFlow();
//    $download->setBillDate('20190312');
//    $download->setAccountType('Basic');
//    $pay = new \EasySwoole\Pay\Pay();
//    $info = $pay->weChat($wechatConfig)->downloadFundFlow($download);
//    echo htmlspecialchars($info, ENT_QUOTES);
//});

/**
 * 微信支付订单评价
 * 测试商户签名失败？？？？
 * 尼玛就是个坑
 */

//go(function () use ($wechatConfig) {
//    $comment = new \EasySwoole\Pay\WeChat\RequestBean\Comment();
//    $comment->setBeginTime('20190312000000');
//    $comment->setEndTime('20190313000000');
//    $comment->setOffset(0);
////    $comment->setLimit(100);
//    $pay = new \EasySwoole\Pay\Pay();
//    $info = $pay->weChat($wechatConfig)->comment($comment);
//    var_dump($info);
////    print_r($info);
//});

//go(function () use ($wechatConfig) {
//    $pay = new \EasySwoole\Pay\Pay();
//
//    $outTradeNo = 'CN' . date('YmdHis') . rand(1000, 9999);
//    $wap = new \EasySwoole\Pay\WeChat\RequestBean\Wap();
//    $wap->setOutTradeNo($outTradeNo);
//    $wap->setBody('xxxxx-WAP测试' . $outTradeNo);
//    $wap->setTotalFee(1);
//    $wap->setSpbillCreateIp('47.98.131.103');
//    $params = $pay->weChat($wechatConfig)->wap($wap);
//    print_r($params->toArray());
//});

