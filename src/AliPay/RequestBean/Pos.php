<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:21
 */

namespace EasySwoole\Pay\AliPay\RequestBean;

/**
 * Class Pos
 * @package EasySwoole\Pay\AliPay\RequestBean
 * @method getProductCode()
 * @method getMethod()
 */
class Pos extends Base
{
	protected $product_code = 'FACE_TO_FACE_PAYMENT';
	protected $method = 'alipay.trade.pay';

	public function getPayload():array {
		unset($payload['trade_type'], $payload['notify_url']);

		$payload['sign'] = $this->generateSign($payload);


		return $this->requestApi('pay/micropay', $payload);
	}
}