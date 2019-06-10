<?php
/**
 * Created by PhpStorm.
 * User: hanwenbo
 * Date: 2019-02-17
 * Time: 17:46
 */
namespace EasySwoole\Pay\AliPay\ResponseBean;


class Refund extends Base
{
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
}