<?php

namespace EasySwoole\Pay;

use EasySwoole\HttpClient\HttpClient;
use EasySwoole\Pay\Beans\Alipay\BaseBean;
use EasySwoole\Pay\Beans\Alipay\Gateway;
use EasySwoole\Pay\Beans\Alipay\RoyaltyDetail;
use EasySwoole\Pay\Beans\Alipay\RoyaltyEntity;
use EasySwoole\Pay\Beans\Proxy;
use EasySwoole\Pay\Config\AlipayConfig;
use EasySwoole\Pay\Exception\AlipayApiError;
use EasySwoole\Pay\Request\Alipay\BaseRequest;
use EasySwoole\Pay\Request\Alipay\OAuthToken;
use EasySwoole\Pay\Request\Alipay\OffLineQrCode;
use EasySwoole\Pay\Request\Alipay\OrderSettle;
use EasySwoole\Pay\Request\Alipay\OrderSettleQuery;
use EasySwoole\Pay\Request\Alipay\OrderSettleRateQuery;
use EasySwoole\Pay\Request\Alipay\OrderSettleRelationBind;
use EasySwoole\Pay\Request\Alipay\OrderSettleRelationQuery;
use EasySwoole\Pay\Request\Alipay\OrderSettleRelationUnBind;
use EasySwoole\Pay\Request\Alipay\OrderUnSettleQuery;
use EasySwoole\Pay\Request\Alipay\PreQrCode;
use EasySwoole\Pay\Request\Alipay\RedPacketPay;
use EasySwoole\Pay\Request\Alipay\TradeClose;
use EasySwoole\Pay\Request\Alipay\TradeQuery;
use EasySwoole\Pay\Request\Alipay\TradeRefund;
use EasySwoole\Pay\Request\Alipay\Wap;
use EasySwoole\Pay\Request\Alipay\Web;
use EasySwoole\Utility\Random;

class Alipay
{

    private string $gateway;
    private string $apiV3GateWay;

    private ?Proxy $proxy = null;

    function __construct(
        protected AlipayConfig $config
    )
    {
        if($this->config->getGateWay() == Gateway::PRODUCE){
            $this->gateway = 'https://openapi.alipay.com/gateway.do';
            $this->apiV3GateWay = 'https://openapi.alipay.com';
        }else{
            $this->gateway = 'https://openapi-sandbox.dl.alipaydev.com/gateway.do';
            $this->apiV3GateWay = 'https://openapi-sandbox.dl.alipaydev.com';
        }
    }


    /*
     * 当面付，预先生成二维码
     */
    function preQrCode(PreQrCode $request): Response\AliPay\PreQrCode
    {
        $res = $this->requestApi($request,'alipay.trade.precreate');
        return new Response\AliPay\PreQrCode($res);
    }

    /**
     * 订单码
     * @param OffLineQrCode $request
     * @return Response\AliPay\OffLineQrCode
     * @throws AlipayApiError
     * @throws Exception\Alipay
     */
    function offLineQrCode(OffLineQrCode $request):Response\AliPay\OffLineQrCode
    {
        $res = $this->requestApi($request,'alipay.trade.precreate');
        return new Response\AliPay\OffLineQrCode($res);
    }

    function wap(Wap $request):string
    {
        $data = $this->buildRequestData($request,'alipay.trade.wap.pay');
        return $this->gateway.'?'.http_build_query($data);
    }

    function web(Web $request):string
    {
        $data = $this->buildRequestData($request,'alipay.trade.page.pay');
        return $this->gateway.'?'.http_build_query($data);
    }

    function redPacketPayApp(RedPacketPay $request):array
    {
        return $this->buildRequestData($request,'alipay.fund.trans.app.pay');
    }

    function orderSettle(OrderSettle $request):Response\AliPay\OrderSettle
    {
        $res = $this->requestApi($request,'alipay.trade.order.settle');
        return new Response\AliPay\OrderSettle($res);
    }

    function orderSettleRelationBind(OrderSettleRelationBind $request):Response\AliPay\OrderSettleRelationBind
    {
        $res = $this->requestApi($request,'alipay.trade.royalty.relation.bind');
        return new Response\AliPay\OrderSettleRelationBind($res);
    }

    function orderSettleRelationUnBind(OrderSettleRelationUnBind $request):Response\AliPay\OrderSettleRelationUnBind
    {
        $res = $this->requestApi($request,'alipay.trade.royalty.relation.unbind');
        return new Response\AliPay\OrderSettleRelationUnBind($res);
    }

