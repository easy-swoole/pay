<?php
/**
 * Created by PhpStorm.
 * User: hanwenbo
 * Date: 2019-02-17
 * Time: 20:46
 */
require_once '../vendor/autoload.php';
go(function (){

    $order = new \EasySwoole\Pay\AliPay\RequestBean\App([
    	'subject'=>'测试',
	    'out_trade_no'=>'123456',
	    'total_amount'=>'0.01',
	    'xxxxxxxxxxx'=>'11111111111111111111111'
    ],true);

    var_dump($order->toArray());
});

