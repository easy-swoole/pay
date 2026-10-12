<?php

namespace EasySwoole\Pay;

use EasySwoole\HttpClient\Bean\Response;
use EasySwoole\HttpClient\HttpClient;
use EasySwoole\Pay\Beans\Proxy;
use EasySwoole\Pay\Config\WechatConfig;
use EasySwoole\Pay\Exception\WechatApiError;
use EasySwoole\Pay\Request\Wechat\App;
use EasySwoole\Pay\Request\Wechat\Callback;
use EasySwoole\Pay\Request\Wechat\H5;
use EasySwoole\Pay\Request\Wechat\JsApi;
use EasySwoole\Pay\Request\Wechat\Native;
use EasySwoole\Pay\Response\Wechat\Query;
use EasySwoole\Pay\Utility\AesGcm;
use EasySwoole\Spl\SplArray;
use EasySwoole\Spl\SplBean;
use EasySwoole\Utility\Random;
use EasySwoole\Pay\Response\Wechat\JsApi as JsApiResponse;
use EasySwoole\Pay\Response\Wechat\App as AppResponse;
use EasySwoole\Pay\Response\Wechat\H5 as H5Response;
use EasySwoole\Pay\Response\Wechat\Native as NativeResponse;
use EasySwoole\Pay\Response\Wechat\Balance as BalanceResponse;

class Wechat
{
    private ?Proxy $proxy = null;

    function __construct(
        protected WechatConfig $config
    ){}


    function setProxy(?Proxy $proxy):Wechat
    {
        $this->proxy = $proxy;
        return $this;
    }

    function certificates(bool $autoDecrypt = true): array
    {
        $path = "/v3/certificates";
        $resp = $this->getRequest($path);
        $json = json_decode($resp->getBody(),true);
        if(isset($json['data'])){
            $final = [];
            if($autoDecrypt){
                foreach ($json['data'] as $key => $item){
                    $str = $this->decrypt($item['encrypt_certificate']['ciphertext'],$item['encrypt_certificate']['nonce'],$item['encrypt_certificate']['associated_data']);
                    if($str){
                        $json['data'][$key]['certificate'] = $str;
                    }
                }
            }

            foreach ($json['data'] as $item){
                $final[$item['serial_no']] = $item;
            }
            return $final;
        }
        throw new Exception\Wechat("get certificates error with response ".$resp->getBody());
    }

    function balance(string $accountType = 'BASIC'): BalanceResponse
    {
        $accountTypes = ['BASIC', 'OPERATION', 'FEES'];
        if (!in_array($accountType, $accountTypes, true)) {
            throw new \InvalidArgumentException('Account type must be BASIC, OPERATION or FEES.');
        }

        $path = "/v3/merchant/fund/balance/{$accountType}";
        $resp = $this->getRequest($path);
        $json = json_decode($resp->getBody(), true);
        if (isset($json['available_amount'])) {
            return new BalanceResponse($json);
        }

        $ex = new WechatApiError($json['message'] ?? 'Query merchant balance failed.');
        $ex->apiCode = $json['code'] ?? 'UNKNOWN_ERROR';
        if (isset($json['detail'])) {
            $ex->detail = $json['detail'];
        }
        throw $ex;
    }


    function decrypt(string $ciphertext, string $iv = '', string $aad = '')
    {
        return AesGcm::decrypt($ciphertext,$this->config->getEncryptKey(),$iv,$aad);
    }

    function jsApi(JsApi $request): JsApiResponse
    {
        $path = "/v3/pay/transactions/jsapi";
        $request->mchid = $this->config->getMchId();
        $request->appid = $this->config->getAppId();
        $json = json_encode(
            $request->toArray(SplBean::FILTER_NOT_NULL),
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );
        $resp = $this->postRequest($path,$json);
        $json = json_decode($resp->getBody(),true);

        if(isset($json['prepay_id'])){
            $json['appId'] = $this->config->getAppId();
            $ret = new JsApiResponse($json);
            $ret->makeSign($this->config);
            return $ret;
        }

        $ex = new WechatApiError($json['message']);
        $ex->apiCode = $json['code'];
        if(isset($json['detail'])){
            $ex->detail = $json['detail'];
        }
        throw $ex;
    }

