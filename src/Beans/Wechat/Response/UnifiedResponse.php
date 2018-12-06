<?php
/**
 * Created by PhpStorm.
 * User: evalor
 * Date: 2018/7/25
 * Time: 上午10:00
 */

namespace EasySwoole\EasyPay\Beans\Wechat\Response;

use EasySwoole\Spl\SplBean;

class UnifiedResponse extends SplBean
{
    protected $return_code;
    protected $return_msg;

    protected $appid;
    protected $mch_id;
    protected $device_info;
    protected $nonce_str;
    protected $sign;
    protected $result_code;
    protected $err_code;
    protected $err_code_des;

    protected $trade_type;
    protected $prepay_id;
    protected $code_url;

    const RETURN_CODE_SUCCESS = 'SUCCESS';
    const RETURN_CODE_FAIL = 'FAIL';

    /**
     * 是否存在错误
     * @return bool|null
     * @author: eValor < master@evalor.cn >
     */
    function hasError()
    {
        if ($this->return_code !== UnifiedResponse::RETURN_CODE_SUCCESS) return $this->return_msg;
        if ($this->result_code !== UnifiedResponse::RETURN_CODE_SUCCESS) return $this->err_code . ': ' . $this->err_code_des;
        return null;
    }

    /**
     * @return mixed
     */
    public function getReturnCode()
    {
        return $this->return_code;
    }

    /**
     * @param mixed $return_code
     */
    public function setReturnCode($return_code): void
    {
        $this->return_code = $return_code;
    }

    /**
     * @return mixed
     */
    public function getReturnMsg()
    {
        return $this->return_msg;
    }

    /**
     * @param mixed $return_msg
     */
    public function setReturnMsg($return_msg): void
    {
        $this->return_msg = $return_msg;
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

    /**
     * @return mixed
     */
    public function getDeviceInfo()
    {
        return $this->device_info;
    }

    /**
     * @param mixed $device_info
     */
    public function setDeviceInfo($device_info): void
    {
        $this->device_info = $device_info;
    }

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
    public function getResultCode()
    {
        return $this->result_code;
    }

    /**
     * @param mixed $result_code
     */
    public function setResultCode($result_code): void
    {
        $this->result_code = $result_code;
    }

    /**
     * @return mixed
     */
    public function getErrCode()
    {
        return $this->err_code;
    }

    /**
     * @param mixed $err_code
     */
    public function setErrCode($err_code): void
    {
        $this->err_code = $err_code;
    }

    /**
     * @return mixed
     */
    public function getErrCodeDes()
    {
        return $this->err_code_des;
    }

    /**
     * @param mixed $err_code_des
     */
    public function setErrCodeDes($err_code_des): void
    {
        $this->err_code_des = $err_code_des;
    }

    /**
     * @return mixed
     */
    public function getTradeType()
    {
        return $this->trade_type;
    }

    /**
     * @param mixed $trade_type
     */
    public function setTradeType($trade_type): void
    {
        $this->trade_type = $trade_type;
    }

    /**
     * @return mixed
     */
    public function getPrepayId()
    {
        return $this->prepay_id;
    }

    /**
     * @param mixed $prepay_id
     */
    public function setPrepayId($prepay_id): void
    {
        $this->prepay_id = $prepay_id;
    }

    /**
     * @return mixed
     */
    public function getCodeUrl()
    {
        return $this->code_url;
    }

    /**
     * @param mixed $code_url
     */
    public function setCodeUrl($code_url): void
    {
        $this->code_url = $code_url;
    }

}