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
use EasySwoole\Pay\AliPay\ResponseBean\Base;
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
	private $config;

	function __construct( Config $config )
	{
		$this->config  = $config;
	}

	public function web( Web $web ) : WebResponse
	{
        $array = $web->toArray(  ) + $this->getSysParams();
        $array['biz_content'] = json_encode($array,JSON_UNESCAPED_UNICODE);
        $array['sign'] = $this->generateSign($array);
        return new WebResponse($array);
	}


	public function wap( Wap $wap ) : WapResponse
	{

	}

	public function app( App $app ) : AppResponse
	{

	}


	public function pos( Pos $pos ) : PosResponse
	{

	}


	public function scan( Scan $scan ) : ScanResponse
	{

	}

	public function transfer( Transfer $transfer ) : TransferResponse
	{

	}


	public function miniProgram( MiniProgram $miniProgram ) : MiniProgramResponse
	{

	}

	public function verify( NotifyRequest $request ) : bool
	{

	}

	/**
	 * Get signContent that is to be signed.
	 *
	 *
	 * @param array $params
	 * @return string
	 */
	private function getSignContent( array $params) : string
	{
        ksort($params);
        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }
        return $stringToBeSigned;
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
	private function generateSign( array $params ) : string
	{
		$privateKey = $this->config->getPrivateKey();
		if( is_null( $privateKey ) ){
			throw new InvalidConfigException( 'Missing Alipay Config -- [private_key]' );
		}
		$string = new SplString( $privateKey );
		if( $string->endsWith( '.pem' ) ){
			$privateKey = openssl_pkey_get_private( $privateKey );
		} else{
			$privateKey = "-----BEGIN RSA PRIVATE KEY-----\n".wordwrap( $privateKey, 64, "\n", true )."\n-----END RSA PRIVATE KEY-----";
		}
		openssl_sign( $this->getSignContent( $params ), $sign, $privateKey, OPENSSL_ALGO_SHA256 );
		$sign = base64_encode( $sign );
		return $sign;
	}

    private function getSysParams():array
    {
        $sysParams = [];
        $sysParams["app_id"] = $this->config->getAppId();
        $sysParams["version"] = $this->config->getApiVersion();
        $sysParams["format"] = $this->config->getFormat();
        $sysParams["sign_type"] = $this->config->getSignType();
        $sysParams["timestamp"] = date("Y-m-d H:i:s");
        $sysParams["return_url"] = $this->config->getReturnUrl();
        $sysParams["notify_url"] = $this->config->getNotifyUrl();
        $sysParams["charset"] = $this->config->getCharset();
        $sysParams["app_auth_token"] = $this->config->getAppAuthToken();
        return (new Base($sysParams))->toArray();
    }

    private function checkEmpty($value)
    {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }

}