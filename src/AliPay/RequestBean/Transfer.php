<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:21
 */

namespace EasySwoole\Pay\AliPay\RequestBean;

/**
 * Class Transfer
 * @package EasySwoole\Pay\AliPay\RequestBean
 * @method getProductCode()
 * @method getMethod()
 */
class Transfer extends Base
{
	protected $product_code = '';
	protected $method = 'alipay.fund.trans.toaccount.transfer';
	public function getPayload():array {
		$payload['method'] = $this->getMethod();
		$payload['biz_content'] = json_encode(array_merge(
			json_decode($payload['biz_content'], true),
			['product_code' => $this->getProductCode()]
		));
		$payload['sign'] = $this->generateSign($payload);

		Events::dispatch(Events::PAY_STARTED, new Events\PayStarted('Alipay', 'Transfer', $endpoint, $payload));

		return $this->requestApi($payload);
	}
}