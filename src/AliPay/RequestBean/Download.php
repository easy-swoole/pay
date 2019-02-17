<?php
/**
 * Created by PhpStorm.
 * User: hanwenbo
 * Date: 2019-02-17
 * Time: 17:46
 */
namespace EasySwoole\Pay\AliPay\RequestBean;


class Download extends Base
{
	protected $method = 'alipay.data.dataservice.bill.downloadurl.query';
	/**
	 * 账单类型，商户通过接口或商户经开放平台授权后其所属服务商通过接口可以获取以下账单类型：trade、signcustomer；trade指商户基于支付宝交易收单的业务账单；signcustomer是指基于商户支付宝余额收入及支出等资金变动的帐务账单；
	 * @example trade
	 * @var string
	 */
	protected $bill_type;
	/**
	 * 账单时间：日账单格式为yyyy-MM-dd，月账单格式为yyyy-MM。
	 * @example 2016-04-05
	 * @var string
	 */
	protected $bill_date;

	/**
	 * @return string
	 */
	public function getBillType() : string
	{
		return $this->bill_type;
	}

	/**
	 * @param string $bill_type
	 */
	public function setBillType( string $bill_type ) : void
	{
		$this->bill_type = $bill_type;
	}

	/**
	 * @return string
	 */
	public function getBillDate() : string
	{
		return $this->bill_date;
	}

	/**
	 * @param string $bill_date
	 */
	public function setBillDate( string $bill_date ) : void
	{
		$this->bill_date = $bill_date;
	}

}