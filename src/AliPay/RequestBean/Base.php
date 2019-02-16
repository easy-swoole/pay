<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:19
 */

namespace EasySwoole\Pay\AliPay\RequestBean;


use EasySwoole\Spl\SplBean;


class Base extends SplBean
{
	protected $out_trade_no;
	protected $total_amount;
	protected $subject;
	protected $timeout_express;

	protected $product_code;
	protected $method;

	/**
	 * @return mixed
	 */
	public function getOutTradeNo()
	{
		return $this->out_trade_no;
	}

	/**
	 * @param mixed $out_trade_no
	 */
	public function setOutTradeNo( $out_trade_no ) : void
	{
		$this->out_trade_no = $out_trade_no;
	}

	/**
	 * @return mixed
	 */
	public function getTotalAmount()
	{
		return $this->total_amount;
	}

	/**
	 * @param mixed $total_amount
	 */
	public function setTotalAmount( $total_amount ) : void
	{
		$this->total_amount = $total_amount;
	}

	/**
	 * @return mixed
	 */
	public function getSubject()
	{
		return $this->subject;
	}

	/**
	 * @param mixed $subject
	 */
	public function setSubject( $subject ) : void
	{
		$this->subject = $subject;
	}

	/**
	 * @return mixed
	 */
	public function getTimeoutExpress()
	{
		return $this->timeout_express;
	}

	/**
	 * @param mixed $timeout_express
	 */
	public function setTimeoutExpress( $timeout_express ) : void
	{
		$this->timeout_express = $timeout_express;
	}

	/**
	 * @return mixed
	 */
	public function getProductCode()
	{
		return $this->product_code;
	}

	/**
	 * @param mixed $product_code
	 */
	public function setProductCode( $product_code ) : void
	{
		$this->product_code = $product_code;
	}

	/**
	 * @return mixed
	 */
	public function getMethod()
	{
		return $this->method;
	}

	/**
	 * @param mixed $method
	 */
	public function setMethod( $method ) : void
	{
		$this->method = $method;
	}


	public function generateSign( array $data ) : string
	{
		$privateKey = self::$instance->private_key;

		if( is_null( $privateKey ) ){
			throw new InvalidConfigException( 'Missing Alipay Config -- [private_key]' );
		}

		if( Str::endsWith( $privateKey, '.pem' ) ){
			$privateKey = openssl_pkey_get_private( $privateKey );
		} else{
			$privateKey = "-----BEGIN RSA PRIVATE KEY-----\n".wordwrap( $privateKey, 64, "\n", true )."\n-----END RSA PRIVATE KEY-----";
		}

		openssl_sign( self::getSignContent( $params ), $sign, $privateKey, OPENSSL_ALGO_SHA256 );

		$sign = base64_encode( $sign );

		Log::debug( 'Alipay Generate Sign', [$params, $sign] );

		return $sign;
	}

}