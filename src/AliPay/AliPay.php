<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 11:42
 */

namespace EasySwoole\Pay\AliPay;


use EasySwoole\Pay\AliPay\RequestBean\App;
use EasySwoole\Pay\AliPay\RequestBean\MiniProgram;
use EasySwoole\Pay\AliPay\RequestBean\NotifyRequest;
use EasySwoole\Pay\AliPay\RequestBean\Pos;
use EasySwoole\Pay\AliPay\RequestBean\Scan;
use EasySwoole\Pay\AliPay\RequestBean\Transfer;
use EasySwoole\Pay\AliPay\RequestBean\Wap;
use EasySwoole\Pay\AliPay\RequestBean\Web;
use EasySwoole\Pay\AliPay\ResponseBean\Web as WebResponse;
use EasySwoole\Pay\AliPay\ResponseBean\Wap as WapResponse;
use EasySwoole\Pay\AliPay\ResponseBean\App as AppResponse;
use EasySwoole\Pay\AliPay\ResponseBean\Pos as PosResponse;
use EasySwoole\Pay\AliPay\ResponseBean\Scan as ScanResponse;
use EasySwoole\Pay\AliPay\ResponseBean\Transfer as TransferResponse;
use EasySwoole\Pay\AliPay\ResponseBean\MiniProgram as MiniProgramResponse;
use EasySwoole\Pay\Utility\NewWork;
use EasySwoole\Pay\Exceptions\GatewayException;
use EasySwoole\Pay\Exceptions\InvalidArgumentException;
use EasySwoole\Pay\Exceptions\InvalidConfigException;
use EasySwoole\Pay\Exceptions\InvalidGatewayException;
use EasySwoole\Pay\Exceptions\InvalidSignException;
use EasySwoole\Spl\SplArray;

use EasySwoole\Spl\SplString;

class AliPay
{
	/**
	 * Const mode_normal.
	 */
	const MODE_NORMAL = 'normal';

	/**
	 * Const mode_dev.
	 */
	const MODE_DEV = 'dev';

	/**
	 * Const url.
	 */
	const URL
		= [
			self::MODE_NORMAL => 'https://openapi.alipay.com/gateway.do',
			self::MODE_DEV    => 'https://openapi.alipaydev.com/gateway.do',
		];

	/**
	 * Alipay gateway.
	 *
	 * @var string
	 */
	protected $baseUri;


	private $config;

	function __construct( Config $config )
	{
		$this->baseUri = Alipay::URL[isset( $config['mode'] ) ?? self::MODE_NORMAL];
		$this->config  = $config;
	}

	/**
	 * Get Base Uri.
	 *
	 * @return string
	 */
	public function getBaseUri()
	{
		return $this->baseUri;
	}

	/*
	 * 电脑支付
	 */
	public function web( Web $web ) : WebResponse
	{
		return new WebResponse( $web->getPayload() );
	}

	/*
	 * 手机网站支付
	 */
	public function wap( Wap $wap ) : WapResponse
	{
		return new WapResponse( $wap->getPayload() );
	}

	/**
	 * APP 支付
	 * @param App $app
	 * @return AppResponse
	 * @throws GatewayException
	 * @throws InvalidConfigException
	 * @throws InvalidSignException
	 */
	public function app( App $app ) : AppResponse
	{
		$payload = $app->getPayload();
		$result  = $this->requestApi( $payload );
		return new AppResponse( $result );
	}

	/**
	 * 刷卡支付
	 * @param Pos $pos
	 * @return PosResponse
	 * @throws GatewayException
	 * @throws InvalidConfigException
	 * @throws InvalidSignException
	 */
	public function pos( Pos $pos ) : PosResponse
	{
		$payload = $pos->getPayload();
		$result  = $this->requestApi( $payload );
		return new PosResponse( $result );
	}

	/*
	 * 扫码支付
	 */
	public function scan( Scan $scan ) : ScanResponse
	{
		$payload['spbill_create_ip'] = Request::createFromGlobals()->server->get( 'SERVER_ADDR' );
		$payload['trade_type']       = $this->getTradeType();
		return $this->preOrder( $payload );
	}

	/*
	 * 帐户转账
	 */
	public function transfer( Transfer $transfer ) : TransferResponse
	{
		$payload['method']      = $this->getMethod();
		$payload['biz_content'] = json_encode( array_merge( json_decode( $payload['biz_content'], true ), ['product_code' => $this->getProductCode()] ) );
		$payload['sign']        = $this->generateSign( $payload );


		return $this->requestApi( $payload );
	}

	/*
	 * 小程序支付
	 */
	public function miniProgram( MiniProgram $miniProgram ) : MiniProgramResponse
	{
		if( empty( json_decode( $payload['biz_content'], true )['buyer_id'] ) ){
			throw new \EasySwoole\Pay\Exceptions\InvalidArgumentException( 'buyer_id required' );
		}

		$payload['method'] = $this->getMethod();
		$payload['sign']   = $this->generateSign( $payload );


		return $this->requestApi( $payload );
	}

