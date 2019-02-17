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


class RedPack extends Base
{
	/**
	 * @var string
	 */
	protected $mch_billno; // 商户订单号
	/**
	 * @var string
	 */
	protected $send_name; // 商户名称
	/**
	 * @var string
	 */
	protected $total_amount;
	/**
	 * @var string
	 */
	protected $re_openid; //  用户openid
	/**
	 * @var string
	 */
	protected $total_num;
	/**
	 * @var string
	 */
	protected $wishing; // 祝福语
	/**
	 * @var string
	 */
	protected $act_name; // 活动名称
	/**
	 * @var string
	 */
	protected $remark;

	/**
	 * @return string
	 */
	public function getMchBillno() : string
	{
		return $this->mch_billno;
	}

	/**
	 * @param string $mch_billno
	 */
	public function setMchBillno( string $mch_billno ) : void
	{
		$this->mch_billno = $mch_billno;
	}

	/**
	 * @return string
	 */
	public function getSendName() : string
	{
		return $this->send_name;
	}

	/**
	 * @param string $send_name
	 */
	public function setSendName( string $send_name ) : void
	{
		$this->send_name = $send_name;
	}

	/**
	 * @return string
	 */
	public function getTotalAmount() : string
	{
		return $this->total_amount;
	}

	/**
	 * @param string $total_amount
	 */
	public function setTotalAmount( string $total_amount ) : void
	{
		$this->total_amount = $total_amount;
	}

	/**
	 * @return string
	 */
	public function getReOpenid() : string
	{
		return $this->re_openid;
	}

	/**
	 * @param string $re_openid
	 */
	public function setReOpenid( string $re_openid ) : void
	{
		$this->re_openid = $re_openid;
	}

	/**
	 * @return string
	 */
	public function getTotalNum() : string
	{
		return $this->total_num;
	}

	/**
	 * @param string $total_num
	 */
	public function setTotalNum( string $total_num ) : void
	{
		$this->total_num = $total_num;
	}

	/**
	 * @return string
	 */
	public function getWishing() : string
	{
		return $this->wishing;
	}

	/**
	 * @param string $wishing
	 */
	public function setWishing( string $wishing ) : void
	{
		$this->wishing = $wishing;
	}

	/**
	 * @return string
	 */
	public function getActName() : string
	{
		return $this->act_name;
	}

	/**
	 * @param string $act_name
	 */
	public function setActName( string $act_name ) : void
	{
		$this->act_name = $act_name;
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


}