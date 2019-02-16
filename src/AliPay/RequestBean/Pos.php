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

	/**
	 * @return array
	 */
	public function getPayload() : array
	{
		$payload                = $this->toArray( null, self::FILTER_NOT_NULL );
		$payload['method']      = $this->getMethod();
		$payload['biz_content'] = json_encode( array_merge( json_decode( $payload['biz_content'], true ), [
			'product_code' => $this->getProductCode(),
			'scene'        => 'bar_code',
		] ) );
		$payload['sign']        = $this->generateSign( $payload );
		return $payload;
	}
}