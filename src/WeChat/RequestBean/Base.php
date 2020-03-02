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

/**
 * 支付公共参数
 * Class Base
 * @package EasySwoole\Pay\WeChat\RequestBean
 */
abstract class Base extends SplBean
{
    // 基础支付参数
    protected $appid;
    protected $mch_id;    // 普通支付商家号为mch_id
    protected $mch_appid; // 企业付款参数 商户账号appid
    protected $mchid;     // 企业付款参数 商家号为mchid
    protected $nonce_str;
    protected $sign;
    protected $sign_type;

    // 服务商支付参数
    protected $sub_appid;
    protected $sub_mch_id;
    protected $sub_openid;

    /**
     * 初始化一个随机字符串供签名用
     * @return void
     */
    public function initialize(): void
    {
        if (empty($this->nonce_str)) {
            $this->nonce_str = Random::character(32);
        }
    }

    /**
     * 转为数组时过滤空值
     * @param array|null $columns
     * @param null $filter
     * @return array
     */
    public function toArray(array $columns = null, $filter = null): array
    {
        return parent::toArray(null, self::FILTER_NOT_NULL);
    }

    /**
     * @return mixed
     */
    public function getAppid()
    {
        return $this->appid;
    }

    /**
     * @param mixed $appid
     */
    public function setAppid($appid): void
    {
        $this->appid = $appid;
    }

    /**
     * @return mixed
     */
    public function getMchId()
    {
        return $this->mch_id;
    }

    /**
     * @param mixed $mch_id
     */
    public function setMchId($mch_id): void
    {
        $this->mch_id = $mch_id;
    }

    //----------------------企业付款新增的参数 开始 分割线-----------------------
    /**
     * @return mixed
     */
    public function getTransferMchId()
    {
        return $this->mchid;
    }
    /**
     * @param mixed $mchid
     */
    public function setTransferMchId($mchid): void
    {
        $this->mchid = $mchid;
    }
    /**
     * @return mixed
     */
    public function getMchAppId()
    {
        return $this->mch_appid;
    }

    /**
     * @param mixed $MchAppId
     */
    public function setMchAppId($MchAppId): void
    {
        $this->mch_appid = $MchAppId;
    }
    //----------------------企业付款新增的参数 结束 分割线-----------------------


    /**
     * @return mixed
     */
    public function getNonceStr()
    {
        return $this->nonce_str;
    }

    /**
     * @param mixed $nonce_str
     */
    public function setNonceStr($nonce_str): void
    {
        $this->nonce_str = $nonce_str;
    }

    /**
     * @return mixed
     */
    public function getSign()
    {
        return $this->sign;
    }

    /**
     * @param mixed $sign
     */
    public function setSign($sign): void
    {
        $this->sign = $sign;
    }

    /**
     * @return mixed
     */
    public function getSignType()
    {
        return $this->sign_type;
    }

    /**
     * @param mixed $sign_type
     */
    public function setSignType($sign_type): void
    {
        $this->sign_type = $sign_type;
    }

    /**
     * @return mixed
     */
    public function getSubAppid()
    {
        return $this->sub_appid;
    }

    /**
     * @param mixed $sub_appid
     */
    public function setSubAppid($sub_appid): void
    {
        $this->sub_appid = $sub_appid;
    }

    /**
     * @return mixed
     */
    public function getSubMchId()
    {
        return $this->sub_mch_id;
    }

    /**
     * @param mixed $sub_mch_id
     */
    public function setSubMchId($sub_mch_id): void
    {
        $this->sub_mch_id = $sub_mch_id;
    }

    /**
     * @return mixed
     */
    public function getSubOpenid()
    {
        return $this->sub_openid;
    }

    /**
     * @param mixed $sub_openid
     */
    public function setSubOpenid($sub_openid): void
    {
        $this->sub_openid = $sub_openid;
    }
}