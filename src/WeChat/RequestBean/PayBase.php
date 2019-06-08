<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/12
 * Time: 16:26
 */

namespace EasySwoole\Pay\WeChat\RequestBean;

/**
 * 支付相关的基础参数
 * Class PayBase
 * @package EasySwoole\Pay\WeChat\RequestBean
 */
abstract class PayBase extends Base
{
	protected $device_info;      // 设备信息
	protected $body;             // 商品描述
	protected $detail;           // 商品详情
	protected $attach;           // 附加数据
	protected $out_trade_no;     // 商户订单号
	protected $fee_type;         // 货币类型
	protected $total_fee;        // 总金额(单位分)
	protected $spbill_create_ip; // 终端IP
	protected $time_start;       // 交易起始时间
	protected $time_expire;      // 交易结束时间
	protected $notify_url;       // 通知地址
	protected $receipt;          // 电子发票入口开放标识
	protected $limit_pay;        // 指定支付方式
	protected $goods_tag;        // 订单优惠标记

	/**
	 * @return mixed
	 */
	public function getDeviceInfo()
	{
		return $this->device_info;
	}

	/**
	 * @param mixed $device_info
	 */
	public function setDeviceInfo($device_info): void
	{
		$this->device_info = $device_info;
	}

	/**
	 * @return mixed
	 */
	public function getBody()
	{
		return $this->body;
	}

	/**
	 * @param mixed $body
	 */
	public function setBody($body): void
	{
		$this->body = $body;
	}

	/**
	 * @return mixed
	 */
	public function getDetail()
	{
		return $this->detail;
	}

	/**
	 * @param mixed $detail
	 */
	public function setDetail($detail): void
	{
		$this->detail = $detail;
	}

	/**
	 * @return mixed
	 */
	public function getAttach()
	{
		return $this->attach;
	}

	/**
	 * @param mixed $attach
	 */
	public function setAttach($attach): void
	{
		$this->attach = $attach;
	}

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
	public function setOutTradeNo($out_trade_no): void
	{
		$this->out_trade_no = $out_trade_no;
	}

	/**
	 * @return mixed
	 */
	public function getFeeType()
	{
		return $this->fee_type;
	}

	/**
	 * @param mixed $fee_type
	 */
	public function setFeeType($fee_type): void
	{
		$this->fee_type = $fee_type;
	}

	/**
	 * @return mixed
	 */
	public function getTotalFee()
	{
		return $this->total_fee;
	}

	/**
	 * @param mixed $total_fee
	 */
	public function setTotalFee($total_fee): void
	{
		$this->total_fee = $total_fee;
	}

	/**
	 * @return mixed
	 */
	public function getSpbillCreateIp()
	{
		return $this->spbill_create_ip;
	}

	/**
	 * @param mixed $spbill_create_ip
	 */
	public function setSpbillCreateIp($spbill_create_ip): void
	{
		$this->spbill_create_ip = $spbill_create_ip;
	}

	/**
	 * @return mixed
	 */
	public function getTimeStart()
	{
		return $this->time_start;
	}

	/**
	 * @param mixed $time_start
	 */
	public function setTimeStart($time_start): void
	{
		$this->time_start = $time_start;
	}

	/**
	 * @return mixed
	 */
	public function getTimeExpire()
	{
		return $this->time_expire;
	}

	/**
	 * @param mixed $time_expire
	 */
	public function setTimeExpire($time_expire): void
	{
		$this->time_expire = $time_expire;
	}

	/**
	 * @return mixed
	 */
	public function getNotifyUrl()
	{
		return $this->notify_url;
	}

	/**
	 * @param mixed $notify_url
	 */
	public function setNotifyUrl($notify_url): void
	{
		$this->notify_url = $notify_url;
	}

	/**
	 * @return mixed
	 */
	public function getReceipt()
	{
		return $this->receipt;
	}

	/**
	 * @param mixed $receipt
	 */
	public function setReceipt($receipt): void
	{
		$this->receipt = $receipt;
	}

	/**
	 * @return mixed
	 */
	public function getLimitPay()
	{
		return $this->limit_pay;
	}

	/**
	 * @param mixed $limit_pay
	 */
	public function setLimitPay($limit_pay): void
	{
		$this->limit_pay = $limit_pay;
	}

	/**
	 * @return mixed
	 */
	public function getGoodsTag()
	{
		return $this->goods_tag;
	}

	/**
	 * @param mixed $goods_tag
	 */
	public function setGoodsTag($goods_tag): void
	{
		$this->goods_tag = $goods_tag;
	}

}