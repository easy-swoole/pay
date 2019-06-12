<?php
/**
 * Created by PhpStorm.
 * User: hanwenbo
 * Date: 2019-02-17
 * Time: 17:46
 */
namespace EasySwoole\Pay\AliPay\RequestBean;


class Refund extends Base
{
	protected $method = 'alipay.trade.refund';
	/**
	 * @var string 支付宝交易号，和商户订单号不能同时为空
	 */
	protected $trade_no;

	/**
	 * @var string 需要退款的金额，该金额不能大于订单金额,单位为元，支持两位小数
	 */
	protected $refund_amount;
	/**
	 * @var string 订单退款币种信息
	 */
	protected $refund_currency;
	/**
	 * @var string 退款的原因说明
	 */
	protected $refund_reason;
	/**
	 * @var string 标识一次退款请求，同一笔交易多次退款需要保证唯一，如需部分退款，则此参数必传。
	 */
	protected $out_request_no;
	/**
	 * @var string 商户的操作员编号
	 */
	protected $operator_id;
	/**
	 * @var string 商户的门店编号
	 */
	protected $store_id;
	/**
	 * @var string 商户的终端编号
	 */
	protected $terminal_id;
	/**
	 * @var string 退款包含的商品列表信息，Json格式。
	其它说明详见：“商品明细说明”
	 */
	protected $goods_detail;
	/**
	 * @var string 退分账明细信息
	 */
	protected $refund_royalty_parameters;
	/**
	 * @var string 银行间联模式下有用，其它场景请不要使用；
	双联通过该参数指定需要退款的交易所属收单机构的pid;
	 */
	protected $org_pid;

	/**
	 * @return string
	 */
	public function getTradeNo() : string
	{
		return $this->trade_no;
	}

	/**
	 * @param string $trade_no
	 */
	public function setTradeNo( string $trade_no ) : void
	{
		$this->trade_no = $trade_no;
	}

	/**
	 * @return string
	 */
	public function getRefundAmount() : string
	{
		return $this->refund_amount;
	}

	/**
	 * @param string $refund_amount
	 */
	public function setRefundAmount( string $refund_amount ) : void
	{
		$this->refund_amount = $refund_amount;
	}

	/**
	 * @return string
	 */
	public function getRefundCurrency() : string
	{
		return $this->refund_currency;
	}

	/**
	 * @param string $refund_currency
	 */
	public function setRefundCurrency( string $refund_currency ) : void
	{
		$this->refund_currency = $refund_currency;
	}

	/**
	 * @return string
	 */
	public function getRefundReason() : string
	{
		return $this->refund_reason;
	}

	/**
	 * @param string $refund_reason
	 */
	public function setRefundReason( string $refund_reason ) : void
	{
		$this->refund_reason = $refund_reason;
	}

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

	/**
	 * @return string
	 */
	public function getOperatorId() : string
	{
		return $this->operator_id;
	}

	/**
	 * @param string $operator_id
	 */
	public function setOperatorId( string $operator_id ) : void
	{
		$this->operator_id = $operator_id;
	}

	/**
	 * @return string
	 */
	public function getStoreId() : string
	{
		return $this->store_id;
	}

	/**
	 * @param string $store_id
	 */
	public function setStoreId( string $store_id ) : void
	{
		$this->store_id = $store_id;
	}

	/**
	 * @return string
	 */
	public function getTerminalId() : string
	{
		return $this->terminal_id;
	}

	/**
	 * @param string $terminal_id
	 */
	public function setTerminalId( string $terminal_id ) : void
	{
		$this->terminal_id = $terminal_id;
	}

	/**
	 * @return string
	 */
	public function getGoodsDetail() : string
	{
		return $this->goods_detail;
	}

	/**
	 * @param string $goods_detail
	 */
	public function setGoodsDetail( string $goods_detail ) : void
	{
		$this->goods_detail = $goods_detail;
	}

	/**
	 * @return string
	 */
	public function getRefundRoyaltyParameters() : string
	{
		return $this->refund_royalty_parameters;
	}

	/**
	 * @param string $refund_royalty_parameters
	 */
	public function setRefundRoyaltyParameters( string $refund_royalty_parameters ) : void
	{
		$this->refund_royalty_parameters = $refund_royalty_parameters;
	}

	/**
	 * @return string
	 */
	public function getOrgPid() : string
	{
		return $this->org_pid;
	}

	/**
	 * @param string $org_pid
	 */
	public function setOrgPid( string $org_pid ) : void
	{
		$this->org_pid = $org_pid;
	}

	protected function initialize(): void
    {
        if(!empty($this->refund_reason)){
            $this->refund_reason = urlencode($this->refund_reason);
        }
    }


}