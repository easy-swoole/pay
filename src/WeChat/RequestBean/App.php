<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:20
 */

namespace EasySwoole\Pay\WeChat\RequestBean;


class App extends PayBase
{
	protected $trade_type = 'APP';

	/**
	 * @var string
	 */
	protected $openid;

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