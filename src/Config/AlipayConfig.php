<?php

namespace EasySwoole\Pay\Config;

use EasySwoole\Pay\Beans\Alipay\Gateway;
use EasySwoole\Spl\SplBean;

class AlipayConfig extends SplBean
{
    protected string $appId;
    protected ?string $notifyUrl = null;
    protected ?string $returnUrl = null;
    protected ?string $alipayPublicKey = null;//支付宝公钥
    protected ?string $appPrivateKey = null;//应用私钥
    protected Gateway $gateWay = Gateway::PRODUCE;
    protected string $charset = "utf-8";
    protected string $format = "JSON";
    protected string $signType = "RSA2";
    protected string $apiVersion = "1.0";
    protected ?string $appAuthToken = null;

    protected bool $certMode = false;

    protected ?string $alipayPublicCert = null; // 支付宝公钥文件路径

    protected ?string $alipayRootCert = null; // 支付宝根证书文件路径

    protected ?string $appPublicCert = null; // 应用公钥证书文件路径

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
    public function getAlipayPublicKey()
    {
        return $this->alipayPublicKey;
    }

    /**
     * @param mixed $alipayPublicKey
     */
    public function setAlipayPublicKey($alipayPublicKey): void
    {
        $this->alipayPublicKey = $alipayPublicKey;
    }

    /**
     * @return mixed
     */
    public function getAppPrivateKey()
    {
        return $this->appPrivateKey;
    }

    /**
     * @param mixed $appPrivateKey
     */
    public function setAppPrivateKey($appPrivateKey): void
    {
        $this->appPrivateKey = $appPrivateKey;
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

    public function getAlipayPublicCert(): string
    {
        return $this->alipayPublicCert;
    }

    public function setAlipayPublicCert(string $alipayPublicCert): void
    {
        $this->alipayPublicCert = $alipayPublicCert;
    }

    public function getAlipayRootCert(): ?string
    {
        return $this->alipayRootCert;
    }

    public function setAlipayRootCert(string $alipayRootCert): void
    {
        $this->alipayRootCert = $alipayRootCert;
    }

    public function getAppPublicCert(): string
    {
        return $this->appPublicCert;
    }

    public function setAppPublicCert(string $appPublicCert): void
    {
        $this->appPublicCert = $appPublicCert;
    }
}
