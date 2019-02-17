<?php
/**
 * Created by PhpStorm.
 * User: hanwenbo
 * Date: 2019-02-17
 * Time: 17:46
 */
namespace EasySwoole\Pay\AliPay\RequestBean;


class TransferFind extends Base
{
	protected $method = 'alipay.fund.trans.order.query';
	/**
	 * 商户转账唯一订单号：发起转账来源方定义的转账单据ID。和支付宝转账单据号不能同时为空。当和支付宝转账单据号同时提供时，将用支付宝转账单据号进行查询，忽略本参数。
	 * @example 3142321423432
	 * @var string
	 */
	protected $out_biz_no;
	/**
	 * 支付宝转账单据号：和商户转账唯一订单号不能同时为空。当和商户转账唯一订单号同时提供时，将用本参数进行查询，忽略商户转账唯一订单号。
	 * @example 20160627110070001502260006780837
	 * @var string
	 */
	protected $order_id;

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
	public function getOrderId() : string
	{
		return $this->order_id;
	}

	/**
	 * @param string $order_id
	 */
	public function setOrderId( string $order_id ) : void
	{
		$this->order_id = $order_id;
	}

}