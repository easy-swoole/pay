<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:21
 */

namespace EasySwoole\Pay\AliPay\RequestBean;


class Transfer extends Base
{
	protected $product_code = '';
	protected $method = 'alipay.fund.trans.toaccount.transfer';
	/**
	 * @var string
	 */
	protected $payee_type;
	/**
	 * @var
	 */
	protected $payee_account;

	/**
	 * @return string
	 */
	public function getPayeeType() : string
	{
		return $this->payee_type;
	}

	/**
	 * @param string $payee_type
	 */
	public function setPayeeType( string $payee_type ) : void
	{
		$this->payee_type = $payee_type;
	}

	/**
	 * @return mixed
	 */
	public function getPayeeAccount()
	{
		return $this->payee_account;
	}

	/**
	 * @param mixed $payee_account
	 */
	public function setPayeeAccount( $payee_account ) : void
	{
		$this->payee_account = $payee_account;
	}

}