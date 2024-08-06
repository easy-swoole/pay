<?php

namespace EasySwoole\Pay;

use EasySwoole\HttpClient\HttpClient;
use EasySwoole\Pay\Beans\Alipay\Gateway;
use EasySwoole\Pay\Config\AlipayConfig;
use EasySwoole\Pay\Exceptions\InvalidConfigException;
use EasySwoole\Pay\Request\Alipay\BaseRequest;
use EasySwoole\Pay\Request\Alipay\PreQrCode;
use EasySwoole\Spl\SplFileStream;
use EasySwoole\Spl\SplString;

class Alipay
{

    private string $gateway;
    function __construct(
        protected AlipayConfig $config
    )
    {
        if($this->config->getGateWay() == Gateway::PRODUCE){
            $this->gateway = 'https://openapi.alipay.com/gateway.do';
        }else{
            $this->gateway = 'https://openapi.alipaydev.com/gateway.do';
        }
    }


    function preQrCode(PreQrCode $request)
    {
        $baseRequest = $this->getSysParams();
        $baseRequest->method = 'alipay.trade.precreate';

        $baseRequest->biz_content = json_encode($request->toArray());
        $requestData = $baseRequest->toArray();
        $sign = $this->generateSign($requestData);
        $requestData['sign'] = $sign;

        var_dump($requestData);
//        $client = new HttpClient($this->gateway);

//        $res = $client->post($requestData);
    }

    protected function getCertSN($certPath){
        $string = new SplFileStream($certPath);
        $cert = $string->__toString();
        $ssl = openssl_x509_parse($cert);
        return md5($this->array2string(array_reverse($ssl['issuer'])) . $ssl['serialNumber']);
    }

    protected function getRootCertSN($certPath)
    {
        $string = new SplFileStream($certPath);
        $cert = $string->__toString();
        $array = explode("-----END CERTIFICATE-----", $cert);
        $SN = null;
        for ($i = 0; $i < count($array) - 1; $i++) {
            $ssl[$i] = openssl_x509_parse($array[$i] . "-----END CERTIFICATE-----");
            if (strpos($ssl[$i]['serialNumber'], '0x') === 0) {
                $ssl[$i]['serialNumber'] = $this->hex2dec($ssl[$i]['serialNumberHex']);
            }
            if ($ssl[$i]['signatureTypeLN'] == "sha1WithRSAEncryption" || $ssl[$i]['signatureTypeLN'] == "sha256WithRSAEncryption") {
                if ($SN == null) {
                    $SN = md5($this->array2string(array_reverse($ssl[$i]['issuer'])) . $ssl[$i]['serialNumber']);
                } else {

                    $SN = $SN . "_" . md5($this->array2string(array_reverse($ssl[$i]['issuer'])) . $ssl[$i]['serialNumber']);
                }
            }
        }
        return $SN;
    }


    /**
     * 0x转高精度数字
     * @param $hex
     * @return int|string
     */
    protected function hex2dec($hex)
    {
        $dec = 0;
        $len = strlen($hex);
        for ($i = 1; $i <= $len; $i++) {
            $dec = bcadd($dec, bcmul(strval(hexdec($hex[$i - 1])), bcpow('16', strval($len - $i))));
        }
        return $dec;
    }

    protected function array2string($array)
    {
        $string = [];
        if ($array && is_array($array)) {
            foreach ($array as $key => $value) {
                $string[] = $key . '=' . $value;
            }
        }
        return implode(',', $string);
    }

    private function getSysParams() : BaseRequest
    {
        $sysParams                   = [];
        $sysParams["app_id"]         = $this->config->getAppId();
        $sysParams["version"]        = $this->config->getApiVersion();
        $sysParams["format"]         = $this->config->getFormat();
        $sysParams["sign_type"]      = $this->config->getSignType();
        $sysParams["timestamp"]      = date( "Y-m-d H:i:s" );
        $sysParams["notify_url"]     = $this->config->getNotifyUrl();
        $sysParams["charset"]        = $this->config->getCharset();
        $sysParams["app_auth_token"] = $this->config->getAppAuthToken();
        if ($this->config->isCertMode()) {
            $sysParams["app_cert_sn"]    = $this->getCertSN($this->config->getAppPublicCertPath());
            $sysParams["alipay_root_cert_sn"] = $this->getRootCertSN($this->config->getAlipayRootCertPath());
        }
        return new BaseRequest($sysParams);
    }

    private function generateSign( array $params ) : string
    {
        $privateKey = $this->config->getPrivateKey();
        if( is_null( $privateKey ) ){
            throw new Exception\Alipay( 'Missing Alipay Config -- [private_key]' );
        }
        if(file_exists($privateKey)){
            $privateKey = openssl_pkey_get_private( $privateKey );
        } else{
            $privateKey = "-----BEGIN RSA PRIVATE KEY-----\n".wordwrap( $privateKey, 64, "\n", true )."\n-----END RSA PRIVATE KEY-----";
        }
        openssl_sign( $this->getSignContent( $params ), $sign, $privateKey, OPENSSL_ALGO_SHA256 );
        $sign = base64_encode( $sign );
        return $sign;
    }

    private function getSignContent( array $params ) : string
    {
        ksort( $params );
        $stringToBeSigned = "";
        $i                = 0;
        foreach( $params as $k => $v ){
            if( $k == 'sign' ){
                continue;
            }
            if( !empty($v) && "@" != substr( $v, 0, 1 ) ){
                if( $i == 0 ){
                    $stringToBeSigned .= "$k"."="."$v";
                } else{
                    $stringToBeSigned .= "&"."$k"."="."$v";
                }
                $i ++;
            }
        }
        return $stringToBeSigned;
    }
}