	public function verify( NotifyRequest $request ) : bool
	{

	}


	/**
	 * @param $data
	 * @return array
	 * @throws GatewayException
	 * @throws InvalidConfigException
	 * @throws InvalidSignException
	 */
	public function requestApi( $data ) : array
	{
		$result = mb_convert_encoding( NewWork::post( $this->getBaseUri(), $data ), 'utf-8', 'gb2312' );
		$result = json_decode( $result, true );

		$method = str_replace( '.', '_', $data['method'] ).'_response';

		if( !isset( $result['sign'] ) || $result[$method]['code'] != '10000' ){
			throw new GatewayException( 'Get Alipay API Error:'.$result[$method]['msg'].($result[$method]['sub_code'] ?? ''), $result, $result[$method]['code'] );
		}

		if( $this->verifySign( $result[$method], true, $result['sign'] ) ){
			return $result[$method];
		}
		throw new InvalidSignException( 'Alipay Sign Verify FAILED', $result );
	}

	/**
	 * Verify sign.
	 *
	 *
	 * @param array       $data
	 * @param bool        $sync
	 * @param string|null $sign
	 *
	 * @throws InvalidConfigException
	 *
	 * @return bool
	 */
	public function verifySign( array $data, $sync = false, $sign = null ) : bool
	{
		$publicKey = $this->config->ali_public_key;

		if( is_null( $publicKey ) ){
			throw new InvalidConfigException( 'Missing Alipay Config -- [ali_public_key]' );
		}
		$string = new SplString( $publicKey );
		if( $string->endsWith( '.pem' ) ){
			$publicKey = openssl_pkey_get_public( $publicKey );
		} else{
			$publicKey = "-----BEGIN PUBLIC KEY-----\n".wordwrap( $publicKey, 64, "\n", true )."\n-----END PUBLIC KEY-----";
		}

		$sign = $sign ?? $data['sign'];

		$toVerify = $sync ? mb_convert_encoding( json_encode( $data, JSON_UNESCAPED_UNICODE ), 'gb2312', 'utf-8' ) : self::getSignContent( $data, true );

		return openssl_verify( $toVerify, base64_decode( $sign ), $publicKey, OPENSSL_ALGO_SHA256 ) === 1;
	}

	/**
	 * Get signContent that is to be signed.
	 *
	 *
	 * @param array $data
	 * @param bool  $verify
	 *
	 * @return string
	 */
	public function getSignContent( array $data, $verify = false ) : string
	{
		$data = self::encoding( $data, $data['charset'] ?? 'gb2312', 'utf-8' );

		ksort( $data );

		$stringToBeSigned = '';
		foreach( $data as $k => $v ){
			if( $verify && $k != 'sign' && $k != 'sign_type' ){
				$stringToBeSigned .= $k.'='.$v.'&';
			}
			if( !$verify && $v !== '' && !is_null( $v ) && $k != 'sign' && '@' != substr( $v, 0, 1 ) ){
				$stringToBeSigned .= $k.'='.$v.'&';
			}
		}

		Log::debug( 'Alipay Generate Sign Content Before Trim', [$data, $stringToBeSigned] );

		return trim( $stringToBeSigned, '&' );
	}

	/**
	 * Convert encoding.
	 *
	 *
	 * @param string|array $data
	 * @param string       $to
	 * @param string       $from
	 *
	 * @return array
	 */
	public static function encoding( $data, $to = 'utf-8', $from = 'gb2312' ) : array
	{
		$encoded = [];

		foreach( $data as $key => $value ){
			$encoded[$key] = is_array( $value ) ? self::encoding( $value, $to, $from ) : mb_convert_encoding( $value, $to, $from );
		}

		return $encoded;
	}

	/**
	 * Generate sign.
	 *
	 *
	 * @param array $params
	 *
	 * @throws InvalidConfigException
	 *
	 * @return string
	 */
	public function generateSign( array $params ) : string
	{
		$privateKey = $this->config->private_key;

		if( is_null( $privateKey ) ){
			throw new InvalidConfigException( 'Missing Alipay Config -- [private_key]' );
		}

		$string = new SplString( $privateKey );
		if( $string->endsWith( '.pem' ) ){
			$privateKey = openssl_pkey_get_private( $privateKey );
		} else{
			$privateKey = "-----BEGIN RSA PRIVATE KEY-----\n".wordwrap( $privateKey, 64, "\n", true )."\n-----END RSA PRIVATE KEY-----";
		}

		openssl_sign( self::getSignContent( $params ), $sign, $privateKey, OPENSSL_ALGO_SHA256 );

		$sign = base64_encode( $sign );

		Log::debug( 'Alipay Generate Sign', [$params, $sign] );

		return $sign;
	}
}