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
	/**
	 * @var string
	 */
	protected $buyer_id ;

	/**
	 * @return string
	 */
	public function getBuyerId() : string
	{
		return $this->buyer_id;
	}

	/**
	 * @param string $buyer_id
	 */
	public function setBuyerId( string $buyer_id ) : void
	{
		$this->buyer_id = $buyer_id;
	}

}