    function orderSettleRelationQuery(OrderSettleRelationQuery $request):Response\AliPay\OrderSettleRelationQuery
    {
        $res = $this->requestApi($request,'alipay.trade.royalty.relation.batchquery');
        $res = new Response\AliPay\OrderSettleRelationQuery($res);
        $temp = $res->receiver_list;
        $res->receiver_list = [];
        foreach ($temp as $item){
            $res->receiver_list[] = new RoyaltyEntity($item);
        }
        return $res;
    }

    function orderSettleQuery(OrderSettleQuery $request):Response\AliPay\OrderSettleQuery
    {
        $res = $this->requestApi($request,'alipay.trade.order.settle.query');
        $res = new Response\AliPay\OrderSettleQuery($res);
        $temp = $res->royalty_detail_list;
        $res->royalty_detail_list = [];
        foreach ($temp as $item){
            $res->royalty_detail_list[] = new RoyaltyDetail($item);
        }
        return $res;
    }

    function orderSettleRateQuery(OrderSettleRateQuery $request):Response\AliPay\OrderSettleRateQuery
    {
        $res = $this->requestApi($request,'alipay.trade.royalty.rate.query');
        return new Response\AliPay\OrderSettleRateQuery($res);
    }

    function orderUnSettleQuery(OrderUnSettleQuery $request):Response\AliPay\OrderUnSettleQuery
    {
        $res = $this->requestApi($request,'alipay.trade.order.onsettle.query');
        return new Response\AliPay\OrderUnSettleQuery($res);
    }

    function tradeQuery(TradeQuery $request):Response\AliPay\TradeQuery
    {
        $res = $this->requestApi($request,'alipay.trade.query');
        return new Response\AliPay\TradeQuery($res);
    }

    function tradeClose(TradeClose $request):Response\AliPay\TradeClose
    {
        $res = $this->requestApi($request,'alipay.trade.close');
        return new Response\AliPay\TradeClose($res);
    }


    function tradeRefund(TradeRefund $request):Response\AliPay\TradeRefund
    {
        $res = $this->requestApi($request,'alipay.trade.refund');
        return new Response\AliPay\TradeRefund($res);
    }

    /**
     * 换取授权访问令牌
     */
    function token(OAuthToken $request): Response\AliPay\OAuthToken
    {
        $path = '/v3/alipay/system/oauth/token';
        $body = [
            'grant_type' => $request->grant_type
        ];
        if (!empty($request->code)) {
            $body['code'] = $request->code;
        }
        if (!empty($request->refresh_token)) {
            $body['refresh_token'] = $request->refresh_token;
        }
        $url = $this->apiV3GateWay . $path;
        $res = $this->requestV3($url, 'POST', $body);
        return new Response\AliPay\OAuthToken($res);
    }

    function userInfo(string $authToken)
    {
        $path = '/v3/alipay/user/info/share';
        $queryParams = ['auth_token' => $authToken];
        $url = $this->apiV3GateWay . $path . '?' . http_build_query($queryParams);
        return $this->requestV3($url,'POST',[]);
    }

    function verifyResponse(array $requestData)
    {
        if( isset( $requestData['fund_bill_list'] ) ){
            $requestData['fund_bill_list'] = htmlspecialchars_decode( $requestData['fund_bill_list'] );
        }

        return $this->verifySign( $requestData );
    }

    public static function success() : string
    {
        return 'success';
    }


    public static function fail() : string
    {
        return 'failure';
    }

    protected function buildRequestData(BaseBean $request,string $method):array
    {
        $baseRequest = $this->getBaseParams();
        $baseRequest->method = $method;
        /**
         * 检查notify url 和 return_url
         */
        if(isset($request->notify_url)){
            $baseRequest->notify_url = $request->notify_url;
        }

        if(isset($request->return_url)){
            $baseRequest->return_url = $request->return_url;
        }

        $baseRequest->biz_content = json_encode($request->toArray());
        $requestData = $baseRequest->toArray();
        $sign = $this->generateSign($requestData);
        $requestData['sign'] = $sign;
        return $requestData;
    }

    protected function requestApi(BaseBean $request,string $method)
    {
        $requestData = $this->buildRequestData($request,$method);
        $client = new HttpClient($this->gateway);
        if(!empty($this->proxy)){
            $client->setClientSettings($this->proxy->toArray());
        }

        $res = $client->post($requestData);
        $response = $res->getBody();
        if(!empty($response)){
            $result = json_decode( mb_convert_encoding( $res->getBody(), 'utf-8', 'gb2312' ), true );
            if(is_array($result)){
                $key =  str_replace( '.', '_', $method ).'_response';
                if($result[$key]['code'] == '10000'){
                    $v = $this->verifySign($result[$key],true,$result['sign']);
                    if($v){
                        return $result[$key];
                    }else{
                        throw new Exception\Alipay('verify api response sign error');
                    }
                }else{
                    $ex = new AlipayApiError($result[$key]['sub_msg']);
                    $ex->apiCode = $result[$key]['code'];
                    $ex->apiSubCode = $result[$key]['sub_code'];
                    $ex->apiMsg = $result[$key]['msg'];
                    throw $ex;
                }
            }else{
                throw new Exception\Alipay("response from {$this->gateway} is not a json format");
            }
        }else{
            throw new Exception\Alipay($res->getErrMsg());
        }
    }

