<?php
/**
 * Created by PhpStorm.
 * User: hanwenbo
 * Date: 2019-02-17
 * Time: 17:46
 */
namespace EasySwoole\Pay\AliPay\RequestBean;


class RefundFind extends Base
{
	protected $method = 'alipay.trade.fastpay.refund.query';

}