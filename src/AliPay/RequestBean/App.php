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

	public function getPayload() : array
	{
		$payload                = $this->toArray( null, self::FILTER_NOT_NULL );
		$payload['method']      = $this->getMethod();
		$payload['biz_content'] = json_encode( array_merge( json_decode( $payload['biz_content'], true ), ['product_code' => $this->getProductCode()] ) );
		$payload['sign']        = $this->generateSign( $payload );
		return $payload;
	}
}