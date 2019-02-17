<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:21
 */

namespace EasySwoole\Pay\AliPay\RequestBean;


class Scan extends Base
{
	protected $product_code = '';
	protected $method = 'alipay.trade.precreate';
}