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
	/**
	 * @var string 支付宝的开发文档中规定passback_params的值需要经过Url编码后传递
	 */
	protected $passback_params;

	/**
	 * @return string
	 */
	public function getPassbackParams() : string
	{
		return $this->passback_params;
	}

	/**
	 * @param string $passback_params
	 */
	public function setPassbackParams( string $passback_params ) : void
	{
		$this->passback_params = $passback_params;
	}


}