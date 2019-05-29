<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:20
 */

namespace EasySwoole\Pay\WeChat\RequestBean;


class App extends Base
{
	protected $trade_type = 'APP';

	/**
	 * @var string
	 */
	protected $out_trade_no;
	/**
	 * @var string
	 */
	protected $total_fee;
	/**
	 * @var string
	 */
	protected $body;

	/**
	 * @var string
	 */
	protected $attach;

	/**
	 * @var string 终端IP
	 */
	protected $spbill_create_ip;

	/**
	 * @var string
	 */
	protected $openid;


	/**
	 * @return string
	 */
	public function getOutTradeNo() : string
	{
		return $this->out_trade_no;
	}

	/**
	 * @param string $out_trade_no
	 */
	public function setOutTradeNo( string $out_trade_no ) : void
	{
		$this->out_trade_no = $out_trade_no;
	}

	/**
	 * @return string
	 */
	public function getTotalFee() : string
	{
		return $this->total_fee;
	}

	/**
	 * @param string $total_fee
	 */
	public function setTotalFee( string $total_fee ) : void
	{
		$this->total_fee = $total_fee;
	}

	/**
	 * @return string
	 */
	public function getBody() : string
	{
		return $this->body;
	}

	/**
	 * @param string $body
	 */
	public function setBody( string $body ) : void
	{
		$this->body = $body;
	}

	/**
	 * @return string
	 */
	public function getAttach() : string
	{
		return $this->attach;
	}

	/**
	 * @param string $attach
	 */
	public function setAttach( string $attach ) : void
	{
		$this->attach = $attach;
	}

	/**
	 * @return string
	 */
	public function getSpbillCreateIp() : string
	{
		return $this->spbill_create_ip;
	}

	/**
	 * @param string $spbill_create_ip
	 */
	public function setSpbillCreateIp( string $spbill_create_ip ) : void
	{
		$this->spbill_create_ip = $spbill_create_ip;
	}

	/**
	 * @return string
	 */
	public function getOpenid() : string
	{
		return $this->openid;
	}

	/**
	 * @param string $openid
	 */
	public function setOpenid( string $openid ) : void
	{
		$this->openid = $openid;
	}
}