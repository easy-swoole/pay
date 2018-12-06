<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018/7/25
 * Time: 上午12:08
 */

namespace EasySwoole\EasyPay\Gateway;

use EasySwoole\EasyPay\Beans\Options\WechatPayOptions;
use EasySwoole\EasyPay\Beans\Wechat\Request\ScanRequest;
use EasySwoole\EasyPay\Beans\Wechat\Response\ScanResponse;
use EasySwoole\EasyPay\Beans\Wechat\Response\UnifiedResponse;
use EasySwoole\EasyPay\Tools\Str;
use EasySwoole\EasyPay\Tools\Validate;

/**
 * 微信支付网关
 * Class Wechat
 * @package EasySwoole\EasyPay\Gateway
 */
class Wechat extends AbstractGateway
{
    protected $basePayload;
    protected $wechatOptions;
    protected $remoteGateway;

    function __construct(WechatPayOptions $wechatOptions, $isSandBox)
    {
        $this->wechatOptions = $wechatOptions;
        $this->remoteGateway = $isSandBox ? 'https://api.mch.weixin.qq.com/sandboxnew/' : 'https://api.mch.weixin.qq.com/';
        $this->initBasePayload();
    }

    /**
     * 发起扫码支付
     * @param ScanRequest $request
     * @param string $clientRealIp
     * @author: eValor < master@evalor.cn >
     * @return ScanResponse
     */
    function scan(ScanRequest $request, $clientRealIp = '0.0.0.0')
    {
        $payload = array_merge($this->basePayload, $request->toArray(null));
        $payload['trade_type'] = 'NATIVE';
        $payload['spbill_create_ip'] = $clientRealIp;
        return new ScanResponse($this->unified($payload)->toArray(), true);
    }

    /**
     * 准备请求基础载荷
     * @author: eValor < master@evalor.cn >
     */
    private function initBasePayload()
    {
        $this->basePayload = [
            'appid'            => $this->wechatOptions->getAppId(),
            'mch_id'           => $this->wechatOptions->getMchId(),
            'nonce_str'        => Str::nonce(),
            'notify_url'       => $this->wechatOptions->getNotifyUrl(),
            'sign'             => '',
            'trade_type'       => '',
            'spbill_create_ip' => '',
        ];
    }

    /**
     * 进行统一下单操作
     * @param $payload
     * @author: eValor < master@evalor.cn >
     * @return UnifiedResponse
     */
    protected function unified($payload)
    {
        $payload = Validate::generateWechatSign($payload, $this->wechatOptions->getSecretKey());
        $remoteAPI = $this->remoteGateway . 'pay/unifiedorder';
        $response = $this->doWechatRequest($remoteAPI, null, $payload);
        $this->initBasePayload();
        return new UnifiedResponse($response, true);
    }
}