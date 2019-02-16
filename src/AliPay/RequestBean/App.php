<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:20
 */

namespace EasySwoole\Pay\AliPay\RequestBean;


class App extends Base
{
	protected $product_code = 'QUICK_MSECURITY_PAY';
	protected $method = 'alipay.trade.app.pay';
}