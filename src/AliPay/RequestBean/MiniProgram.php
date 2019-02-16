<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:21
 */

namespace EasySwoole\Pay\AliPay\RequestBean;

class MiniProgram extends Base
{
	protected $method = 'alipay.trade.create';
}