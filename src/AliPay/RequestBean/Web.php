<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:19
 */

namespace EasySwoole\Pay\AliPay\RequestBean;


class Web extends Base
{
	protected $product_code = 'FAST_INSTANT_TRADE_PAY';
	protected $method = 'alipay.trade.page.pay';
}