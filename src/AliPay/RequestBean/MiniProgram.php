<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:21
 */

namespace EasySwoole\Pay\AliPay\RequestBean;

use \EasySwoole\Pay\Exceptions\InvalidArgumentException;

class MiniProgram extends Base
{
	protected $method = 'alipay.trade.create';

	/**
	 * @return array
	 * @throws InvalidArgumentException
	 */
	public function getPayload() : array
	{
		$payload = $this->toArray( null, self::FILTER_NOT_NULL );
		if( empty( json_decode( $payload['biz_content'], true )['buyer_id'] ) ){
			throw new InvalidArgumentException( 'buyer_id required' );
		}
		$payload['method'] = $this->getMethod();
		$payload['sign']   = $this->generateSign( $payload );
		return $payload;
	}
}