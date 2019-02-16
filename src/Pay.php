<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 11:38
 */

namespace EasySwoole\Pay;


use EasySwoole\Pay\AliPay\AliPay;
use EasySwoole\Pay\AliPay\Config as AliPayConfig;
use EasySwoole\Pay\WeChat\Config as WeChatConfig;
use EasySwoole\Pay\WeChat\WeChat;

class Pay
{
	private $instanceList = [];

	function weChat( WeChatConfig $config = null ) : ?WeChat
	{
		if( $config ){
			$this->instanceList['weChat'] = new WeChat( $config );
		}
		if( isset( $this->instanceList['weChat'] ) ){
			return $this->instanceList['weChat'];
		} else{
			return null;
		}
	}

	function aliPay( AliPayConfig $config = null ) : ?AliPay
	{
		if( $config ){
			$this->instanceList['aliPay'] = new AliPay( $config );
		}
		if( isset( $this->instanceList['aliPay'] ) ){
			return $this->instanceList['aliPay'];
		} else{
			return null;
		}
	}
}