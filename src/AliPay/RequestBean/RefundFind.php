<?php
/**
 * Created by PhpStorm.
 * User: hanwenbo
 * Date: 2019-02-17
 * Time: 17:46
 */
namespace EasySwoole\Pay\AliPay\RequestBean;


class RefundFind extends Base
{
	protected $method = 'alipay.trade.fastpay.refund.query';
	/**
	 * 请求退款接口时，传入的退款请求号，如果在退款请求时未传入，则该值为创建交易时的外部交易号
	 * @var string
	 */
	protected $out_request_no;

	/**
	 * @return string
	 */
	public function getOutRequestNo() : string
	{
		return $this->out_request_no;
	}

	/**
	 * @param string $out_request_no
	 */
	public function setOutRequestNo( string $out_request_no ) : void
	{
		$this->out_request_no = $out_request_no;
	}

}