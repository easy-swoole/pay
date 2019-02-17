<?php
/**
 *
 * Copyright  EasySwoole
 * User: hanwenbo
 * Date: 2019-02-17
 * Time: 13:24
 *
 */

namespace EasySwoole\Pay\WeChat\RequestBean;


class MiniProgram extends Base
{
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