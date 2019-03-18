<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2019-02-15
 * Time: 19:19
 */

namespace EasySwoole\Pay\WeChat\RequestBean;


use EasySwoole\Spl\SplBean;
use EasySwoole\Utility\Random;


abstract class Base extends SplBean
{
    protected $appid;            //是
    protected $mch_id;           //是
    protected $nonce_str;        //是
    protected $sign;             //是
    protected $sign_type;        //否，默认为md5


    public function getAppId(): string
    {
        return $this->appid;
    }

    public function setAppId(string $appId): void
    {
        $this->appid = $appId;
    }

    public function getMchId(): string
    {
        return $this->mch_id;
    }

    public function setMchId(string $mchId): void
    {
        $this->mch_id = $mchId;
    }

    public function getNonceStr(): string
    {
        return $this->nonce_str;
    }

    public function setNonceStr(string $nonceStr): void
    {
        $this->nonce_str = $nonceStr;
    }


    public function getSignType(): ?string
    {
        return $this->sign_type;
    }

    public function setSignType(string $signType): void
    {
        $this->sign_type = $signType;
    }

    public function setSign(string $sign): void
    {
        $this->sign = $sign;
    }

    public function getSign(): string
    {
        return $this->sign;
    }

    public function initialize(): void
    {
        if (empty($this->nonce_str)) {
            $this->nonce_str = Random::character(32);
        }
    }

    public function toArray(array $columns = null, $filter = null): array
    {
        return parent::toArray(null, self::FILTER_NOT_NULL);
    }
}