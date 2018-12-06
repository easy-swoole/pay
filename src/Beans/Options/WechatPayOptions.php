<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018/7/25
 * Time: 上午12:02
 */

namespace EasySwoole\EasyPay\Beans\Options;

use EasySwoole\Spl\SplBean;

/**
 * 微信支付参数
 * Class WechatPayOptions
 * @package EasySwoole\EasyPay\Beans\Options
 */
class WechatPayOptions extends SplBean
{
    protected $appId;
    protected $mchId;
    protected $secretKey;
    protected $notifyUrl = '';

    protected $apiClientCert;
    protected $apiClientKey;

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
    public function getMchId()
    {
        return $this->mchId;
    }

    /**
     * @param mixed $mchId
     */
    public function setMchId($mchId): void
    {
        $this->mchId = $mchId;
    }

    /**
     * @return mixed
     */
    public function getSecretKey()
    {
        return $this->secretKey;
    }

    /**
     * @param mixed $secretKey
     */
    public function setSecretKey($secretKey): void
    {
        $this->secretKey = $secretKey;
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
    public function getApiClientCert()
    {
        return $this->apiClientCert;
    }

    /**
     * @param mixed $apiClientCert
     */
    public function setApiClientCert($apiClientCert): void
    {
        $this->apiClientCert = $apiClientCert;
    }

    /**
     * @return mixed
     */
    public function getApiClientKey()
    {
        return $this->apiClientKey;
    }

    /**
     * @param mixed $apiClientKey
     */
    public function setApiClientKey($apiClientKey): void
    {
        $this->apiClientKey = $apiClientKey;
    }
}