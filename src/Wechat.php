<?php

namespace EasySwoole\Pay;

use EasySwoole\HttpClient\Bean\Response;
use EasySwoole\HttpClient\HttpClient;
use EasySwoole\Pay\Config\WechatConfig;
use EasySwoole\Pay\Request\Wechat\App;
use EasySwoole\Pay\Request\Wechat\H5;
use EasySwoole\Pay\Request\Wechat\JsApi;
use EasySwoole\Utility\Random;
use EasySwoole\Pay\Response\Wechat\JsApi as JsApiResponse;
use EasySwoole\Pay\Response\Wechat\App as AppResponse;
use EasySwoole\Pay\Response\Wechat\H5 as H5Response;

class Wechat
{
    function __construct(
        protected WechatConfig $config
    )
    {

    }

    function jsApi(JsApi $request): JsApiResponse
    {
        $path = "/v3/pay/transactions/jsapi";
        $request->setAppid($this->config->getAppId());
        $json = json_encode($request->toArray(null,$request::FILTER_NOT_NULL));
        $resp = $this->postRequest($path,$json);
        $json = json_decode($resp->getBody(),true);

        if(isset($json['prepay_id'])){
            return new JsApiResponse($json);
        }
        throw new Exception\Wechat("jsApiPay make order error with response ".$resp->getBody());
    }

    function app(App $request)
    {
        $path = "/v3/pay/transactions/app";
        $request->setAppid($this->config->getAppId());
        $json = json_encode($request->toArray(null,$request::FILTER_NOT_NULL));
        $resp = $this->postRequest($path,$json);
        $json = json_decode($resp->getBody(),true);
        if(isset($json['prepay_id'])){
            return new AppResponse($json);
        }
        throw new Exception\Wechat("appPay make order error with response ".$resp->getBody());
    }

    function h5(H5 $request)
    {
        $path = "/v3/pay/transactions/h5";
        $request->setAppid($this->config->getAppId());
        $json = json_encode($request->toArray(null,$request::FILTER_NOT_NULL));
        $resp = $this->postRequest($path,$json);
        $json = json_decode($resp->getBody(),true);
        if(isset($json['h5_url'])){
            return new H5Response($json);
        }
        throw new Exception\Wechat("H5 Pay make order error with response ".$resp->getBody());
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


    protected function getReuest(string $path):array
    {
        $token = $this->sign("GET",$path,"");
        $url = "https://api.mch.weixin.qq.com{$path}";
        $client = new HttpClient($url);
        $client->setHeader("Authorization",$token,false);
        $resp = $client->get();
        if(!empty($resp->getErrMsg())){
            throw new Exception\Wechat("Request Error case {$resp->getErrMsg()}");
        }
        $json = json_decode($resp->getBody(),true);
        if(is_array($json)){
            return $json;
        }
        throw new Exception\Wechat("Request Error with response {$resp->getBody()}");
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

}