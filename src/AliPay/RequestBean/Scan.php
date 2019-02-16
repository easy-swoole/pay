<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:21
 */

namespace EasySwoole\Pay\AliPay\RequestBean;

/**
 * Class Scan
 * @package EasySwoole\Pay\AliPay\RequestBean
 * @method getProductCode()
 * @method getMethod()
 */
class Scan extends Base
{
	protected $product_code = '';
	protected $method = 'alipay.trade.precreate';
	public function getPayload():array {
		$payload['spbill_create_ip'] = Request::createFromGlobals()->server->get('SERVER_ADDR');
		$payload['trade_type'] = $this->getTradeType();
		return $this->preOrder($payload);
	}
}