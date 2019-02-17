<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 11:40
 */

namespace EasySwoole\Pay\WeChat;

use EasySwoole\Pay\Wechat\RequestBean\App;
use EasySwoole\Pay\Wechat\RequestBean\GroupRedPack;
use EasySwoole\Pay\Wechat\RequestBean\MiniProgram;
use EasySwoole\Pay\Wechat\RequestBean\OfficialAccount;
use EasySwoole\Pay\Wechat\RequestBean\Pos;
use EasySwoole\Pay\Wechat\RequestBean\RedPack;
use EasySwoole\Pay\Wechat\RequestBean\Scan;
use EasySwoole\Pay\Wechat\RequestBean\Transfer;
use EasySwoole\Pay\Wechat\RequestBean\Wap;

use EasySwoole\Pay\Wechat\ResponseBean\App as AppResponse;
use EasySwoole\Pay\Wechat\ResponseBean\GroupRedPack as GroupRedPackResponse;
use EasySwoole\Pay\Wechat\ResponseBean\MiniProgram as MiniProgramResponse;
use EasySwoole\Pay\Wechat\ResponseBean\OfficialAccount as OfficialAccountResponse;
use EasySwoole\Pay\Wechat\ResponseBean\Pos as PosResponse;
use EasySwoole\Pay\Wechat\ResponseBean\RedPack as RedPackResponse;
use EasySwoole\Pay\Wechat\ResponseBean\Scan as ScanResponse;
use EasySwoole\Pay\Wechat\ResponseBean\Transfer as TransferResponse;
use EasySwoole\Pay\Wechat\ResponseBean\Wap as WapResponse;

class WeChat
{
	private $config;

	function __construct( Config $config )
	{
		$this->config = $config;
	}

	/*
	 * 公众号支付
	 */
	public function officialAccount( OfficialAccount $officialAccount) : OfficialAccountResponse
	{
		$pay_request            = [
			'appId'     => !$this->payRequestUseSubAppId ? $payload['appid'] : $payload['sub_appid'],
			'timeStamp' => strval( time() ),
			'nonceStr'  => Str::random(),
			'package'   => 'prepay_id='.$this->preOrder( $payload )->get( 'prepay_id' ),
			'signType'  => 'MD5',
		];
		$pay_request['paySign'] = Support::generateSign( $pay_request );
	}

	/*
	 * 小程序支付
	 */
	public function miniProgram(MiniProgram $miniProgram) : MiniProgramResponse
	{

	}

	/*
	 * H5 支付
	 */
	public function wap( Wap $wap) : WapResponse
	{

	}

	/*
	 * 扫码支付
	 */
	public function scan(Scan $scan) : ScanResponse
	{

	}

	/*
	 * 刷卡支付
	 */
	public function pos(Pos $pos) : PosResponse
	{

	}

	/*
	 * APP 支付
	 */
	public function app(App $app) : AppResponse
	{

	}

	/*
	 * 企业付款
	 */
	public function transfer(Transfer $transfer) : TransferResponse
	{

	}

	/*
	 * 普通红包
	 */
	public function redPack(RedPack $redPack) : RedPackResponse
	{

	}

	/*
	 * 分裂红包
	 */
	public function groupRedPack( GroupRedPack $groupRedPack) : GroupRedPackResponse
	{
		$payload['wxappid']  = $payload['appid'];
		$payload['amt_type'] = 'ALL_RAND';

		if( $this->mode === Wechat::MODE_SERVICE ){
			$payload['msgappid'] = $payload['appid'];
		}

		unset( $payload['appid'], $payload['trade_type'], $payload['notify_url'], $payload['spbill_create_ip'] );

		$payload['sign'] = Support::generateSign( $payload );

		Events::dispatch( Events::PAY_STARTED, new Events\PayStarted( 'Wechat', 'Group Redpack', $endpoint, $payload ) );

		return Support::requestApi( 'mmpaymkttransfers/sendgroupredpack', $payload, true );
	}

}