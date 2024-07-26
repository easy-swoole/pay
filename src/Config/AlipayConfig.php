<?php

namespace EasySwoole\Pay\Config;

use EasySwoole\Pay\Beans\Alipay\Gateway;
use EasySwoole\Spl\SplBean;

class AlipayConfig extends SplBean
{
    protected $appId;
    protected $notifyUrl;
    protected $returnUrl;
    protected $publicKey;
    protected $privateKey;
    protected Gateway $gateWay = Gateway::PRODUCE;
    protected $charset = "utf-8";
    protected $format = "JSON";
    protected $signType = "RSA2";
    protected $apiVersion = "1.0";
    protected $appAuthToken;

    /**
     * @return mixed
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @param mixed $appId
     */
    public function setAppId($appId): void
    {
        $this->appId = $appId;
    }

    /**
     * @return mixed
     */
    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }

    /**
     * @param mixed $notifyUrl
     */
    public function setNotifyUrl($notifyUrl): void
    {
        $this->notifyUrl = $notifyUrl;
    }

    /**
     * @return mixed
     */
    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    /**
     * @param mixed $returnUrl
     */
    public function setReturnUrl($returnUrl): void
    {
        $this->returnUrl = $returnUrl;
    }

    /**
     * @return mixed
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    /**
     * @param mixed $publicKey
     */
    public function setPublicKey($publicKey): void
    {
        $this->publicKey = $publicKey;
    }

    /**
     * @return mixed
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * @param mixed $privateKey
     */
    public function setPrivateKey($privateKey): void
    {
        $this->privateKey = $privateKey;
    }

    public function getGateWay(): Gateway
    {
        return $this->gateWay;
    }

    public function setGateWay(Gateway $gateWay): void
    {
        $this->gateWay = $gateWay;
    }

    public function getCharset(): string
    {
        return $this->charset;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function getSignType(): string
    {
        return $this->signType;
    }

    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    public function setApiVersion(string $apiVersion): void
    {
        $this->apiVersion = $apiVersion;
    }

    /**
     * @return mixed
     */
    public function getAppAuthToken()
    {
        return $this->appAuthToken;
    }

    /**
     * @param mixed $appAuthToken
     */
    public function setAppAuthToken($appAuthToken): void
    {
        $this->appAuthToken = $appAuthToken;
    }
}