<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 11:40
 */

namespace EasySwoole\Pay\WeChat;

use EasySwoole\Spl\SplBean;

class Config extends SplBean
{
    /**
     * @var string
     */
    protected $appid; // APP APPID 公众号 APPID 或者小程序ID
    /**
     * @var string
     */
    protected $mch_appid;// 商户账号appid 	mch_appid 	是 	wx8888888888888888 	String(128) 	申请商户号的appid或商户号绑定的appid
    /**
     * @var string
     */
    protected $miniAppId;  // 小程序 APPID
    /**
     * @var string
     */
    protected $mchId;
    /**
     * @var string
     */
    protected $key;
    /**
     * @var string
     */
    protected $notifyUrl;
    /**
     * @var string
     */
    protected $apiClientCert; //api客户端证书
    /**
     * @var string
     */
    protected $apiClientKey; // api客户端证书秘钥

    protected $signType;//签名方式

    protected $gateWay = GateWay::NORMAL;//SANDBOX

    /**
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appid;
    }

    /**
     * @param string $appid
     */
    public function setAppId(string $appid): void
    {
        $this->appid = $appid;
    }
    /**
     * @return string
     */
    public function getMchAppId(): string
    {
        return $this->mch_appid;
    }

    /**
     * @param string $mchappid
     */
    public function setMchAppId(string $mchappid): void
    {
        $this->mch_appid = $mchappid;
    }


    /**
     * @return string
     */
    public function getMiniAppId(): string
    {
        return $this->miniAppId;
    }

    /**
     * @param string $miniAppId
     */
    public function setMiniAppId(string $miniAppId): void
    {
        $this->miniAppId = $miniAppId;
    }

    /**
     * @return string
     */
    public function getMchId(): string
    {
        return $this->mchId;
    }

    /**
     * @param string $mchId
     */
    public function setMchId(string $mchId): void
    {
        $this->mchId = $mchId;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey(string $key): void
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getNotifyUrl(): ?string
    {
        return $this->notifyUrl;
    }

    /**
     * @param string $notifyUrl
     */
    public function setNotifyUrl(string $notifyUrl): void
    {
        $this->notifyUrl = $notifyUrl;
    }

    /**
     * @return string
     */
    public function getApiClientCert(): ?string
    {
        return $this->apiClientCert;
    }

    /**
     * @param string $apiClientCert
     */
    public function setApiClientCert(string $apiClientCert): void
    {
        $this->apiClientCert = $apiClientCert;
    }

    /**
     * @return string
     */
    public function getApiClientKey(): ?string
    {
        return $this->apiClientKey;
    }

    /**
     * @param string $apiClientKey
     */
    public function setApiClientKey(string $apiClientKey): void
    {
        $this->apiClientKey = $apiClientKey;
    }

    /**
     * @return string
     */
    public function getGateWay(): string
    {
        return $this->gateWay;
    }

    /**
     * @param string $gateWay
     */
    public function setGateWay(string $gateWay): void
    {
        $this->gateWay = $gateWay;
    }
}