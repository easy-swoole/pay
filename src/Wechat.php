<?php

namespace EasySwoole\Pay;

use EasySwoole\HttpClient\Bean\Response;
use EasySwoole\HttpClient\HttpClient;
use EasySwoole\Pay\Config\WechatConfig;
use EasySwoole\Pay\Request\Wechat\App;
use EasySwoole\Pay\Request\Wechat\Callback;
use EasySwoole\Pay\Request\Wechat\H5;
use EasySwoole\Pay\Request\Wechat\JsApi;
use EasySwoole\Pay\Request\Wechat\Native;
use EasySwoole\Pay\Utility\AesGcm;
use EasySwoole\Utility\Random;
use EasySwoole\Pay\Response\Wechat\JsApi as JsApiResponse;
use EasySwoole\Pay\Response\Wechat\App as AppResponse;
use EasySwoole\Pay\Response\Wechat\H5 as H5Response;
use EasySwoole\Pay\Response\Wechat\Native as NativeResponse;

class Wechat
{
    function __construct(
        protected WechatConfig $config
    )
    {

    }

    function certificates(bool $autoDecrypt = true)
    {
        $path = "/v3/certificates";
        $resp = $this->getReuest($path);
        $json = json_decode($resp->getBody(),true);
        if(isset($json['data'])){
            $final = [];
            if($autoDecrypt){
                foreach ($json['data'] as $key => $item){
                    $str = AesGcm::decrypt($item['encrypt_certificate']['ciphertext'],$this->config->getEncryptKey(),$item['encrypt_certificate']['nonce'],$item['encrypt_certificate']['associated_data']);
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

    function jsApi(JsApi $request): JsApiResponse
    {
        $path = "/v3/pay/transactions/jsapi";
        $request->setMchid($this->config->getMchId());
        $request->setAppid($this->config->getAppId());
        $json = json_encode($request->toArray(null,$request::FILTER_NOT_NULL));
        $resp = $this->postRequest($path,$json);
        $json = json_decode($resp->getBody(),true);

        if(isset($json['prepay_id'])){
            $json['appId'] = $this->config->getAppId();
            $ret = new JsApiResponse($json);
            $ret->makeSign($this->config);
            return $ret;
        }
        throw new Exception\Wechat("jsApiPay make order error with response ".$resp->getBody());
    }

    function app(App $request):AppResponse
    {
        $path = "/v3/pay/transactions/app";
        $request->setAppid($this->config->getAppId());
        $request->setMchid($this->config->getMchId());
        $json = json_encode($request->toArray(null,$request::FILTER_NOT_NULL));
        $resp = $this->postRequest($path,$json);
        $json = json_decode($resp->getBody(),true);
        if(isset($json['prepay_id'])){
            return new AppResponse($json);
        }
        throw new Exception\Wechat("appPay make order error with response ".$resp->getBody());
    }

    function h5(H5 $request):H5Response
    {
        $path = "/v3/pay/transactions/h5";
        $request->setAppid($this->config->getAppId());
        $request->setMchid($this->config->getMchId());
        $json = json_encode($request->toArray(null,$request::FILTER_NOT_NULL));
        $resp = $this->postRequest($path,$json);
        $json = json_decode($resp->getBody(),true);
        if(isset($json['h5_url'])){
            return new H5Response($json);
        }
        throw new Exception\Wechat("H5 Pay make order error with response ".$resp->getBody());
    }

    function native(Native $request):NativeResponse
    {
        $path = "/v3/pay/transactions/native";
        $request->setAppid($this->config->getAppId());
        $request->setMchid($this->config->getMchId());
        $json = json_encode($request->toArray(null,$request::FILTER_NOT_NULL));
        $resp = $this->postRequest($path,$json);
        $json = json_decode($resp->getBody(),true);
        if(isset($json['code_url'])){
            return new NativeResponse($json);
        }
        throw new Exception\Wechat("Native Pay make order error with response ".$resp->getBody());
    }

    function query(string $transaction_id)
    {
        $path = "/v3/pay/transactions/id/{$transaction_id}?mchid={$this->config->getMchId()}";
        $ret = $this->getReuest($path);
    }

    function close(string $out_trade_no)
    {
        $path = "/v3/pay/transactions/out-trade-no/{$out_trade_no}/close";
        $ret = $this->postRequest($path,json_encode([
            "mchid"=>$this->config->getMchId()
        ]));
        if($ret->getStatusCode() == 204){
            return true;
        }else{
            return $ret->getStatusCode();
        }
    }


    protected function getReuest(string $path):Response
    {
        $token = $this->sign("GET",$path,"");
        $url = "https://api.mch.weixin.qq.com{$path}";
        $client = new HttpClient($url);
        $client->setHeader("Authorization",$token,false);
        return $client->get();
    }

    protected function postRequest(string $path,string $json):Response
    {
        $token = $this->sign("POST",$path,$json);
        $url = "https://api.mch.weixin.qq.com{$path}";
        $client = new HttpClient($url);
        $client->setHeader("Authorization",$token,false);
        return  $client->postJson($json);
    }


    private function sign(string $method,string $path,string $body)
    {
        $time = time();
        $nonce = strtoupper( Random::character(32));
        $body = "{$method}\n{$path}\n{$time}\n{$nonce}\n{$body}\n";
        openssl_sign($body, $raw_sign, $this->config->getMchPrivateKey(), 'sha256WithRSAEncryption');
        $sign = base64_encode($raw_sign);
        $schema = 'WECHATPAY2-SHA256-RSA2048 ';
        return $schema.sprintf('mchid="%s",nonce_str="%s",timestamp="%d",serial_no="%s",signature="%s"',
                $this->config->getMchId(), $nonce, $time, $this->config->getMchCertSerialNo(), $sign);
    }


    function verify(Callback $callback,?string $publicKey = null):bool
    {
        if($publicKey == null){
            $list = $this->certificates();
            if(!isset($list[$callback->getCertSerial()])){
                throw new Exception\Wechat("certificate no {$callback->getCertSerial()} not exist");
            }
            $publicKey = $list[$callback->getCertSerial()];
        }
        $body = "{$callback->getTimestamp()}\n{$callback->getNonce()}\n{$callback->getBody()}\n";
        if (($result = openssl_verify($body, base64_decode($callback->getSignature()), $publicKey['certificate'], OPENSSL_ALGO_SHA256)) === false) {
            throw new Exception\Wechat('Verified the input $message failed, please checking your $publicKey whether or nor correct.');
        }

        return $result === 1;
    }
}