    protected function verifySign( array $data, $sync = false, $sign = null ) : bool
    {
        unset($data['sign_type']);

        $publicKey = null;

        if ($this->config->isCertMode()) {
            $publicKey = $this->getPublicKey($this->config->getAlipayPublicCert());
        } else if ($this->config->getAlipayPublicKey()) {
            $publicKey = $this->config->getAlipayPublicKey();
            $publicKey = "-----BEGIN PUBLIC KEY-----\n".wordwrap( $publicKey, 64, "\n", true )."\n-----END PUBLIC KEY-----";
            $publicKey = openssl_pkey_get_public( $publicKey );
        }

        $sign = $sign ?? $data['sign'];

        $toVerify = $sync ? mb_convert_encoding( json_encode( $data, JSON_UNESCAPED_UNICODE ), 'gb2312', 'utf-8' ) : $this->getSignContent( $data );

        return openssl_verify( $toVerify, base64_decode( $sign ), $publicKey, OPENSSL_ALGO_SHA256 ) === 1;
    }

    protected function getPublicKey($cert):string
    {
        $pkey = openssl_pkey_get_public($cert);
        $keyData = openssl_pkey_get_details($pkey);
        return trim($keyData['key']);
    }

    protected function getCertSN($cert):string
    {
        $ssl = openssl_x509_parse($cert);
        return md5($this->array2string(array_reverse($ssl['issuer'])) . $ssl['serialNumber']);
    }

