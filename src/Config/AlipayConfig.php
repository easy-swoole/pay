<?php

namespace EasySwoole\Pay\Config;

use EasySwoole\Pay\Beans\Alipay\Gateway;
use EasySwoole\Spl\SplBean;

class AlipayConfig extends SplBean
{
    protected string $appId;
    protected ?string $notifyUrl = null;
    protected ?string $returnUrl = null;
    protected ?string $publicKey = null;
    protected ?string $privateKey = null;
    protected Gateway $gateWay = Gateway::PRODUCE;
    protected string $charset = "utf-8";
    protected string $format = "JSON";
    protected string $signType = "RSA2";
    protected string $apiVersion = "1.0";
    protected ?string $appAuthToken = null;

    protected bool $certMode = false;

    protected ?string $alipayPublicCertPath = null; // 支付宝公钥文件路径

    protected ?string $alipayRootCertPath = null; // 支付宝根证书文件路径

    protected ?string $appPublicCertPath = null; // 应用公钥证书文件路径

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
    public function getReturnUrl():?string
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

    public function isCertMode(): bool
    {
        return $this->certMode;
    }

    public function setCertMode(bool $certMode): void
    {
        $this->certMode = $certMode;
    }

    public function getAlipayPublicCertPath(): string
    {
        return $this->alipayPublicCertPath;
    }

    public function setAlipayPublicCertPath(string $alipayPublicCertPath): void
    {
        $this->alipayPublicCertPath = $alipayPublicCertPath;
    }

    public function getAlipayRootCertPath(): string
    {
        return $this->alipayRootCertPath;
    }

    public function setAlipayRootCertPath(string $alipayRootCertPath): void
    {
        $this->alipayRootCertPath = $alipayRootCertPath;
    }

    public function getAppPublicCertPath(): string
    {
        return $this->appPublicCertPath;
    }

    public function setAppPublicCertPath(string $appPublicCertPath): void
    {
        $this->appPublicCertPath = $appPublicCertPath;
    }
}