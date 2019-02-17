<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:21
 */

namespace EasySwoole\Pay\AliPay\RequestBean;


class Pos extends Base
{
	protected $product_code = 'FACE_TO_FACE_PAYMENT';
	protected $method = 'alipay.trade.pay';
	protected $scene = 'bar_code';
}