<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:20
 */

namespace EasySwoole\Pay\Wechat\RequestBean;


class OfficialAccount extends Base
{
	protected $trade_type = 'JSAPI';
	protected $openid ;

	/**
	 * @return mixed
	 */
	public function getOpenid()
	{
		return $this->openid;
	}

	/**
	 * @param mixed $openid
	 */
	public function setOpenid( $openid ) : void
	{
		$this->openid = $openid;
	}

}