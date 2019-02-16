<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:21
 */

namespace EasySwoole\Pay\AliPay\RequestBean;

/**
 * Class MiniProgram
 * @package EasySwoole\Pay\AliPay\RequestBean
 * @method getMethod()
 */
class MiniProgram extends Base
{
	protected $method = 'alipay.trade.create';


	public function getPayload():array {
		$payload = $this->toArray(null,self::FILTER_NOT_NULL);
		$payload = json_decode($payload,JSON_UNESCAPED_UNICODE);
		if (empty(json_decode($payload['biz_content'], true)['buyer_id'])) {
			throw new \Yansongda\Pay\Exceptions\InvalidArgumentException('buyer_id required');
		}

		$payload['method'] = $this->getMethod();
		$payload['sign'] = $this->generateSign($payload);


		return $this->requestApi($payload);
	}
}