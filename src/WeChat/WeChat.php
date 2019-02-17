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

use EasySwoole\Pay\Exceptions\InvalidConfigException;

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
	public function officialAccount( OfficialAccount $officialAccount ) : OfficialAccountResponse
	{
		$pay_request            = [
			'appId'     => !$this->payRequestUseSubAppId ? $array['appid'] : $array['sub_appid'],
			'timeStamp' => strval( time() ),
			'nonceStr'  => Str::random(),
			'package'   => 'prepay_id='.$this->preOrder( $array )->get( 'prepay_id' ),
			'signType'  => 'MD5',
		];
		$pay_request['paySign'] = Support::generateSign( $pay_request );
	}

	/*
	 * 小程序支付
	 */
	public function miniProgram( MiniProgram $miniProgram ) : MiniProgramResponse
	{

	}

	/*
	 * H5 支付
	 */
	public function wap( Wap $wap ) : WapResponse
	{

	}

	/*
	 * 扫码支付
	 */
	public function scan( Scan $scan ) : ScanResponse
	{

	}

	/*
	 * 刷卡支付
	 */
	public function pos( Pos $pos ) : PosResponse
	{

	}

	/*
	 * APP 支付
	 */
	public function app( App $app ) : AppResponse
	{
		$array                = $app->toArray() + $this->getSysParams();

		if( $this->mode === Wechat::MODE_SERVICE ){
			$array['sub_appid'] = Support::getInstance()->sub_appid;
		}

		$pay_request         = [
			'appid'     => $this->mode === Wechat::MODE_SERVICE ? $array['sub_appid'] : $array['appid'],
			'partnerid' => $this->mode === Wechat::MODE_SERVICE ? $array['sub_mch_id'] : $array['mch_id'],
			'prepayid'  => $this->preOrder( $array )->get( 'prepay_id' ),
			'timestamp' => strval( time() ),
			'noncestr'  => Str::random(),
			'package'   => 'Sign=WXPay',
		];
		$pay_request['sign'] = $this->generateSign( $pay_request );

	}

	/*
	 * 企业付款
	 */
	public function transfer( Transfer $transfer ) : TransferResponse
	{

	}

	/*
	 * 普通红包
	 */
	public function redPack( RedPack $redPack ) : RedPackResponse
	{

	}

	/*
	 * 分裂红包
	 */
	public function groupRedPack( GroupRedPack $groupRedPack ) : GroupRedPackResponse
	{
		$array['wxappid']  = $array['appid'];
		$array['amt_type'] = 'ALL_RAND';

		if( $this->mode === Wechat::MODE_SERVICE ){
			$array['msgappid'] = $array['appid'];
		}

		unset( $array['appid'], $array['trade_type'], $array['notify_url'], $array['spbill_create_ip'] );

		$array['sign'] = Support::generateSign( $array );

		Events::dispatch( Events::PAY_STARTED, new Events\PayStarted( 'Wechat', 'Group Redpack', $endpoint, $array ) );

		return Support::requestApi( 'mmpaymkttransfers/sendgroupredpack', $array, true );
	}


	/**
	 * @param mixed $request
	 * @return array
	 * @throws InvalidConfigException
	 */
	private function getRequestParams( $request ) : array
	{
		$array                = $request->toArray() + $this->getSysParams();
		$array['biz_content'] = json_encode( $array, JSON_UNESCAPED_UNICODE );
		$array['sign']        = $this->generateSign( $array );
		return $array;
	}

	private function getSysParams() : array
	{
		$sysParams                   = [];
		$sysParams["app_id"]         = $this->config->getAppId();
		$sysParams["version"]        = $this->config->getApiVersion();
		$sysParams["format"]         = $this->config->getFormat();
		$sysParams["sign_type"]      = $this->config->getSignType();
		$sysParams["timestamp"]      = date( "Y-m-d H:i:s" );
		$sysParams["return_url"]     = $this->config->getReturnUrl();
		$sysParams["notify_url"]     = $this->config->getNotifyUrl();
		$sysParams["charset"]        = $this->config->getCharset();
		$sysParams["app_auth_token"] = $this->config->getAppAuthToken();
		return (new Base( $sysParams ))->toArray();
	}

	private function checkEmpty( $value )
	{
		if( !isset( $value ) )
			return true;
		if( $value === null )
			return true;
		if( trim( $value ) === "" )
			return true;
		return false;
	}

	/**
	 * Generate wechat sign.
	 * @param array $data
	 * @return string
	 */
	public function generateSign( array $data ) : string
	{
		ksort( $data );
		$string = md5( $this->getSignContent( $data ).'&key='.$this->config->getKey() );
		return strtoupper( $string );
	}

	/**
	 * Generate sign content.
	 * @param array $data
	 * @return string
	 */
	public function getSignContent( array $data ) : string
	{
		$buff = '';
		foreach( $data as $k => $v ){
			$buff .= ($k != 'sign' && $v != '' && !is_array( $v )) ? $k.'='.$v.'&' : '';
		}
		return trim( $buff, '&' );
	}

	/**
	 * Decrypt refund contents.
	 * @param string $contents
	 * @return string
	 */
	public function decryptRefundContents( string $contents ) : string
	{
		return openssl_decrypt( base64_decode( $contents ), 'AES-256-ECB', md5( $this->config->getKey() ), OPENSSL_RAW_DATA );
	}
}