    function app(App $request):AppResponse
    {
        $path = "/v3/pay/transactions/app";
        $request->appid = $this->config->getAppId();
        $request->mchid = $this->config->getMchId();
        $json = json_encode(
            $request->toArray(SplBean::FILTER_NOT_NULL),
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );
        $resp = $this->postRequest($path,$json);
        $json = json_decode($resp->getBody(),true);
        if(isset($json['prepay_id'])){
            $ret = new AppResponse([
                'appId' => $this->config->getAppId(),
                'partnerId' => $this->config->getMchId(),
                'prepayId' => $json['prepay_id'],
            ]);
            $ret->makeSign($this->config);
            return $ret;
        }

        $ex = new WechatApiError($json['message'] ?? 'APP payment order failed.');
        $ex->apiCode = $json['code'] ?? 'UNKNOWN_ERROR';
        if(isset($json['detail'])){
            $ex->detail = $json['detail'];
        }
        throw $ex;
    }

    function h5(H5 $request):H5Response
    {
        $path = "/v3/pay/transactions/h5";
        $request->mchid = $this->config->getMchId();
        $request->appid = $this->config->getAppId();

        $json = json_encode(
            $request->toArray(SplBean::FILTER_NOT_NULL),
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );
        $resp = $this->postRequest($path,$json);
        $json = json_decode($resp->getBody(),true);
        if(isset($json['h5_url'])){
            return new H5Response($json);
        }

        $ex = new WechatApiError($json['message']);
        $ex->apiCode = $json['code'];
        if(isset($json['detail'])){
            $ex->detail = $json['detail'];
        }
        throw $ex;
    }

    function native(Native $request):NativeResponse
    {
        $path = "/v3/pay/transactions/native";
        $request->appid = $this->config->getAppId();
        $request->mchid = $this->config->getMchId();
        $json = json_encode(
            $request->toArray(SplBean::FILTER_NOT_NULL),
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );
        $resp = $this->postRequest($path,$json);
        $json = json_decode($resp->getBody(),true);
        if(isset($json['code_url'])){
            return new NativeResponse($json);
        }

        $ex = new WechatApiError($json['message'] ?? 'Native payment order failed.');
        $ex->apiCode = $json['code'] ?? 'UNKNOWN_ERROR';
        if(isset($json['detail'])){
            $ex->detail = $json['detail'];
        }
        throw $ex;
    }

    function query(string $transaction_id)
    {
        $transactionId = rawurlencode($transaction_id);
        $mchId = rawurlencode($this->config->getMchId());
        $path = "/v3/pay/transactions/id/{$transactionId}?mchid={$mchId}";
        $resp = $this->getRequest($path);
        $json = json_decode($resp->getBody(),true);
        if(isset($json['trade_state'])){
            return new Query($json);
        }
        $ex = new WechatApiError($json['message'] ?? 'Query transaction failed.');
        $ex->apiCode = $json['code'] ?? 'UNKNOWN_ERROR';
        if(isset($json['detail'])){
            $ex->detail = $json['detail'];
        }
        throw $ex;
    }

    function queryByOutTradeNo(string $out_trade_no)
    {
        $outTradeNo = rawurlencode($out_trade_no);
        $mchId = rawurlencode($this->config->getMchId());
        $path = "/v3/pay/transactions/out-trade-no/{$outTradeNo}?mchid={$mchId}";
        $resp = $this->getRequest($path);
        $json = json_decode($resp->getBody(),true);
        if(isset($json['trade_state'])){
            return new Query($json);
        }
        $ex = new WechatApiError($json['message'] ?? 'Query transaction failed.');
        $ex->apiCode = $json['code'] ?? 'UNKNOWN_ERROR';
        if(isset($json['detail'])){
            $ex->detail = $json['detail'];
        }
        throw $ex;
    }

    function close(string $out_trade_no)
    {
        $outTradeNo = rawurlencode($out_trade_no);
        $path = "/v3/pay/transactions/out-trade-no/{$outTradeNo}/close";
        $resp = $this->postRequest($path,json_encode([
            "mchid"=>$this->config->getMchId()
        ]));

        if($resp->getStatusCode() == 204){
            return true;
        }else{
            $json = json_decode($resp->getBody(),true);
            $ex = new WechatApiError($json['message'] ?? 'Close transaction failed.');
            $ex->apiCode = $json['code'] ?? 'UNKNOWN_ERROR';
            if(isset($json['detail'])){
                $ex->detail = $json['detail'];
            }
            throw $ex;
        }
    }