    protected function getRootCertSN($cert):?string
    {
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

    private function getBaseParams() : BaseRequest
    {
        $sysParams                   = [];
        $sysParams["app_id"]         = $this->config->getAppId();
        $sysParams["version"]        = $this->config->getApiVersion();
        $sysParams["format"]         = $this->config->getFormat();
        $sysParams["sign_type"]      = $this->config->getSignType();
        $sysParams["timestamp"]      = date( "Y-m-d H:i:s" );
        $sysParams["notify_url"]     = $this->config->getNotifyUrl();
        $sysParams["return_url"]     = $this->config->getReturnUrl();
        $sysParams["charset"]        = $this->config->getCharset();
        $sysParams["app_auth_token"] = $this->config->getAppAuthToken();
        if ($this->config->isCertMode()) {
            $sysParams["app_cert_sn"]    = $this->getCertSN($this->config->getAppPublicCert());
            $sysParams["alipay_root_cert_sn"] = $this->getRootCertSN($this->config->getAlipayRootCert());
        }
        return new BaseRequest($sysParams);
    }

    private function generateSign( array $params ) : string
    {
        $privateKey = $this->config->getAppPrivateKey();
        if( is_null( $privateKey ) ){
            throw new Exception\Alipay( 'Missing Alipay Config -- [private_key]' );
        }
//        if(file_exists($privateKey)){
//            $privateKey = openssl_pkey_get_private( $privateKey );
//        } else{
//            $privateKey = "-----BEGIN RSA PRIVATE KEY-----\n".wordwrap( $privateKey, 64, "\n", true )."\n-----END RSA PRIVATE KEY-----";
//        }
        $privateKey = "-----BEGIN RSA PRIVATE KEY-----\n".wordwrap( $privateKey, 64, "\n", true )."\n-----END RSA PRIVATE KEY-----";
        openssl_sign( $this->getSignContent( $params ), $sign, $privateKey, OPENSSL_ALGO_SHA256 );
        $sign = base64_encode( $sign );
        return $sign;
    }

    private function getSignContent( array $params , $explod = '&') : string
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
                    $stringToBeSigned .= $explod."$k"."="."$v";
                }
                $i ++;
            }
        }
        return $stringToBeSigned;
    }

    function setProxy(?Proxy $proxy):Alipay
    {
        $this->proxy = $proxy;
        return $this;
    }

    private function buildV3AuthString()
    {
        if($this->config->isCertMode()){
            $nonce = Random::makeUUIDV4();
            $timestamp = intval(microtime(true)*1000);
            $app_cert_sn = $this->getCertSN($this->config->getAppPublicCert());
            return "app_id={$this->config->getAppId()},app_cert_sn={$app_cert_sn},nonce={$nonce},timestamp={$timestamp}";
        }else{
            $nonce = Random::makeUUIDV4();
            $timestamp = intval(microtime(true)*1000);
            return "app_id={$this->config->getAppId()},nonce={$nonce},timestamp={$timestamp}";
        }
    }

    private function buildV3SignString(string $authString,string $httpMethod,string $requestUrl,array $body):string
    {
        $str = "{$authString}\n";
        $str .= "{$httpMethod}\n";
        $str .= "{$requestUrl}\n";
        if(!empty($body)){
            $body = json_encode($body);
            $str .= "{$body}\n";
        }else{
            $str .= "\n";
        }

        if(!empty($this->config->getAppAuthToken())){
            $str .= "{$this->config->getAppAuthToken()}\n";
        }

        return $str;
    }

    function requestV3(string $url,string $method,array $body)
    {
        $authString = $this->buildV3AuthString();
        $urlInfo = parse_url($url);
        $path = $urlInfo['path'];
        if(!empty($urlInfo['query'])){
            $path .= '?'.$urlInfo['query'];
        }
        $signBody = $this->buildV3SignString($authString,$method,$path,$body);

        $privateKey = $this->config->getAppPrivateKey();
        if (is_null( $privateKey)){
            throw new Exception\Alipay( 'Missing Alipay Config -- [private_key]');
        }

        $privateKey = "-----BEGIN RSA PRIVATE KEY-----\n".wordwrap( $privateKey, 64, "\n", true )."\n-----END RSA PRIVATE KEY-----";
        openssl_sign($signBody, $sign, $privateKey, OPENSSL_ALGO_SHA256 );
        $sign = base64_encode( $sign );
        $authorization = "ALIPAY-SHA256withRSA {$authString},sign={$sign}";

        $client = new HttpClient($url);
        $headers = [
            'Authorization' => $authorization,
        ];

        if ($this->config->isCertMode() && $this->config->getAlipayRootCert()) {
            $certSn = $this->getRootCertSN($this->config->getAlipayRootCert());
            if (!$certSn) {
                throw new Exception\Alipay('Alipay Config -- [alipay root cert] error');
            }
            $headers['Alipay-Root-Cert-Sn'] = $certSn;
        }

        $client->setHeaders($headers, true, false);

        if($method == "POST"){
            if (!empty($body)) {
                $body = json_encode($body);
            } else {
                $body = null;
            }
            $res = $client->postJson($body);
        }else{
            $res = $client->get();
        }


        $response = $res->getBody();
        if(!empty($response)){
            $respHeaders = $res->getHeaders();
            $verify = $this->verifyResponseV3($response, $respHeaders, true);
            if (!$verify) {
                throw new Exception\Alipay("verify api response signature error");
            }

            $json = json_decode($response,true);
            if(!is_array($json)){
                throw new Exception\Alipay("response from {$this->apiV3GateWay} is not a json format");
            }

            $statusCode = $res->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                $ex = new AlipayApiError($json['message']);
                $ex->apiCode = $json['code'];
                throw $ex;
            }

            return $json;
        }else{
            throw new Exception\Alipay($res->getErrMsg());
        }
    }

    protected function verifyResponseV3($respBody, $headers, bool $isCheckSign): bool
    {
        $sign = $headers['alipay-signature'] ?? null;
        if ($isCheckSign && !$sign) {
            return true;
        }

        $timestamp = $headers['alipay-timestamp'] ?? null;
        $nonce = $headers['alipay-nonce'] ?? null;

        //验签
        if ($this->config->isCertMode()) {
            //证书模式
            if (!$this->config->getAlipayPublicCert()) {
                throw new Exception\Alipay('支付宝公钥证书错误。请检查公钥文件格式是否正确');
            }
            $res = $this->getPublicKey($this->config->getAlipayPublicCert());
        } else {
            //公钥模式
            $publicKeyStr = $this->config->getAlipayPublicKey();
            $publicKey = "-----BEGIN PUBLIC KEY-----\n".wordwrap($publicKeyStr, 64, "\n", true )."\n-----END PUBLIC KEY-----";
            $res = openssl_pkey_get_public( $publicKey );
        }

        if (!$res) {
            if (!$this->config->getAppPrivateKey()) {
                return true;
            }
            throw new Exception\Alipay('支付宝RSA公钥错误。请检查公钥文件格式是否正确');
        }

        $content = $timestamp . "\n"
            . $nonce . "\n"
            . (!$respBody ? "" : $respBody) . "\n";
        //调用openssl内置方法验签，返回bool值
        return (openssl_verify($content, base64_decode($sign), $res, OPENSSL_ALGO_SHA256) === 1);
    }
}
