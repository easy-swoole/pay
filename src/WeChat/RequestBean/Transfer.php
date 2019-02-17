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


class Transfer
{

	/**
	 * @var string
	 */
	protected $partner_trade_no;   //商户订单号
	/**
	 * @var string
	 */
	protected $openid;  //收款人的openid
	/**
	 * @var string
	 */
	protected $check_name;  //NO_CHECK：不校验真实姓名\FORCE_CHECK：强校验真实姓名
	// 're_user_name'=>'张三',       //check_name为 FORCE_CHECK 校验实名的时候必须提交
	/**
	 * @var string
	 */
	protected $amount;  //企业付款金额，单位为分
	/**
	 * @var string
	 */
	protected $desc; //企业付款金额，单位为分

}