    protected function getRequest(string $path):Response
    {
        $token = $this->sign("GET",$path,"");
        $url = "https://api.mch.weixin.qq.com{$path}";
        $client = new HttpClient($url);
        if(!empty($this->proxy)){
            $client->setClientSettings($this->proxy->toArray());
        }
        $client->setHeader("Authorization",$token,false);
        $client->setHeader("Accept","application/json",false);
        $response = $client->get();
        $this->verifyResponse($response);
        return $response;
    }

    protected function postRequest(string $path,string $json):Response
    {
        $token = $this->sign("POST",$path,$json);
        $url = "https://api.mch.weixin.qq.com{$path}";
        $client = new HttpClient($url);
        if(!empty($this->proxy)){
            $client->setClientSettings($this->proxy->toArray());
        }
        $client->setHeader("Authorization",$token,false);
        $client->setHeader("Accept","application/json",false);
        $response = $client->postJson($json);
        $this->verifyResponse($response);
        return $response;
    }


    private function sign(string $method,string $path,string $body)
    {
        $time = time();
        $nonce = strtoupper( Random::character(32));
        $body = "{$method}\n{$path}\n{$time}\n{$nonce}\n{$body}\n";
        openssl_sign($body, $raw_sign, $this->config->getMchApiClientKey(), OPENSSL_ALGO_SHA256);
        $sign = base64_encode($raw_sign);
        $schema = 'WECHATPAY2-SHA256-RSA2048 ';
        return $schema.sprintf('mchid="%s",nonce_str="%s",timestamp="%d",serial_no="%s",signature="%s"',
                $this->config->getMchId(), $nonce, $time, $this->config->getMchCertSerialNo(), $sign);
    }


    function verify(Callback $callback,?string $publicKey = null):bool
    {
        if($publicKey == null){
            $publicKey = $this->config->getWechatPayPublicKey();
            $publicKeyId = $this->config->getWechatPayPublicKeyId();
            if(empty($publicKey) || empty($publicKeyId)){
                throw new Exception\Wechat('Wechat Pay public key or public key ID is not configured.');
            }
            if(!hash_equals($publicKeyId, $callback->certSerial)){
                throw new Exception\Wechat("Wechat Pay public key ID {$callback->certSerial} does not match the configured ID.");
            }
        }
        $body = "{$callback->timestamp}\n{$callback->nonce}\n{$callback->body}\n";
        if (($result = openssl_verify($body, base64_decode($callback->signature), $publicKey, OPENSSL_ALGO_SHA256)) === false) {
            throw new Exception\Wechat('Verified the input $message failed, please checking your $publicKey whether or nor correct.');
        }

        return $result === 1;
    }

    private function verifyResponse(Response $response): void
    {
        $headers = array_change_key_case((array)$response->getHeaders(), CASE_LOWER);
        $requiredHeaders = [
            'wechatpay-timestamp',
            'wechatpay-nonce',
            'wechatpay-signature',
            'wechatpay-serial',
        ];
        foreach ($requiredHeaders as $header) {
            if (!isset($headers[$header])) {
                throw new Exception\Wechat("Wechat Pay response header {$header} is missing.");
            }
        }

        $publicKey = $this->config->getWechatPayPublicKey();
        $publicKeyId = $this->config->getWechatPayPublicKeyId();
        if (empty($publicKey) || empty($publicKeyId)) {
            throw new Exception\Wechat('Wechat Pay public key or public key ID is not configured.');
        }
        if (!hash_equals($publicKeyId, $headers['wechatpay-serial'])) {
            throw new Exception\Wechat("Wechat Pay public key ID {$headers['wechatpay-serial']} does not match the configured ID.");
        }

        $body = "{$headers['wechatpay-timestamp']}\n{$headers['wechatpay-nonce']}\n{$response->getBody()}\n";
        if (openssl_verify($body, base64_decode($headers['wechatpay-signature']), $publicKey, OPENSSL_ALGO_SHA256) !== 1) {
            throw new Exception\Wechat('Wechat Pay response signature verification failed.');
        }
    }

    public static function success(): string
    {
        return '<xml><return_code>SUCCESS</return_code><return_msg>OK</return_msg></xml>';
    }

    /**
     * 结果返回给微信服务器
     * @return string
     */
    public static function fail(): string
    {
        return '<xml><return_code>FAIL</return_code><return_msg>FAIL</return_msg></xml>';
    }
}
