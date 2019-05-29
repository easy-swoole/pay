<?php
/**
 * Created by PhpStorm.
 * User: xcg
 * Date: 2019/3/28
 * Time: 18:15
 */

namespace EasySwoole\Pay\WeChat\WeChatPay;


use EasySwoole\Pay\WeChat\RequestBean\Base;
use EasySwoole\Pay\WeChat\ResponseBean\App as AppResponse;
use EasySwoole\Pay\WeChat\Utility;
use EasySwoole\Utility\Random;

class App extends AbstractPayBase
{
	public function requestPath() : string
	{
		return '/pay/unifiedorder';
	}

	public function pay( Base $bean )
	{
		/** @var \EasySwoole\Pay\WeChat\RequestBean\App $bean */
		$utility = new Utility( $this->config );
		// 如果没有定义回调 使用全局回调
		if( empty( $bean->getNotifyUrl() ) ){
			$bean->setNotifyUrl( $this->config->getNotifyUrl() );
		}
		$result       = $utility->requestApi( $this->requestPath(), $bean );
		$data         = [
			'appid'     => $result['appid'],
			'partnerid' => $result['mch_id'],
			'prepayid'  => $result['prepay_id'],
			'noncestr'  => Random::character( 32 ),
			'timestamp' => strval( time() ),
			'package'   => 'Sign=WXPay',
		];
		$data['sign'] = $utility->generateSign( $data );
		return new AppResponse( $data );
	}
}