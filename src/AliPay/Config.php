<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 11:42
 */

namespace EasySwoole\Pay\AliPay;


use EasySwoole\Spl\SplBean;

class Config extends SplBean
{
	protected $appId;
	protected $notifyUrl;
	protected $returnUrl;
	protected $publicKey;
	protected $privateKey;
	protected $gateWay = GateWay::SANDBOX;
	protected $charset = "utf-8";
	protected $format = "JSON";
	protected $signType = "RSA2";
    protected $apiVersion = "1.0";
    protected $appAuthToken;

    // 支付宝 证书方式

    /** @var bool $certMode */
    protected $certMode = false;
    /** @var string $certPath */
    protected $certPath; // 支付宝公钥文件路径
    /** @var string $rootCertPath */
    protected $rootCertPath; // 支付宝根证书文件路径
    /** @var string $merchantCertPath */
    protected $merchantCertPath; // 应用公钥证书文件路径

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
	public function setAppId( $appId ) : void
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
	public function setNotifyUrl( $notifyUrl ) : void
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
	public function setReturnUrl( $returnUrl ) : void
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
	public function setPublicKey( $publicKey ) : void
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
	public function setPrivateKey( $privateKey ) : void
	{
		$this->privateKey = $privateKey;
	}

	/**
	 * @return string
	 */
	public function getGateWay() : string
	{
		return $this->gateWay;
	}

	/**
	 * @param string $gateWay
	 */
	public function setGateWay( string $gateWay ) : void
	{
		$this->gateWay = $gateWay;
	}

	/**
	 * @return string
	 */
	public function getCharset() : string
	{
		return $this->charset;
	}

	/**
	 * @param string $charset
	 */
	public function setCharset( string $charset ) : void
	{
		$this->charset = $charset;
	}

	/**
	 * @return string
	 */
	public function getFormat() : string
	{
		return $this->format;
	}

	/**
	 * @param string $format
	 */
	public function setFormat( string $format ) : void
	{
		$this->format = $format;
	}

	/**
	 * @return string
	 */
	public function getSignType() : string
	{
		return $this->signType;
	}

	/**
	 * @param string $signType
	 */
	public function setSignType( string $signType ) : void
	{
		$this->signType = $signType;
	}

    /**
     * @return string
     */
    public function getApiVersion(): string
    {
        return $this->apiVersion;
    }

    /**
     * @param string $apiVersion
     */
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

    /**
     * @return bool
     */
    public function isCertMode(): bool
    {
        return $this->certMode;
    }

    /**
     * @param bool $certMode
     */
    public function setCertMode(bool $certMode): void
    {
        $this->certMode = $certMode;
    }

    /**
     * @return string
     */
    public function getCertPath(): ?string
    {
        return $this->certPath;
    }

    /**
     * @param string $certPath
     */
    public function setCertPath(string $certPath): void
    {
        $this->certPath = $certPath;
    }

    /**
     * @return string
     */
    public function getRootCertPath(): ?string
    {
        return $this->rootCertPath;
    }

    /**
     * @param string $rootCertPath
     */
    public function setRootCertPath(string $rootCertPath): void
    {
        $this->rootCertPath = $rootCertPath;
    }

    /**
     * @return string
     */
    public function getMerchantCertPath(): ?string
    {
        return $this->merchantCertPath;
    }

    /**
     * @param string $merchantCertPath
     */
    public function setMerchantCertPath(string $merchantCertPath): void
    {
        $this->merchantCertPath = $merchantCertPath;
    }
}