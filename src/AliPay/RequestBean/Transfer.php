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
	protected $method = 'alipay.fund.trans.toaccount.transfer';
	/**
	 * @var string
	 */
	protected $out_biz_no;

	/**
	 * @var string
	 */
	protected $payee_type;
	/**
	 * @var string
	 */
	protected $payee_account;
	/**
	 * @var string
	 */
	protected $payer_show_name;

	/**
	 * @var string
	 */
	protected $payee_real_name;

	/**
	 * @var string
	 */
	protected $remark;
	/**
	 * @var string
	 */
	protected $amount;

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

	/**
	 * @return string
	 */
	public function getOutBizNo() : string
	{
		return $this->out_biz_no;
	}

	/**
	 * @param string $out_biz_no
	 */
	public function setOutBizNo( string $out_biz_no ) : void
	{
		$this->out_biz_no = $out_biz_no;
	}

	/**
	 * @return string
	 */
	public function getPayerShowName() : string
	{
		return $this->payer_show_name;
	}

	/**
	 * @param string $payer_show_name
	 */
	public function setPayerShowName( string $payer_show_name ) : void
	{
		$this->payer_show_name = $payer_show_name;
	}

	/**
	 * @return string
	 */
	public function getPayeeRealName() : string
	{
		return $this->payee_real_name;
	}

	/**
	 * @param string $payee_real_name
	 */
	public function setPayeeRealName( string $payee_real_name ) : void
	{
		$this->payee_real_name = $payee_real_name;
	}

	/**
	 * @return string
	 */
	public function getRemark() : string
	{
		return $this->remark;
	}

	/**
	 * @param string $remark
	 */
	public function setRemark( string $remark ) : void
	{
		$this->remark = $remark;
	}

	/**
	 * @return string
	 */
	public function getAmount() : string
	{
		return $this->amount;
	}

	/**
	 * @param string $amount
	 */
	public function setAmount( string $amount ) : void
	{
		$this->amount = $amount;
	}


}